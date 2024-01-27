
<?php
include('include/conexao.php');
$con=conecta();


$dia = date('d');
$mes = date('M');
$ano = date('Y');
$h= date('H')-1;
$m = date('i');
$s = date('s');

$data=$dia.'/'.$mes.'/'.$ano.' , '.$h.':'.$m.':'.$s;

session_start();
if($_SESSION['nome_admin']){
$n = "admin : ".$_SESSION['nome_admin'];
    }
else if($_SESSION['esquadra']){

    $esq=$_SESSION['esquadra'];

    $esquadra =$con ->query("select * from esquadra where esquadra='$esq' ") or die(mysql_error());


    $valores = mysqli_fetch_assoc($esquadra);


    $n = $valores['func_esquadra']." : ".$_SESSION['esquadra'];

}else if($_SESSION['utilizador']){




    $n = $_SESSION['utilizador'];

}
session_destroy();



/*Insere a data e hora que o admin iniciou sessão*/
$insere = $con->query("INSERT INTO logout(id_logout, nome_user, datalogout)
 VALUES (DEFAULT , '$n','$data')") or die ("Erro ao Inserir a data e hora que o admin iniciou sessão");

header('Location:index.php');

?>