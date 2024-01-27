<?php
include 'include/conexao.php';
session_start();
$con = conecta();
$r=$con ->query("select visualizacao from pagina where id_pagina='1' and estado='1' ") or die(mysql_error());
$row = mysqli_fetch_assoc($r);
$visualizacao = $row['visualizacao'];

$esquadras = $con->query("select * from esquadra where estado='1'");
$totalEsquadra = mysqli_num_rows($esquadras);

$desaparecidos = $con->query("select * from desaparecidos where estado='1'");
$totalDesaparecidos = mysqli_num_rows($desaparecidos);

$docs = $con->query("select * from documentos where estado='1'");
$totalDocs = mysqli_num_rows($docs);

$total = $totalDesaparecidos + $totalDocs;

$encontrados = $con->query("select * from desaparecidos where estado='0'");
$totalEncontrados = mysqli_num_rows($encontrados);

$docsEncontrados = $con->query("select * from documentos where estado='0'");
$totalDocsEncontrados = mysqli_num_rows($docsEncontrados);

$total1 = $totalEncontrados + $totalDocsEncontrados;
?>

<!doctype html>
<html lang="pt-pt">
<head>

    <title>Esquadra</title>
    <!-- Bootstrap CSS -->
    <!-- Required meta tags -->
    <meta http-equiv="Content­Type" content="text/html;charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../../css/bootstracss">
    <link rel="stylesheet" href="../adminLTE-master/dist/css/adminLTE.css">

    <link rel="stylesheet" href="../adminLTE-master/bootstrap/css/bootstrap.css">

    <link rel="stylesheet" href="../../../vendors/linericon/style.css">
    <link rel="stylesheet" href="../../../css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="../../../vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="../../../vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="../../../vendors/animate-css/animate.css">
    <link href="../adminlte-master/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/glyphicon.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="vendors/animate-css/animate.css">
    <link rel="stylesheet" href="Ionicons/css/ionicons.min.css">
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">


    <style>
        #ativo1{
            color: #005cbf;
        }
    </style>
</head>
<body class="skin-blue layout-top-nav">

<!--================Header Menu Are
a =================-->
<header class="header_area">
    <?php include"include/header.php"; ?>
</header>
<!--================Header Menu Area =================-->
<div class="content-wrapper" style="margin-top: 50px">
    <div class="container-fluid">
<section class="content-header" >
    <h1>
        Olá, seja bem vindo
        <small><?php echo $valores['func_esquadra']. ". Aproveite do melhor que há, em ser utilizador regular do \"AngoSearch\" ."; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">AngoSearch</li>
    </ol>
</section></div>
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center" >
        <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container"><br><br>
            <div class="banner_content text-center">
                <h2></h2>
                <div class="page_link">
                    <h4  class="text-danger text-heading" style="margin-top: -40px"><b style='font-weight: bolder;
                    font-family: "trebuchet MS", Verdana, sans-serif'><?php echo $_SESSION['esquadra']; ?></b></h4>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->
<!-- Small boxes (Stat box) -->
<br><center>
<div class="row" id="resumo" style="">
<div class="welcome_text">
                    <h4>Sistema ANGOSEARCH</h4>
                    <p>Bem-Vindo ao Sistema AngoSearch <span class="text-primary">
                            <?php echo $_SESSION['esquadra']; ?></span></p>

                </div>
    <div class="col-lg-5 col-xs-4">
        <!-- small box -->
        <div class="small-box bg-blue" style="background: #002a80;">
            <div class="inner" style="text-align: left">
                <h3><?php echo $totalDesaparecidos; ?></h3>

                <p>Pessoas Desaparecidos</p>
            </div>
            <div class="icon">
                <i class="ion  ion-android-people"> </i>
            </div>
            <a href="view_desaparecidos.php" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        <!-- small box -->
        <div class="small-box bg-yellow" style="background: #002a80;">
            <div class="inner" style="text-align: left">
                <h3><?php echo $totalEncontrados; ?></h3>

                <p>Pessoas Encontradas</p>
            </div>
            <div class="icon">
                <i class="ion  ion-android-people"> </i>
            </div>
            <a href="pessoas_encontradas.php" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6 col-xs-4">
        <!-- small box -->
        <div class="small-box bg-orange">
            <div class="inner" style="text-align: left">
                <h3><?php echo $totalDocs; ?></h3>

                <p>Documentos Perdidos</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-document"></i>
            </div>
            <a href="view_doc.php" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
        </div>

        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner" style="text-align: left">
                <h3><?php echo $totalDocsEncontrados; ?></h3>

                <p>Documentos Encontrados</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-document"></i>
            </div>
            <a href="docs_encontrados.php" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
   
    <!-- ./col -->
    
    <!-- ./col -->
</div></center>
<!-- /.row -->
<!--================Welcome Area =================-->

<!--================End Welcome Area =================-->

<!--================Causes Area =================-->

<!--================End Causes Area =================-->



<!--================Event Area =================-->
<!--================End Event Area =================-->


<!--================Clients Logo Area =================-->

<!--================End Clients Logo Area =================-->

</div>
<!--================ start footer Area  =================-->
<footer class="footer-area section_gap">
    <?php include "include/rodape.php";

    ?>
</footer>
<!--================ End footer Area  =================-->

<script src="../adminlte-master/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script src="../adminlte-master/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="include/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="include/jquery-ui/jquery-ui.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="include/jquery-knob/dist/jquery.knob.min.js"></script>
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