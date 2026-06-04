import { createApp } from 'vue';
import CpSearch from './components/CpSearch.vue';
const initCpSearch = () => {
    const $container = document.querySelector('#cp-search');

    if (!$container) {
        return
    }
    const app = createApp({
        components: {
            'cp-search': CpSearch,
        }
    });
   
    app.mount($container)
    
}

export default initCpSearch