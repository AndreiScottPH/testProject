<?php
require_once 'database_connection.php';

session_start();
if (!empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = sprintf("SELECT user_id, password FROM users WHERE login = '%s'", $username);
    $result = $mysqli->query($query);
    if ($result->num_rows == 1) {
        $result = $result->fetch_array();
        if (password_verify($password, $result['password'])) {
            $_SESSION['user_id'] = $result['user_id'];
        } else {
            $header_error = 'Неверный логин/пароль';
        }
    }
}