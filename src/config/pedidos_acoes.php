<?php
session_start();
include_once('./MyPDO.php');

$requestUri = $_SERVER['REQUEST_URI'];

if ($requestUri == '/pedido/item') {
    $id = $_POST['id'];
    $quantidade = $_POST['quantidade'];
    $nome = $_POST['nome'];
    $imagem = $_POST['imagem'];
    $preco = $_POST['preco'];

    array_push($_SESSION['tmpPedido']['produtos'], [$id, $quantidade, $nome, $imagem, $preco]);

    header('location: http://' . $_SERVER['SERVER_NAME'] . '/sacola');
} else if ($requestUri == '/pedido/finalizar') {
    $sql = 'INSERT INTO pedidos(data_status, status, total, parcelas, metodo_pagamento, boleto_numero, usuario_id, cartao_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?)';

    $data = date('Y-m-d');
    $status = 'APROVACAO';
    $total = 0;
    $parcelas = $_POST['parcelas'];
    $metodo = strtoupper($_POST['metodo']);
    $boleto_numero = null;
    $usuario_id = $_SESSION['usuario']->id;
    $cartao_id = null;

    foreach ($_SESSION['tmpPedido']['produtos'] as $produto) {
        $total += $produto[1] * $produto[4];
    }
    
    if ($metodo == 'BOLETO') {
        $boleto_numero = rand(100000, 200000).''.rand(100000, 200000).''.rand(100000, 200000).''.rand(100000, 200000).''.rand(100000, 200000);
    } else if ($metodo == 'CARTAO') {
        $cartao_id = $_POST['cartao'];
    }

    $parametros = [$data, $status, $total, $parcelas, $metodo, $boleto_numero, $usuario_id, $cartao_id];

    MyPDO::executa_sql($sql, $parametros);

    $ultimo_pedido_id = MyPDO::executa_sql('SELECT MAX(id) AS id FROM pedidos');

    $sqlItem = 'INSERT INTO produtos_pedido(pedido_id, produto_id, quantidade, total) VALUES(?, ?, ?, ?)';
    
    foreach ($_SESSION['tmpPedido']['produtos'] as $produto) {
        $parametrosItem = [$ultimo_pedido_id[0]->id, $produto[0], $produto[1], ($produto[1] * $produto[4])];

        MyPDO::executa_sql($sqlItem, $parametrosItem);
    }

    unset($_SESSION['tmpPedido']);

    header('location: http://' . $_SERVER['SERVER_NAME'] . '/pedidos');
} else if ($requestUri == '/pedido/estado') {
    $status = $_POST['status'];
    $id = $_POST['id'];

    $sql = 'UPDATE pedidos SET status = ? WHERE id = ?';

    MyPDO::executa_sql($sql, [$status, $id]);

    header('location: http://' . $_SERVER['SERVER_NAME'] . '/painel/pedidos');
}
