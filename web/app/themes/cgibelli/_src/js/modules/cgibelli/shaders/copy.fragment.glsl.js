// Persistence pass: carries the mask "energy" forward and slowly drains it,
// so painted areas fade back to the initial image over time.
export const copyFragment = /* glsl */ `
    varying vec2 vUv;

    uniform sampler2D uPrev;
    uniform float uFade;

    void main() {
        vec4 prev = texture2D(uPrev, vUv);
        gl_FragColor = max(prev - uFade, 0.0);
    }
`;
