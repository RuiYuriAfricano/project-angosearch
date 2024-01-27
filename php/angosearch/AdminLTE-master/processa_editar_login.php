
<?php

session_start();
if($_SESSION['nome_admin']) {
    ?>
<?php
include '../admin/include/conexao.php';
$con= conecta();



    $senhaADM = md5($_POST['senhaADM']);

    $n=$_SESSION['nome_admin'];
    $q=$con->query("select usuario from login where admin='$n' and estado='1'");
    $pegaUs=mysqli_fetch_array($q);
    $usuarioADM=$pegaUs['usuario'];
    $p= $con->query("select * from login where senha='$senhaADM' and usuario='$usuarioADM' and estado='1'");

    if((mysqli_num_rows($p)) > 0):

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$id_login=$_POST['loginID'];


if ($usuario == "" && $senha=="" ) {
    echo"
 <META HTTP-EQUIV=REFRESH CONTENT = '0; URL
=http://localhost/Projecto%20Final%20-%20Loide%20Laura/php/angosearch/adminLTE-master/view_esquadra.php'>
 <script>

                        alert('Preencha o campo usuário sua senha para poder editar!');

        </script> ";
}

else {

       if($senha =="" && $usuario!=""){



        $up = $con->query("update login set usuario='$usuario' WHERE id_login ='$id_login'")
        or die ("erro ao cadastrar esquadra".mysql_error());


        header('Location:view_esquadra.php?msg=edit');
           }
   else if($senha !="" && $usuario==""){

        $nova_senha = md5($senha);

        $up = $con->query("update login set senha='$nova_senha' WHERE id_login ='$id_login'")
        or die ("erro ao cadastrar esquadra".mysql_error());




        header('Location:view_esquadra.php?msg=edit');
    }


}
    else:
        header("Location:view_esquadra.php?msg=senhaerror");
    endif;
?>

<?php }else{
    header("Location:../../login-usuario.php");
}?>