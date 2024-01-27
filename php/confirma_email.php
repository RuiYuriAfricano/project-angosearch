<?php include "include/conexao.php";
$con=conecta();
$id=$_GET['id'];
if(!empty($id)){
$atualiza=$con->query("update utlizador set estado='1' WHERE  MD5($id)='$id'");

    echo "Cadastro Confirmado Com Sucesso.......!";
}
?>