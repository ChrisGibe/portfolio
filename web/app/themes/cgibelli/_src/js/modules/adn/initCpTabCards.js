/**
 * All Functions : 
 *  - getTransform
 *  - getAllListInterviewsMenus
 *  - getAllLinksFromMenus
 *  - getAllActiveLinks
 *  - onItemClick
 *  - initListInterviews (Main function)
 */

/**
 * @param {HTMLElement} element 
 * @return {String} example: "translateX(10px) scaleX(1)"
 */
 const getTransform = (element) => {
    const transform = {
        x: element.offsetLeft,
        scaleX: element.offsetWidth / 100
    }

    return `translateX(${transform.x}px) scaleX(${transform.scaleX})`
}

/**
 * Return All the menu from all the cp-tab-cards inside a page
 * @returns {Array[HTMLElement]} All the menus 
 */
const getAllListInterviewsMenus = () => {
    const allListInterviewsMenus = Array.from(document.querySelectorAll('.cp-tab-cards .label-ul'));

    if(!allListInterviewsMenus) {
        return
    }

    allListInterviewsMenus.forEach(menu => {
        const indicator = document.createElement('span')
        indicator.classList.add('indicator')

        menu.appendChild(indicator)
    })

    return allListInterviewsMenus
}

/**
 * Return All the links inside all the menus from all the cp-tab-cards inside a page
 * @param {Array[HTMLElement]} allMenus 
 * @returns {Array[HTMLElement]} All the links from all the menus
 */
const getAllLinksFromMenus = (allMenus) => {
    if(!allMenus) {
        return
    }

    let allLinks = []
    allMenus.forEach(menu => {
       let list = Array.from(menu.querySelectorAll('li button'));
       allLinks.push(...list)
    })

    return allLinks
}

/**
 * Return all the active links from all the cp-tab
 * @param {Array[HTMLElement]} allMenus 
 * @returns {Array[HTMLElement]} All the active links
 */
const getAllActiveLinks = (allMenus) => {
    let allActiveItems = []
    allMenus.forEach(menu => {
        let itemActive = menu.querySelector('[aria-current]')
        allActiveItems.push(itemActive)
    })

    return allActiveItems
}

/**
 * callBack for the click event
 * @param {{currentTarget: HTMLElement}}
 */
 const onItemClick = (e) => {
    if(e.currentTarget.getAttribute('aria-current') === true) {
        return
    }

    const $menu = e.currentTarget.parentElement.parentElement

    // Remove 'aria-current' for all the links
    const linksFromCurrentMenu = Object.values($menu.children)
    linksFromCurrentMenu.forEach(link => {
        link.removeAttribute('aria-current')
    })
 
    e.currentTarget.setAttribute('aria-current', 'true')

    // Move indicator
    const indicator = $menu.lastChild
    indicator.animate([
        {transform: getTransform(e.currentTarget)}
    ], {
        fill:'both', 
        duration: 600,
        easing: 'cubic-bezier(.48,1.55,.28,1)'
    })
}

/**
 * For Each Menu from cp-tab
 * Set position of the indicator line and add click event for the link navigation
 */
const initCpTabCards = () => {
    const allMenus = getAllListInterviewsMenus()
    const allMenusLinks = getAllLinksFromMenus(allMenus)
    const allActiveLinks = getAllActiveLinks(allMenus)

    if(allActiveLinks) {
        allActiveLinks.forEach(activeLink => {
            const indicator = activeLink.parentElement.parentElement.lastChild
            indicator.style.setProperty('transform', getTransform(activeLink))
        })
    }

    if(allMenusLinks) {
        allMenusLinks.forEach((link) => {
            link.addEventListener('click', onItemClick)
        })
    }
}

export default initCpTabCards