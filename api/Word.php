<?php

require('DBC.php');

class Word {

    private $dbc;

    function getWord() {

        // Get a record from the DB
        $this->dbc = new Database();
        $this->dbc->query("SELECT word FROM words_".$_SESSION['lang']." ORDER BY RAND() LIMIT 1");
        $row = $this->dbc->single();

        // trimming word
        $word = trim($row->word);

        // We might get compound words, so we explode the returned string into words
        $wordsArray = explode(' ',$word);

        foreach ($wordsArray as $i => $word) {
            // Converting the words to lowercase, and split it to array with multibyte chars preserved
            $wordsArray[$i] = preg_split('//u', mb_strtolower($word), null, PREG_SPLIT_NO_EMPTY);
        }

        $_SESSION['word'] = $wordsArray;

        $wordsLengths = [];

        // Preparing the array of word lengths to be returned
        foreach($wordsArray as $word){
            $wordsLengths[] = sizeof($word);
        }

        echo json_encode($wordsLengths, JSON_UNESCAPED_UNICODE);
    }

    function checkLetter() {
        $letter = mb_strtolower($_POST['letter']);
        $charactersArray = $_SESSION['word'];
        $letterIndexes = [];

        // If the player has not yet used this letter
        if(!in_array($letter, $_SESSION['pastletters'])){
            $_SESSION['pastletters'][] = $letter;
            $letterFound = false;
            $gameWon = false;
            $gameOver = false;

            for($i = 0; $i < sizeof($charactersArray); $i++){
                
                $letterIndexes[$i] = [];
                
                for($j = 0; $j < sizeof($charactersArray[$i]); $j++){
                    if($charactersArray[$i][$j] == $letter){
                        $letterFound = true;
                        $letterIndexes[$i][] = $j;
                    }
                }

                if($letterFound){
                    if(!$this->checkLettersLeft()){
                        $gameWon = true;
                        $_SESSION['gameWon'] = true;
                    }
                }
            }
            
            if(!$letterFound){
                $_SESSION['falseTips']++;
                    if($_SESSION['falseTips'] === STEPS_TILL_DEATH){
                        $gameOver = true;
                        $_SESSION['gameOver'] = true;
                    }
            }

            echo json_encode([$letterFound, $letterIndexes, $gameWon, $gameOver], JSON_UNESCAPED_UNICODE);
        }else{
            // We return false, if the user has tried this letter already
            echo json_encode(false, JSON_UNESCAPED_UNICODE);
        }
    }

    function checkLettersLeft () {
        // If there are letters left, we return true;
        $lettersMissing = false;
        $i = 0;
        while(!$lettersMissing && $i < sizeof($_SESSION['word'])){
            $lettersMissing = sizeof(array_diff($_SESSION['word'][$i], $_SESSION['pastletters'])) > 0 ? true : false;
            $i = $lettersMissing ? $i : $i + 1;
        }
        if($i == sizeof($_SESSION['word'])){
            // There are no letters missing
            return false;
        }else{
            return true;
        }
    }
}

?>