<?php


class authorize
{
    public function authorizeUser(PDO $pdo, array $userEnter)
    {
        if (!empty($userEnter)) {
            $builder = queryBuilder::getLoginPassword($pdo, $userEnter['login']);
            if (password_verify($userEnter['password'], $builder['password'])) {
                $_SESSION['admin_id'] = $builder['admin_id'];
                header("Location:users.html");
                exit();
            } else {
                global $error;
                $error = 'Неверный логин/пароль';
            }
        }
    }

    public function isSession()
    {
        session_start();
        if (isset($_SESSION['admin_id'])) {
            header("Location:users.html");
            exit();
        }
    }

    public static function isNotSession()
    {
        session_start();
        if (!isset($_SESSION['admin_id'])) {
            header("Location:index.php");
            exit();
        }
    }

    public static function EndSession()
    {
        session_start();
        unset($_SESSION['admin_id']);
        header("Location:/index.php");
        exit();
    }
}