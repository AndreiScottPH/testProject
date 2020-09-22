<?php
require_once 'database_connection.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location:index.php");
    exit();
} else {
    $per_page = !empty($_POST['per_page']) ? $mysqli->real_escape_string(trim(strip_tags($_POST['per_page']))) : '';
    $num_page = !empty($_POST['page']) ? $mysqli->real_escape_string(trim(strip_tags($_POST['page']))) : '';
    $num_page = $num_page * $per_page;
    $sorting = !empty($_POST['sorting']) ? $mysqli->real_escape_string(trim(strip_tags($_POST['sorting']))) : 'ASC';
    $sort_name = !empty($_POST['sort_name']) ? $mysqli->real_escape_string(trim(strip_tags($_POST['sort_name']))) : 'user_id';
    $query = sprintf("SELECT user_id, username, email, address FROM users ORDER BY %s %s LIMIT %d, %d",
        $sort_name, $sorting, $num_page, $per_page);
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