import { ScrollTrigger } from "gsap/ScrollTrigger";

// MODULES
import initFirstScene from "./modules/cgibelli/initFirstScene";
import initSliderCases from "./modules/cgibelli/initSliderCases";
import { initLenis } from "./modules/cgibelli/initLenis";
import initHeroVideoAnim from "./modules/cgibelli/initHeroVideoAnim";
import initFooter from "./modules/cgibelli/initFooter";
import { AboutExperience } from "./modules/cgibelli/AboutExperience";

document.addEventListener('DOMContentLoaded', () => {
    // Setup
    initLenis();

    // MODULES
    initFirstScene();
    initSliderCases();
    initHeroVideoAnim();
    initFooter();

    if (document.getElementById('about-experience-canvas')) {
        new AboutExperience();
    }
})

// Unique Refresh
window.addEventListener('load', () => {
    ScrollTrigger.refresh();
});