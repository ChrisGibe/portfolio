import gsap from 'gsap';
import {lenis} from "./initLenis";

const initHeroVideoAnim = () => {
  const mm = gsap.matchMedia();
  const cp = document.querySelector('.cp-hero');
  const wrapper = document.querySelector('.about-wrapper');

  if (!wrapper) return;

  const header = document.querySelector('header');
  const fullWrapper = document.querySelector('.full-about-wrapper');
  const closeBtn = fullWrapper.querySelector('.close-btn');
  const fullText = fullWrapper.querySelector('.about-text');
  const aboutBtnMobile = document.querySelector('.about-btn-mobile');

  let isFullOpened = false;

  // Expand `origin` (cursor circle on desktop, button on mobile) to open the full about view
  const openFull = (origin, transformOrigin) => {
    if (isFullOpened) return;
    const tl = new gsap.timeline();
    tl.to(origin, {
      duration: 0.3,
      transformOrigin,
      scale: 0.01,
    }, 0)
    tl.to(origin, {
      duration: 0.7,
      opacity: 0,
      transformOrigin,
      scale: 5
    }, 0.3)
    tl.to(fullWrapper, {
      duration: 0.7,
      opacity: 1,
      pointerEvents: 'all',
      onEnter: () => {
        isFullOpened = true;
        header.style.zIndex = -1;
        lenis.scrollTo('top', {immediate: true, lock: true})
        lenis.stop();
      }
    }, 0.3)
    // Reveal the about text once the full view is in
    tl.to(fullText, {
      duration: 0.6,
      ease: 'power2.out',
      opacity: 1,
      y: 0
    }, 0.7)
  }

  // Collapse the full about view back to `origin`
  const closeFull = (origin) => {
    const tl = new gsap.timeline();
    tl.to(fullText, {
      duration: 0.3,
      ease: 'power1.in',
      opacity: 0,
      y: '2rem'
    }, 0)
    tl.to(origin, {
      duration: 0.65,
      ease: 'power1.out',
      opacity: 1,
      scale: 1
    }, 0)
    tl.to(fullWrapper, {
      duration: 0.65,
      ease: 'power1.out',
      opacity: 0,
      pointerEvents: 'none',
      onEnter: () => {
        isFullOpened = false;
        header.style.zIndex = 2;
        lenis.start();
      }
    }, 0)
  }

  // Desktop: cursor circle follows the mouse, clicking the hero expands it
  mm.add('(min-width: 991px)', () => {
    const onMouseMove = (e) => {
      const maskWidth = parseInt(window.getComputedStyle(wrapper).webkitMaskSize, 10);
      gsap.to(wrapper, {
        duration: 0.5,
        overwrite: "auto",
        maskPosition: `${e.clientX - maskWidth/2}px ${e.clientY - maskWidth/2}px`,
        ease: "none"
      });
    }
    const onOpen = (e) => openFull(wrapper, `${e.clientX}px ${e.clientY}px`);
    const onClose = () => closeFull(wrapper);

    window.addEventListener('mousemove', onMouseMove);
    cp.addEventListener('click', onOpen);
    closeBtn.addEventListener('click', onClose);

    return () => {
      window.removeEventListener('mousemove', onMouseMove);
      cp.removeEventListener('click', onOpen);
      closeBtn.removeEventListener('click', onClose);
    }
  })

  // Mobile: a static masked button expands to the same full about view on tap
  mm.add('(max-width: 990px)', () => {
    if (!aboutBtnMobile) return;

    const onOpen = () => openFull(aboutBtnMobile, 'center center');
    const onClose = () => closeFull(aboutBtnMobile);

    aboutBtnMobile.addEventListener('click', onOpen);
    closeBtn.addEventListener('click', onClose);

    return () => {
      aboutBtnMobile.removeEventListener('click', onOpen);
      closeBtn.removeEventListener('click', onClose);
    }
  })

};

export default initHeroVideoAnim;
