<?php
function conecta()
{

    $host = "localhost";
    $usuario = "root";
    $pass = "";
    $bd = "bd_angosearch";
    $conexao = mysqli_connect($host, $usuario, $pass, $bd) or die("Erro na Conexão do Banco de Dados");
    if (!$conexao)
        throw new Exception('Não foi possível se conectar com o banco de dados');
    else

        return $conexao;
}


?>