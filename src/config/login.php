<?php

session_start();

include_once('./MyPDO.php');

$usuario = $_POST['usuario'];
$senha = md5($_POST['senha']);
$urlLogado = 'http://' . $_SERVER['SERVER_NAME'] . '/perfil';
$urlNaoLogado = 'http://' . $_SERVER['SERVER_NAME'] . '/perfil';

if (substr_count($_SERVER['HTTP_REFERER'], 'admin') > 0) {
    $urlLogado = 'http://' . $_SERVER['SERVER_NAME'] . '/painel';
    $urlNaoLogado = 'http://' . $_SERVER['SERVER_NAME'] . '/admin';
}

$resultado = MyPDO::buscaUsuario($usuario); 

if ($resultado[0]->usuario == $usuario && $resultado[0]->senha == $senha) {
    $_SESSION['usuario'] = $resultado[0];

    $_SESSION['tmpPedido']['produtos'] = [];

    header('Location: ' . $urlLogado);
} else {
    $_SESSION['erroLogin'] = 'Falha na autenticação.';
    header('Location: ' . $urlNaoLogado);
}
