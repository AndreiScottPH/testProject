<?php
require_once 'database_connection.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location:index.php");
    exit();
} else {

    $per_page = 10;

    $query = sprintf("SELECT COUNT(*) FROM users");
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        $result = $result->fetch_row();
        $result = $result[0];
        $amount_pages = ceil($result / $per_page);
        echo json_encode($amount_pages);
    } else {
        echo json_encode('Данных нет');
    }
}
