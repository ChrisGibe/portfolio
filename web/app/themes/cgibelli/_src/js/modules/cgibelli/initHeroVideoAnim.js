import gsap from 'gsap';
import {lenis} from "./initLenis";

// Mask circle sizes: small spotlight when closed, large enough to cover the
// screen when opened.
const MASK_CLOSED = '300px';
const MASK_OPEN = '4000px';

const initHeroVideoAnim = () => {
  const mm = gsap.matchMedia();
  const cp = document.querySelector('.cp-hero');
  const wrapper = document.querySelector('.about-wrapper');

  if (!wrapper) return;

  const header = document.querySelector('header');
  const aboutText = wrapper.querySelector('.about-text');
  const aboutBtnMobile = document.querySelector('.about-btn-mobile');

  let isOpened = false;

  // Shared "panel is now open" side-effects (text reveal + lock scroll)
  const reveal = () => {
    // Dissolve the canvas frosted-glass cover and enable the mouse reveal
    window.dispatchEvent(new CustomEvent('about:open'));
    lenis.scrollTo('top', {immediate: true, lock: true});
    lenis.stop();
    gsap.to(aboutText, {duration: 0.6, ease: 'power2.out', opacity: 1, y: 0, delay: 0.3});
    gsap.to(header, {duration: 0.3, opacity: 0, pointerEvents: 'none'});
  };

  const hide = () => {
    // Restore the frosted-glass cover and stop the mouse reveal
    window.dispatchEvent(new CustomEvent('about:close'));
    lenis.start();
    gsap.to(aboutText, {duration: 0.3, ease: 'power1.in', opacity: 0, y: '2rem'});
    gsap.to(header, {duration: 0.3, opacity: 1, pointerEvents: 'auto'});
  };

  // Desktop: the canvas shows through a cursor-following circle that grows to
  // full screen on click; clicking again (anywhere on the canvas) closes it.
  mm.add('(min-width: 991px)', () => {
    // Keep the mask circle centred on (x, y) for the given size, so growing the
    // size expands the disc symmetrically instead of drifting to a corner.
    const setMask = (size, x, y) => {
      wrapper.style.setProperty('--mask-size', `${size}px`);
      const position = `${x - size / 2}px ${y - size / 2}px`;
      wrapper.style.webkitMaskPosition = position;
      wrapper.style.maskPosition = position;
    };

    // Center of the spotlight, updated by the cursor and frozen on open
    const center = {x: window.innerWidth / 2, y: window.innerHeight / 2};

    const onMouseMove = (e) => {
      if (isOpened) return;
      center.x = e.clientX;
      center.y = e.clientY;
      const maskWidth = parseInt(window.getComputedStyle(wrapper).webkitMaskSize, 10);
      const position = `${e.clientX - maskWidth / 2}px ${e.clientY - maskWidth / 2}px`;
      gsap.to(wrapper, {
        duration: 0.5,
        overwrite: 'auto',
        ease: 'none',
        webkitMaskPosition: position,
        maskPosition: position,
      });
    };
    const open = () => {
      isOpened = true;
      // Raise the canvas above .content so it covers the hero once full screen
      gsap.set(wrapper, {zIndex: 6});
      // Grow the circle from the click point, recentring it every frame
      gsap.killTweensOf(wrapper);
      const grow = {size: parseInt(window.getComputedStyle(wrapper).webkitMaskSize, 10)};
      gsap.to(grow, {
        size: parseInt(MASK_OPEN, 10),
        duration: 1,
        ease: 'power2.inOut',
        onUpdate: () => setMask(grow.size, center.x, center.y),
      });
      reveal();
    };
    const close = () => {
      isOpened = false;
      // Drop back below .content so the spotlight reads behind the hero text
      gsap.set(wrapper, {zIndex: 4});
      gsap.killTweensOf(wrapper);
      const shrink = {size: parseInt(window.getComputedStyle(wrapper).webkitMaskSize, 10)};
      gsap.to(shrink, {
        size: parseInt(MASK_CLOSED, 10),
        duration: 0.8,
        ease: 'power2.inOut',
        onUpdate: () => setMask(shrink.size, center.x, center.y),
      });
      hide();
    };
    // Single toggle so the same click can't close then reopen
    const onClick = (e) => {
      // Let interactive elements (CTA link, links in the about text) work normally
      if (e.target.closest('a, button')) return;
      if (isOpened) close();
      else open();
    };

    window.addEventListener('mousemove', onMouseMove);
    cp.addEventListener('click', onClick);

    return () => {
      window.removeEventListener('mousemove', onMouseMove);
      cp.removeEventListener('click', onClick);
    }
  })

  // Mobile: a static masked button fades the full-screen canvas in on tap;
  // tapping the canvas closes it.
  mm.add('(max-width: 990px)', () => {
    if (!aboutBtnMobile) return;

    const open = () => {
      if (isOpened) return;
      isOpened = true;
      gsap.set(wrapper, {zIndex: 6});
      gsap.to(wrapper, {duration: 0.7, opacity: 1, pointerEvents: 'all'});
      reveal();
    };
    const close = (e) => {
      if (!isOpened) return;
      if (e && e.target.closest('a, button')) return;
      isOpened = false;
      gsap.set(wrapper, {zIndex: 4});
      gsap.to(wrapper, {duration: 0.6, opacity: 0, pointerEvents: 'none'});
      hide();
    };

    aboutBtnMobile.addEventListener('click', open);
    wrapper.addEventListener('click', close);

    return () => {
      aboutBtnMobile.removeEventListener('click', open);
      wrapper.removeEventListener('click', close);
    }
  })

};

export default initHeroVideoAnim;
