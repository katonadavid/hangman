<?php

$urlArray = explode('/', $_SERVER['REQUEST_URI']);

$classToLoad = $urlArray[sizeof($urlArray)-2];
$fnToCall = end($urlArray);

require($classToLoad.'.php');

$main = new $classToLoad;

$main->$fnToCall();

?>