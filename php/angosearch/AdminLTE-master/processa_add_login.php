
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
$id=$_POST['esquadraID'];


if ($usuario == "" ) {
    echo"
 <META HTTP-EQUIV=REFRESH CONTENT = '0; URL
=http://localhost/Projecto%20Final%20-%20Loide%20Laura/php/angosearch/adminLTE-master/view_esquadra.php'>
 <script>

                        alert('Preencha o campo usuário por favor!');

        </script> ";
} else if($senha==""){
    echo"<META HTTP-EQUIV=REFRESH CONTENT = '0; URL
=http://localhost/Projecto%20Final%20-%20Loide%20Laura/php/angosearch/adminLTE-master/view_esquadra.php'> <script>

                        alert('Preencha o campo senha por favor!');

        </script> ";
}

else {




    $teste1=$con->query("select * from login WHERE usuario='$usuario'");

    if(mysqli_num_rows($teste1) > 0){
        echo"<META HTTP-EQUIV=REFRESH CONTENT = '0; URL
=http://localhost/Projecto%20Final%20-%20Loide%20Laura/php/angosearch/adminLTE-master/view_esquadra.php'> <script>

                        alert('Este usuário . Insira um outro usuário');

        </script> ";
    }else{

        $nova_senha = md5($senha);


        $insere = $con->query("INSERT INTO login(id_login,usuario,senha,acesso,estado,fk_esquadra)
 VALUES (default,'$usuario', '$nova_senha', 'esquadra','1', '$id')")
        or die ("erro ao cadastrar esquadra".mysql_error());


        header('Location:view_esquadra.php?msg=add');
    }





}
else:
    header("Location:view_esquadra.php?msg=senhaerror");
endif;
?>

<?php }else{
    header("Location:../../login-usuario.php");
}?>