import {gsap} from 'gsap';
import {CSSRulePlugin} from 'gsap/CSSRulePlugin';
import {EaselPlugin} from 'gsap/EaselPlugin';
import {ScrollTrigger} from 'gsap/ScrollTrigger';
import {SplitText} from "../libs/SplitText.min";

gsap.registerPlugin(CSSRulePlugin, EaselPlugin, ScrollTrigger, SplitText);


const teqAnimations = () => {

    // SHOW TEXT FROM BOTTOM TO TOP

    //Split lines & words for animations
    const splitTitle = new SplitText(".splitLine", {type: "lines, words", linesClass:"lines", wordsClass:"word"});

    // How to use : add classes "splitLine animTextShowUp" to the element.
    gsap.utils.toArray(".animTextShowUp").forEach((text, i) => {
        const child = text.querySelectorAll('.word');
        gsap.from(child, {
            yPercent:100,
            alpha:0,
            stagger: {each: 0.2},
            scrollTrigger: {
                trigger: text,
                start: "top 80%",
                toggleActions: "play none play reverse",
            }
        });
    });

    // Variant with overflow hidden on parent
    gsap.utils.toArray(".showUp").forEach((text, i) => {
        const children = text.querySelectorAll('.word');

        gsap.from(children, {
            yPercent: 100,
            alpha: 0,
            duration: 0.6,
            scrollTrigger: {
                trigger: text,
                start: "top 90%",
                toggleActions: "play none play reverse",

            }
        });
    });

    // variant with content
    // How to use : add class "sanim-childs-reveal" to the container +
    // add class "anim-childs-reveal-item" to items to show
    gsap.utils.toArray(".anim-childs-reveal").forEach(box => {
        const childs = box.querySelectorAll('.anim-childs-reveal-item');
        gsap.from(childs, {
            alpha:0,
            y:'50px',
            stagger: {each: 0.2},
            scrollTrigger: {
                trigger: box,
                start: "top 80%",
                toggleActions: "play none play reverse",
            }
        });
    });


    // SHOW CONTENT FROM RIGHT (translateX + opacity)
    // How: add class "animShow" and difine the direction with "data-from"
    // Option left , right; bottom, top
    gsap.utils.toArray(".animShow").forEach((box, i) => {
        const dir = box.dataset.from;
        let x, y;
        switch (dir) {
            case 'right':
                x = '50px';
                y = 0
                break;
            case 'left':
                x = '-50px';
                y = 0
                break;
            case 'bottom':
                x = 0;
                y = '50px';
                break;
            case 'top':
                x = 0;
                y = '-50px';
                break;
        }
        gsap.from(box, {
            x:x,
            y:y,
            alpha:0,
            scrollTrigger: {
                trigger: box,
                start: "top 80%",
                toggleActions: "play none play reverse",
            }
        });
    });


    // SCALE IMG
    // How to use : add class "animScaleImg" to the image
    gsap.utils.toArray(".animScaleImg").forEach((img, i) => {
        gsap.from(img, {
            scale:1.5,
            duration:1,
            scrollTrigger: {
                trigger: img,
                start: "top 80%",
                toggleActions: "play none play reverse",
            }
        });
    })

    // set speed attributes with css class => speed-80 = data-speed="0.8"
    const speedElementsToSet = document.querySelectorAll('[class*=speed-');
    speedElementsToSet.forEach(el => {
        el.classList.forEach(attr => {
            if (attr.startsWith('speed-')) el.setAttribute('data-speed', +attr.split('-')[1] / 100)
        })
    })

    let speedElements = gsap.utils.toArray("[data-speed]");

    speedElements.forEach((el, i) => {
        let speed = parseFloat(el.getAttribute("data-speed"));
        gsap.fromTo(el, {y: 0}, {
            y: 0,
            ease: "none",
            scrollTrigger: {
                trigger: el,
                start: "top bottom",
                end: "bottom top",
                scrub: true,
                onRefresh: self => {
                    let start = Math.max(0, self.start),
                        distance = self.end - start,
                        end = start + (distance / speed);
                    self.setPositions(start, end);
                    self.animation.vars.y = (end - start) * (1 - speed);
                    self.animation.invalidate().progress(1).progress(self.progress);
                }
            }
        })
    })

    ScrollTrigger.update();
}

export default teqAnimations;
