<?php
include_once 'Products.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (Products::delete($id)) {
        header('Location: dashboard.php');
    } else {
        echo "¡Error al eliminar el producto!";
    }
}
