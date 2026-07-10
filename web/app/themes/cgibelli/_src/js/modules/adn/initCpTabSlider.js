const initCpTabSlider = () => {
    const tabSliders = document.querySelectorAll('.cp-tab-slider')

    if(!tabSliders) {
        return
    }

    /**
     * Change all the aria-current to false
     * @param {HTMLElement} buttons All the buttons .label-btn
     * @param {HTMLElement} currentButton The button being clicked on
     */
    const ariaCurrentFalse = (buttons, currentButton) => {
        buttons.forEach(button => {
            if (button === currentButton) return;
            button.setAttribute('aria-current', "false")
        })
    }

    // Just giving some random data-values to slides for testing purposes
    const updateSwiperEvent = new Event("updateswiper");

    /**
     * Click (and keyboard) event to switch aria-current to true
     */
    tabSliders.forEach(slider => {
        const labelButtons = slider.querySelectorAll('.label-btn')
        const slides = slider.querySelectorAll('.swiper-slide');

        labelButtons.forEach(button => {
            button.addEventListener('click', () => {
                ariaCurrentFalse(labelButtons, button)
                button.setAttribute('aria-current', button.getAttribute('aria-current') === 'true' ? 'false' : 'true');
                let newSlidesLength = 0;

                slides.forEach(slide => {
                    if (button.getAttribute('aria-current') === 'true') {
                        if (slide.getAttribute('data-value') === button.getAttribute('data-value')) {
                            slide.style.display = 'block';
                            newSlidesLength += 1;
                        }
                        else slide.style.display = 'none';
                    }
                    else {
                        slide.style.display = 'block';
                        newSlidesLength = 1;
                    }
                })
                if (newSlidesLength === 0) slider.querySelector('.swiper').style.display = "none";
                else slider.querySelector('.swiper').style.display = "block";
                document.dispatchEvent(updateSwiperEvent)
            })
        })
    }) 
}

export default initCpTabSlider