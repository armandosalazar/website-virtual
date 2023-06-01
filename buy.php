<?php

if (isset($_GET['id'])) {
    include_once 'Products.php';
    include_once 'Session.php';
    include_once 'Shopping.php';

    $product = Products::getById($_GET['id']);

    if (Shopping::buy(Session::getUser()['id'], $product['id'])) {
        header('Location: profile.php');
        echo "¡Producto comprado exitosamente!<br>";
    } else {
        header('Location: profile.php');
        echo "¡Error al comprar el producto!<br>";
    }
}
