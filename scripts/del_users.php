<?php
require_once 'database_connection.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location:index.php");
    exit();
} else {
    foreach ($_POST['usersCheck'] as $user_id) {
        $query = sprintf("DELETE FROM users WHERE user_id = %d", $user_id);
        $i = $mysqli->query($query);
        if ($mysqli->errno) {
            echo json_encode(false);
            break;
        }
    }
    echo json_encode(true);
}

