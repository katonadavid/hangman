class Drawing {


}

class LetterList {


}

class ApiHelper {

    constructor (url){
        this.url = url;
        console.log(url);
    }

    async getWord () {
        const response = await fetch(`${this.url}/word/getword`);
        const word = await response.json();
        console.log(word);
        
    }


}

class App {

    constructor (apiUrl) {
        this.api = new ApiHelper(apiUrl);
        this.wordLength = this.api.getWord();
    }

    static init () {
        
        
    }
}

const apiUrl = 'http://localhost/davidkatona/hangman/api';
const app = new App(apiUrl);