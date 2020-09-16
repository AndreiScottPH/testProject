<?php
error_reporting(0);

define("HOST", "127.0.0.1");
define("USER", "root");
define("PASSWORD", "root");
define("DATABASE", "testproject_interlabs");
define("DEV", true);


//function handle_error($user_error, $dev_error)
//{
//    session_start();
//    $_SESSION['user_error'] = $user_error;
//    $_SESSION['dev_error'] = $dev_error;
//    header("Location:/error.php");
//    exit();
//}