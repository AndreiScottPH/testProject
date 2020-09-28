<?php
require_once 'database_connection.php';

authorize::isNotSession();

$per_page = !empty($_POST['per_page']) ? trim($_POST['per_page']) : 10;
$num_page = !empty($_POST['page']) ? trim($_POST['page']) : 0;
$num_page = $num_page * $per_page;
$sortingDirect = !empty($_POST['sorting']) ? 'DESC' : 'ASC';
$sort_name = !empty($_POST['sort_name']) ? $_POST['sort_name'] : 'user_id';

$qer=$queryBuilder->showUsers($sort_name, $sortingDirect, $num_page, $per_page);