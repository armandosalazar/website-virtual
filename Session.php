<?php

include_once 'Connection.php';

class Session
{
    static function verifySession()
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: /authentication.php?tab=login');
        }
    }

    static function login($email, $password)
    {
        session_start();

        $connection = Connection::getConnection();

        $result = $connection->query("SELECT id, name, last_name, email FROM users WHERE email = '$email' AND password = '$password'");

        var_dump($result); // mysqli_result

        $user = $result->fetch_assoc();

        var_dump($user);

        if ($user) {
            $_SESSION['user'] = $user;
            header('Location: /');
        } else {
            header('Location: /authentication.php?tab=login');
        }
    }

    static function logout()
    {
        session_start();

        session_destroy();

        header('Location: /authentication.php?tab=login');
    }

    static function register($name, $lastName, $email, $password)
    {
        session_start();

        $connection = Connection::getConnection();

        $result = $connection->query("INSERT INTO users (name, last_name, email, password) VALUES ('$name', '$lastName', '$email', '$password')");

        var_dump($result); // true or false

        if ($result) {
            header('Location: /authentication.php?tab=login');
        } else {
            header('Location: /authentication.php?tab=register');
        }
    }

    static function getUser()
    {
        session_start();
        return $_SESSION['user'];
    }
}
