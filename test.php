<?php

$word = 'geschirrspülmaschine ';
$wordar = explode(' ',$word);
var_dump($wordar);
$nw = preg_split('//u', mb_strtolower($word), null, PREG_SPLIT_NO_EMPTY);

var_dump($nw);

?>