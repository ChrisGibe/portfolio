function initCpMenu() {

    const menu = document.querySelector('.menu-nav');
    const menuLinks = menu.querySelectorAll('.menu-link');

    const burger = document.querySelector('.burger-inner')


    menuLinks.forEach((link) => {
        const toOpen = link.nextElementSibling;
        link.addEventListener('click', function (e) {
            if (toOpen) {
                e.preventDefault();
            }
            if (!toOpen.classList.contains('menu-opened')) {
                if (menu.querySelector('.menu-opened')) {
                    menu.querySelector('.menu-opened').classList.remove('menu-opened');
                }
                toOpen.classList.add('menu-opened');
            } else {
                menu.querySelector('.menu-opened').classList.remove('menu-opened');
            }
        });


        link.addEventListener("keyup", function (event) {
            event.preventDefault();
            if (event.keyCode === 13) {
                toggleSub(link,toOpen);
            }

        });

    });

    burger.addEventListener('click', function () {
        menu.classList.toggle('active')
    })


    function toggleSub(link,toOpen) {
        link.setAttribute(
            'aria-expanded',
            `${!(link.getAttribute('aria-expanded') === 'true')}`
        );
        const subLinksToToggle = toOpen.querySelectorAll('a');
        subLinksToToggle.forEach( (link) => {
            const tabIndex = link.tabIndex;
            const newIndex = ((tabIndex === -1) ? 0 : -1);
            link.tabIndex = newIndex;
        })

    }
}

export default initCpMenu;