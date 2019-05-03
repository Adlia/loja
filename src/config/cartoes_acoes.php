<?php
session_start();
include_once('./MyPDO.php');

$requestUri = $_SERVER['REQUEST_URI'];

if ($requestUri == '/cartoes/cadastrar') {
    $numero = $_POST['numero'];
    $titular = $_POST['titular'];
    $validade = $_POST['validade'];
    $bandeira = $_POST['bandeira'];

    $validade = substr($validade, 5, 2) . '/' . substr($validade, 2, 2);

    $parametros = [$numero, $titular, $validade, $bandeira, $_SESSION['usuario']->id];

    $sql = 'INSERT INTO cartoes_credito(numero, titular, validade, bandeira, usuario_id) VALUES(?, ?, ?, ?, ?)';

    if ($_POST['edit_id'] != '') {
        $sql  = 'UPDATE cartoes SET numero = ?, titular = ?, validade = ?, bandeira = ? WHERE id = ?';
        array_push($parametros, $_POST['edit_id']);
    }

    $resposta = MyPDO::executa_sql($sql, $parametros);
} else if (strpos($requestUri, '/cartoes/excluir') !== false) {
    $id = substr($requestUri, 17);

    $sql = 'DELETE FROM cartoes_credito WHERE id = ?';

    $resultado = MyPDO::executa_sql($sql, [$id]);
}

header('location: http://' . $_SERVER['SERVER_NAME'] . '/perfil');
