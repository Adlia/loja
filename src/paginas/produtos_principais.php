<?php
    include_once('./src/config/MyPDO.php');
?>

<div class="produtos-principais">
    <h2>Conheça nossos melhores produtos...</h2>
    <?php 
        $produtos = MyPDO::executa_sql('SELECT * FROM  produtos WHERE quantidade <> 0');
    
        if (count($produtos) > 0) {
            $aux = 4;
            foreach ($produtos as $produto) {
                if ($aux == 4){
                    echo '<div class="row">';
                    $aux = 0;
                }
    ?>
                <div class="produto">
                    <img src="./assets/imgs/produtos/<?php echo $produto->imagem; ?>">
                    <span><?php echo $produto->nome; ?></span>
                    <span><?php echo 'R$ '.str_replace('.', ',', $produto->preco); ?></span>
                    <a href="/produto/<?php echo $produto->id; ?>">Comprar</a>
                </div>
    <?php
            $aux++;
            if ($aux == 4){
                echo '</div>';
                
            }
            }
        }
    ?>
</div>