<h2>Produtos</h2>

<div class="categorias">
    <?php 
        if (isset($_SESSION['erroDelProd'])) {
            echo '<div class="grupo"><span class="alerta">' . $_SESSION['erroDelCat'] . '</span></div>';
            unset($_SESSION['erroDelProd']);        
        }
    ?>  

    <form enctype="multipart/form-data" action="/painel/produtos/novo" method="post" class="cadastrar-form">
        <input type="hidden" name="edit_id" id="edit_id">

        <div class="grupo">
            <div class="sub-grupo">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" required>
            </div>

            <div class="sub-grupo">
                <label for="descricao">Descrição:</label>
                <input type="text" name="descricao" id="descricao" required>
            </div>

            <div class="sub-grupo">
                <label for="preco">Preço:</label>
                <input type="text" name="preco" id="preco" placeholder="EX: 1520,35" required>
            </div>

            <div class="sub-grupo">
                <label for="icon">Imagem:</label>
                <input type="file" name="imagem" id="imagem" required>
            </div>
        </div>

        <div class="grupo">
            <div class="sub-grupo">
                <label for="quantidade">Quantidade:</label>
                <input type="number" name="quantidade" id="quantidade" min="0" value="0" required>
            </div>

            <div class="sub-grupo">
                <label for="categoria">Categoria:</label>
                <select name="categoria" id="categoria">
                    <?php
                    $categorias = MyPDO::executa_sql('SELECT * FROM categorias');

                    if (count($categorias) == 0) {
                        echo '<option value="">Não há categorias cadastradas</option>';
                    } else {
                        foreach ($categorias as $categoria) {
                            echo '<option value="'.$categoria->id.'">'.$categoria->id.' - '.$categoria->nome.'</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <button class="green-button" type="submit">Cadastrar</button>
        </div>

    </form>

    <table class="table">
        <thead>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Categoria</th>
            <th>Imagem</th>
            <th>Ação</th>
        </thead>

        <tbody>
            <?php
            $produtos = MyPDO::executa_sql('SELECT * FROM produtos');

            if (count($produtos) == 0) {
            ?>
                <tr>
                    <td colspan="7"><h2>Não há produtos cadastrados</h2></td>
                </tr>
            <?php
            } else {
                foreach ($produtos as $produto) {
            ?>
                    <tr>
                        <td>
                            <?php echo $produto->nome; ?>
                        </td>
                        <td>
                            <?php echo $produto->descricao; ?>
                        </td>
                        <td>
                            R$ <?php echo $produto->preco; ?>
                        </td>
                        <td>
                            <?php echo $produto->quantidade; ?>
                        </td>
                        <td>
                            <?php echo $produto->categoria_id; ?>
                        </td>
                        <td> 
                            <img src="../../../assets/imgs/produtos/<?php echo $produto->imagem; ?>" alt="Ícone" class="img-produto" >
                            </td>
                        <td>
                            <a href="javascript:editar(<?php echo $produto->id; ?>, '<?php echo $produto->nome; ?>', '<?php echo $produto->descricao; ?>', <?php echo $produto->preco; ?>, <?php echo $produto->quantidade; ?>, <?php echo $produto->categoria_id; ?>);">
                                <img src="../../../assets/imgs/icons/ico-edit.png" alt="Editar">
                            </a>
                            <a href="/painel/produtos/excluir/<?php echo $produto->id; ?>">
                                <img src="../../../assets/imgs/icons/ico-delete.png" alt="Deletar">
                            </a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    function editar(id, nome, descricao, preco, quantidade, categoria_id) {
        document.getElementById('edit_id').value = id;
        document.getElementById('nome').value = nome;
        document.getElementById('descricao').value = descricao;
        document.getElementById('preco').value = preco;
        document.getElementById('quantidade').value = quantidade;
        document.getElementById('categoria').value = categoria_id;
    }
</script>