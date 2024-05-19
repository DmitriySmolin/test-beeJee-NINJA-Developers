<?php

namespace Models;

use PDO;

class User
{
    /**
     * saves the new user
     * @param Connect $connect
     * @param string $login
     * @param string $password
     * @return bool
     */
    public function saveUser(Connect $connect, string $login, string $password):bool
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = 'INSERT INTO `users` (login, password) VALUES (:login, :password)';
        $params = [
            ':login' => $login,
            ':password' => $password
        ];
        $stmt = $connect->connect(PATH_CONF)->prepare($query);
        $stmt->execute($params);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * user authentication check
     * @param Connect $connect
     * @param string $login
     * @param string $password
     * @return bool
     */
    public function authUser(Connect $connect, string $login, string $password):bool
    {
        $query = "SELECT * FROM `users` WHERE login = :login";
        $params = [
            ':login' => $login
        ];
        $stmt = $connect->connect(PATH_CONF)->prepare($query);
        $stmt->execute($params);
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($row) == 1) {
            if (password_verify($password, $row[0]['password'])) {
                $_SESSION['user_id'] = $row[0]['id'];
                $_SESSION['login'] = $row[0]['login'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * completes user authentication
     * @return void
     */
    public function logout():void
    {
        session_start();
        session_unset ();
        session_destroy ();
        unset($_SESSION['user_id']);
        unset($_SESSION['login']);
        header ("Location: http://localhost:8000");
        exit();
    }
}