<?php
require_once 'database_connection.php';

authorize::isNotSession();

$email = trim($_POST['email']);

$queryBuilder->availableEmail($email);
