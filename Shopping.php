<?php

class Shopping
{
    static function buy($id_user, $id_product)
    {
        $connection = Connection::getConnection();
        return $connection->query("INSERT INTO shopping (id_user, id_product) VALUES ('$id_user', '$id_product')");
    }

    static function getShopping($id_user)
    {
        $connection = Connection::getConnection();
        $result = $connection->query("select p.* from products p inner join shopping s on p.id = s.id_product where s.id_user = '$id_user'");

        $shopping = array();

        while ($row = $result->fetch_assoc()) {
            array_push($shopping, $row);
        }

        return $shopping;
    }
}
