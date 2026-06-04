import gsap from 'gsap';
import {ScrollTrigger} from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger)

/**
 * Make the Navigation of the cp-anchors "Sticky"
 */
const initCpAnchors = () => {
    const allCpAnchors = document.querySelectorAll('.cp-anchors')

    // Use an additional Height to avoid the scrollbar height
    const additionalHeight = 125

    allCpAnchors.forEach(cpAnchor => {
        const stickyNav = cpAnchor.querySelector('.sticky-nav')

        // Sticky Height
        const stickyNavStyles = getComputedStyle(stickyNav)
        const stickyNavHeight = parseInt(stickyNavStyles.height) + additionalHeight

        let breakpoint = gsap.matchMedia();

        breakpoint.add("(min-width: 1025px)", () => {
            gsap.to(stickyNav, {
                scrollTrigger: {
                    trigger: cpAnchor,
                    start: `top +=${additionalHeight}px`,
                    end: `bottom +=${stickyNavHeight}px`,
    
                    // Update the position of the Navigation when you scroll
                    onUpdate : self => {
                        if (self.progress !== 0 && self.progress !== 1) {
                            const cpAnchorPosition = cpAnchor.getBoundingClientRect().top
                            const stickyNavPosition = cpAnchorPosition - additionalHeight;
                            stickyNav.style.top = `${-stickyNavPosition}px`
                        }
                    }
                }, 
            })
        })
    });
}

export default initCpAnchors