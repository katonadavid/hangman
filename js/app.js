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

    async checkLetter (letter) {
    
        const post = new FormData();
        post.append('letter', letter);
        const response = await fetch(`${this.url}/word/checkletter`,{
            method : 'post',
            body : post
        });
        
        const result = response.json();
        return result;
    }


}

class App {

    constructor (apiUrl) {
        this.api = new ApiHelper(apiUrl);
        this.pastLettersDiv = document.querySelector('#past-letters');
    }
    
    async init () {
        this.wordsLength = await this.api.getWord();
        this.letters = new LetterList(this.wordsLength);
        this.input = document.querySelector('input');
        this.input.addEventListener('input', this.checkLetter.bind(this));
    }

    async checkLetter() {
        const letter = this.input.value;
        this.input.value = '';
        const result = await this.api.checkLetter(letter);
        console.log(result);
        
        
        const letterSpan = document.createElement('span');

        
    }


}

const apiUrl = 'http://localhost/davidkatona/hangman/api';
const app = new App(apiUrl);
app.init();