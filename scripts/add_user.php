<?php

require_once 'database_connection.php';


$username = !empty($_POST['username']) ? $mysqli->real_escape_string(trim(strip_tags($_POST['username']))) : '';
$email = !empty($_POST['email']) ? $mysqli->real_escape_string(trim(strip_tags($_POST['email']))) : '';
$address = !empty($_POST['address']) ? $mysqli->real_escape_string(trim(strip_tags($_POST['address']))) : '';

$query=sprintf("INSERT INTO use (username, email, address) VALUES ('%s', '%s', '%s')", $username, $email, $address);
$mysqli->query($query);

if ($mysqli->errno){
    return false;
}


echo json_encode(true);

