import Swiper, {
    Autoplay, EffectFade, Scrollbar, Pagination, Navigation,
} from 'swiper';
import { addIndex, allDatasParsed, ariaHiddenSlide } from './swiperMethods';
import teqSwiperData from '../../data/swiper-data.json'


/**
 * Global function for init all the swiper with the same Class Name
 */
function initCpSlider() {
    Swiper.use([Autoplay, EffectFade, Scrollbar, Pagination, Navigation]);
    const mobileScreen = window.matchMedia('(max-width: 991px)');

    //Initialize each swiper with cp-slider Class Name
    const swipers = document.querySelectorAll('.cp-slider');
    if(swipers.length == 0) return
    swipers.forEach((swiper, index) => {
        // Give a specific name to make it unique
        swiper.setAttribute('id', `swiper-${index}`);
        const swiperID = document.getElementById(`swiper-${index}`);


        addIndex(swiperID, index, 'swiper-scrollbar')
        addIndex(swiperID, index, 'swiper-pagination')
        addIndex(swiperID, index, 'swiper-navigation-next')
        addIndex(swiperID, index, 'swiper-navigation-prev')

        const nextArrow = document.querySelectorAll(`.swiper-navigation-next-${index} .swiper-button-next`)
        const prevArrow = document.querySelectorAll(`.swiper-navigation-prev-${index} .swiper-button-prev`)

        nextArrow.forEach(arrow => {
            arrow.addEventListener('keypress', (e) => {
                if(e.keyCode === 13) {
                    setTimeout(() => {
                        ariaHiddenSlide(swiper, 'next')
                    }, 400)
                }
            })
        })

        prevArrow.forEach(arrow => {
            arrow.addEventListener('keypress', (e) => {
                if(e.keyCode === 13) {
                    setTimeout(() => {
                        ariaHiddenSlide(swiper, 'prev')
                    }, 400)
                }
            })
        })

        const swiperData =  allDatasParsed(swiper, teqSwiperData);

        const mySwiper = new Swiper(swiper, {
            init:false,
            speed: 400,
            spaceBetween: swiperData.spaceOnMobile.value,
            slidesPerView: swiperData.nbSlidesMob.value,
            slidesPerGroup: swiperData.nbSlidesMob.value,
            centeredSlides: swiperData.isCenteredSlides.value,
            watchSlidesProgress: true,

            keyboard: {
                enabled: true,
            },

            a11y: {
                enabled: true,
            },
          
            on: {
                init(){
                    ariaHiddenSlide(swiper)
                }
            },

            scrollbar: {
                el: `.swiper-scrollbar-${index}`,
                draggable: true,
            },
            // when window width is >= 426px
            breakpoints: {
                426: {
                    spaceBetween: swiperData.spaceOnMobile.value,
                    slidesPerView: swiperData.nbSlidesTab.value,
                    slidesPerGroup: swiperData.nbSlidesTab.value,
                    draggable: true,
                },
                // when window width is >= 769px
                769: {
                    spaceBetween: swiperData.defaultSlidesSpace.value,
                    slidesPerView: swiperData.nbSlidesDesk.value,

                    scrollbar: {
                        el: `.swiper-scrollbar-${index}`,
                        draggable: true,
                    },
                    pagination: {
                        el: `.swiper-pagination-${index}`,
                        type: 'bullets',
                        clickable: 'true',
                    },
                    navigation: {
                        nextEl: `.swiper-navigation-next-${index} .swiper-button-next`,
                        prevEl: `.swiper-navigation-prev-${index} .swiper-button-prev`,
                    },
                    slidesPerGroup: swiperData.nbSlidesDesk.value,
                },
            },
        });

        mySwiper.init();
        // Disables swiper on slider-video for small screens
        if (swiper.classList.contains('slider-video') && mobileScreen.matches) {
            mySwiper.destroy();
        }

        mySwiper.on('init', function(){
            if(swiper.slides.length > 1) {
                const leftButton = document.querySelector('.swiper-button-prev')
                const rightButton = document.querySelector('.swiper-button-next')
                leftButton.style.opacity = 1;
                leftButton.style.display = "block";
                rightButton.style.opacity = 1;
                rightButton.style.display = "block";
            }
        });

        /**
         * Ajust buttons position to be at the center of the image when page load and resize
         * Add the class "simple-s" at your slider to not target the other one that you don't want to 
         * replace buttons
         */
        const buttonsNext = document.querySelectorAll('.simple-s .swiper-button-next')
        const buttonsPrev = document.querySelectorAll('.simple-s .swiper-button-prev')
        const illust = document.querySelector('.simple-s img')

        const buttonsPosition = () => {
            if(!illust) return
            const buttonsTopPosition = illust.offsetHeight / 2
            buttonsNext.forEach(button => {
                button.style.top = `${buttonsTopPosition}px`
            })
            buttonsPrev.forEach(button => {
                button.style.top = `${buttonsTopPosition}px`
            })
        }

        window.addEventListener('resize', () => {
            buttonsPosition();
        })

        window.addEventListener('load', () => {
            buttonsPosition();
        })

        document.addEventListener('updateswiper', () => {
            mySwiper.update();
            mySwiper.slideTo(0, 0);
        })
    });
}

export default initCpSlider;
