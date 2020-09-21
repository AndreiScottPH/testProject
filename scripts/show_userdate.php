<?php
require_once 'database_connection.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location:index.php");
    exit();
} else {
    $id = !empty($_POST['id']) ? $mysqli->real_escape_string(trim(strip_tags($_POST['id']))) : '';

    $query = sprintf("SELECT user_id, username, email, address FROM users WHERE user_id = %d", $id);
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        while ($item = $result->fetch_array()) {
            $row[] = $item;
        }
        echo json_encode($row);
    } else {
        echo json_encode('Данных нет');
    }
}