<?php
require_once 'database_connection.php';

session_start();

if (isset($_SESSION['user_id']) && !isset($_SESSION['admin'])) {
    $query = sprintf("SELECT label FROM users WHERE user_id = '%s'", $_SESSION['user_id']);
    $result = $mysqli->query($query);
    $result = $result->fetch_array();
    if (isset($result['label']) && strlen($result['label']) == 5) {
        $_SESSION['admin'] = true;
    } else {
        $_SESSION['admin'] = false;
    }
}

