<?php
require_once 'database_connection.php';

authorize::isNotSession();

$id = trim($_POST['id']);

$queryBuilder->showOneUser($id);

