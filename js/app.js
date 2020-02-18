class Drawing {

    constructor() {
        this.drawing = [
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
        let next = this.drawing.shift();
        if(Array.isArray(next)){
            next.forEach(lineId => {
                let line = document.getElementById(lineId);
                line.classList.add('draw');
            });
        }else{
            let line = document.getElementById(next);
            line.classList.add('draw');
        }
        if(this.drawing.length === 0) {
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
        console.log(result);
        
        return result;
    }


}

class App {

    constructor (apiUrl) {
        this.api = new ApiHelper(apiUrl);
        this.pastLettersDiv = document.querySelector('#past-letters');
        this.drawing = new Drawing();
    }
    
    async init () {
        this.wordsLength = await this.api.getWord();
        this.letters = new LetterList(this.wordsLength);
        this.input = document.querySelector('input');
        this.input.addEventListener('input', this.checkLetter.bind(this));
    }

    async checkLetter() {
        const letter = this.input.value;
        console.log('Letter:' +letter);
        
        this.input.value = '';
        let result = await this.api.checkLetter(letter);
        
        if(result){
            // The element on index 0 is a boolean, which describes if we have the letter in the words
            if(result[0]){
                this.letters.drawLetter(letter, result[1]);
                let pastletter = document.createElement('span');
                pastletter.innerText = letter.toUpperCase();
                this.pastLettersDiv.append(pastletter);
            }else{
                this.drawing.drawNextItem();
            }
        }else {
            alert('már használtad');
        }
    }
}

const apiUrl = 'http://localhost/davidkatona/hangman/api';
const app = new App(apiUrl);
app.init();