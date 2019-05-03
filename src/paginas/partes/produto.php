<?php
    include_once('./src/config/MyPDO.php');

    $produto_id = substr($_SERVER['REQUEST_URI'], 9);

    $produto = MyPDO::executa_sql('SELECT * FROM produtos WHERE id = ?', [$produto_id]);

    if (count($produto) == 0) {
        header('location: http://' . $_SERVER['SERVER_NAME'] . '/');
    }
?>

<div class="mostra-produto">    
    <div class="row">
        <img src="../assets/imgs/produtos/<?php echo $produto[0]->imagem ?>">
        <div class="col">
            <h1><?php echo $produto[0]->nome; ?></h1>

            <span><?php echo $produto[0]->descricao; ?></span>

            <h3>
                <?php echo 'R$ '.str_replace('.', ',', $produto[0]->preco); ?>                
            </h3>

            <span>
                Em até 10x de R$<?php echo number_format(($produto[0]->preco / 10), 2); ?> sem juros
            </span>

            <span>Unidades disponíveis: <?php echo $produto[0]->quantidade; ?></span>

            <div class="row">
                <?php
                    if (isset($_SESSION['usuario'])) {
                ?>
                    <form action="/pedido/item" method="post">
                        <span>Quantidade:</span>
                        <input type="hidden" name="id" value="<?php echo $produto[0]->id; ?>">
                        <input type="hidden" name="nome" value="<?php echo $produto[0]->nome; ?>">
                        <input type="hidden" name="imagem" value="<?php echo $produto[0]->imagem; ?>">
                        <input type="hidden" name="preco" value="<?php echo $produto[0]->preco; ?>">
                        <input type="number" min="1" name="quantidade" id="quantidade" value="1">
                        <button type="submit" >Adicionar ao carrinho</button>
                    </form>
                <?php 
                    } else {
                ?>
                    <span class="warning">Faça o login para começar a comprar</span>
                <?php 
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="sugestoes">
    <h2>Você também pode gostar...</h2>
    <div class="row">
        <?php
            $sugestoes = MyPDO::executa_sql('SELECT * FROM produtos WHERE id <> ? ORDER BY RAND() LIMIT 5', [$produto_id]);
            foreach ($sugestoes as $produto) {
        ?>
            <div class="produto">
                <img src="../assets/imgs/produtos/<?php echo $produto->imagem; ?>">
                <span><?php echo $produto->nome; ?></span>
                <span><?php echo 'R$ '.str_replace('.', ',', $produto->preco); ?></span>
                <form action="produto/<?php echo $produto->id; ?>">
                    <button type="submit" >Comprar</button>
                </form>
            </div>
        <?php
            }
        ?>
    </div>
</div>