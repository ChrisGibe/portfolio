import * as THREE from 'three';
import GUI from 'lil-gui';

import Sizes from '../../utils/Sizes';
import Time from '../../utils/Time';

import { mainVertex } from './shaders/main.vertex.glsl';
import { mainFragment } from './shaders/main.fragment.glsl';
import { brushFragment } from './shaders/brush.fragment.glsl';
import { copyFragment } from './shaders/copy.fragment.glsl';

// Distance (in normalized 0..1 space) between two interpolated brush stamps,
// so fast mouse moves still paint a continuous stroke.
const BRUSH_STEP = 0.008;
// Brush diameter in clip space (full canvas width = 2).
const BRUSH_SIZE = 0.35;
// How long (ms) a painted spot stays fully revealed before it starts fading.
const HOLD_DURATION = 100;
// How long (ms) the fade back to the initial image then takes.
const FADE_DURATION = 400;
// Total energy lifetime, and the energy level below which the fade begins.
const ENERGY_LIFETIME = HOLD_DURATION + FADE_DURATION;
const HOLD_THRESHOLD = FADE_DURATION / ENERGY_LIFETIME;
// How ragged the brush edge is — gives the painterly / organic outline.
const EDGE_ROUGHNESS = 0;
// Spatial scale of the paint grain anchored to the screen.
const GRAIN_SCALE = 3.0;
// Living ripple on the reveal boundary (mask only, the image never moves).
const FLOW_AMPLITUDE = 0.005;
const FLOW_SCALE = 2.5;
// Sand dissolve: higher frequency = finer grains; softness = width of the
// granular transition band along the edge.
const GRAIN_FREQUENCY = 90.0;
const GRAIN_SOFTNESS = 0.3;

// Momentum after the mouse stops. Friction nearer 1 = glides further; the cutoff
// is the speed (clip units / frame) below which the glide stops.
const MOMENTUM_FRICTION = 0.88;
const MOMENTUM_MIN_SPEED = 0.0001;

export class AboutExperience {
    constructor() {
        this.canvas = document.getElementById('about-experience-canvas');

        if (!this.canvas) {
            console.warn('AboutExperience: #about-experience-canvas not found');
            return;
        }

        this.textureUrl = this.canvas.dataset.texture;
        this.textureUrl2 = this.canvas.dataset.textureReveal;

        // Tweakable settings (exposed through the lil-gui debug panel)
        this.settings = {
            brushSize: BRUSH_SIZE,
            edgeRoughness: EDGE_ROUGHNESS,
            grainScale: GRAIN_SCALE,
            flowAmplitude: FLOW_AMPLITUDE,
            flowScale: FLOW_SCALE,
            grainFrequency: GRAIN_FREQUENCY,
            grainSoftness: GRAIN_SOFTNESS,
            holdDuration: HOLD_DURATION,
            fadeDuration: FADE_DURATION,
            momentumFriction: MOMENTUM_FRICTION,
            momentumMinSpeed: MOMENTUM_MIN_SPEED,
        };

        // Utils
        this.sizes = new Sizes();
        this.time = new Time();

        // Brush stamps queued since the last frame
        this.points = [];

        // Momentum: the paint position keeps gliding in the last direction after
        // the mouse stops, slowed down by friction (a "push" / throw feel).
        this.painter = null; // current paint position (clip space)
        this.velocity = { x: 0, y: 0 };
        this.movedThisFrame = false;

        this.init();
    }

    init() {
        this.setRenderer();
        this.setScene();
        this.setMask();
        this.setPlane();
        this.loadTextures();
        this.bindEvents();
        this.setDebug();
    }

    setRenderer() {
        this.renderer = new THREE.WebGLRenderer({
            canvas: this.canvas,
            antialias: true,
            alpha: true,
        });
        this.renderer.setSize(this.sizes.width, this.sizes.height);
        this.renderer.setPixelRatio(this.sizes.pixelRatio);
        // Pass the sRGB image bytes straight through (no double conversion)
        this.renderer.outputColorSpace = THREE.LinearSRGBColorSpace;
    }

    setScene() {
        this.scene = new THREE.Scene();
        // Orthographic frustum maps exactly to -1..1, so a 2x2 plane fills the canvas
        this.camera = new THREE.OrthographicCamera(-1, 1, 1, -1, 0, 10);
        this.camera.position.set(0, 0, 1);
    }

    setMask() {
        this.maskRead = this.createMaskTarget();
        this.maskWrite = this.createMaskTarget();
        this.clearMaskTargets();

        // Persistence pass: copies the previous mask (with optional decay)
        this.copyScene = new THREE.Scene();
        this.copyMaterial = new THREE.ShaderMaterial({
            vertexShader: mainVertex,
            fragmentShader: copyFragment,
            uniforms: {
                uPrev: { value: null },
                uFade: { value: 0 },
            },
            depthTest: false,
            depthWrite: false,
        });
        this.copyScene.add(new THREE.Mesh(new THREE.PlaneGeometry(2, 2), this.copyMaterial));

        // Brush pass: an organic, painterly disc stamped at each mouse position
        this.maskScene = new THREE.Scene();
        this.brushMaterial = new THREE.ShaderMaterial({
            vertexShader: mainVertex,
            fragmentShader: brushFragment,
            uniforms: {
                uCenter: { value: new THREE.Vector2(0, 0) },
                uRoughness: { value: EDGE_ROUGHNESS },
                uGrainScale: { value: GRAIN_SCALE },
            },
            transparent: true,
            blending: THREE.AdditiveBlending,
            depthTest: false,
            depthWrite: false,
        });
        this.brush = new THREE.Mesh(new THREE.PlaneGeometry(1, 1), this.brushMaterial);
        this.updateBrushScale();
        this.maskScene.add(this.brush);
    }

    createMaskTarget() {
        return new THREE.WebGLRenderTarget(
            this.sizes.width * this.sizes.pixelRatio,
            this.sizes.height * this.sizes.pixelRatio,
            {
                minFilter: THREE.LinearFilter,
                magFilter: THREE.LinearFilter,
            }
        );
    }

    clearMaskTargets() {
        this.renderer.setClearColor(0x000000, 0);
        this.renderer.setRenderTarget(this.maskRead);
        this.renderer.clear();
        this.renderer.setRenderTarget(this.maskWrite);
        this.renderer.clear();
        this.renderer.setRenderTarget(null);
    }

    // Keep the brush disc circular despite the stretched -1..1 frustum
    updateBrushScale() {
        const aspect = this.sizes.width / this.sizes.height;
        const size = this.settings.brushSize;
        this.brush.scale.set(size, size * aspect, 1);
    }

    setPlane() {
        this.material = new THREE.ShaderMaterial({
            vertexShader: mainVertex,
            fragmentShader: mainFragment,
            uniforms: {
                uTexture1: { value: null },
                uTexture2: { value: null },
                uMask: { value: this.maskRead.texture },
                uResolution: {
                    value: new THREE.Vector2(this.sizes.width, this.sizes.height),
                },
                uImageResolution: { value: new THREE.Vector2(1, 1) },
                uFlowAmplitude: { value: FLOW_AMPLITUDE },
                uFlowScale: { value: FLOW_SCALE },
                uGrainFrequency: { value: GRAIN_FREQUENCY },
                uGrainSoftness: { value: GRAIN_SOFTNESS },
                uHoldThreshold: { value: HOLD_THRESHOLD },
            },
        });

        this.mesh = new THREE.Mesh(new THREE.PlaneGeometry(2, 2), this.material);
        this.scene.add(this.mesh);
    }

    loadTextures() {
        const loader = new THREE.TextureLoader();

        if (this.textureUrl) {
            loader.load(this.textureUrl, (texture) => {
                this.material.uniforms.uTexture1.value = texture;
                this.material.uniforms.uImageResolution.value.set(
                    texture.image.width,
                    texture.image.height
                );
            });
        } else {
            console.warn('AboutExperience: no data-texture provided on canvas');
        }

        if (this.textureUrl2) {
            loader.load(this.textureUrl2, (texture) => {
                this.material.uniforms.uTexture2.value = texture;
            });
        } else {
            console.warn('AboutExperience: no data-texture-reveal provided on canvas');
        }
    }

    bindEvents() {
        this.sizes.on('resize', () => this.resize());
        this.time.on('tick', () => this.update());
        this.canvas.addEventListener('pointermove', (event) => this.onPointerMove(event));
    }

    onPointerMove(event) {
        const rect = this.canvas.getBoundingClientRect();
        const x = (event.clientX - rect.left) / rect.width;
        const y = (event.clientY - rect.top) / rect.height;

        // Convert to clip space; flip Y (DOM top-left -> WebGL bottom-left)
        const point = {
            x: x * 2 - 1,
            y: (1 - y) * 2 - 1,
        };

        if (this.painter) {
            // Record the move direction/speed so the glide can continue it
            this.velocity.x = point.x - this.painter.x;
            this.velocity.y = point.y - this.painter.y;
            this.interpolate(this.painter, point);
        }

        this.points.push(point);
        this.painter = { x: point.x, y: point.y };
        this.movedThisFrame = true;
    }

    // After the mouse stops, keep gliding the paint position along the last
    // velocity, decelerating with friction, until it is slow enough to stop.
    applyMomentum() {
        if (!this.painter) {
            return;
        }

        if (Math.hypot(this.velocity.x, this.velocity.y) < this.settings.momentumMinSpeed) {
            return;
        }

        const previous = { x: this.painter.x, y: this.painter.y };
        this.painter.x += this.velocity.x;
        this.painter.y += this.velocity.y;

        this.points.push({ x: this.painter.x, y: this.painter.y });
        this.interpolate(previous, this.painter);

        this.velocity.x *= this.settings.momentumFriction;
        this.velocity.y *= this.settings.momentumFriction;
    }

    // Fill the gap between two stamps so fast strokes stay continuous
    interpolate(from, to) {
        const dx = to.x - from.x;
        const dy = to.y - from.y;
        const distance = Math.hypot(dx, dy);
        const steps = Math.min(Math.floor(distance / BRUSH_STEP), 64);

        for (let i = 1; i < steps; i++) {
            const t = i / steps;
            this.points.push({
                x: from.x + dx * t,
                y: from.y + dy * t,
            });
        }
    }

    drawMask() {
        const renderer = this.renderer;

        // 1. Carry the previous mask forward (persistence / decay)
        this.copyMaterial.uniforms.uPrev.value = this.maskRead.texture;
        renderer.setRenderTarget(this.maskWrite);
        renderer.clear();
        renderer.render(this.copyScene, this.camera);

        // 2. Stamp the queued brush points on top
        renderer.autoClear = false;
        for (const point of this.points) {
            this.brush.position.set(point.x, point.y, 0);
            // Anchor the paint grain in screen space (0..1) for a natural texture
            this.brushMaterial.uniforms.uCenter.value.set(
                point.x * 0.5 + 0.5,
                point.y * 0.5 + 0.5
            );
            renderer.render(this.maskScene, this.camera);
        }
        renderer.autoClear = true;
        this.points = [];

        // 3. Swap read/write and expose the latest mask to the main shader
        const tmp = this.maskRead;
        this.maskRead = this.maskWrite;
        this.maskWrite = tmp;
        this.material.uniforms.uMask.value = this.maskRead.texture;

        renderer.setRenderTarget(null);
    }

    resize() {
        this.renderer.setSize(this.sizes.width, this.sizes.height);
        this.renderer.setPixelRatio(this.sizes.pixelRatio);

        const targetWidth = this.sizes.width * this.sizes.pixelRatio;
        const targetHeight = this.sizes.height * this.sizes.pixelRatio;
        this.maskRead.setSize(targetWidth, targetHeight);
        this.maskWrite.setSize(targetWidth, targetHeight);

        this.material.uniforms.uResolution.value.set(this.sizes.width, this.sizes.height);
        this.updateBrushScale();
    }

    // Recompute the hold/fade threshold uniform after a timing change
    updateHoldThreshold() {
        const lifetime = this.settings.holdDuration + this.settings.fadeDuration;
        this.material.uniforms.uHoldThreshold.value =
            lifetime > 0 ? this.settings.fadeDuration / lifetime : 0;
    }

    // Live-tweak panel — only mounted when the URL contains "#debug"
    setDebug() {
        if (!window.location.hash.includes('debug')) {
            return;
        }

        const s = this.settings;
        const main = this.material.uniforms;
        const brush = this.brushMaterial.uniforms;

        this.gui = new GUI({ title: 'About Experience' });

        const fBrush = this.gui.addFolder('Brush / curseur');
        fBrush.add(s, 'brushSize', 0.05, 1, 0.01).name('size').onChange(() => this.updateBrushScale());
        fBrush.add(s, 'edgeRoughness', 0, 0.5, 0.005).name('roughness (0 = rond)')
            .onChange((v) => { brush.uRoughness.value = v; });
        fBrush.add(s, 'grainScale', 0.5, 10, 0.1).name('grain scale')
            .onChange((v) => { brush.uGrainScale.value = v; });

        const fEdge = this.gui.addFolder('Bord du reveal');
        fEdge.add(s, 'flowAmplitude', 0, 0.1, 0.001).name('flow amplitude')
            .onChange((v) => { main.uFlowAmplitude.value = v; });
        fEdge.add(s, 'flowScale', 0, 10, 0.1).name('flow scale')
            .onChange((v) => { main.uFlowScale.value = v; });
        fEdge.add(s, 'grainFrequency', 10, 200, 1).name('sand frequency')
            .onChange((v) => { main.uGrainFrequency.value = v; });
        fEdge.add(s, 'grainSoftness', 0, 1, 0.01).name('sand softness')
            .onChange((v) => { main.uGrainSoftness.value = v; });

        const fTiming = this.gui.addFolder('Timing (ms)');
        fTiming.add(s, 'holdDuration', 0, 3000, 10).name('hold').onChange(() => this.updateHoldThreshold());
        fTiming.add(s, 'fadeDuration', 0, 3000, 10).name('fade').onChange(() => this.updateHoldThreshold());

        const fMomentum = this.gui.addFolder('Momentum');
        fMomentum.add(s, 'momentumFriction', 0.5, 0.99, 0.01).name('friction');
        fMomentum.add(s, 'momentumMinSpeed', 0.00001, 0.01, 0.00001).name('min speed');
    }

    update() {
        // Run the glide only on frames where the mouse did not move,
        // so the momentum takes over right after the cursor stops.
        if (!this.movedThisFrame) {
            this.applyMomentum();
        }
        this.movedThisFrame = false;

        // Drain the mask energy by the fraction of its lifetime elapsed this frame
        // (frame-rate independent), so painted areas return to the initial state.
        const lifetime = this.settings.holdDuration + this.settings.fadeDuration;
        this.copyMaterial.uniforms.uFade.value =
            lifetime > 0 ? this.time.delta / lifetime : 1;

        this.drawMask();
        this.renderer.render(this.scene, this.camera);
    }
}
