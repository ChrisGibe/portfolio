import gsap from "gsap";
export function initFilters (baseUrl, slug, value, type, selectedFilter, selectedTaxo) {
    let url = '';
    let queryFilters;
    let queryTaxos;


    let tl = gsap.timeline();
    tl.to('.container-result',{
        alpha:0,
        duration:0.3
    });

    if(slug || value){
        queryFilters = '';
        if(type == 'taxo'){
            if(slug && !value) {
                delete selectedTaxo[slug];
            }else{
                selectedTaxo[slug] = value;
            }
        }else{
            if(slug && !value) {
                delete selectedFilter[slug];
            }else{
                selectedFilter[slug] = value;
            }
        }
        Object.keys(selectedFilter).forEach((slug, index) => {
            queryFilters = queryFilters.concat('&', slug + '=' + selectedFilter[slug]);
        });
        url = baseUrl + queryFilters;

    }
    else{
        url = baseUrl
        selectedFilter = {};
        selectedTaxo = {};
    }


    return {url, selectedFilter, selectedTaxo} ;
}
