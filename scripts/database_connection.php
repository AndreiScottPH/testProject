<?php

require_once 'app_config.php';

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

//if ($mysqli->connect_errno) {
//    handle_error("Ошибка", $mysqli->connect_error);
//}
