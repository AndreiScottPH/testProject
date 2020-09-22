<?php

require_once 'app_config.php';

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);;
$mysqli->query("SET NAMES utf8");
