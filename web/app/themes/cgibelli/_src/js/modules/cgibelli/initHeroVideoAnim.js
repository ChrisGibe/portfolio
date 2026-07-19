import gsap from 'gsap';
import {lenis} from "./initLenis";

// Mask circle sizes: small spotlight when closed, large enough to cover the
// screen when opened.
const MASK_CLOSED = '300px';
const MASK_OPEN = '4000px';

// Mobile zoom-reveal timing/scales (open <-> close crossfade with a scale, so
// the circle "grows" and the fullscreen image settles from a slight zoom).
const OPEN_OUT = 0.5;         // fade/scale-out duration of the leaving state
const OPEN_IN = 0.8;          // fade/scale-in duration of the arriving state
const CIRCLE_GROW = 1.35;     // how much the circle grows while fading out
const CIRCLE_SETTLE = 1.18;   // circle start scale when returning (settles to 1)
const FULLSCREEN_ZOOM = 1.04; // slight zoom on the fullscreen image at the swap

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
    gsap.to(aboutText, {duration: 0.6, ease: 'power3.out', opacity: 1, delay: 0.3});
    gsap.to(header, {duration: 0.3, opacity: 0, pointerEvents: 'none'});
  };

  const hide = () => {
    // Restore the frosted-glass cover and stop the mouse reveal
    window.dispatchEvent(new CustomEvent('about:close'));
    lenis.start();
    gsap.to(aboutText, {duration: 0, ease: 'power1.in', opacity: 0 });
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

  // Mobile: the canvas is rendered inside a small circle (the whole photo,
  // distorted) anchored on the in-flow button; tapping scales it to fullscreen
  // (distortion off) and tapping the image again returns to the circle.
  mm.add('(max-width: 990px)', () => {
    if (!aboutBtnMobile) return;

    // open/close share the wrapper, about text and header. A rapid open->close
    // must cancel the in-flight animation — including the delayed text reveal —
    // otherwise that pending tween fires after hide() and the about text
    // lingers on the closed circle.
    let mobileTl = null;
    const killActive = () => {
      if (mobileTl) mobileTl.kill();
      gsap.killTweensOf([wrapper, aboutText, header]);
    };

    // Anchor the circular canvas over the (transparent) in-flow button. The
    // wrapper is absolutely positioned inside the hero, so it scrolls with the
    // page without a scroll listener.
    const positionCircle = () => {
      const btnRect = aboutBtnMobile.getBoundingClientRect();
      const heroRect = cp.getBoundingClientRect();
      gsap.set(wrapper, {
        position: 'absolute',
        top: btnRect.top - heroRect.top,
        left: btnRect.left - heroRect.left,
        width: btnRect.width,
        height: btnRect.height,
        borderRadius: '50%',
        zIndex: 4,
        pointerEvents: 'none',
      });
    };

    // Initial closed state: place + reveal the circle, size the canvas to it
    positionCircle();
    gsap.set(wrapper, {opacity: 1});
    window.dispatchEvent(new CustomEvent('about:resize'));

    const open = () => {
      if (isOpened) return;
      isOpened = true;
      killActive();
      mobileTl = gsap.timeline()
        // The circle grows and fades out (grossissement) — this masks the swap
        // from the square "circle" render to the fullscreen "cover" render.
        .to(wrapper, {duration: OPEN_OUT, opacity: 0, scale: CIRCLE_GROW, ease: 'sine.inOut'})
        .add(() => {
          // Snap the canvas box to fullscreen (hidden, slightly zoomed in),
          // resize the renderer, then turn the distortion off (about:open).
          gsap.set(wrapper, {
            position: 'fixed',
            top: 0,
            left: 0,
            width: '100%',
            height: '100%',
            borderRadius: 0,
            zIndex: 6,
            pointerEvents: 'all',
            scale: FULLSCREEN_ZOOM,
            opacity: 0,
          });
          window.dispatchEvent(new CustomEvent('about:resize'));
          reveal();
        })
        // The fullscreen image settles from the slight zoom and fades in
        .to(wrapper, {duration: OPEN_IN, opacity: 1, scale: 1, ease: 'power3.out'});
    };

    const close = (e) => {
      if (!isOpened) return;
      // Let links inside the about text work normally
      if (e && e.target.closest('a, button')) return;
      isOpened = false;
      killActive();
      mobileTl = gsap.timeline()
        // The fullscreen image zooms out slightly and fades
        .to(wrapper, {duration: OPEN_OUT, opacity: 0, scale: FULLSCREEN_ZOOM, ease: 'sine.inOut'})
        .add(() => {
          hide();
          // Back to the circle (hidden, slightly enlarged), distortion back on
          positionCircle();
          gsap.set(wrapper, {scale: CIRCLE_SETTLE, opacity: 0});
          window.dispatchEvent(new CustomEvent('about:resize'));
        })
        // The circle shrinks back to size and fades in
        .to(wrapper, {duration: OPEN_IN, opacity: 1, scale: 1, ease: 'power3.out'});
    };

    const onResize = () => {
      if (!isOpened) positionCircle();
      window.dispatchEvent(new CustomEvent('about:resize'));
    };

    aboutBtnMobile.addEventListener('click', open);
    wrapper.addEventListener('click', close);
    window.addEventListener('resize', onResize);

    return () => {
      aboutBtnMobile.removeEventListener('click', open);
      wrapper.removeEventListener('click', close);
      window.removeEventListener('resize', onResize);
      // Reset inline styles so the desktop branch starts from a clean slate
      gsap.set(wrapper, {
        clearProps: 'position,top,left,width,height,borderRadius,zIndex,pointerEvents,opacity,transform',
      });
    }
  })

};

export default initHeroVideoAnim;
