<?php

ob_start();

include_once 'Session.php';
include_once 'Connection.php';

Connection::getConnection();

$PHP_SELF = $_SERVER['PHP_SELF'];

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'login';

if ($tab === 'login') {
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if ($email && $password) {
        Session::login($email, $password);
    }
}

if ($tab === 'register') {
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if ($name && $lastName && $email && $password) {
        Session::register($name, $lastName, $email, $password);
    }
}


?>
<!DOCTYPE html>
<html lang="es">
<?php include_once 'layouts/head.php' ?>

<body>

    <?php if ($tab === 'login') : ?>
        <h2 style="margin: 20px">Iniciar sesión</h2>

        <form action="<?php $PHP_SELF ?>" method="post">
            <input type="email" name="email" placeholder="Correo electrónico">
            <input type="password" name="password" placeholder="Contraseña">
            <input type="submit" value="Iniciar sesión">
            <a style="text-decoration: none; color: white; display: block; text-align: center;" href="/authentication.php?tab=register">Registrarse</a>
        </form>
    <?php endif; ?>

    <?php if ($tab === 'register') : ?>
        <h2 style="margin: 20px;">Registrarse</h2>

        <form action="<?php $PHP_SELF ?>" method="post">
            <input type="text" name="name" placeholder="Nombre">
            <input type="text" name="lastName" placeholder="Apellido">
            <input type="email" name="email" placeholder="Correo electrónico">
            <input type="password" name="password" placeholder="Contraseña">
            <input type="submit" value="Registrarse">
            <a style="text-decoration: none; color: white; display: block; text-align: center;" href="/authentication.php?tab=login">Iniciar sesión</a>
        </form>
    <?php endif; ?>

</body>

</html>
