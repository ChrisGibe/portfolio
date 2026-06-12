import gsap from 'gsap';
import {lenis} from "./initLenis";

const initHeroVideoAnim = () => {
  const mm = gsap.matchMedia();
  const cp = document.querySelector('.cp-hero');
  const wrapper = document.querySelector('.showreel-wrapper');
  if (!wrapper) return;

  const header = document.querySelector('header');
  const cursorVideo = wrapper.querySelector('video');
  const fullVideoWrapper = document.querySelector('.full-video-wrapper');
  const fullVideo = fullVideoWrapper.querySelector('video');

  let isFullVideoOpened = false;

  const closeBtn = fullVideoWrapper.querySelector('.close-btn');

  mm.add('(min-width: 991px)', () => {
    // Make cursor video follow mouse
    window.addEventListener('mousemove', (e) => {
      const maskWidth = parseInt(window.getComputedStyle(wrapper).webkitMaskSize, 10);
      gsap.to(wrapper, {
        duration: 0.5,
        overwrite: "auto",
        maskPosition: `${e.clientX - maskWidth/2}px ${e.clientY - maskWidth/2}px`,
        ease: "none"
      });
    })

    // Opening full video & animating cursor video when clicking on hero
    cp.addEventListener('click', (e) => {
      if (!isFullVideoOpened) {
        const tl = new gsap.timeline();
        tl.to(wrapper, {
          duration: 0.3,
          transformOrigin: `${e.clientX}px ${e.clientY}px`,
          scale: 0.01,
        }, 0)
        tl.to(wrapper, {
          duration: 0.7,
          // ease: 'power1.out',
          opacity: 0,
          transformOrigin: `${e.clientX}px ${e.clientY}px`,
          scale: 5
        }, 0.3)
        tl.to(fullVideoWrapper, {
          duration: 0.7,
          // ease: 'power1.out',
          opacity: 1,
          pointerEvents: 'all',
          onEnter: () => {
            fullVideo.currentTime = 0;
            cursorVideo.currentTime = 0;
            fullVideo.play();
            isFullVideoOpened = true;
            header.style.zIndex = -1;
            lenis.scrollTo('top', {immediate: true, lock: true})
            lenis.stop();
          }
        }, 0.3)
      }
    })

    // Closing full video on button click
    closeBtn.addEventListener('click', () => {
      const tl = new gsap.timeline();
      tl.to(wrapper, {
        duration: 0.65,
        ease: 'power1.out',
        opacity: 1,
        scale: 1
      }, 0)
      tl.to(fullVideoWrapper, {
        duration: 0.65,
        ease: 'power1.out',
        opacity: 0,
        pointerEvents: 'none',
        onEnter: () => {
          fullVideo.currentTime = 0;
          cursorVideo.currentTime = 0;
          fullVideo.pause();
          isFullVideoOpened = false;
          header.style.zIndex = 2;
          lenis.start();
        }
      }, 0)
    })
  })

};

export default initHeroVideoAnim;