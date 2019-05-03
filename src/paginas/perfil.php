<div class="perfil">    
    <div class="content">
    <?php
        if ($_SERVER['REQUEST_URI'] == '/perfil') {
            include('./src/paginas/meus_dados.php');
        } else {
            include('./src/paginas/meus_pedidos.php');
        }
    ?>
    </div>
</div>