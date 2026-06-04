
/**
 * Display a grid for development mode
 */
export default function toggleGrid() {
    const grid = document.querySelector('#grid');
    
    if(!grid) {
        return
    }

    const gridVisible = document.cookie.split('; ').find((row) => row.startsWith('grid='))

    // Add automatically the grid on reload if the cookie 'grid' have the 'visible' value
    if(gridVisible === 'grid=visible') {
        grid.classList.add('isVisible')
    }

    // Key event 'ctrl+g' to display or hide the grid and toggle the value of the 'grid' cookie
    window.addEventListener('keyup', (e) => {
        if(e.ctrlKey && e.keyCode === 71) {
            grid.classList.toggle('isVisible')

            if(grid.classList.contains('isVisible')) {
                document.cookie = "grid=visible"
            }else {
                document.cookie = "grid=hidden"
            }
        }
    })
}