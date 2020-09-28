<?php
require_once 'database_connection.php';

authorize::isNotSession();

$username = trim($_POST['username']);
$email = trim($_POST['email']);
$address = trim($_POST['address']);
$id = trim($_POST['id']);

$queryBuilder->updateUser($username, $email, $address, $id);