<?php
require 'autoload.php';

define("DEV", true);
if(DEV==false)
    error_reporting(0);

$pdo = new PDO("mysql:host=127.0.0.1;dbname=testproject_interlabs;charset=utf8", 'root', 'root');
$queryBuilder = new queryBuilder($pdo);