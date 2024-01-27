

<?php
include('include/conexao.php');
$con=conecta();
$usuario=$_POST["usuario"];
$dt=$_POST["dt"];
$senha=md5($_POST["senha"]);

$data=date('Y-m-d H:i:s');




if($usuario!="" and $senha!="") {

// teste admin
    $sql = $con->query("select usuario,senha,acesso, admin
from login where usuario='$usuario' AND
  senha = '$senha' AND acesso = 'admin' AND  estado='1'  ") or die ("erro");

    $sql1 = $con->query("select usuario,senha,acesso, admin
from login where usuario='$usuario' AND
  senha != '$senha' AND acesso = 'admin' AND  estado='1'  ") or die ("erro");

    $sql2 = $con->query("select usuario,senha,acesso, admin
from login where usuario !='$usuario' AND
  senha = '$senha' AND acesso = 'admin' AND  estado='1'  ") or die ("erro");

    $linhas = mysqli_num_rows($sql);
    $linhas1 = mysqli_num_rows($sql1);
    $linhas2 = mysqli_num_rows($sql2);

    //teste da esquadra
 
    $sql3 = $con->query("select usuario,senha,acesso,fk_esquadra
from login where  usuario='$usuario' AND
  senha = '$senha' AND acesso = 'esquadra' AND  estado='1' " ) or die ("erro na sql3".mysql_error());

    $sql4 = $con->query("select usuario,senha,acesso,fk_esquadra
from login where  usuario='$usuario' AND
  senha != '$senha' AND acesso = 'esquadra' AND  estado='1' " ) or die ("erro na sql3".mysql_error());

    $sql5 = $con->query("select usuario,senha,acesso,fk_esquadra
from login where  usuario!='$usuario' AND
  senha = '$senha' AND acesso = 'esquadra' AND  estado='1' " ) or die ("erro na sql3".mysql_error());

    $linhas3= mysqli_num_rows($sql3);
        $linhas4 = mysqli_num_rows($sql4);
            $linhas5 = mysqli_num_rows($sql5);

    //teste do utilizador

    $sql6 = $con->query("select usuario,senha,acesso,fk_utilizador
from login where  usuario='$usuario' AND
  senha = '$senha' AND acesso = 'utilizador' AND  estado='1' " ) or die ("erro na sql3".mysql_error());

    $sql7 = $con->query("select usuario,senha,acesso,fk_utilizador
from login where  usuario='$usuario' AND
  senha != '$senha' AND acesso = 'utilizador' AND  estado='1' " ) or die ("erro na sql3".mysql_error());

    $sql8 = $con->query("select usuario,senha,acesso,fk_utilizador
from login where  usuario!='$usuario' AND
  senha = '$senha' AND acesso = 'utilizador' AND  estado='1' " ) or die ("erro na sql3".mysql_error());

    $linhas6= mysqli_num_rows($sql6);
    $linhas7 = mysqli_num_rows($sql7);
    $linhas8 = mysqli_num_rows($sql8);

    if ($linhas > 0) {


        while ($dados = mysqli_fetch_assoc($sql)) {


            session_start();
            $_SESSION['nome_admin'] = $dados['admin'];

            $n = "admin : ".$_SESSION['nome_admin'];




        }
        /*Insere a data e hora que o admin iniciou sessão*/
        $insere = $con->query("INSERT INTO inicia_sessao(id_iniciaSessao, nome_user, dataLogin)
 VALUES (DEFAULT , '$n','$dt')") or die ("Erro ao Inserir a data e hora que o admin iniciou sessão");
        header('Location:angosearch/adminLTE-master/index.php');

    } else if($linhas1 > 0){

        session_start();
        $_SESSION['erroLogin'] ="<p class='text-danger' style=' margin-top: 12px;
 font-weight: bolder; font-size: 12px;'><span class='glyphicon glyphicon-info-sign'></span>
Senha Incorrecta...</p>";

        header('Location:login-usuario.php');
    }

    else if($linhas2 > 0){

        session_start();
        $_SESSION['erroLogin'] ="<p class='text-danger' style=' margin-top: 12px;
 font-weight: bolder; font-size: 12px;'><span class='glyphicon glyphicon-info-sign'></span>
Usuário Incorreto... </p>";

        header('Location:login-usuario.php');
    }

    else if($linhas3 > 0){

        while ($dados = mysqli_fetch_assoc($sql3)) {
		session_start();
		$fk_esquadra = $dados['fk_esquadra'];
		$pesquisa_esquadra = $con->query("select esquadra,func_esquadra , tipoEsquadra,
		bairro from esquadra, tipoesquadra, bairro where id_esquadra='$fk_esquadra'
		AND fk_tipoEsquadra = id_tipoEsquadra AND fk_bairro = id_bairro")or die ("Erro ao pegar os dados da escolar".mysql_error());

		$dados_esquadra = mysqli_fetch_assoc($pesquisa_esquadra);
		
           
            $_SESSION['esquadra'] = $dados_esquadra['esquadra'];
            $_SESSION['tipo_esquadra'] = $dados_esquadra['tipoEsquadra'];
            $_SESSION['bairro'] = $dados_esquadra['bairro'];

            $n = $dados_esquadra['esquadra']." : ".$dados_esquadra['func_esquadra'];




        }
        /*Insere a data e hora que o admin iniciou sessão*/
        $insere = $con->query("INSERT INTO inicia_sessao(id_iniciaSessao, nome_user, dataLogin)
 VALUES (DEFAULT , '$n','$dt')") or die ("Erro ao Inserir a data e hora que a esquadra iniciou sessão");
        header('Location:angosearch/esquadra/principal_esquadra.php');
    }

    else if($linhas4 > 0){

        session_start();
        $_SESSION['erroLogin'] ="<p class='text-danger' style=' margin-top: 12px;
 font-weight: bolder; font-size: 12px;'><span class='glyphicon glyphicon-info-sign'></span>
Senha Incorrecta...</p>";

        header('Location:login-usuario.php');
    }

    else if($linhas5 > 0){

        session_start();
        $_SESSION['erroLogin'] ="<p class='text-danger' style=' margin-top: 12px;
 font-weight: bolder; font-size: 12px;'><span class='glyphicon glyphicon-info-sign'></span>
Usuário Incorreto... </p>";

        header('Location:login-usuario.php');
    }


    //utilizador


    else if($linhas6 > 0){

        while ($dados = mysqli_fetch_assoc($sql6)) {
            session_start();
            $fk_utilizador = $dados['fk_utilizador'];
            $pesquisa_utilizador = $con->query("select nome_completo from utilizador where id_utilizador='$fk_utilizador'
and estado='1'")or die
            ("Erro ao pegar os dados do utiliador1".mysql_error());

            $dados_utilizador = mysqli_fetch_assoc($pesquisa_utilizador);


            $_SESSION['utilizador'] = $dados_utilizador['nome_completo'];

            $n=$_SESSION['utilizador'];


        }
        /*Insere a data e hora que o admin iniciou sessão*/
        $insere = $con->query("INSERT INTO inicia_sessao(id_iniciaSessao, nome_user, dataLogin)
 VALUES (DEFAULT , '$n','$dt')") or die ("Erro ao Inserir a data e hora que a esquadra iniciou sessão");
        header('Location:angosearch/utilizador/index.php');
    }

    else if($linhas7 > 0){

        session_start();
        $_SESSION['erroLogin'] ="<p class='text-danger' style=' margin-top: 12px;
 font-weight: bolder; font-size: 12px;'><span class='glyphicon glyphicon-info-sign'></span>
Senha Incorrecta...</p>";

        header('Location:login-usuario.php');
    }

    else if($linhas8 > 0){

        session_start();
        $_SESSION['erroLogin'] ="<p class='text-danger' style=' margin-top: 12px;
 font-weight: bolder; font-size: 12px;'><span class='glyphicon glyphicon-info-sign'></span>
Usuário Incorreto... </p>";

        header('Location:login-usuario.php');
    }








    else {

        session_start();
        $_SESSION['erroLogin'] ="<p class='text-danger' style=' margin-top: 12px;
 font-weight: bolder; font-size: 12px;'><span class='glyphicon glyphicon-info-sign'></span>
Utilizador inexistente...!</p>";

        header('Location:login_error.php');
    }


}


else{
    echo "
<META HTTP-EQUIV=REFRESH CONTENT = '0; URL = http://localhost/Projecto Final - Loide Laura/php/login-usuario.php'>
<script type=\"text/javascript\">

alert(\"Preencha os Campos Por Favor\");
</script>";
}

?>
