<?php
session_start();

if ( isset($_SESSION['nome_admin'])) {
    header("Location:angosearch/AdminLTE-master/index.php");
} else {
?>

<?php  include 'include/conexao.php';
    include_once 'angosearch/adminLTE-master/classes/Traffic.php';
    new Traffic();
    $con=conecta();
    $r=$con ->query("select visualizacao,conteudo from pagina where id_pagina='3' and estado='1' ") or die(mysql_error());
    $row = mysqli_fetch_assoc($r);
    $visualizacao = $row['visualizacao'];
    $visualizacao_mais = $visualizacao+1;
    $atuliza= $con ->query("update pagina set visualizacao='$visualizacao_mais' where id_pagina ='3'") or die("erro ao atualizar visualização");


    ?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../midia/img/fav-iconAngo.jpg" type="image/jpg">
    <title>Galeria</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../vendors/linericon/style.css">
    <link rel="stylesheet" href="../css/themify-icons.css">
    <link rel="stylesheet" href="../css/flaticon.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="../vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="../vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="../vendors/animate-css/animate.css">
    <link rel="stylesheet" href="plugins/css/style.css">
    <!-- main css -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <style>
        #ativo5{
            color: #005cbf;
        }

        /*--------------------*/
        /* HOME COURSE SECTION */
        /*--------------------*/

        #ourCourses{
            background-color: #f6f6f6;
            float: left;
            display: inline;
            width: 100%;
            padding: 60px 0px;
        }
        .ourCourse_content{
            float: left;
            display: inline;
            width: 100%;
        }
        .course_nav{}
        .course_nav li {
            display: block;
            float: left;
            margin-right: 30px;
            width: 31%;
        }
        .course_nav li:last-child{
            margin-right: 0px;
        }
        .single_course {
            background-color: #ffffff;
            border: 1px solid #efefef;
            display: inline;
            float: left;
            min-height: 150px;
            width: 100%;
        }
        .singCourse_imgarea {
            float: left;
            overflow: hidden;
            position: relative;
            text-align: center;
            width: 100%;
        }
        .singCourse_imgarea img {
            display: block;
            position: relative;
            width: 100%;
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            -ms-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }
        .singCourse_imgarea .mask {
            background-color: rgba(49, 59, 61, 0.6);
            -webkit-transform: translateX(-100%);
            -moz-transform: translateX(-100%);
            -o-transform: translateX(-100%);
            -ms-transform: translateX(-100%);
            transform: translateX(-100%);
            -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=100)";
            filter: alpha(opacity=100);
            opacity: 1;
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            -ms-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }
        .singCourse_imgarea .mask, .singCourse_imgarea .content {
            left: 0;
            overflow: hidden;
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
        }
        /*.singCourse_imgarea:hover .mask {
            -webkit-transform: translateX(0px);
            -moz-transform: translateX(0px);
            -o-transform: translateX(0px);
            -ms-transform: translateX(0px);
            transform: translateX(0px);
        }*/
        .singCourse_imgarea:hover img {
            /*-webkit-transform: translateX(100%);
            -moz-transform: translateY(100%);
            -o-transform: translateY(100%);
            -ms-transform: translateY(100%);
            transform: translateY(100%);*/
            transform: scale(1.6) rotate(-9deg);
            transition: all 700ms linear 0s;
            max-height: auto; !important;

        }
        .course_more {
            border: 2px solid #fff;
            color: #fff;
            display: inline-block;
            font-size: 18px;
            margin-top: 27%;
            padding: 10px;
            text-transform: uppercase;
            -webkit-transition: all 0.5s;
            -o-transition: all 0.5s;
            transition: all 0.5s;
        }
        .course_more:hover,.course_more:focus {
            background-color: #fff;
            text-decoration: none;
            outline: none;
            border-radius: 4px;
        }
        .singCourse_content{
            float: left;
            display: inline;
            width: 100%;
            padding: 10px;
        }
        .singCourse_title {
            border-bottom: 1px solid #efefef;
            font-size: 20px;
            margin-top: 10px;
            padding-bottom: 10px;

        }
        .singCourse_title a{
            -webkit-transition: all 0.5s;
            -o-transition: all 0.5s;
            transition: all 0.5s;
        }
        .singCourse_title a:hover{
            text-decoration: none;
            outline: none;
        }
        .singCourse_price{
            border-bottom: 1px solid #efefef;
            padding-bottom: 10px;
        }
        .singCourse_price > span {
            font-weight: bold;
            font-size: 18px;
        }
        .singCourse_author {
            border-top: 1px solid #efefef;
            display: inline;
            float: left;
            padding: 20px 10px 0;
            width: 100%;
        }
        .singCourse_author > img {
            float: left;
            border-radius: 50%;
            height: 40px;
            margin-bottom: 25px;
            margin-right: 15px;
            width: 40px;
        }
        .singCourse_author>p{
            float: left;
            color: #c0c1c1;
            font-size: 15px;
            margin-top: 10px;
            -webkit-transition: all 0.5s;
            -o-transition: all 0.5s;
            transition: all 0.5s;
        }
        .singCourse_author>p:hover{
            color: #000;
        }
        .course_nav .slick-prev {
            left: -37px;
            background-image: url("img/course-nav-prev.png");
            background-color: transparent;
            background-position: center center;
            background-repeat: no-repeat;
            height: 121px;
            width: 36px;
        }
        .course_nav .slick-next {
            background-image: url("img/course-nav-next.png");
            background-color: transparent;
            background-position: center center;
            background-repeat: no-repeat;
            height: 121px;
            width: 36px;
            right: -6px;
        }
        .course_nav .slick-prev, .course_nav .slick-next {
            top: 40%;
        }

        /*--------------------*/
        /* HOME OUR TUTORS SECTION */
        /*--------------------*/
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
                <h2>Nossa Galeria</h2>
                <div class="page_link">
                    <br><br><a href="#">"Fotográfias de algumas Pessoas Desaparecidas <br> e algumas Ilustrações "</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Welcome Area =================-->
<!--================Gallery Area =================-->


<!--=========== BEGIN COURSE BANNER SECTION ================-->
<br><br>
<section id="courseArchive">

<?php $pegafoto = $con->query("SELECT id_desaparecido,nome_completo,idade,nome_pai,nome_mae,data_desaparecimento,foto,postado_por,
dataRegistro,descricao,caracteristicas_especiais,bairro,genero,provincia FROM
desaparecidos,bairro,genero,provincia WHERE estado = '1' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia and id_desaparecido!='7' and id_desaparecido!='4' and foto!='usuario.png' ORDER  BY  id_desaparecido DESC LIMIT 8 "); ?>
<div class="container">
<div class="row"><!-- start course content -->

    <?php while($fotos=mysqli_fetch_array($pegafoto)): ?>
    <!-- start single course -->
<div class="col-lg-6 col-md-6 col-sm-6">
    <div class="single_course wow fadeInUp">
        <div class="singCourse_imgarea">
            <center><img alt="" height="414"
                         src="angosearch/admin/midia/foto_desaparecido/<?php echo $fotos['foto']; ?>" style="max-width: 280px;max-height: 260px" /></center>

            <div class="mask"><a class="course_more" href="angosearch/admin/midia/foto_desaparecido/<?php echo $fotos['foto']; ?>">Visualizar</a></div>
        </div>

        <div class="singCourse_content">
            <center>
                <h3 class="singCourse_title"><a href="maisDesaparecidos.php?id_desaparecido=<?php echo $fotos['id_desaparecido']; ?>">
                        <?php echo $fotos['nome_completo']; ?></a></h3>
            </center>
        </div>

        <div class="singCourse_author"><img alt="img" height="160" src="http://localhost/Projecto Final - Loide Laura/webimg/images/igor.jpg" width="160" />
            <p>Igor Ginga, Administrador</p>
        </div>
    </div>
</div>
<!-- End single course --><!-- start single course -->
<?php endwhile; ?>

<!-- End single course --><!-- End single course --></div>
<!-- start previous & next button --></div>

</section>
    <!-- End course content -->
<!-- End single course -->

<!--================End Gallery Area =================-->
<!--================End Welcome Area =================-->

<!--================Feature Area =================-->

<!--================End Feature Area =================-->

<!--================Testimonials Area =================-->
<!--================End Testimonials Area =================-->

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
</body>
</html>
<?php

}   ?>