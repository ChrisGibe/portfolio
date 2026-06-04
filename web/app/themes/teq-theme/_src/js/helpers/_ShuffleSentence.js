class ShuffleSentence {
    /**
     * Shuffle animation for a sentence
     * @param {String} content all the words of the sentence
     * @param {HTMLElement} container the container of the sentence
     * @param {Number} iterations number or iterations word your word or sentence
     */
    constructor(content, container, iterations) {
        this.container = container
        this.word = content;
        this.sentenceSplitted = this.word.split(' ')
        this.MAX_ITERATIONS = iterations;
        this.animate();
    }

    /**
     * Trigger the animation
     */
    animate() {
        this.container.addEventListener('mouseover', () => {
            let i = 0;
            let timer = setInterval(() => {

                this.sentenceSplitted.forEach((element, index) => {
                    if(element.length > 0) {
                        const splittedWord = this.shuffleArray(element.split(''))
                        this.sentenceSplitted[index] = splittedWord
                    }
                });
    
                this.container.innerText = this.sentenceSplitted.join(' ').toString()
                
                i === this.MAX_ITERATIONS ? this.endTimer(timer) : null;
    
                i++
            }, 70)
        })
    }

    /**
     * Shuffle the Array
     * @param {Array} splittedWord An array splitted
     * @returns {Array} A new splitted array
     */
    shuffleArray(splittedWord) {
        for (let i = splittedWord.length - 1; i > 0; i--) {

            const randomNumber = Math.floor(Math.random() * (i + 1));
            const temporaryWord = splittedWord[i];
    
            splittedWord[i] = splittedWord[randomNumber];
            splittedWord[randomNumber] = temporaryWord;
          }
        
        return splittedWord.join('')
    }

    /**
     * Stop the setInterval and display the word
     * @param {Function} callBack The setInterval
     */
    endTimer(callBack) {
        clearInterval(callBack)
        this.container.innerText = this.word
    }
}

export default ShuffleSentence