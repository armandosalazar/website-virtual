<?php

include_once 'Session.php';

$user = Session::getUser();

?>
<!DOCTYPE html>
<html lang="es">
<?php include_once 'layouts/head.php'; ?>
<link rel="stylesheet" href="css/profile.css">

<body>
    <?php include_once 'layouts/header.php'; ?>

    <main>
        <section class="header" style="margin: 20px 0px;">
            <h2>Perfil</h2>
            <h3><?= $user['name'] . ' ' . $user['last_name'] ?></h3>
            <h4><?= $user['email'] ?></h4>
        </section>
        <section class="products">
            <h2 style="margin-bottom: 20px;">Mis productos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <?php
                include_once 'Products.php';

                $products = Products::getByIdUser(Session::getUser()['id']);

                foreach ($products as $product) {
                    echo "<tr>";
                    echo "<td>" . $product['name'] . "</td>";
                    echo "<td>" . $product['description'] . "</td>";
                    echo "<td>" . $product['price'] . "</td>";
                    echo "<td>" . $product['stock'] . "</td>";
                    echo "<td><img src='" . $product['image'] . "' width='50px'></td>";
                    echo "</tr>";
                }
                ?>
            </table>
            <a href="/pdf.php">Generar reporte de productos</a>
        </section>

        <section class="shopping">
            <h2 style="margin: 20px 0;">Mis compras</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <?php
                include_once 'Shopping.php';

                $shopping = Shopping::getShopping(Session::getUser()['id']);

                foreach ($shopping as $product) {
                    echo "<tr>";
                    echo "<td>" . $product['name'] . "</td>";
                    echo "<td>" . $product['description'] . "</td>";
                    echo "<td>" . $product['price'] . "</td>";
                    echo "<td>" . $product['stock'] . "</td>";
                    echo "<td><img src='" . $product['image'] . "' width='50px'></td>";
                    echo "</tr>";
                }
                ?>
            </table>
            <a href="/pdf.php?type=shopping">Generar reporte de compras</a>
        </section>
    </main>

</body>

</html>