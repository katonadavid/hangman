<?php

session_save_path('../sess');
session_start();
var_dump($_SESSION);
var_dump($_COOKIE);

?>