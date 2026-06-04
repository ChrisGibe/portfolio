import gsap from 'gsap'
import { ScrollTrigger } from 'gsap/all';

const initCpCollapser2 = () => {
  gsap.registerPlugin(ScrollTrigger);
  const collapsers = document.querySelectorAll('.cp-collapser');
  if (!collapsers.length) return;

  collapsers.forEach(collapser => {
    const collapserButtons = collapser.querySelectorAll('.collapser-item button');
    const autoCollapse = collapser.classList.contains('auto-collapse');
  
    collapserButtons.forEach(button => {
      const contentWrapper = button.nextElementSibling.querySelector('.wysiwyg-wrapper');
      // icons[0] : + / icons[1] : -
      const icons = button.querySelectorAll('svg');
  
      button.addEventListener('click', () => {
        if (autoCollapse) {
          collapserButtons.forEach(btn => {
            if (btn === button) {return};
            closeCollapse(btn.nextElementSibling.querySelector('.wysiwyg-wrapper'));
            btn.setAttribute('aria-expanded', false)
            const allIcons = btn.querySelectorAll('svg');
            allIcons[0].style.display = 'block';
            allIcons[1].style.display = 'none';
          })
        }
        if (button.getAttribute('aria-expanded') === 'false') {
          gsap.to(contentWrapper, {
            height: 'auto',
            opacity: 1,
            onComplete: () => {ScrollTrigger.refresh()},
          });
          button.setAttribute('aria-expanded', true)
        }
        else {
          closeCollapse(contentWrapper);
          button.setAttribute('aria-expanded', false)
        }
        icons.forEach(icon => {
          gsap.to(icon, {
            display: window.getComputedStyle(icon).display === 'none' ? 'block' : 'none',
            duration: 0,
          });
        }) 
      })
    })
  })
};

const closeCollapse = (el) => {
  gsap.to(el, {
    height: 0,
    opacity: 0,
    onComplete: () => {ScrollTrigger.refresh()},
  });
};

export default initCpCollapser2;