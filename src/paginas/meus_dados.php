<div class="meus-dados">
<h1>Dados pessoais</h1>

<div class="form-dados">
    <form action="/cadastrar" method="post">
        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $_SESSION['usuario']->id; ?>">
           <div class="form-grupo">
                <div class="group">
                    <label for="nome">Nome completo:</label>
                    <input type="text" name="nome" id="nome" value="<?php if (isset($_SESSION['tmpCadastro'][0])) { echo $_SESSION['tmpCadastro'][0]; unset($_SESSION['tmpCadastro'][0]); } else { echo $_SESSION['usuario']->nome; } ?>" required>
                </div>

                <div class="group">
                    <label for="usuario">Usuário:</label>
                    <input type="text" name="usuario" id="usuario" value="<?php { echo $_SESSION['usuario']->usuario; } ?>" readonly required>
                </div>

                <div class="group">
                    <label for="email">E-mail:</label>
                    <?php
                    if (isset($_SESSION['erroEmail'])) {
                    ?>
                        <div class="sub-grupo">
                            <input class="input-erro" type="email" name="email" id="email" value="<?php echo $_SESSION['tmpCadastro'][1]; ?>" required>
                            <small style="color: red;">Esse e-mail já está sendo usado</small>
                        </div>
                        <?php
                        unset($_SESSION['erroEmail']);
                    } else {
                    ?>
                        <input type="email" name="email" id="email" value="<?php if (isset($_SESSION['tmpCadastro'][1])) { echo $_SESSION['tmpCadastro'][1]; unset($_SESSION['tmpCadastro'][1]); } else { echo $_SESSION['usuario']->email; }?>" required>
                    <?php
                    }
                    ?>
                </div>

                <div class="group">
                    <label for="cpf">CPF:</label>
                    <input type="text" name="cpf" id="cpf" value="<?php { echo $_SESSION['usuario']->cpf; } ?>" readonly required>
                </div>
           </div>

            <div class="form-grupo">
                <div class="group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" name="endereco" id="endereco" value="<?php if (isset($_SESSION['tmpCadastro'][4])) { echo $_SESSION['tmpCadastro'][4]; unset($_SESSION['tmpCadastro'][4]); } else { echo $_SESSION['usuario']->endereco; } ?>" required>
                </div>

                <div class="group">
                    <label for="senha">Senha:</label>
                    <?php
                    if (isset($_SESSION['erroSenha'])) {
                    ?>
                        <div class="sub-grupo">
                            <input class="input-erro" type="password" name="senha" id="senha" required>
                            <small style="color: red;">As senhas não conferem</small>
                        </div>
                        <?php
                        unset($_SESSION['erroSenha']);
                    } else {
                    ?>
                        <input type="password" name="senha" id="senha" required>
                    <?php
                    }
                    ?>
                </div>

                <div class="group">
                    <label for="confirmSenha">Confirme a senha:</label>
                    <input type="password" name="confirmSenha" id="confirmSenha" required>
                </div>
            </div>

            <div class="group">
                <button class="green-button" type="submit" style="width: 10% !important;">Atualizar</button>
            </div> 
        </form>
</div>

<div class="cartoes">
    <h3>Cartões de crédito</h3>
    <div class="cadastrar">
        <form action="/cartoes/cadastrar" method="post">
            <input type="hidden" name="edit_id" id="edit_id">
            <div class="group">
                <label for="numero">Número:</label>
                <input type="number" name="numero" id="numero" required>
            </div>

            <div class="group">
                <label for="titular">Nome do titular:</label>
                <input type="text" name="titular" id="titular" required>
            </div>

            <div class="group">
                <label for="titular">Validade:</label>
                <input type="month" name="validade" id="validade" placeholder="MM/AA" required>
            </div>

            <div class="group">
                <label for="titular">Bandeira:</label>
                <select name="bandeira" id="bandeira" required>
                    <option value="MASTER">Master</option>
                    <option value="VISA">Visa</option>
                    <option value="HIPER">Hiper</option>
                    <option value="ELO">Elo</option>
                </select>
            </div>

            <div class="group">
                <button class="green-button" type="submit" style="width: 40% !important; margin-top: 14px;">Cadastrar</button>
            </div>
        </form>
    </div>

<div class="listar">
    <table class="table">
        <thead>
            <th>Número</th>
            <th>Nome do titular</th>
            <th>Validade</th>
            <th>Bandeira</th>
            <th>Ação</th>
        </thead>

        <tbody>
            <?php
            $cartoes = MyPDO::executa_sql('SELECT * FROM cartoes_credito WHERE usuario_id = ?', [$_SESSION['usuario']->id]);

            if (count($cartoes) == 0) {
                echo '<tr>
                            <td colspan="5"><h2>Não há cartões cadastrados</h2></td>
                         </tr>';
            } else {
                foreach ($cartoes as $cartao) {
                    echo '<tr>
                            <td>' . $cartao->numero . '</td>
                            <td>' . $cartao->titular . '</td>
                            <td>' . $cartao->validade . '</td>
                            <td> '. $cartao->bandeira .' </td>
                            <td>
                                <a class="acoes" href="javascript:editar(' . $cartao->id . ', ' . "'" . $cartao->numero . "'" . ', ' . "'" . $cartao->validade . "'" . ', '.$cartao->bandeira.');">
                                    <img src="../../../assets/imgs/icons/ico-edit.png" alt="Editar">
                                </a>
                                <a class="acoes" href="/cartoes/excluir/' . $cartao->id . '">
                                    <img src="../../../assets/imgs/icons/ico-delete.png" alt="Deletar">
                                </a>
                            </td>
                         </tr>';
                }
            }
            ?>
        </tbody>
    </div>
</div>
</div>