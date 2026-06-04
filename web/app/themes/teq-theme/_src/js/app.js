import svgxhr from "webpack-svgstore/dist/helpers/svgxhr";
svgxhr("./app/themes/teq-theme/assets/svg/svg-sprites.svg");


import initVars from "./helpers/_initvars";
import createGrid from "./helpers/_createGrid"
import toggleGrid from "./helpers/_toggleGrid";
import teqAnimations from "./helpers/_animations";

// TEQUILARAPIDO
import initFirstScene from "./modules/tequilarapido/initFirstScene";
import initSliderCases from "./modules/tequilarapido/initSliderCases";
import { initLenis } from "./modules/tequilarapido/initLenis";
import initHeroVideoAnim from "./modules/tequilarapido/initHeroVideoAnim";
//import initPageTransition from './modules/tequilarapido/initPageTransition'

document.addEventListener('DOMContentLoaded', () => {
    // Setup
    initLenis();
    initVars();
    createGrid();
    toggleGrid();
    teqAnimations();

    // TEQUILARAPIDO
    initFirstScene();
    initSliderCases();
    //initPageTransition();
    initHeroVideoAnim();
})