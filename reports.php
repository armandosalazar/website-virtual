<!DOCTYPE html>
<?php ob_start(); ?>
<html lang="es">
<?php include_once 'layouts/head.php'; ?>

<style>
    td {
        padding: 5px;
    }

    tr td a {
        all: unset;
        text-decoration: underline;
        cursor: pointer;
    }

    tr td a:hover {
        all: unset;
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<body>
    <?php include_once 'layouts/header.php'; ?>
    <main>
        <section class="products">
            <h2 style="margin-bottom: 20px;">Mis productos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Archivo en webdav</td>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once 'Reports.php';
                    include_once 'Session.php';

                    $reports = Reports::getReportsByIdUser(Session::getUser()['id']);

                    foreach ($reports as $report) {
                    ?>
                        <tr>
                            <td><a href="<?= $report['url'] ?>" target="_blank"><?= $report['url'] ?></a></td>
                            <td><a href="<?= $report['url'] ?>">Descargar</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>