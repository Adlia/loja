<h2>Categorias</h2>

<div class="categorias">
    <?php 
        if (isset($_SESSION['erroDelCat'])) {
            echo '<div class="grupo"><span class="alerta">' . $_SESSION['erroDelCat'] . '</span></div>';
            unset($_SESSION['erroDelCat']);        
        }
    ?>
    <form enctype="multipart/form-data" action="/painel/categorias/nova" method="post" class="cadastrar-form">
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
                <label for="geek">É Geek?</label>
                <input type="checkbox" name="geek" id="geek">
            </div>

            <div class="sub-grupo">
                <button class="green-button" type="submit">Cadastrar</button>
            </div>
        </div>

    </form>

    <table class="table">
        <thead>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Geek</th>
            <th>Ação</th>
        </thead>

        <tbody>
            <?php
            $categorias = MyPDO::executa_sql('SELECT * FROM categorias');

            if (count($categorias) == 0) {
                echo '<tr>
                            <td colspan="5"><h2>Não há categorias cadastradas</h2></td>
                         </tr>';
            } else {
                foreach ($categorias as $categoria) {
                    
                    $geek = 'Não';

                    if ($categoria->geek == 1) {
                        $geek = 'Sim';
                    }

                    echo '<tr>
                            <td>' . $categoria->nome . '</td>
                            <td>' . $categoria->descricao . '</td>
                            <td> '.$geek.' </td>
                            <td>
                                <a href="javascript:editar(' . $categoria->id . ', ' . "'" . $categoria->nome . "'" . ', ' . "'" . $categoria->descricao . "'" . ', '.$categoria->geek.');">
                                    <img src="../../../assets/imgs/icons/ico-edit.png" alt="Editar">
                                </a>
                                <a href="/painel/categorias/excluir/' . $categoria->id . '">
                                    <img src="../../../assets/imgs/icons/ico-delete.png" alt="Deletar">
                                </a>
                            </td>
                         </tr>';
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    function editar(id, nome, descricao, geek) {
        document.getElementById('edit_id').value = id;
        document.getElementById('nome').value = nome;
        document.getElementById('descricao').value = descricao;
        
        if (geek == 1) {
            document.getElementById('geek').checked = true;
        } else {
            document.getElementById('geek').checked = false;
        }
    }
</script>