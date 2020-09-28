<?php
require 'autoload.php';

define("DEV", false);
if(DEV==false)
    error_reporting(0);

//$pdo = new PDO("mysql:host=127.0.0.1;dbname=testproject_interlabs;charset=utf8", 'root', 'root');
$pdo = new PDO("mysql:host=localhost; dbname=andreialbm;", 'andreialbm', 'PfUABPGEx39x8q2',
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

$queryBuilder = new queryBuilder($pdo);