<?php
session_start();

include('./MyPDO.php');

$requestUri = $_SERVER['REQUEST_URI'];

if ($requestUri == '/painel/produtos/novo') {
    $preco = str_replace(',', '.',$_POST['preco']);
    $quantidade = intval($_POST['quantidade']);
    $categoria = intval($_POST['categoria']);

    $parametros = [$_POST['nome'], $_POST['descricao'], $preco, $quantidade , $_FILES['imagem']['name'], $categoria];

    $sql = "INSERT INTO produtos(nome, descricao, preco, quantidade, imagem, categoria_id) VALUES(?, ?, ?, ?, ?, ?)";

    if ($_POST['edit_id'] != '') {
        $edit_id = intval($_POST['edit_id']);
        $sql = 'UPDATE produtos SET nome = ?, descricao = ?, preco = ?, quantidade = ?, imagem = ?, categoria_id = ? WHERE id = ?';
        array_push($parametros, $edit_id);
    }

    move_uploaded_file($_FILES['imagem']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/assets/imgs/produtos/' . $parametros[4]);

    $resultado = MyPDO::executa_sql($sql, $parametros);
} else if (strpos($requestUri, '/painel/produtos/excluir') !== false) {
    $id = substr($requestUri, 25);

    $vendas =  MyPDO::executa_sql('SELECT * FROM produtos_pedido WHERE produto_id = ?', [$id]);

    if (count($produtos) > 0) {
        $_SESSION['erroDelProd'] = 'Não é possível excluir esse produto pois há vendas dele.';
    } else {
        $sql = 'DELETE FROM produtos WHERE id = ?';

        $resultado = MyPDO::executa_sql($sql, [$id]);
    }
}

header('location: http://' . $_SERVER['SERVER_NAME'] . '/painel/produtos');
