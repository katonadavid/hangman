<?php

$word = 'übersetzungsfehler';
$word = mb_strtolower($word);
$wordar = preg_split('//u', $word, null, PREG_SPLIT_NO_EMPTY);
var_dump($wordar);

?>