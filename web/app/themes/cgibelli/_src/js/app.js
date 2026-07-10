import initVars from "./helpers/_initvars";
import toggleGrid from "./helpers/_toggleGrid";
import teqAnimations from "./helpers/_animations";

// TEQUILARAPIDO
import initFirstScene from "./modules/tequilarapido/initFirstScene";
import initSliderCases from "./modules/tequilarapido/initSliderCases";
import { initLenis } from "./modules/tequilarapido/initLenis";
import initHeroVideoAnim from "./modules/tequilarapido/initHeroVideoAnim";
import initFooter from "./modules/tequilarapido/initFooter";
import { AboutExperience } from "./modules/tequilarapido/AboutExperience";

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
    initFooter();
    new AboutExperience();
})