<?php

require('DBC.php');

class Word {

    private $dbc;
    private $word;

    function getWord() {

        $this->dbc = new Database();

        $this->dbc->query("SELECT word FROM words_".$_SESSION['lang']." ORDER BY RAND() LIMIT 1");
        $row = $this->dbc->single();
        $word = $row->word;
        $_SESSION['word'] = $word;
        echo json_encode($word, JSON_UNESCAPED_UNICODE);
    }

    function checkLetter() {

        $letter = 't';
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