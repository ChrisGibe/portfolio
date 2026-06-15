import gsap from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger";
import {lenis} from "./initLenis";

gsap.registerPlugin(ScrollTrigger);

const initSliderCases = () => {
  const hero = document.querySelector(".cp-hero");
  const contentHero = document.querySelector(".cp-hero .content");
  const sliderOfCases = document.querySelector(".cp-slider-cases");
  const footer = document.querySelector("footer");
  const header = document.querySelector("header");
  const indicator = document.querySelector(".indicator");
  const thumbnails = document.querySelectorAll(".thumbnail");
  const IS_HP = document.body.classList.contains("-homepage");

  if (!hero || !sliderOfCases) {
    return;
  }

  let mm = gsap.matchMedia();
  mm.add("(min-width: 991px)", () => {
    let currentCase;
    // Translate the slider from the right at the begining
    gsap.to(sliderOfCases, {
      translateX: 0,
      scrollTrigger: {
        trigger: hero,
        start: "top top",
        end: `+=${window.innerHeight}`,
        scrub: true,
        pin: true,
        onUpdate: (self) => {
          self.progress > 0.01 ? gsap.to(".cp-hero .overlay", {opacity: 0.2}) : gsap.to(".cp-hero .overlay", {opacity: 0});
          self.progress > 0.01 ? gsap.to(contentHero, {opacity: 0.2}) : gsap.to(contentHero, {opacity: 1});
        },
      },
    });

    // Move the indicator in sync with case transitions
    // Shift by 1 viewport so progress starts at the end of the slider entrance pin
    const indicatorDistance = thumbnails[thumbnails.length - 1].offsetLeft - thumbnails[0].offsetLeft;
    ScrollTrigger.create({
      trigger: ".container-fake-case",
      start: () => `top top+=${window.innerHeight}`,
      end: () => `bottom bottom+=${window.innerHeight}`,
      onUpdate: (self) => {
        gsap.set(indicator, {x: self.progress * indicatorDistance});
      },
    });

    // Translate the footer at the end of the cases slider
    if(IS_HP){
      const lastFakeCase = document.querySelector(".container-fake-case").lastElementChild;
      gsap.to(footer, {
        translateX: 0,
        scrollTrigger: {
          trigger: lastFakeCase,
          endTrigger: ".fake-footer",
          start: `+=${window.innerHeight} bottom`,
          end: "bottom bottom",
          scrub: true,
          onUpdate: (self) => {
            if (self.progress > 0.9) {
              footer.classList.add("black");
              header.classList.add("black");
            } else {
              footer.classList.remove("black");
              header.classList.remove("black");
            }
          },
        },
      });
    }

    // CASE TRANSITION
    // Shift by 1 viewport so case 0 becomes active at the end of the slider entrance pin
    gsap.utils.toArray(".tequila-case").forEach((tequilaCase, dataCase) => {
      gsap.to(tequilaCase, {
        scrollTrigger: {
          trigger: `.fake-case[data-case="${dataCase}"]`,
          start: () => `top top+=${window.innerHeight}`,
          onEnter: () => {
            if(currentCase !== tequilaCase) {
              gsap.utils.toArray(".tequila-case").forEach((caseTequila) => {
                gsap.to(caseTequila, {opacity: 0, zIndex: 2});
              });
              gsap.to(tequilaCase, {opacity: 1, zIndex: 3});
              currentCase = tequilaCase;
            }
          },
          onUpdate: (self) => {
            // FOR SCROLLBACK
            if (self.direction === -1 && self.progress === 0) {
              if(currentCase !== tequilaCase) {
                gsap.utils.toArray(".tequila-case").forEach((caseTequila) => {
                  gsap.to(caseTequila, {opacity: 0, zIndex: 2});
                });
                gsap.to(tequilaCase, {opacity: 1, zIndex: 3});
                currentCase = tequilaCase
              }
            }
          },
        },
      });
    });

    /**
     * Click event to move the indicator on the thumbnail of the case targeted,
     * and display the case
     */
    let isProgrammaticScroll = false;

    thumbnails.forEach((thumbnail) => {
      thumbnail.addEventListener("click", () => {
        const dataCase = thumbnail.getAttribute("data-case");
        const fakeCaseToScroll = document.querySelector(`.fake-case[data-case="${dataCase}"]`);
        const caseToDisplay = document.querySelector(`.tequila-case[data-case="${dataCase}"]`);

        isProgrammaticScroll = true;
        lenis.scrollTo(fakeCaseToScroll, {
          offset: -window.innerHeight,
          duration: 0.3,
          onComplete: () => {
            isProgrammaticScroll = false;
            if(currentCase !== caseToDisplay) {
              gsap.to(".tequila-case", {opacity: 0, zIndex: 2});
              gsap.to(caseToDisplay, {opacity: 1, zIndex: 3})
              currentCase = caseToDisplay
            }
          },
        });
      });
    });

    /**
     * Scotch the indicator to the nearest thumbnail when the user stops scrolling.
     * Positions are shifted by -1 viewport to match the active scroll position
     * of each case (which fires 1 viewport before fake-case.offsetTop).
     */
    let offsetsCases = [];
    thumbnails.forEach((thumbnail, index) => {
      const fakeCase = document.querySelector(`.fake-case[data-case="${index}"]`);
      const activePosition = fakeCase.offsetTop - window.innerHeight;
      offsetsCases.push(activePosition);
      thumbnail.setAttribute("data-position", `${activePosition}`);
    });

    const firstCasePosition = offsetsCases[0];
    const lastCasePosition = offsetsCases[offsetsCases.length - 1];

    function closestNumber(target, array) {
      let closest = array[0];
      for (let i = 1; i < array.length; i++) {
        if (Math.abs(target - array[i]) < Math.abs(target - closest)) {
          closest = array[i];
        }
      }
      return closest;
    }

    lenis.on("scroll", () => {
      if (isProgrammaticScroll) return;
      if (window.scrollY > firstCasePosition && window.scrollY < lastCasePosition) {
        const thumbToScotch = closestNumber(window.scrollY, offsetsCases);

        isProgrammaticScroll = true;
        lenis.scrollTo(thumbToScotch, {
          duration: 0.2,
          onComplete: () => {
            isProgrammaticScroll = false;
            const thumbnail = document.querySelector(`.thumbnail[data-position='${thumbToScotch}']`);
            const dataCase = thumbnail.getAttribute("data-case");
            const caseToDisplay = document.querySelector(`.tequila-case[data-case="${dataCase}"]`);

            if(currentCase !== caseToDisplay) {
              gsap.to(".tequila-case", {opacity: 0, zIndex: 2});
              gsap.to(caseToDisplay, {opacity: 1, zIndex: 3});
              currentCase = caseToDisplay;
            }
          },
        });
      }
    });
  });
};

export default initSliderCases;
