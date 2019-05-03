<?php
include_once('../config/MyPDO.php');

$pedidos = MyPDO::executa_sql('SELECT * FROM pedidos');
?>
<h2>Pedidos</h2>
<div class="pedidos">
<?php
    if (count($pedidos) == 0) {
?>
        <h3>Não há pedidos pendentes</h3>
<?php
} else {
    foreach ($pedidos as $pedido) {
?>
    <div class="pedido">
        <div class="info">
            <?php
                $cliente = MyPDO::executa_sql('SELECT * FROM usuarios WHERE id = ?', [$pedido->usuario_id]);
            ?>
            <span>Nome: <?php echo $cliente[0]->nome ?></span>
            <span>Email: <?php echo $cliente[0]->email ?></span>
            <span>Endereço: <?php echo $cliente[0]->endereco ?></span>
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
                            <img src="../assets/imgs/produtos/<?php echo $produto->imagem; ?>">
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

        <div class="info">
            Estado atual do pedido: <?php echo $pedido->status ?>
            <form action="/pedido/estado" method="post">
                <input type="hidden" name="id" id="id" value="<?php echo $pedido->id ?>">
                <select name="status" id="status">
                    <option value="APROVACAO">Aprovação</option>
                    <option value="PAGO">Pago</option>
                    <option value="ENVIADO">Enviado</option>
                    <option value="ENTREGUE">Entregue</option>
                    <option value="CANCELADO">Cancelado</option>
                </select>

                <button class="green-button" style="width: 100px !important;" type="submit">Atualizar</button>
            </form>
        </div>
    </div>
</div>
    <?php } } ?>