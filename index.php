<?php
include_once 'Session.php';

Session::verifySession();

?>
<!DOCTYPE html>
<html lang="es">
<?php include_once 'layouts/head.php' ?>
<link rel="stylesheet" href="css/index.css">

<body>
    <?php include_once 'layouts/header.php' ?>

    <main>
        <h2 style="margin-bottom: 20px;">Todos los productos</h2>
        <section class="products">
            <?php
            include_once 'Products.php';

            $products = Products::getAll();

            foreach ($products as $product) {
                echo "<article class='card-product'>";
                echo "<img src='" . $product['image'] . "' width='200px'>";
                echo "<h3>" . $product['name'] . "</h3>";
                echo "<p>" . $product['description'] . "</p>";
                echo "<p>Precio: $" . $product['price'] . "</p>";
                echo "<p>Stock: " . $product['stock'] . "</p>";
                echo "<a href='buy.php?id=" . $product['id'] . "'>Comprar</a>";
                echo "</article>";
            }
            ?>

        </section>
    </main>

</body>

</html>