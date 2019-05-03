<?php

session_start();

include('./MyPDO.php');

$produtos = MyPDO::executa_sql('SELECT * FROM produtos_pedido PP INNER JOIN produtos PR ON PP.produto_id = PR.id WHERE pedido_id = ?', [9]);

echo '<pre>';
print_r($produtos);