<?php
require_once 'database_connection.php';

authorize::isNotSession();

$queryBuilder->delUsers($_POST['usersCheck']);