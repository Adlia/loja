<?php
include_once('./src/config/MyPDO.php');

$pedidos = MyPDO::executa_sql('SELECT * FROM pedidos WHERE usuario_id = ?', [$_SESSION['usuario']->id]);
?>

<div>
    <h3>Meus pedidos:</h3>
    <?php
    if (count($pedidos) == 0) {
        ?>
        <h4>Você ainda não fez nenhum pedido.</h4>
    <?php
} else {
    foreach ($pedidos as $pedido) {
        ?>
            <div class="pedido">
                <div class="status">
                    <?php
                    if ($pedido->status == 'APROVACAO') {
                        ?>
                        <div class="barra aprovacao">
                            Pedido aguardando aprovação...
                        </div>
                    <?php
                } else if ($pedido->status == 'PAGO') {
                    ?>
                        <div class="barra pago">
                            Pagamento recebido...
                        </div>
                    <?php
                } else if ($pedido->status == 'ENVIADO') {
                    ?>
                        <div class="barra enviado">
                            Pacote enviado...
                        </div>
                    <?php
                } else if ($pedido->status == 'ENTREGUE') {
                    ?>
                        <div class="barra entregue">
                            Encomenda recebida
                        </div>
                    <?php
                } else {
                ?>
                    <div class="barra cancelado">
                        Pedido cancelado pela loja
                    </div>
                <?php 
                }
                ?>
                </div>

                <div class="info">
                    <?php
                    if ($pedido->metodo_pagamento == 'CARTAO') {
                        ?>
                        <span>Forma de pagamento: Cartão de Crédito</span>
                        <span>Número de parcelas: <?php echo $pedido->parcelas; ?>x</span>
                    <?php
                } else {
                    ?>
                        <span>Forma de pagamento: Boleto Bancário</span>
                        <span>Número do boleto: <?php echo $pedido->boleto_numero; ?></span>
                    <?php
                }
                ?>
                    <span>Total do pedido: R$<?php echo $pedido->total ?></span>
                </div>

                <table>
                    <thead>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                    </thead>
                    <?php
                    $produtos = MyPDO::executa_sql('SELECT PP.produto_id, PP.quantidade, PP.total, PR.nome, PR.preco, PR.imagem FROM produtos_pedido PP INNER JOIN produtos PR ON PP.produto_id = PR.id WHERE pedido_id = ?', [$pedido->id]);
                    foreach ($produtos as $produto) {
                        ?>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="./assets/imgs/produtos/<?php echo $produto->imagem; ?>">
                                </td>
                                <td>
                                    <?php echo $produto->nome ?>
                                </td>
                                <td>
                                    <?php echo $produto->quantidade ?>
                                </td>
                                <td>
                                    R$ <?php echo $produto->preco ?>
                                </td>
                            </tr>
                        </tbody>
                    <?php
                }
                ?>
                </table>

            </div>
        <?php
    }
}
?>
</div>