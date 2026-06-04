/**
 * @param {String} swiper The class name of the swiper
 * @param {String} dataName The name of the attribute 
 * @param {Number || Boolean} defaultValue The default value (check swiper documention)
 * @returns Return an HTML data parsed
 */
 export function parseTheData (swiper, dataName, defaultValue) {
    if(dataName === 'data-centered') {
        return JSON.parse(swiper.getAttribute(dataName)) || defaultValue
    }else
        return parseFloat(swiper.getAttribute(dataName)) || defaultValue
}

/**
 * @param {HTMLElement} swiper The class name of the swiper
 * @param {Object} allDatas All the data without the parsed value
 * @returns {Object} All the datas with the parsed value
 */
 export function allDatasParsed (swiper, allDatas) {
    for (const [key, data] of Object.entries(allDatas)) {
        data.value = parseTheData(swiper, data.nameHTML, data.defaultValue)
    }
    return allDatas
}


/**
 * Add a specific Index for a class element of a swiper
 * @param {Sring} id Id of the swiper 
 * @param {Number} index Index of the swiper  
 * @param {String} className The element class name of the swiper
 */
export function addIndex(id, index, className) {
    if (id.getElementsByClassName(className)[0]) {
        id.getElementsByClassName(className)[0].classList.add(`${className}-${index}`);
    }
}

/**
 * Trigger accessibility focusable and tabindex for each slide
 * @param {Object} slider The swiper
 * @param {String} direction Check the sense of navigation 
 */
export function ariaHiddenSlide(slider, direction) {
        const allSlides = slider.querySelectorAll('.swiper-slide a')
        const slidesVisible = slider.querySelectorAll('.swiper-slide-visible a')

        allSlides.forEach(slide => {
            slide.setAttribute('aria-hidden', true)
            slide.tabIndex = -1
        })

        slidesVisible.forEach(slide => {
            slide.setAttribute('aria-hidden', false)
            slide.tabIndex = 0
        })

        switch (direction) {
            case 'next':
                slidesVisible[0].focus()
            break;
            case 'prev':
                slidesVisible[slidesVisible.length -1 ].focus()
            break;
        }
}