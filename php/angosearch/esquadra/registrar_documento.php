<?php
session_start();
/*if($_SESSION['nome_admin']) {*/

    ?>

<?php
include'include/conexao.php';

$con=conecta();
if(isset($_POST['sub'])) {

    $detalhe = $_POST['detalhe'];
    $codigo_doc = $_POST['codigo'];
    $nomeDoc = $_POST['nome_doc'];
    $dataRegistro = $_POST['dt'];
    $postado_por=$_SESSION['nome_admin'];


    if ($detalhe == "" or $nomeDoc=="") {
        header('Location:registrar_documento.php?msg=erro');
    } else {




        $imageName = $_FILES["fotografia"]["name"];
        if(!empty($imageName)) {
            $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            $fileAllow = array("jpg","png","jpeg");
            if(in_array($fileExtension,$fileAllow)){

                if($_FILES['fotografia']['size']< 4128943) {


                    $strDtMix = @date("d").substr((string)microtime(), 2, 8);
                    $uploadfile = $strDtMix.".".pathinfo($imageName, PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES['fotografia']['tmp_name'], "../admin/midia/documentos/".$uploadfile);


                    $insere = $con->query("INSERT INTO documentos(id_doc,nome_doc,fotografia,detalhe,codigo_doc,postado_por,dataRegistro,estado )
 VALUES (default,'$nomeDoc','$uploadfile', '$detalhe','$codigo_doc','$postado_por','$dataRegistro', '1')")
                    or die ("erro ao registrar documento".mysql_error());


                    header('Location:registrar_documento.php?msg=add');
                }else{

                    header('Location:registrar_documento.php?msg=2'); //tamanho grande
                }

            }else{

                header('Location:registrar_documento.phpmsg=3'); // extensão da foto é invalida
            }
        }else{
            header('Location:registrar_documento.php?msg=4');
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
    <link href="../adminLTE-master/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" >
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

    <style>
        #ativo2{
            color: #005cbf;
        }
    </style>
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
            <div class="container"><br><br><br><br><br><bR><bR>
                <div class="banner_content text-center">
                    <h2></h2>
                    <div class="page_link">
                        <h3 class="text-danger"><b style='font-weight: bolder;'>
                                <span class="glyphicon	glyphicon-plus"></span>  Documento Perdido</b></h3>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->
    <div class="content-wrapper">
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row" id="resumo">
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


                        <span class='notification n-error'>Não foi inserida nenhuma imagem...!</span>


                    <?php }


                    if ($_REQUEST["msg"] == "erro") {

                        ?>


                        <span class='notification n-error'>Preencha os campos por favor...!</span>


                    <?php
                    }
                }?>
            </div>


            <!-- left column -->
            <div class="col-md-12">
                <div class="box box-primary" style="width: 80%">
                    <div class="box-header">
                        <h3 class="box-title">Registrar Documento Perdido</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Designação do Documentos</label>
                                <input type="text" class="form-control" id="arquivo" name="nome_doc">
                                <input type="hidden" class="form-control" id="dat" name="dt">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Imagem</label>
                                <input type="file" class="form-file id="arquivo" name="fotografia">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Detalhes</label>
                                <textarea name="detalhe" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Código do Documento</label>
                                <input type="text" class="form-control" name="codigo" placeholder="ex: Nº do BI, de Cédula, etc...">
                            </div>


                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary" type="submit"  name="sub"/>
                            <span	class="glyphicon	glyphicon-ok"></span> Registrar
                            </button>
                        </div>
                    </form>
                </div></div>
    </section></div></div>
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

<?php/*
}
else{
    header("Location:../../login-usuario.php");
}*/
?>