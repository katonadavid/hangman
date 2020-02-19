class Drawing {

    constructor() {
        this.drawingSvg = document.querySelector('#man');
        this.drawingItems = [
            'ground-path',
            'wood1-path',
            'wood2-path',
            'wood3-path',
            'wood4-path',
            [
                'head1-path',
                'eye1-path',
                'eye2-path',
                'mouth-path'
            ],
            'body-path',
            'left-arm-path',
            'right-arm-path',
            'left-leg-path',
            'right-leg-path'
        ];
    }

    drawNextItem(){
        let next = this.drawingItems.shift();
        if(Array.isArray(next)){
            this.drawingSvg.classList.add('hasHead');
            next.forEach(lineId => {
                let line = document.getElementById(lineId);
                line.classList.add('draw');
            });
        }else{
            let line = document.getElementById(next);
            line.classList.add('draw');
        }
        if(this.drawingItems.length === 0) {
            alert('Game over');
        }
    }
}

class LetterList {

    constructor (wordLengths) {
        this.letterListObject = document.querySelector('#letter-list');
        this.wordObjects = [];
        this.words = [];
        let wordTemplate = document.querySelector('#tmp-word');
        let letterTemplate = document.querySelector('#tmp-letter');

        wordLengths.forEach( (length, index) => {
            
            let wordObject = wordTemplate.content.cloneNode(true).querySelector('div');
            this.words[index] = [];

            for(let j = 0; j < length; j++){
                let letterObject = letterTemplate.content.cloneNode(true).querySelector('div');
                
                this.words[index].push(letterObject.querySelector('span'));
                wordObject.append(letterObject);
            }
            
            this.wordObjects.push(wordObject);
            this.letterListObject.append(wordObject);
        });
    }

    drawLetter(letter, indexArrays) {
        indexArrays.forEach((indexArray, i) => {
            
            indexArray.forEach(index => {
                this.words[i][index].innerText = letter;
            });
        });
    }
}

class PastLetterList {

    constructor () {
        this.pastLettersObject = document.querySelector('#past-letters');
        this.pastLetterList = [];
    }

    appendLetter (letter) {
        let pastletter = document.createElement('span');
        pastletter.innerText = letter.toUpperCase();
        this.pastLettersObject.append(pastletter);
        this.pastLetterList[letter] = pastletter;
    }

    flashLetter (letter) {
        this.pastLetterList[letter].classList.add('flash-red');
        setTimeout(() => {
            this.pastLetterList[letter].classList.remove('flash-red');
        }, 1000);
    }

}

class ApiHelper {

    constructor (url){
        this.url = url;
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
        const result = await response.json();
        return result;
    }


}

class App {

    constructor (apiUrl) {
        this.api = new ApiHelper(apiUrl);
        this.pastLetters = new PastLetterList();
        this.drawing = new Drawing();
    }
    
    async init () {
        this.wordsLength = await this.api.getWord();
        this.letters = new LetterList(this.wordsLength);
        this.input = document.querySelector('input');
        this.input.addEventListener('input', this.checkInput.bind(this));
    }

    checkInput() {
        const letter = this.input.value;
        const charRegex = new RegExp('[a-zA-ZÀ-ž]');
        this.input.value = '';
        let validLetter = charRegex.test(letter);
        
        if(validLetter){
            this.checkLetter(letter);
        }else{
            alert('not a valid input');
        }
    }

    async checkLetter(letter) {

        let checkResult = await this.api.checkLetter(letter);

        if(checkResult){
            // The element on index 0 is a boolean, which describes if we have the letter in the words
            if(checkResult[0]){
                this.letters.drawLetter(letter, checkResult[1]);
            }else{
                this.drawing.drawNextItem();
                if(this.drawing.drawingSvg.classList.contains('hasHead')){
                    this.drawing.drawingSvg.classList.add('surprised');
                    setTimeout(() => {
                        this.drawing.drawingSvg.classList.remove('surprised');
                    }, 1500);
                }
            }
            this.pastLetters.appendLetter(letter);
        }else{
            this.pastLetters.flashLetter(letter);
        }
    }
}

const apiUrl = 'http://localhost/davidkatona/hangman/api';
const app = new App(apiUrl);
app.init();