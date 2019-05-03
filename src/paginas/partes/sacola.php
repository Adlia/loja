<?php
    include_once('./src/config/MyPDO.php');
?>

<div class="mostra-produto">
    <h2>Sacola de Compras</h2>

    <form action="/pedido/finalizar" method="post">
        <table class="table">
            <thead>
                <th>#</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Sub-total</th>
                <th>Ações</th>
            </thead>

            <tbody>
                <?php
                    $tmp = [];

                    if (isset($_SESSION['tmpPedido']['produtos'])) {
                        $tmp = $_SESSION['tmpPedido']['produtos'];
                        $total = 0;
                    }
                    
                    if (count($tmp) == 0) {
                ?>
                        <tr>
                            <td colspan="5">Sua sacola está vazia. :(</td>
                        </tr>
                <?php
                    } else {
                        foreach ($tmp as $produto) {
                ?>
                            <tr>
                                <td>
                                    <img src="./assets/imgs/produtos/<?php echo $produto[3]; ?>">
                                </td>
                                <td><?php echo $produto[2]; ?></td>
                                <td><?php echo $produto[1]; ?></td>
                                <td>R$ <?php $total += $produto[1] * $produto[4]; echo $produto[1] * $produto[4]; ?></td>
                                <td>
                                    <a href="/pedido/remover/<?php echo $produto[0]; ?>">
                                        <img src="./assets/imgs/icons/ico-delete.png" style="height: 25px; width: 25px;">
                                    </a>
                                </td>
                            </tr>
                <?php        
                        }
                    }
                ?>
            </tbody>
        </table>

        <?php 
            if (count($tmp) > 0) {
                $cartoes = MyPDO::executa_sql('SELECT * FROM cartoes_credito WHERE usuario_id = ?', [$_SESSION['usuario']->id ]);
        ?>
                <h3>Método de pagamento</h3>
                <div class="row" style="justify-content: flex-start !important;">
                    <div class="metodo-pagamento">
                        <input type="radio" name="metodo" id="boleto" value="boleto" checked>Boleto Bancário
                    </div>
                    <?php
                        if (count($cartoes) > 0) {
                    ?>
                            <div class="metodo-pagamento" style="width: 600px !important;">
                                <input type="radio" name="metodo" id="cartao" value="cartao" ><span>Cartão de Crédito</span>
                                <select name="cartao" id="cartao">
                                    <?php
                                        foreach ($cartoes as $cartao) {
                                    ?>
                                        <option value="<?php echo $cartao->id; ?>"><?php echo $cartao->bandeira.' - '.$cartao->numero; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>

                                <select name="parcelas" id="parcelas">
                                    <?php
                                        for ($i = 1; $i < 6; $i++) { 
                                    ?>
                                        <option value="<?php echo $i+1 ?>"><?php echo $i ?>x de R$<?php echo number_format($total / $i, 2); ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                    <?php
                        }
                    ?>
                </div>
                <h3>Endereço de entrega</h3>
                <div class="row" style="justify-content: flex-start !important;">
                    <span>
                        <?php
                            echo $_SESSION['usuario']->endereco;
                        ?>
                    </span>
                </div>
        <?php
            }
        ?>

        <div class="row botoes-pedido" style="justify-content: flex-end !important;">
            <a href="/" style="background-color: #CFD8DC;">Continuar comprando</a>
            <?php
            if (count($tmp) > 0) {
            ?>
                <button type="submit" style="background-color: #4CAF50; color: #FFF; font-weight: bold;">Finalizar pedido</button>
            <?php
            }
            ?>
        </div>
    </form>
</div>