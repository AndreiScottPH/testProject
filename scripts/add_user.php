<?php
require_once 'database_connection.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location:index.php");
    exit();
} else {
    $username = !empty($_POST['username']) ? $mysqli->real_escape_string(trim(strip_tags($_POST['username']))) : '';
    $email = !empty($_POST['email']) ? $mysqli->real_escape_string(trim(strip_tags($_POST['email']))) : '';
    $address = !empty($_POST['address']) ? $mysqli->real_escape_string(trim(strip_tags($_POST['address']))) : '';

    $query = sprintf("INSERT INTO users (username, email, address) VALUES ('%s', '%s', '%s')", $username, $email, $address);
    $mysqli->query($query);

    if ($mysqli->errno) {
        echo json_encode(false);
        exit();
    }

    echo json_encode(true);
}
