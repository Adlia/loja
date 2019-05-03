<?php
// Classe personalizada para usar o PDO
class MyPDO extends PDO
{
    static $conexao;

    // Cria um nova conexão com o banco de dados
    static function conecta()
    {
        if (MyPDO::$conexao === null) {
            MyPDO::$conexao = new MyPDO("mysql:host=localhost;dbname=loja", "root", "");
        }
    }

    // Cancela a conexão com o banco de dados
    static function desconecta()
    {
        MyPDO::$conexao = null;
    }

    // Executa o comando SQL passado por parâmetro de acordo com os valores passados na variável $parâmetros
    static function executa_sql($sql, $parametros = null)
    {
        MyPDO::conecta();

        $resposta = MyPDO::$conexao->prepare($sql);

        for ($i = 0; $i < substr_count($sql, '?'); $i++) {
            $resposta->bindParam(($i + 1), $parametros[$i]);
        }

        $resposta->execute();

        MyPDO::desconecta();

        return $resposta->fetchAll(MyPDO::FETCH_OBJ);
    }

    // Busca pelo usuário no banco de dados
    static function buscaUsuario($usuario)
    {
        $sql = 'SELECT * FROM usuarios WHERE usuario = ?';

        $resposta = MyPDO::executa_sql($sql, [$usuario]);

        return $resposta;
    }
}