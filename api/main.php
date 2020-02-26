<?php

header("Access-Control-Allow-Origin: *");
session_save_path('../sess');
session_start();

define('STEPS_TILL_DEATH', 11);

if(!isset($_SESSION['pastletters'])){
    $_SESSION['pastletters'] = [];
}

if(!isset($_SESSION['gameOver'])){
    $_SESSION['gameOver'] = false;
}

if(!isset($_SESSION['gameWon'])){
    $_SESSION['gameWon'] = false;
}

if(!isset($_SESSION['falseTips'])){
    $_SESSION['falseTips'] = 0;
}

$urlArray = explode('/', $_SERVER['REQUEST_URI']);

$classToLoad = $urlArray[sizeof($urlArray)-2];
$fnToCall = end($urlArray);

require($classToLoad.'.php');

$main = new $classToLoad;

$main->$fnToCall();

?>