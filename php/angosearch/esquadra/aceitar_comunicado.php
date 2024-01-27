<?php
session_start();


if ( !$_SESSION['esquadra']) {
    header("Location:../../login-usuario.php");
} else {
    ?>
    <?php

    include 'include/conexao.php';
    $con=conecta();
    $esq=$_SESSION['esquadra'];
    $esquadra =$con ->query("select * from esquadra where esquadra='$esq'") or die(mysql_error());


    $valores = mysqli_fetch_assoc($esquadra);

    if($_GET["id_desaparecido"]!="") {

        $id = $_GET["id_desaparecido"];

        $postado_por = $valores['func_esquadra'] . " : " . $_SESSION['esquadra'];

        $dt = date('d-m-Y');

        try {
            $insere = $con->query("update desaparecidos set estado='1', postado_por='$postado_por', dataRegistro='$dt' where estado='2'
                                and id_desaparecido='$id'");
            if ($insere === FALSE) {
                throw new Exception('Problemas: ' . $con->errno . ' --- ' . $con->error . '<br />');
            } else {
                header('Location:comunicados.php?msg=1'); // enviado com sucesso
            }
        } catch (Exception $e) {
            //caso haja uma exceção a mensagem é capturada e atribuida a $msg
            echo $e->getMessage();
        }
    }
    ?>

    <!doctype html>
    <html lang="pt-pt">
    <head>
    </head>
   <body>
    </body>
    </html>
<?php

}   ?>