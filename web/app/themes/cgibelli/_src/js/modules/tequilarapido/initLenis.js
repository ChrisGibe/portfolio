import Lenis from 'lenis'

export let lenis;
export const initLenis = () => {
    lenis = new Lenis({
        wrapper: document.body,
        lerp: 0.1,
    });

    function raf(time) {
        lenis.raf(time)
        requestAnimationFrame(raf)
      }
      
      requestAnimationFrame(raf)
}

export default {initLenis, lenis}