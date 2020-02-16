<?php

header("Access-Control-Allow-Origin: *");
session_save_path('../sess');
session_start();


$_SESSION['lang'] = 'en';
$_SESSION['pastletters'] = [];

$urlArray = explode('/', $_SERVER['REQUEST_URI']);

$classToLoad = $urlArray[sizeof($urlArray)-2];
$fnToCall = end($urlArray);

require($classToLoad.'.php');

$main = new $classToLoad;

$main->$fnToCall();

?>