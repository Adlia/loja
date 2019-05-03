<?php 
    session_start();

    if (isset($_SESSION['usuario']) && $_SESSION['usuario']->nivel == 'ADMIN') {
        header('location: http://' . $_SERVER['SERVER_NAME'] . '/painel');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin</title>

        <link rel="stylesheet" href="./assets/css/admin.css<?php echo '?v='.rand(); ?>">
        <link rel="stylesheet" href="./assets/css/base.css<?php echo '?v='.rand(); ?>">
    </head>
    <body>
        <div class="login-panel">
            <h3>Jóias do Infinito</h3>

            <?php
                if (isset($_SESSION['erroLogin'])) {
                    echo '<span class="alerta">'.$_SESSION['erroLogin'].'</span>';
                    unset($_SESSION['erroLogin']);
                }
            ?>

            <form action="login" method="post" class="login-form">
                <label for="usuario">Usuário</label>
                <input type="text" name="usuario" id="usuario" required>

                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" required>

                <button class="green-button" type="submit">Entrar</button>
            </form>
        </div>
    </body>
</html>