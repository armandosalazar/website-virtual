<?php ob_start() ?>
<!DOCTYPE html>

<html lang="es">
<?php include_once 'layouts/head.php' ?>

<body>

    <?php include_once 'layouts/header.php' ?>

    <?php
    include_once 'Products.php';
    include_once 'Session.php';

    $_PHP_SELF = $_SERVER['PHP_SELF'];

    if ($_GET['id']) {
        $id = $_GET['id'];
        $product = Products::getById($id);
    }

    ?>

    <div class="form-container">
        <h2>Editar producto</h2>
        <form action="<?php $_PHP_SELF ?>" method="post" required enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Nombre" value="<?php echo $product['name'] ?>" required>
            <input type="text" name="description" placeholder="Descripción" value="<?php echo $product['description'] ?>" required>
            <input type="number" min="1" step="any" name="price" placeholder="Precio" value="<?php echo $product['price'] ?>" required>
            <input type="number" name="stock" placeholder="Stock" value="<?php echo $product['stock'] ?>" required>
            <input type="file" name="image">
            <input type="submit" value="Guardar">
        </form>
    </div>

    <?php
    if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['stock']) && isset($_FILES['image'])) {
        if (empty($_POST['name']) | empty($_POST['description']) | empty($_POST['price']) | empty($_POST['stock']) | empty($_FILES['image'])) {
            echo "¡Error rellenar todos los campos requeridos!<br>";
        } else {
            $image_name = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $folder = "uploads/";

            move_uploaded_file($image_tmp, $folder . $image_name);

            Products::update($id, $_POST['name'], $_POST['description'], $_POST['price'], $_POST['stock'], $folder . $image_name);
            header("Location: dashboard.php");
        }
    }
    ?>

</body>

</html>