<?php
require_once 'database_connection.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location:index.php");
    exit();
} else {
    $email = !empty($_POST['email']) ? $mysqli->real_escape_string(trim(strip_tags($_POST['email']))) : '';
    $query = sprintf("SELECT email FROM users WHERE email='%s'", $email);
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        echo json_encode('Данный email занят');
    } else {
        echo json_encode('email свободен');
    }
}
