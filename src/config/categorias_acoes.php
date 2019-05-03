<?php
session_start();

include('./MyPDO.php');

$requestUri = $_SERVER['REQUEST_URI'];

if ($requestUri == '/painel/categorias/nova') {
    $geek = 0;

    if (isset($_POST['geek'])) {
        $geek = 1;
    }

    $parametros = [$_POST['nome'], $_POST['descricao'], $geek];

    $sql = "INSERT INTO categorias(nome, descricao, geek) VALUES(?, ?, ?)";

    if ($_POST['edit_id'] != '') {
        $sql = 'UPDATE categorias SET nome = ?, descricao = ?, geek = ? WHERE id = ?';
        array_push($parametros, $_POST['edit_id']);
    }

    $resultado = MyPDO::executa_sql($sql, $parametros);
} else if (strpos($requestUri, '/painel/categorias/excluir') !== false) {
    $id = substr($requestUri, 27);

    $produtos =  MyPDO::executa_sql('SELECT * FROM produtos WHERE categoria_id = ?', [$id]);

    if (count($produtos) > 0) {
        $_SESSION['erroDelCat'] = 'Não é possível excluir essa categoria pois há produtos cadastrados nela.';
    } else {
        $sql = 'DELETE FROM categorias WHERE id = ?';

        $resultado = MyPDO::executa_sql($sql, [$id]);
    }
}

header('location: http://' . $_SERVER['SERVER_NAME'] . '/painel/categorias');
