import { noise } from './noise.glsl';

// Mixes the two images by the mask. The reveal edge flows with organic noise,
// but the images themselves are sampled with a fixed cover UV (never displaced).
export const mainFragment = /* glsl */ `
    varying vec2 vUv;

    uniform sampler2D uTexture1;
    uniform sampler2D uTexture2;
    uniform sampler2D uMask;
    uniform vec2 uResolution;
    uniform vec2 uImageResolution;
    uniform float uFlowAmplitude;
    uniform float uFlowScale;
    uniform float uGrainFrequency;
    uniform float uGrainSoftness;
    uniform float uHoldThreshold;
    uniform float uTime;
    uniform vec2 uCursor;
    uniform float uCursorRadius;
    uniform float uDistortStrength;
    uniform float uDistortFrequency;

    ${noise}

    // Mimics CSS object-fit: cover
    vec2 coverUv(vec2 uv) {
        float screenAspect = uResolution.x / uResolution.y;
        float imageAspect = uImageResolution.x / uImageResolution.y;
        vec2 scale = vec2(1.0);

        if (screenAspect > imageAspect) {
            scale.y = imageAspect / screenAspect;
        } else {
            scale.x = screenAspect / imageAspect;
        }

        return (uv - 0.5) * scale + 0.5;
    }

    void main() {
        // Static organic warp of the boundary (mask lookup only). No time term,
        // so the edge does not keep moving once the mouse stops.
        vec2 fp = vUv * uFlowScale;
        vec2 flow = vec2(
            fbm(fp),
            fbm(fp + vec2(5.2, 1.3))
        ) * uFlowAmplitude;
        float energy = clamp(texture2D(uMask, vUv + flow).r, 0.0, 1.0);

        // Hold then fade: energy stays "full reveal" above the threshold (the
        // ~1s hold), then ramps down to 0 as it drains (return to initial state).
        float held = smoothstep(0.0, uHoldThreshold, energy);

        // Sand grain: fine noise anchored in screen space. Each grain flips from
        // base to reveal at its own threshold, so the edge dissolves into grains
        // both when appearing and when fading back.
        float grain = fbm(vUv * uGrainFrequency) * 0.5 + 0.5;
        float amount = smoothstep(
            grain - uGrainSoftness,
            grain + uGrainSoftness,
            held
        );

        // Localized animated distortion under the cursor circle; sharp elsewhere.
        // The falloff keeps it inside the spotlight; uTime keeps it moving even
        // when the cursor is still.
        vec2 d = vUv - uCursor;
        d.x *= uResolution.x / uResolution.y; // aspect-correct the distance
        float falloff = smoothstep(uCursorRadius, 0.0, length(d));
        vec2 wobble = vec2(
            fbm(vUv * uDistortFrequency + vec2(uTime, 0.0)),
            fbm(vUv * uDistortFrequency + vec2(0.0, uTime))
        ) * uDistortStrength * falloff;

        vec2 uv = coverUv(vUv) + wobble;
        vec4 base = texture2D(uTexture1, uv);
        vec4 reveal = texture2D(uTexture2, uv);

        gl_FragColor = mix(base, reveal, amount);
    }
`;
