<?php


class queryBuilder
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public static function getLoginPassword(PDO $pdo, $login)
    {
        $sql = "SELECT admin_id, password FROM admin WHERE login = :login";
        $stn = $pdo->prepare($sql);
        $stn->bindValue(':login', $login);
        $stn->execute();
        if ($stn->rowCount() == 1) {
            return $stn->fetch(PDO::FETCH_ASSOC);
        } else {
            global $error;
            $error = 'Неверный логин/пароль';
            return false;
        }
    }

    public function addUser($username, $email, $address)
    {
        $sql = "INSERT INTO users (username, email, address) VALUES (:username, :email, :address)";
        $stn = $this->pdo->prepare($sql);
        $stn->bindParam(':username', $username, PDO::PARAM_STR);
        $stn->bindParam(':email', $email, PDO::PARAM_STR);
        $stn->bindParam(':address', $address, PDO::PARAM_STR);
        $res = $stn->execute();
        if ($res) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }

    public function updateUser($username, $email, $address, $id)
    {
        $sql = "UPDATE users SET username = :username, email=:email, address=:address WHERE user_id = :id";
        $stn = $this->pdo->prepare($sql);
        $stn->bindParam('username', $username, PDO::PARAM_STR);
        $stn->bindParam('email', $email, PDO::PARAM_STR);
        $stn->bindParam('address', $address, PDO::PARAM_STR);
        $stn->bindParam('id', $id, PDO::PARAM_INT);
        $result = $stn->execute();
        echo json_encode($result);
    }

    public function delUsers($arrayUsers)
    {
        foreach ($arrayUsers as $user_id) {
            $sql = "DELETE FROM users WHERE user_id = :user_id";
            $stn = $this->pdo->prepare($sql);
            $stn->bindValue(':user_id', $user_id);
            $res = $stn->execute();
            if (!$res) {
                echo json_encode(false);
                exit();
            }
        }
        echo json_encode(true);
    }

    public function availableEmail($email)
    {
        $sql = "SELECT email FROM users WHERE email=:email";
        $stn = $this->pdo->prepare($sql);
        $stn->bindParam(':email', $email, PDO::PARAM_STR);
        $stn->execute();
        if ($stn->rowCount() > 0) {
            echo json_encode('Данный email занят');
        } else {
            echo json_encode('email свободен');
        }
    }

    public function showOneUser($id)
    {
        $sql = "SELECT user_id, username, email, address FROM users WHERE user_id = :id";
        $stn = $this->pdo->prepare($sql);
        $stn->bindParam(':id', $id, PDO::PARAM_INT);
        $stn->execute();
        if ($stn->rowCount() > 0) {
            $result = $stn->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } else {
            echo json_encode('Данных нет');
        }
    }

    public function showUsers($sort_name, $sortingDirect, $num_page, $per_page)
    {
        $sql = "SELECT user_id, username, email, address FROM users ORDER BY {$sort_name} {$sortingDirect} LIMIT :startLimit, :perPage";
        $stn = $this->pdo->prepare($sql);
        $stn->bindParam(':startLimit', $num_page, PDO::PARAM_INT);
        $stn->bindParam(':perPage', $per_page, PDO::PARAM_INT);
        $stn->execute();
        if ($stn->rowCount() > 0) {
            $result = $stn->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($result);
        } else {
            echo json_encode('Данных нет');
        }
    }

    public function amountPages($per_page)
    {
        $stn = $this->amountUsers();
        if ($stn->rowCount() > 0) {
            $result = $stn->fetch(PDO::FETCH_NUM);
            $result = $result[0];
            settype($result, 'integer');
            $amount_pages = ceil($result / $per_page);
            $amount = ['pages' => $amount_pages, 'users' => $result];

            echo json_encode($amount);
        } else {
            echo json_encode('Данных нет');
        }
    }

    private function amountUsers()
    {
        $sql = "SELECT COUNT(*) FROM users";
        return $this->pdo->query($sql);
    }
}