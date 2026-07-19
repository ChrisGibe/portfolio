import toggleGrid from "./helpers/_toggleGrid";
import teqAnimations from "./helpers/_animations";

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
    toggleGrid();
    teqAnimations();

    // MODULES
    initFirstScene();
    initSliderCases();
    initHeroVideoAnim();
    initFooter();
    new AboutExperience();
})