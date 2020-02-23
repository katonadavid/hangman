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
        this.drawingDeadItems = [
            [
                'eye1-path',
                'eye2-path',
                'mouth-path'
            ],
            [
                'eye1-dead-path1', 
                'eye1-dead-path2', 
                'eye2-dead-path1', 
                'eye2-dead-path2',
                'mouth-dead-path'
            ]
        ];
        this.drawingHappyItems = [
            ['mouth-path'],
            ['happy-path']
        ];
    }

    drawNextItem() {
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
    }

    gameOver() {
        this.drawingDeadItems[0].forEach( item => {
            document.getElementById(item).remove();
        });
        this.drawingDeadItems[1].forEach( item => {
            document.getElementById(item).classList.add('draw');
        });
    }

    gameWon() {
        if(this.drawingSvg.classList.contains('hasHead')){
            this.drawingHappyItems[0].forEach( item => {
                document.getElementById(item).remove();
            });
            this.drawingHappyItems[1].forEach( item => {
                document.getElementById(item).classList.add('draw');
            });
        }
    }
}

class LetterList {

    constructor (wordLengths) {
        this.letterListObject = document.querySelector('#letter-list');
        this.wordObjects = [];
        this.words = [];
        
        document.querySelector('#wordCount').innerText = wordLengths.length > 1 ? wordLengths.length + ' words' : wordLengths.length + ' word';
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
        try{
            const result = await response.json();
            return result;
        }catch(e){
            console.log(e.message);
            console.log('Something went wrong. The game probably ended.');
            
        }
    }
}

class UIFeedback {

    constructor() {
        this.invalidModal = document.querySelector('#invalid-input-modal');
        this.gameWonModal = document.querySelector('#gameWon-modal');
        this.gameOverModal = document.querySelector('#gameOver-modal');
    }

    invalidInput(){
        this.invalidModal.classList.add('visible');
        setTimeout(() => {
            this.invalidModal.classList.remove('visible');
        }, 4000);
    }

    gameWon(){
        this.gameWonModal.classList.add('visible');
    }
    
    gameOver(){
        this.gameOverModal.classList.add('visible');
    }
}

class Settings {

    constructor(){
        this.toggler = document.querySelector('#settings > div:first-child');
        this.dropdown = document.querySelector('#settings > div:nth-child(2)');
        this.difficultyRange = document.querySelector('input[type="range"]');
        this.toggler.addEventListener('click', this.slideToggle.bind(this));
        this.difficultyRange.addEventListener('input', this.changeRangeColor);
    }

    slideToggle(){
        $('#settings > div:nth-child(2)').slideToggle();
        $('#settings > div:first-child').toggleClass('pushed');
    }

    changeRangeColor(){

        this.className = '';

        switch(this.value){
            case '1' :
                this.classList.add('easy');
                break;
            case '2' :
                this.classList.add('medium');
                break;
            case '3' :
                this.classList.add('hard');
        }
    }

}

class App {

    constructor (apiUrl) {
        this.api = new ApiHelper(apiUrl);
        this.pastLetters = new PastLetterList();
        this.drawing = new Drawing();
        this.ui = new UIFeedback();
        this.settings = new Settings();
    }
    
    async init () {
        this.wordsLength = await this.api.getWord();
        this.letters = new LetterList(this.wordsLength);
        this.input = document.querySelector('#letterinput');
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
            this.ui.invalidInput();
        }
    }

    async checkLetter(letter) {

        let checkResult = await this.api.checkLetter(letter);
        console.log(checkResult);
        
        if(checkResult){
            // The element on index 0 is a boolean, which describes if we have the letter in the words
            if(checkResult[0]){
                this.letters.drawLetter(letter, checkResult[1]);
                if(checkResult[2]){
                    this.hideInputField();
                    this.drawing.gameWon();
                    this.ui.gameWon();
                }
            }else{
                this.drawing.drawNextItem();
                // The 4th element in the response describes if the game is over
                if(checkResult[3]){
                    this.hideInputField();
                    this.drawing.gameOver();
                    this.ui.gameOver();
                }
                // !checkResult[3] - if the game is not over, then make the surprised face.
                if(this.drawing.drawingSvg.classList.contains('hasHead') && !checkResult[3]){
                    this.drawing.drawingSvg.classList.add('surprised');
                    setTimeout(() => {
                        this.drawing.drawingSvg.classList.remove('surprised');
                    }, 1500);
                }
            }
            this.pastLetters.appendLetter(letter);
        }else if(checkResult === false){
            this.pastLetters.flashLetter(letter);
        }
    }

    hideInputField() {
        this.input.classList.add('fadeOut');
        setTimeout(() => {
            this.input.remove();
        }, 500);
    }
}

const apiUrl = 'http://localhost/davidkatona/hangman/api';
const app = new App(apiUrl);
app.init();