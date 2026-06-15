import gsap from "gsap";
import { SplitText } from "../../libs/SplitText.min";
import { CustomEase } from "gsap/all";

const initFirstScene = () => {
  const cpHero = document.querySelector('.cp-hero')

  if(!cpHero) {
    return
  }

  gsap.registerPlugin(SplitText, CustomEase);

  CustomEase.create(
    "butter",
    "M0,0 C0.211,0.741 0.478,0.941 1,1"
  );

  const splitTextTop = new SplitText(".cp-hero .title-top", {type: "chars"});
  const splitTextBottom = new SplitText(".cp-hero .title-bottom", {type: "chars"});

  // SET
  gsap.set([splitTextTop.chars, splitTextBottom.chars], { translateY: "110%", translateX: "10%"});

  // TO
  gsap.to([splitTextTop.chars, splitTextBottom.chars], {
    translateY: 0,
    translateX: 0,
    duration: 1.2,
    stagger: 0.025,
    ease: "butter",
  });

  gsap.to(".cp-hero .title-container", {
    rotateX: 0,
    rotateY: 0,
    duration: 1.2,
    ease: "butter",
  });

  gsap.to(".cp-hero .title-container", {
    opacity: 1,
    duration: 0.8,
    ease: "butter",
    delay: 0.5,
  });

  gsap.to('.logo-header', { alpha: 1, translateY: 0, duration: 2, ease: "butter"});
  gsap.to('.cp-hero .description', { alpha: 1, duration: 2, ease: "butter"});
  gsap.to('.cp-hero .cta-primary', { alpha: 1, duration: 2, ease: "butter"});

  // LINES AT THE END
  gsap.to('.cp-hero .line', { scaleX: 1, duration: 1.2, delay: 1.3, ease: "butter" });
};

export default initFirstScene;
