<?php
require_once 'database_connection.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location:index.php");
    exit();
} else {
    $query = sprintf("SELECT user_id, username, email, address FROM users");
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        while ($item = $result->fetch_array()) {
            $row[] = $item;
        }
    }

    echo json_encode($row);
}