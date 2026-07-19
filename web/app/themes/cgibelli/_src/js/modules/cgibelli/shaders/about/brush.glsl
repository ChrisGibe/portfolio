// A soft disc whose radius is perturbed by screen-anchored noise, giving each
// stamp a ragged, painterly outline instead of a clean circle.
varying vec2 vUv;

uniform vec2 uCenter;
uniform float uRoughness;
uniform float uGrainScale;

//__NOISE__

void main() {
    float d = distance(vUv, vec2(0.5));

    // Perturb the radius with noise anchored in screen space, so the stroke
    // has a ragged, painterly outline instead of a clean circle.
    float n = fbm(uCenter * uGrainScale + (vUv - 0.5) * 2.0);
    float radius = 0.5 + n * uRoughness;

    float strength = smoothstep(radius, radius - 0.22, d);
    gl_FragColor = vec4(vec3(strength), 1.0);
}
