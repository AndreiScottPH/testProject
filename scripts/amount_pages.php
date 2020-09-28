<?php
require_once 'database_connection.php';

authorize::isNotSession();

$per_page = !empty($_POST['per_page']) ? trim($_POST['per_page']) : 10;

$queryBuilder->amountPages($per_page);