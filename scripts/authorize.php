<?php
require_once 'database_connection.php';

session_start();
if (!empty($_POST)) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $query = sprintf("SELECT admin_id, password FROM admin WHERE login = '%s'", $login);
    $result = $mysqli->query($query);
    if ($result->num_rows == 1) {
        $result = $result->fetch_array();
        if (password_verify($password, $result['password'])) {
            $_SESSION['admin_id'] = $result['admin_id'];
        } else {
            $error = 'Неверный логин/пароль';
        }
    } else {
        $error = 'Неверный логин/пароль';
    }
}