<?php
include_once('../config/MyPDO.php');

session_start();

if (isset($_SESSION['usuario']) && $_SESSION['usuario']->nivel != 'ADMIN') {
    header('Location: http://' . $_SERVER['SERVER_NAME'] . '/perfil');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Painel Administrativo</title>

    <?php
    if ($_SERVER['REQUEST_URI'] == '/painel') {
        echo '<link rel="stylesheet" href="./assets/css/painel.css?v='.rand().'">
            <link rel="stylesheet" href="./assets/css/base.css?v='.rand().'">';
    } else {
        echo '<link rel="stylesheet" href="../assets/css/painel.css?v='.rand().'">
            <link rel="stylesheet" href="../assets/css/base.css?v='.rand().'">';
    }
    ?>


</head>

<body>
    <?php include('./partes/painel_menu.php') ?>

    <div class="content">
        <?php
        if ($_SERVER['REQUEST_URI'] == '/painel') {
            include_once('./partes/painel_bemvindo.php');
        } else if ($_SERVER['REQUEST_URI'] == '/painel/categorias') {
            include_once('./partes/categorias.php');
        } else if ($_SERVER['REQUEST_URI'] == '/painel/produtos') {
            include_once('./partes/produtos.php');
        } else if ($_SERVER['REQUEST_URI'] == '/painel/pedidos') {
            include_once('./partes/pedidos.php');
        }
        ?>
    </div>
</body>

</html>