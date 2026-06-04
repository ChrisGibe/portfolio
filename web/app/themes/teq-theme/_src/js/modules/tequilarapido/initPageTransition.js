import Swup from "swup"

const initPageTransition = () => {
    const swup = new Swup({
        animateHistoryBrowsing: true,
        cache: true,
    });

    swup.hooks.on('content:replace', () => {
        window.scrollTo(0)
    }, { before: true });
}

export default initPageTransition