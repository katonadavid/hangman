class Drawing {


}

class LetterList {

    constructor (wordLengths) {
        console.log(wordLengths);
        
        this.letterListObject = document.querySelector('#letter-list');
        let wordTemplate = document.querySelector('#tmp-word');
        let letterTemplate = document.querySelector('#tmp-letter');
        this.wordObjects = [];

        wordLengths.forEach( length => {
            
            let wordObject = wordTemplate.content.cloneNode(true).querySelector('div');

            for(let j = 0; j < length; j++){
                let letterObject = letterTemplate.content.cloneNode(true);
                this.wordObjects.push(wordObject);
                wordObject.append(letterObject);
            }
            this.letterListObject.append(wordObject);
        });
        
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