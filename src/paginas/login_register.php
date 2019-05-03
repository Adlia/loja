<?php
include_once('./src/config/MyPDO.php');
?>

<div class="forms">
    <div class="login">
        <h2>Entre com a sua conta:</h2>
        <?php
                if (isset($_SESSION['erroLogin'])) {
                    echo '<span class="alerta">'.$_SESSION['erroLogin'].'</span>';
                    unset($_SESSION['erroLogin']);
                }
            ?>
        <form action="/login" method="post">
            <div class="grupo">
                <label for="usuario">Usuário:</label>
                <input type="text" name="usuario" id="usuario" required>
            </div>

            <div class="grupo">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required>
            </div>

            <div class="grupo">
                <button class="green-button" type="submit">Entrar</button>
            </div>
        </form>
    </div>

    <div class="cadastro">
        <h2>Cadastrar uma nova conta:</h2>
        <form action="/cadastrar" method="post">
            <div class="grupo">
                <label for="nome">Nome completo:</label>
                <input type="text" name="nome" id="nome" value="<?php if (isset($_SESSION['tmpCadastro'][0])) { echo $_SESSION['tmpCadastro'][0]; unset($_SESSION['tmpCadastro'][0]); } ?>" required>
            </div>

            <div class="grupo">
                <label for="usuario">Usuário:</label>
                <?php
                if (isset($_SESSION['erroUsuario'])) {
                ?>
                    <div class="sub-grupo">
                        <input class="input-erro" type="text" name="usuario" id="usuario" value="<?php echo $_SESSION['tmpCadastro'][2] ?>" required>
                        <small style="color: red;">Usuário já está sendo usado</small>
                    </div>
                    <?php
                    unset($_SESSION['erroUsuario']);
                } else {
                ?>
                    <input type="text" name="usuario" id="usuario" value="<?php if (isset($_SESSION['tmpCadastro'][2])) { echo $_SESSION['tmpCadastro'][2]; unset($_SESSION['tmpCadastro'][2]); } ?>" required>
                <?php
                }
                ?>
            </div>

            <div class="grupo">
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
                    <input type="email" name="email" id="email" value="<?php if (isset($_SESSION['tmpCadastro'][1])) { echo $_SESSION['tmpCadastro'][1]; unset($_SESSION['tmpCadastro'][1]); } ?>" required>
                <?php
                }
                ?>
            </div>

            <div class="grupo">
                <label for="cpf">CPF:</label>
                <?php
                if (isset($_SESSION['erroCpf'])) {
                ?>
                    <div class="sub-grupo">
                        <input class="input-erro" type="text" name="cpf" id="cpf" value="<?php echo $_SESSION['tmpCadastro'][3] ?>" required>
                        <small style="color: red;">CPF inválido ou já foi cadastrado</small>
                    </div>
                    <?php
                    unset($_SESSION['erroCpf']);
                } else {
                ?>
                    <input type="text" name="cpf" id="cpf" placeholder="999.999.999-99" value="<?php if (isset($_SESSION['tmpCadastro'][3])) { echo $_SESSION['tmpCadastro'][3]; unset($_SESSION['tmpCadastro'][3]); } ?>" required>
                <?php
                }
                ?>
            </div>

            <div class="grupo">
                <label for="endereco">Endereço:</label>
                <input type="text" name="endereco" id="endereco" value="<?php if (isset($_SESSION['tmpCadastro'][4])) { echo $_SESSION['tmpCadastro'][4]; unset($_SESSION['tmpCadastro'][4]); } ?>" required>
            </div>

            <div class="grupo">
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

            <div class="grupo">
                <label for="confirmSenha">Confirme a senha:</label>
                <input type="password" name="confirmSenha" id="confirmSenha" required>
            </div>

            <div class="grupo">
                <button class="green-button" type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
</div>