<?php
require_once 'database_connection.php';

authorize::isNotSession();

$username = trim($_POST['username']);
$email = trim($_POST['email']);
$address = trim($_POST['address']);

$queryBuilder->addUser($username, $email, $address);