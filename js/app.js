class Drawing {


}

class LetterList {

    constructor (wordLengths) {
        console.log(wordLengths);
        
        this.letterListObject = document.querySelector('#letter-list');
        let wordTemplate = document.querySelector('#tmp-word');
        let letterTemplate = document.querySelector('#tmp-letter');
        this.wordObjects = [];

        for(let i = 0; i < wordLengths.length; i++){
            // Making a word element in the DOM
            let wordObject = wordTemplate.content.cloneNode(true);
            // Adding the lines to it
            for(let i = 0; i < wordLengths[i]; i++){
                wordObject.append(letterTemplate.content.cloneNode(true));
            }
            this.letterListObject.append(wordObject);
        }
        
    }
}

class ApiHelper {

    constructor (url){
        this.url = url;
        console.log(url);
    }

    async getWord () {
        const response = await fetch(`${this.url}/word/getword`);
        const wordsLength = await response.json();
        return wordsLength;
    }


}

class App {

    constructor (apiUrl) {
        this.api = new ApiHelper(apiUrl);
    }

    async init () {
        this.wordsLength = await this.api.getWord();
        this.letters = new LetterList(this.wordsLength);
    }
}

const apiUrl = 'http://localhost/davidkatona/hangman/api';
const app = new App(apiUrl);
app.init();