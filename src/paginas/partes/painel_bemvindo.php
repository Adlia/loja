<h2>Resumo</h2>

<div class="resumo">
    <div class="item">
        <img src="../../../assets/imgs/icons/ico-product-big.png" alt="Produtos">
        <span>Produtos</span>
        <h1>
            <?php
                $produtos = MyPDO::executa_sql('SELECT  *   FROM produtos');
                echo count($produtos);
            ?>
        </h1>
    </div>

    <div class="item">
        <img src="../../../assets/imgs/icons/ico-sell.png" alt="Vendas">
        <span>Vendas</span>
        <h1>R$
            <?php
                $vendas = MyPDO::executa_sql("SELECT  SUM(total) as total  FROM pedidos WHERE status = 'ENTREGUE'");
                
                if (!is_numeric($vendas[0]->total)) {
                    echo '0';
                } else {
                    echo $vendas[0]->total;
                }
            ?>
        </h1>
    </div>

    <div class="item">
        <img src="../../../assets/imgs/icons/ico-clients.png" alt="Clientes">
        <span>Clientes</span>
        <h1>
            <?php
                $clientes = MyPDO::executa_sql("SELECT  *   FROM    usuarios WHERE  nivel = 'CLIENTE'");
                echo count($clientes);
            ?>
        </h1>
    </div>
</div>