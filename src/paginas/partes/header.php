<?php
include('./src/config/MyPDO.php');
?>

<div class="bar">
    <div class="logo">
        <a href="/">Jóias do Infinito</a>
    </div>

    <nav class="menu" >
        <a href="/perfil" class="menu-item">
            <img src="../../../assets/imgs/icons/avatar.png" alt="Perfil">
            Perfil
        </a>

        <?php
            if (isset($_SESSION['usuario'])) {
        ?>
            <a href="/sacola" class="menu-item">
                <img src="../../../assets/imgs/icons/shopping-bag.png" alt="Sacola">
                Sacola
            </a>

            <a href="/pedidos" class="menu-item">
            <img src="../../../assets/imgs/icons/ico-box.png" alt="Pedidos">
                Pedidos
            </a>

            <a href="/sair" class="menu-item">
            <img src="../../../assets/imgs/icons/logout.png" alt="Sair">
                Sair
            </a>
        <?php
            }
        ?>
    </nav>
</div>

<div class="categorias">
    <nav class="menu-categorias">
        <?php
        $categorias = MyPDO::executa_sql('SELECT * FROM categorias WHERE geek = 0');

        if (count($categorias) > 0) {
            foreach ($categorias as $categoria) {
                ?>
                <a href="/categoria/<?php echo $categoria->id ?>" class="menu-item">
                    
                    <?php echo $categoria->nome; ?>
                </a>
            <?php
        }
    }
    ?>
    <a href="/categoria/0" class="menu-item geek" style="font-weight: bold; color: #f44336;">
        GEEK                
    </a>
    </nav>
</div>