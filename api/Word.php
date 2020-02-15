<?php

require('DBC.php');

class Word {

    private $dbc;
    private $word;

    function getWord() {

        // Get a record from the DB
        $this->dbc = new Database();
        $this->dbc->query("SELECT word FROM words_".$_SESSION['lang']." ORDER BY RAND() LIMIT 1");
        $row = $this->dbc->single();

        // We might get compound words, so we explode the returned string into words
        $wordsArray = explode(' ',$row->word);
        $_SESSION['word'] = $wordsArray;

        $wordLength = [];

        // Preparing the array of word lengths to be returned
        foreach($wordsArray as $word){
            $wordLength[] = strlen($word);
        }

        echo json_encode($wordLength, JSON_UNESCAPED_UNICODE);
    }

    function checkLetter() {

        $letter = 'p';
        $word = $_SESSION['word'];

        $letterIndexes = [];

        for($i = 0; $i < strlen($word); $i++){
            if($word[$i] == $letter){
                $letterIndexes[] = $i;
            }
        }

        echo json_encode($letterIndexes, JSON_UNESCAPED_UNICODE);

    }
}

?>