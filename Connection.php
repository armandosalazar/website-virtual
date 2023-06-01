<?php


class Connection
{
    static function getConnection()
    {
        $connection = new mysqli('localhost', 'root', 'root', 'social_commerces');

        if ($connection->connect_errno) {
            echo "Error de conexión: " . $connection->connect_error;
            exit();
        } else {
            // echo "Conexión exitosa";
        }

        return $connection;
    }
}
