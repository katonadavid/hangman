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
        $letter = strtoupper($_POST['letter']);
        $wordArray = $_SESSION['word'];
        $letterIndexes = [];

        // If the player has not yet used this letter
        if(!in_array($letter, $_SESSION['pastletters'])){

            $_SESSION['pastletters'][] = $letter;

            for($i = 0; $i < sizeof($wordArray); $i++){
                
                $word = strtoupper($wordArray[$i]);

                for($j = 0; $j < strlen($word); $j++){
                    
                    if($word[$j] == $letter){
                        $letterIndexes[] = $j;
                    }
                }
            }
            echo json_encode($letterIndexes, JSON_UNESCAPED_UNICODE);
            // Itt folytatni. hiába regisztrálja a múltbeliek közé a betűt, a response marad az indextömb
        }else{
            echo json_encode(false, JSON_UNESCAPED_UNICODE);
        }
    }
}

?>