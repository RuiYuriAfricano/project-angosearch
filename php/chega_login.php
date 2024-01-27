<?php
include('include/conexao.php');





function verifiaLogin(){
    $con=conecta();
    $teste =$con ->query("select * from login where estado='1' ") or die(mysql_error());
    $dados=mysqli_fetch_array($teste);

     $verifia = $dados['usuario'] == $_POST['login'];
     if ($verifia)
         return $verifia;
}
verifiaLogin();
?>