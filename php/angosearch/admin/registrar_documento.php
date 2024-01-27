<?php
session_start();
if($_SESSION['nome_admin']) {


    ?>

<?php
include'include/conexao.php';

$con=conecta();
if(isset($_POST['sub'])) {

    $detalhe = $_POST['detalhe'];
    $nomeDoc = $_POST['nome_doc'];
    $dataRegistro = $_POST['dt'];
    $postado_por=$_SESSION['nome_admin'];


    if ($detalhe == "") {
        header('Location:registrar_documento?msg=erro');
    } else {




$imageName = $_FILES["fotografia"]["name"];
if(!empty($imageName)) {
$fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
$fileAllow = array("jpg","png","jpeg");
if(in_array($fileExtension,$fileAllow)){

    if($_FILES['fotografia']['size']< 4128943) {


        $strDtMix = @date("d").substr((string)microtime(), 2, 8);
        $uploadfile = $strDtMix.".".pathinfo($imageName, PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['fotografia']['tmp_name'], "midia/documentos/".$uploadfile);


        $insere = $con->query("INSERT INTO documentos(id_doc,nome_doc,fotografia,detalhe,postado_por,dataRegistro,estado )
 VALUES (default,'$nomeDoc','$uploadfile', '$detalhe','$postado_por','$dataRegistro', '1')")
        or die ("erro ao registrar documento".mysql_error());


        header('Location:registrar_documento?msg=add');
    }else{

        header('Location:registrar_documento.php?msg=2'); //tamanho grande
    }

}else{

    header('Location:registrar_documento.php?msg=3'); // extensão da foto é invalida
}
}else{
    header('Location:registrar_documento?msg=4');
}


    }
}
?>

<!doctype html>
<html lang="pt-pt">
<head>
    <!-- Required meta tags -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Registro de Documentos</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/glyphicon.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="vendors/animate-css/animate.css">
    <link rel="stylesheet" href="Ionicons/css/ionicons.min.css">
    <!--<link rel="stylesheet" href="bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <!--<link rel="stylesheet" href="bootstrap-daterangepicker/daterangepicker.css">
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="../../../js/calendario.js"></script>
</head>
<body onload="setInterval('apresentaData()',1000);">
<div>

    <!--================Header Menu Are
    a =================-->
    <header class="header_area">
        <?php include"include/cabecalho.php"; ?>
    </header>
    <!--================Header Menu Area =================-->

    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
            <div class="container">
                <div class="banner_content text-center">
                    <h2><span	class="glyphicon	glyphicon-plus"></span> Registro de Documentos Perdidos</h2>
                    <div class="page_link">
                        <a href="visualizar_documentos.php">Visualizar Documentos</a>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->
    <br>
    <div style="">
        <?Php
        if(isset($_REQUEST["msg"])) {
            if ($_REQUEST["msg"] == "add") {

                ?>
                <span class='notification n-success'>Registrado com Sucesso.......!!</span>
            <?php }

            if ($_REQUEST["msg"] == "2") {

                ?>
                <span class="notification n-error">Erro: Fotografia Muito grande, escolhe uma de tamanho menor .</span>
            <?php }
            if ($_REQUEST["msg"] == "3") {
                ?>
                <span class='notification n-error'>Erro: Extensão Inválida</span>


            <?php }


            if ($_REQUEST["msg"] == "4") {

                ?>


                <span class='notification n-error'>Não foi inserida nenhuma imagem ...!</span>


            <?php }


            if ($_REQUEST["msg"] == "erro") {

                ?>


                <span class='notification n-error'>Preencha o campo detalhe ...!</span>


                <?php
            }
        }?>
    </div>
    <!--================Welcome Area =================-->

    <script language="JavaScript" src="js/apresentaMSG.js"></script>
    <center>
    <div class="col-lg-9    table-responsive" style="border: solid 1px; text-align: center;  width: 80%;
background:#999;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px;">

        <!--================End Welcome Area =================-->
        <form name="" action="" method="post"  enctype="multipart/form-data">
            <table width="100%">

                <tr>
                    <td height="45"  align="right">Nome do Documento :</td>
                    <input type="hidden" class="form-control" id="dat" name="dt">
                    <td width="582" align="left">
                        <input type="text" class="form-control" id="arquivo" name="nome_doc" style="color:#002a80;border-radius: 20px;">

                    </td>
                </tr>

                <tr>
                    <td height="45"  align="right">Fotográfia do Documento :</td>
                    <td width="582" align="left">
                        <input type="file" class="form-control" id="arquivo" name="fotografia" style="color:#002a80;border-radius: 20px;">

                    </td>
                </tr>
                <tr>
                    <td height="45"  align="right">Detalhes :</td>
                    <td width="582" align="left"><textarea name="detalhe" rows="3"></textarea>

                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td align="left" height="45">
                        <button class="btn btn-primary" type="submit"  name="sub"/>
                        <span	class="glyphicon	glyphicon-ok"></span> Registrar
                        </button>
                        <a href="registrar_documento"><input class="btn btn-danger" type="button" value="Cancelar" /></a></td>
                </tr>
            </table></form></div></center></div>
<!--================End Causes Area =================-->

<style>
    table{

    }
    table td {
        background-color: transparent;
        padding: 12px;
        font-size: 16px;
        color:#fff;
        font-weight: bold;
        border: none;



    }
    input.input-short, input.input-medium, input.input-long, select {
        height: 35px;
    }
    input.input-short, input.input-medium, input.input-long, select, textarea {
        background: url(../images/input-bg.gif) top left repeat-x #f6f6f6;
        border: 0;
        border: 1px solid #cccccc;
    }
    .input-medium {
        width: 50%;
    }
    .input-short, .input-medium, .input-long {
        padding: 3px;
        border: 1px solid #999;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        -khtml-border-radius: 5px;
        border-radius: 5px;
    }
</style>
<!--================Event Area =================-->
<!--================End Event Area =================-->


<!--================Clients Logo Area =================-->

<!--================End Clients Logo Area =================-->


<!--================ start footer Area  =================-->
<footer class="footer-area section_gap">
    <?php include"include/rodape.php"; ?>
</footer>
<!--================ End footer Area  =================-->




<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/stellar.js"></script>
<script src="vendors/lightbox/simpleLightbox.min.js"></script>
<script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
<script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
<script src="vendors/isotope/isotope-min.js"></script>
<script src="vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/mail-script.js"></script>
<script src="js/theme.js"></script>
<script src="bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
</body>
</html>

<?php
}
else{
    header("Location:../../login-usuario.php");
}
?>