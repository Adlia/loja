<?php
    session_start();

    $redirect = 'http://' . $_SERVER['SERVER_NAME'] . '/perfil';

    if ($_SESSION['usuario']->nivel == 'ADMIN') {
        $redirect = 'http://' . $_SERVER['SERVER_NAME'] . '/admin';
    }

    session_destroy();
    header('Location: ' . $redirect);
