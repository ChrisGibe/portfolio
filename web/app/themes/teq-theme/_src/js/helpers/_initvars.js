function initvars() {

    // VH and VW FOR MOBILES
    let vh = window.innerHeight * 0.01;
    let vw = window.innerWidth * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
    document.documentElement.style.setProperty('--vw', `${vw}px`);

    // HEADER HEIGHT VAR
    const menu = document.querySelector('.header-desk');
    if (!menu) {
        return;
    }
    let headerHeight = menu.offsetHeight;

    document.documentElement.style.setProperty('--headerHeight', `${headerHeight}px`);


    addEventListener('resize', (event) => {
        let vh = window.innerHeight * 0.01;
        let vw = window.innerWidth * 0.01;
        document.documentElement.style.setProperty('--vh', `${vh}px`);
        document.documentElement.style.setProperty('--vw', `${vw}px`);
        document.documentElement.style.setProperty('--headerHeight', `${headerHeight}px`);

    });
}

export default initvars;
