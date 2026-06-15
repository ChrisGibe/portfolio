import initVars from "./helpers/_initvars";
import toggleGrid from "./helpers/_toggleGrid";
import teqAnimations from "./helpers/_animations";

// TEQUILARAPIDO
import initFirstScene from "./modules/tequilarapido/initFirstScene";
import initSliderCases from "./modules/tequilarapido/initSliderCases";
import { initLenis } from "./modules/tequilarapido/initLenis";
import initHeroVideoAnim from "./modules/tequilarapido/initHeroVideoAnim";

document.addEventListener('DOMContentLoaded', () => {
    // Setup
    initLenis();
    initVars();
    toggleGrid();
    teqAnimations();

    // TEQUILARAPIDO
    initFirstScene();
    initSliderCases();
    initHeroVideoAnim();
})