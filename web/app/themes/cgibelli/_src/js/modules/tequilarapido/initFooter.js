import gsap from "gsap";

const initFooter = () => {
    // Footer initialization code here
    const $footer = document.querySelector('footer');

    if(!$footer) return;

    const titleContainer = $footer.querySelector('.title-container');
    const customCursorFooter = document.querySelector('.custom-cursor-footer');

    const mousePosition = { x: 0, y: 0 };

    window.addEventListener('mousemove', (event) => {
        mousePosition.x = event.clientX;
        mousePosition.y = event.clientY;
        gsap.to(customCursorFooter, {
            x: mousePosition.x,
            y: mousePosition.y,
            duration: 0.8,
            ease: 'power2.out'
        });
    });

    titleContainer.addEventListener('mouseenter', () => {
        gsap.to(customCursorFooter, {
            opacity: 1,
            scale: 1,
            duration: 0.4,
            ease: 'power2.out'
        });
    });

    titleContainer.addEventListener('mouseleave', () => {
        gsap.to(customCursorFooter, {
            opacity: 0,
            scale: 0,
            duration: 0.4,
            ease: 'power2.out'
        });
    });

}

export default initFooter;
