<?php
    session_start();
    include_once('MyPDO.php');

    function validaCPF($cpf) {
 
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
         
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
        return true;
    }

    $insere = true;
    $atualiza = false;

    if ($_POST['edit_id'] != '') {
        $atualiza = true;
    }

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $senha = $_POST['senha'];
    $confirmSenha = $_POST['confirmSenha'];

    $_SESSION['tmpCadastro'] = [$nome, $email, $usuario, $cpf, $endereco];

    $verificaEmail = MyPDO::executa_sql('SELECT * FROM usuarios WHERE email = ?', [$email]);
    $verificaUsuario = MyPDO::executa_sql('SELECT * FROM usuarios WHERE usuario = ?', [$usuario]);
    $verificaCpf = MyPDO::executa_sql('SELECT * FROM usuarios WHERE cpf = ?', [$cpf]);

    if (count($verificaEmail) > 0 && $verificaEmail[0]->usuario != $usuario) {
        $_SESSION['erroEmail'] = true;
        $insere = false;
    }

    if (count($verificaUsuario) > 0 && !$atualiza) {
        $_SESSION['erroUsuario'] = true;
        $insere = false;
    }

    if ((count($verificaCpf) > 0 || validaCPF($cpf) === false) && !$atualiza) {
        $_SESSION['erroCpf'] = true;
        $insere = false;
    }

    if ($senha != $confirmSenha) {
        $_SESSION['erroSenha'] = true;
        $insere = false;
    }

    if ($insere) {
        unset($_SESSION['tmpCadastro']);

        $parametros = [$usuario, md5($senha), $nome, $endereco, $cpf, $email];
        $sql = 'INSERT INTO usuarios(usuario, senha, nome, endereco, cpf, email, nivel)'."VALUES (?, ?, ?, ?, ?, ?, 'CLIENTE')";

        if ($atualiza) {
            $sql = 'UPDATE usuarios SET usuario = ?, senha = ?, nome = ?, endereco = ?, cpf = ?, email = ? WHERE id = ?';
            array_push($parametros, $_POST['edit_id']);
        }

        MyPDO::executa_sql($sql, $parametros);

        $resultado = MyPDO::buscaUsuario($usuario); 
        $_SESSION['usuario'] = $resultado[0];
    }

    header('Location: '.'http://' . $_SERVER['SERVER_NAME'] . '/perfil');
