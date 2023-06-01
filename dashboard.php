<?php ob_start() ?>

<!DOCTYPE html>
<html lang="es">

<?php include_once 'layouts/head.php' ?>
<link rel="stylesheet" href="css/dashboard.css">

<body>
    <?php include_once 'layouts/header.php' ?>

    <main>

        <div class="form-container">
            <h2 style="margin-bottom: 20px;">Registrar productos</h2>
            <form action="<?php $_PHP_SELF ?>" method="post" required enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Nombre" required>
                <input type="text" name="description" placeholder="Descripción" required>
                <input type="number" min="1" step="any" name="price" placeholder="Precio" required>
                <input type="number" name="stock" placeholder="Stock" required>
                <input type="file" name="image" required>
                <input type="submit" value="Guardar">
            </form>
        </div>

        <?php
        include_once 'Products.php';
        include_once 'Session.php';

        $_PHP_SELF = $_SERVER['PHP_SELF'];

        if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['stock']) && isset($_FILES['image'])) {
            if (empty($_POST['name']) | empty($_POST['description']) | empty($_POST['price']) | empty($_POST['stock']) | empty($_FILES['image'])) {
                echo "¡Error rellenar todos los campos requeridos!<br>";
            } else {
                $image_name = $_FILES['image']['name'];
                $image_tmp = $_FILES['image']['tmp_name'];
                $folder = "uploads/";

                move_uploaded_file($image_tmp, $folder . $image_name);


                $id_user = Session::getUser()['id'];
                echo $id_user;

                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $stock = $_POST['stock'];
                $image = $folder . $image_name;

                if (Products::create($id_user, $name, $description, $price, $stock, $image)) {
                    echo "¡Producto registrado exitosamente!<br>";
                    echo $folder . $image_name;
                } else {
                    echo "¡Error al registrar el producto!<br>";
                }
            }
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <?php

            $products = Products::getByIdUser(Session::getUser()['id']);

            foreach ($products as $product) {
                echo "<tr>";
                echo "<td>" . $product['name'] . "</td>";
                echo "<td>" . $product['description'] . "</td>";
                echo "<td>" . $product['price'] . "</td>";
                echo "<td>" . $product['stock'] . "</td>";
                echo "<td><img src='" . $product['image'] . "' width='50px'></td>";
                echo "<td><a href='edit.php?id=" . $product['id'] . "'>Editar</a> <a href='delete.php?id=" . $product['id'] . "'>Eliminar</a></td>";
                echo "</tr>";
            }
            ?>
        </table>


    </main>

</body>

</html>