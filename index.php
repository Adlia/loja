<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Jóias do Infinito</title>

        <?php
            if (substr_count($_SERVER['REQUEST_URI'], '/produto') > 0 || substr_count($_SERVER['REQUEST_URI'], '/categoria') > 0) {
        ?>
            <link rel="stylesheet" href="../assets/css/caroussel.css<?php echo '?v='.rand(); ?>">
            <link rel="stylesheet" href="../assets/css/style.css<?php echo '?v='.rand(); ?>">
            <link rel="stylesheet" href="../assets/css/base.css<?php echo '?v='.rand(); ?>">
            <link rel="stylesheet" href="../assets/css/login_register.css<?php echo '?v='.rand(); ?>">
        <?php
            } else {
        ?>
            <link rel="stylesheet" href="./assets/css/caroussel.css<?php echo '?v='.rand(); ?>">
            <link rel="stylesheet" href="./assets/css/style.css<?php echo '?v='.rand(); ?>">
            <link rel="stylesheet" href="./assets/css/base.css<?php echo '?v='.rand(); ?>">
            <link rel="stylesheet" href="./assets/css/login_register.css<?php echo '?v='.rand(); ?>">
        <?php
            } 
        ?>
    </head>

    <body>
        <div class="container">
                <?php include('./src/paginas/partes/header.php'); ?>
            
                <?php
                    if ($_SERVER['REQUEST_URI'] == '/perfil') {
                        if (isset($_SESSION['usuario'])) {
                            include('./src/paginas/perfil.php');
                        } else {
                            include('./src/paginas/login_register.php');
                        }
                    } else if (substr_count($_SERVER['REQUEST_URI'], '/produto') > 0) {
                        include_once('./src/paginas/partes/caroussel.php');
                        include_once('./src/paginas/partes/produto.php');
                    } else if ($_SERVER['REQUEST_URI'] == '/sacola') {
                        include_once('./src/paginas/partes/sacola.php');
                    } else if ($_SERVER['REQUEST_URI'] == '/pedidos') {
                        include_once('./src/paginas/partes/caroussel.php');
                        include_once('./src/paginas/partes/pedidos_cliente.php');
                    } else if (substr_count($_SERVER['REQUEST_URI'], '/categoria') > 0) {
                        include_once('./src/paginas/partes/categoria.php');
                    } else {
                        include_once('./src/paginas/partes/caroussel.php');
                        include_once('./src/paginas/produtos_principais.php');
                    }
                ?>
        </div>

        <?php include('./src/paginas/partes/footer.php'); ?>
    </body>
</html>