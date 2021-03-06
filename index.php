<?php
require_once 'scripts/database_connection.php';

$authorize = new authorize();

$authorize->isSession();
$authorize->authorizeUser($pdo, $_POST);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/main.css" rel="stylesheet">
    <title>Test Project</title>
</head>
<body>
<div class="index">
    <div class="_container">
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="index__form">
            <div class="index__error"><?= $error; ?></div>
            <label for="login"></label>
            <input type="text" id="login" name="login" placeholder="Логин" value="<?= $_POST['login'] ?>">
            <label for="password"></label>
            <input type="password" id="password" name="password" placeholder="Пароль">
            <button>войти</button>
        </form>
    </div>
</div>
</body>
</html>