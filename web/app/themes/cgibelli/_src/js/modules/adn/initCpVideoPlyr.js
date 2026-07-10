import Plyr from 'plyr'


// PLYR DOCUMENTATION : https://github.com/sampotts/plyr

/**
 * Initialization of all the Plyr players
 * @param {String} id The ID of the players
 */
const initCpVideoPlyr = (id) => {
    let ratioVideo;
    
    const allPlyrVideo = document.querySelectorAll(id)

    allPlyrVideo.forEach((video, index) => {
        const component = video.parentElement.parentElement.parentElement
        
        if(component.classList.contains('cp-video-txt-cta')) {
            ratioVideo = '4:3'
        }else {
            ratioVideo = '16:9'
        }

        // Add an unique ID for avoid conflict
        video.id = `player-${index}`

        const player = new Plyr(`#player-${index}`, {
            muted: true,

            /**
             * For Vimeo we can disable controls here, but for 
             * Youtube we need to pass the data inside the HTML (check the component or documentation)
             */
            vimeo: {
                "controls": false,
            },
            ratio: ratioVideo
        });
    })
}

export default initCpVideoPlyr