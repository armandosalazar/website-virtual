<?php

include_once 'Connection.php';

class Products
{
    static function create($id_user, $name, $description, $price, $stock, $image)
    {
        $connection = Connection::getConnection();
        return $connection->query("INSERT INTO products (id_user, name, description, price, stock, image) VALUES ('$id_user', '$name', '$description', '$price', '$stock', '$image')");
    }

    static function getAll()
    {
        $connection = Connection::getConnection();
        $result = $connection->query("SELECT * FROM products");

        $products = array();

        while ($row = $result->fetch_assoc()) {
            array_push($products, $row);
        }

        return $products;
    }

    static function getById($id)
    {
        $connection = Connection::getConnection();
        $result = $connection->query("SELECT * FROM products WHERE id = '$id'");

        return $result->fetch_assoc();
    }

    static function getByIdUser($id)
    {
        $connection = Connection::getConnection();
        $result = $connection->query("SELECT * FROM products WHERE id_user = '$id'");

        $products = array();

        while ($row = $result->fetch_assoc()) {
            array_push($products, $row);
        }

        return $products;
    }

    static function update($id, $name, $description, $price, $stock, $image)
    {
        $connection = Connection::getConnection();
        return $connection->query("UPDATE products SET name = '$name', description = '$description', price = '$price', stock = '$stock', image = '$image' WHERE id = '$id'");
    }

    static function delete($id)
    {
        $connection = Connection::getConnection();
        return $connection->query("DELETE FROM products WHERE id = '$id'");
    }
}
