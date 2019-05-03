<?php
    include_once('./src/config/MyPDO.php');

    $categoria_id = substr($_SERVER['REQUEST_URI'], 11);

    if ($categoria_id == '0') {
        $categoria_nome = 'Geek';
    } else {
        $categoria = MyPDO::executa_sql('SELECT * FROM categorias WHERE id = ?', [$categoria_id]);

        if (count($categoria) == 0) {
            header('location: http://' . $_SERVER['SERVER_NAME'] . '/');
        }

        $categoria_nome = $categoria[0]->nome;
    }
?>
<div class="produtos-principais">
    <h2><?php echo $categoria_nome; ?>...</h2>
    <?php 
        if ($categoria_id == '0') {
            $produtos = MyPDO::executa_sql('SELECT p.id, p.nome, p.descricao, p.preco, p.imagem FROM produtos p, categorias c WHERE p.categoria_id = c.id AND c.geek = 1');
        } else {
            $produtos = MyPDO::executa_sql('SELECT * FROM  produtos WHERE quantidade <> 0 AND categoria_id = ?', [$categoria_id]);
        }

        if (count($produtos) > 0) {
            $aux = 4;
            foreach ($produtos as $produto) {
                if ($aux == 4){
                    echo '<div class="row">';
                    $aux = 0;
                }
    ?>
                <div class="produto">
                    <img src="../assets/imgs/produtos/<?php echo $produto->imagem; ?>">
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