<?php
session_start();

if ( isset($_SESSION['nome_admin'])) {
    header("Location:angosearch/AdminLTE-master/index.php");
} else {
?>

<?php
    include 'include/conexao.php';
    include_once 'angosearch/adminLTE-master/classes/Traffic.php';
    new Traffic();
    $con=conecta();
$r=$con ->query("select visualizacao from pagina where id_pagina='2' and estado='1' ") or die(mysql_error());
$row = mysqli_fetch_assoc($r);
$visualizacao = $row['visualizacao'];
$visualizacao_mais = $visualizacao+1;
    $atuliza= $con ->query("update pagina set visualizacao='$visualizacao_mais' where id_pagina ='2'") or die("erro ao atualizar visualização");

$s =$con ->query("select * from pagina where id_pagina='2' and estado='1' ") or die(mysql_error());

$linh = mysqli_num_rows($s);
$dad = mysqli_fetch_assoc($s);

    $s1 =$con ->query("select * from pagina where id_pagina='1' and estado='1' ") or die(mysql_error());

    $linh1 = mysqli_num_rows($s1);
    $dad1 = mysqli_fetch_assoc($s1);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../midia/img/fav-iconAngo.jpg" type="image/jpg">
    <title>Sobre</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="angosearch/admin/css/glyphicon.css">
    <link rel="stylesheet" href="../vendors/linericon/style.css">
    <link rel="stylesheet" href="../css/themify-icons.css">
    <link rel="stylesheet" href="../css/flaticon.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="../vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="../vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="../vendors/animate-css/animate.css">
    <link rel="stylesheet" href="plugins/css/style.css">
    <link rel="stylesheet" href="angosearch/adminlte-master/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <!-- main css -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">


    <style>
        #ativo2{
            color: #005cbf;
        }
    </style>
</head>
<body>

<!--================Header Menu Area =================-->
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
                <h2>Sobre Nós</h2>
                <div class="page_link">
                    <br><br><a href="#" style="">"Descrição, Objectivo e Motivação"</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Welcome Area =================-->
<section class="welcome_area p_120">
    <div class="container">
    <div class="row welcome_inner">
    <?Php echo $dad['conteudo']; ?>
    </div>
    </div>
</section>
<!--================End Welcome Area =================-->

<!--================Feature Area =================-->
<section class="feature_area p_120">
    <?Php echo $dad['texto_adicional']; ?>
</section>
<!--================End Feature Area =================-->
<section class="causes_area p_120" >

    <div class="container"  >
        <?php echo $dad1['texto_adicional']; ?>
        </div>


<!--================Testimonials Area =================-->
    <section class="testimonials_area p_120">
        <div class="container">
            <div class="row testimonials_inner">
                <div class="col-lg-4">
                    <div class="testi_left_text">
                        <h4>Oque Dizem os Utilizadores </h4>
                        <p>Eis , abaixo uma lista de comentários feitos pelos utilizadores ,
                            apartir de suas contas do portal<br>« Angosearch » .</p>
                    </div>
                </div>

                <?php


                $c=$con->query("SELECT id_comentario,comentario,data_comentario,nome_completo,foto
            FROM comentario,utilizador WHERE  id_utilizador=utilizador and fk_desaparecido='0' and estado_comment='1'
                                            ORDER  BY  id_comentario  DESC  LIMIT 5 ");


                ?>
                <div class="col-lg-8">
                    <?php $l = mysqli_num_rows($c);
                    ?>
                    <div class="testi_slider owl-carousel   active-review-carusel">
                        <?php
                        if ($l > 0) {


                            while ($dados1 = mysqli_fetch_assoc($c)) { ?>
                                <div class="item    single-feedback-carusel">
                                <div class="testi_item">
                                    <img style="max-width: 80px;max-height: 80px;" src="angosearch/admin/midia/img/<?php echo $dados1['foto']; ?>" alt="">
                                    <p ><i style="width: 30px;
height: 30px;
font-size: 15px;
line-height: 30px;
position: absolute;
color: #666;
background: #d2d6de;
    background-color: rgb(210, 214, 222);
border-radius: 50%;
text-align: center;
left: 18px;

" class="fa fa-comments bg-yellow"></i>       <p style="margin-left: 20px;text-align: left"><?php echo utf8_encode($dados1['comentario']); ?>.</p></p>
                                    <h4><?php echo $dados1['nome_completo']; ?></h4>
                            <span style="color: #999;
text-align: center;
padding: 10px;
font-size: 12px;" class="time"><i class="fa fa-clock-o"></i> <?php echo date('D, d-m-Y H:i',strtotime($dados1['data_comentario'])); ?>
                            </span>


                                </div>
                                </div><?php }}?>
                    </div>
                </div>

    </section>
<!--================End Testimonials Area =================-->
</section>
<!--================Clients Logo Area =================-->
<section class="clients_logo_area">
    <?php include"include/clients_logo.php"; ?>
</section>
<!--================End Clients Logo Area =================-->


<!--================ start footer Area  =================-->
<footer class="footer-area area-padding-top">

    <?php include_once "include/rodape.php";

    ?>

</footer>
<!--================ End footer Area  =================-->

<div class="btn-back-to-top bg0-hov" id="myBtn" style="display: flex;">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
</div>
<div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>
<!--================ End footer Area  =================-->


<script src="plugins/js/jquery-3.2.1.min.js"></script>
<script src="plugins/js/jquery-migrate-3.0.0.js"></script>
<script src="plugins/js/popper.min.js"></script>
<script src="plugins/js/bootstrap.min.js"></script>
<script src="plugins/js/owl.carousel.min.js"></script>
<script src="plugins/js/jquery.waypoints.min.js"></script>
<script src="plugins/js/jquery.stellar.min.js"></script>
<script src="plugins/js/jquery.animateNumber.min.js"></script>

<script src="plugins/js/jquery.magnific-popup.min.js"></script>

<script src="plugins/js/main.js"></script>
<style>
    .symbol-btn-back-to-top {

        font-size: 22px;
        color: white;
        line-height: 1em;

    }
    .btn-back-to-top:hover {

        cursor: pointer;

    }
    .btn-back-to-top {
        display: none;
        position: fixed;
        width: 40px;
        height: 40px;
        bottom: 40px;
        right: 40px;
        background-color: black;
        opacity: 0.5;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        border-radius: 4px;
        transition: all 0.4s;
        -webkit-transition: all 0.4s;
        -o-transition: all 0.4s;
        -moz-transition: all 0.4s;
        font-weight: 400;
        font-size: 16px;
        line-height: 1.5;
    }
</style>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/calendario.js"></script>
<script src="../js/popper.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/stellar.js"></script>
<script src="../vendors/lightbox/simpleLightbox.min.js"></script>
<script src="../vendors/nice-select/js/jquery.nice-select.min.js"></script>
<script src="../vendors/isotope/imagesloaded.pkgd.min.js"></script>
<script src="../vendors/isotope/isotope-min.js"></script>
<script src="../vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="../js/jquery.ajaxchimp.min.js"></script>
<script src="../js/mail-script.js"></script>
<script src="../js/theme.js"></script>



<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="plugins/custom.js"></script>
</body>
</html>
<?php

}   ?>