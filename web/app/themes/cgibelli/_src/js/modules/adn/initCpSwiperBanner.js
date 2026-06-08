import Swiper, {
    Autoplay, EffectFade, Scrollbar, Pagination, Navigation, Keyboard
} from 'swiper';
import {gsap} from 'gsap';
import {SplitText} from "../../libs/SplitText.min";

gsap.registerPlugin(SplitText);

/**
 * Swiper for Hero Banner
 * @param {String} classNameComponent The class name of the component
 * @param {String} classNamePagination The class name of the pagination container
 */
const initCpSwiperBanner = (classNameComponent, classNamePagination) => {

    if (!document.querySelector(classNameComponent)) {
        return;
    }

    // Split title for animations
    const splitTitle = new SplitText(`${classNameComponent} h2`, { type: "lines" });
    const lines = splitTitle.lines;
    let effectSwiper = "fade"

    if (window.innerWidth <= 768) {
        effectSwiper = "slide"
    }

    // INIT SLIDER
    Swiper.use([Autoplay, EffectFade, Scrollbar, Pagination, Navigation, Keyboard]);
    const swiper = new Swiper(`${classNameComponent} .swiper`, {
        init:false,
        slidesPerView: 1,
        speed: 500,
        keyboard: {
            enabled: true,
            onlyInViewport: false,
        },
        watchSlidesProgress: true,
        navigation: {
            nextEl: `.swiper-button-next${classNameComponent}-nav`,
            prevEl: `.swiper-button-prev${classNameComponent}-nav`,
        },
        effect:effectSwiper,
        fadeEffect: {
            crossFade: true
        },
        autoplay:false,
        pagination: {
            el: `${classNamePagination}`,
            clickable: true,
            renderBullet: function (index, className) {
                return `<span class="${className}">0${index + 1}</span>`;
            },
        },
        breakpoints: {
            0: {
                spaceBetween: 24
            },
            480:{
                spaceBetween: 32
            },
            769:{
                slidesPerView:1,
            }
        },
        on: {
            slideChangeTransitionEnd() {
                swiperTabIndex();

            },
        },

    });

    swiper.on('init', function(){
        /*if(swiper.slides.length > 1) {
            const leftButton = document.querySelector(`${classNameComponent} .swiper-button-prev`)
            const rightButton = document.querySelector(`${classNameComponent} .swiper-button-next`)
            leftButton.style.opacity = 1;
            leftButton.style.display = "block";
            rightButton.style.opacity = 1;
            rightButton.style.display = "block";
        }*/
        swiperTabIndex()
    });

    swiper.init();


    function swiperTabIndex(){
        const slidesLink = document.querySelectorAll(`${classNameComponent} .swiper-slide a`)
        slidesLink.forEach((link) => {
            link.tabIndex = -1;
        });

        const visibleSlide = swiper.visibleSlides[0];
        if (visibleSlide.querySelector('a')) visibleSlide.querySelector('a').tabIndex = 0
    }
}

export default initCpSwiperBanner