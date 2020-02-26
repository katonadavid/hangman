<?php

class Session {

    function clear(){
        $_SESSION['pastletters'] = [];
        $_SESSION['gameWon'] = false;
        $_SESSION['gameOver'] = false;
        $_SESSION['falseTips'] = 0;
    }

    function setGame() {
        $lang = $_POST['lang'];
        $diff = $_POST['diff'];
        $_SESSION['lang'] = $lang;
        $_SESSION['difficulty'] = $diff;
        setcookie("lang", $lang, time() + 604800, "/");
        setcookie('diff', $diff, time() + 604800, "/");
    }
}
?>