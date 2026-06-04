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
  const nbOfCases = document.querySelectorAll(".fake-case").length;

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

    // After slider component translate at 100%, move the "scroll position" on scroll
    ScrollTrigger.create({
      trigger: ".container-fake-case",
      start: `top top`,
      end: `bottom bottom`,
      onUpdate: (self) => {
        gsap.to(indicator, {xPercent: self.progress * (nbOfCases * 100 - 100)});
      },
    });

    // Translate the footer at the end of the cases slider
    const lastFakeCase = document.querySelector(".container-fake-case").lastElementChild;
    gsap.to(footer, {
      translateX: 0,
      scrollTrigger: {
        trigger: lastFakeCase,
        endTrigger: ".fake-footer",
        start: `+=${window.innerHeight + 300} bottom`,
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

    // CASE TRANSITION
    gsap.utils.toArray(".tequila-case").forEach((tequilaCase, dataCase) => {
      gsap.to(tequilaCase, {
        scrollTrigger: {
          trigger: `.fake-case[data-case="${dataCase}"]`,
          start: "top top",
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
    thumbnails.forEach((thumbnail) => {
      thumbnail.addEventListener("click", () => {
        const dataCase = thumbnail.getAttribute("data-case");
        const fakeCaseToScroll = document.querySelector(`.fake-case[data-case="${dataCase}"]`);
        const caseToDisplay = document.querySelector(`.tequila-case[data-case="${dataCase}"]`);

        lenis.scrollTo(fakeCaseToScroll, {
          duration: 0.3,
          onComplete: () => {
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
     * Scotch the indicator to the nearest thumbnail when the use stop scrolling
     */
    let offsetsCases = [];
    thumbnails.forEach((thumbnail, index) => {
      const fakeCase = document.querySelector(`.fake-case[data-case="${index}"]`);
      offsetsCases.push(fakeCase.offsetTop);
      thumbnail.setAttribute("data-position", `${fakeCase.offsetTop}`);
    });

    const firstCasePosition = document.querySelector(".container-fake-case").firstElementChild.offsetTop;
    const lastCasePosition = document.querySelector(".container-fake-case").lastElementChild.offsetTop;

    lenis.on("scroll", () => {
      if (window.scrollY > firstCasePosition && window.scrollY < lastCasePosition) {
        if (!document.documentElement.classList.contains("lenis-scrolling")) {
          let currentScroll = window.scrollY;

          function closestNumber(target, array) {
            // Sort the array to simplify the search
            array.sort((a, b) => a - b);

            // Initialize the variable to store the closest number
            let closestNumber = array[0];

            // Iterate through the array to find the closest number
            for (let i = 1; i < array.length; i++) {
              if (Math.abs(target - array[i]) < Math.abs(target - closestNumber)) {
                closestNumber = array[i];
              }
            }
            return closestNumber;
          }

          let thumbToScotch = closestNumber(currentScroll, offsetsCases);

          lenis.scrollTo(thumbToScotch, {
            duration: 0.2,
            onComplete: () => {
              const thumbnail = document.querySelector(`.thumbnail[data-position='${thumbToScotch}']`);
              const dataCase = thumbnail.getAttribute("data-case");
              const caseToDisplay = document.querySelector(`.tequila-case[data-case="${dataCase}"]`);

              if(currentCase !== caseToDisplay) {
                gsap.to(".tequila-case", {opacity: 0, zIndex: 2});
                currentCase !== caseToDisplay ? gsap.to(caseToDisplay, {opacity: 1, zIndex: 3}) : null;
                currentCase = caseToDisplay
              }

              lenis.raf(0);
            },
          });
        }
      }
    });
  });
};

export default initSliderCases;
