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
    $id = !empty($_POST['id']) ? $mysqli->real_escape_string(trim(strip_tags($_POST['id']))) : '';

    $query = sprintf("UPDATE users SET username = '%s', email='%s', address='%s' WHERE user_id = %d",
        $username, $email, $address, $id);
    $result = $mysqli->query($query);

    echo json_encode($result);
}