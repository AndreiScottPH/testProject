<?php
require_once 'database_connection.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location:index.php");
    exit();
} else {

    $per_page = !empty($_POST['per_page']) ? $mysqli->real_escape_string(trim(strip_tags($_POST['per_page']))) : '';;

    $query = sprintf("SELECT COUNT(*) FROM users");
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        $result = $result->fetch_row();
        $result = $result[0];
        settype($result, 'integer');
        $amount_pages = ceil($result / $per_page);
        $amount = ['pages' => $amount_pages, 'users' => $result];
        echo json_encode($amount);
    } else {
        echo json_encode('Данных нет');
    }
}
