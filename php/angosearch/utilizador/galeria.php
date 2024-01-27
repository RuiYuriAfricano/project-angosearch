<?php
session_start();


if ( !$_SESSION['utilizador']) {
    header("Location:../../login-usuario.php");
} else {
    ?>
    <?php

    include 'include/conexao.php';

    ?>

    <!doctype html>
    <html lang="pt-pt">
    <head>
        <!-- Required meta tags -->
        <meta http-equiv="Content­Type" content="text/html;charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">
        <title>Galeria</title>
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




        <link href="../../slider/css/style.css" rel="stylesheet" type="text/css"/>
        <!-- Other StyleSheet -->
        <link href="../../slider/css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="../../slider/css/slicknav.css" rel="stylesheet" type="text/css"/>
        <link href="../../slider/css/global.css" rel="stylesheet" type="text/css"/>
        <link href="../../slider/css/prettyPhoto.css" rel="stylesheet" type="text/css"/>
        <!-- Layer Slider -->
        <link rel="stylesheet" href="../../slider/layerslider/css/layerslider.css" type="text/css"/>

        <!-- main css -->
        <link rel="stylesheet" href="../../../css/style.css">
        <link rel="stylesheet" href="../../../css/responsive.css"

        <link rel="stylesheet" href="../../../js/jq/bootstrap.css">

        <script type="text/javascript" src="../../../js/jq/jq.js"></script>
        <script type="text/javascript" src="../../../js/jq/bootstrap.js"></script>
        <style>
            #ativo1{
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
    <body class="skin-blue layout-top-nav">

    <!--================Header Menu Are
    a =================-->
    <header class="header_area">
        <?php include"include/header.php"; ?>
    </header>
    <!--================Header Menu Area =================-->
    <div class="content-wrapper" style="margin-top: 50px">
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <section class="content-header" >
                <h1>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a> <small><?php echo$_SESSION['utilizador'];?></small></h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-image"></i> Galeria</a></li>
                    <li class="active">AngoSearch</li>
                </ol>
            </section></div></div>
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
                                             src="..//admin/midia/foto_desaparecido/<?php echo $fotos['foto']; ?>" style="max-width: 280px;max-height: 260px" /></center>

                                <div class="mask"><a class="course_more" href="../admin/midia/foto_desaparecido/<?php echo $fotos['foto']; ?>">Visualizar</a></div>
                            </div>

                            <div class="singCourse_content">
                                <center>
                                    <h3 class="singCourse_title">
                                        <a href="maisDesaparecido.php?id_desaparecido=<?php echo $fotos['id_desaparecido']; ?>">
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
    <!--================End Testimonials Area =================-->
    <!--================Event Area =================-->


    <style type="text/css">
        .img-thumbnail, .thumbnail {
            -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.075);
            box-shadow: 0 1px 2px rgba(0,0,0,.075);
        }
        .thumbnail {
            display: block;
            padding: 4px;
            padding-right: 4px;
            padding-left: 4px;
            margin-bottom: 20px;
            line-height: 1.42857143;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            -webkit-transition: border .2s ease-in-out;
            -o-transition: border .2s ease-in-out;
            transition: border .2s ease-in-out;
        }

        .carousel-control {
            position: absolute;
            top: 35%;
            left: 15px;
            width: 40px;
            height: 40px;
            margin-top: -20px;
            font-size: 60px;
            font-weight: 100;
            line-height: 28px;
            color: #ffffff;
            text-align: center;
            background: #222222;
            border: 3px solid #ffffff;
            -webkit-border-radius: 23px;
            -moz-border-radius: 23px;
            border-radius: 23px;
            opacity: 0.5;
            filter: alpha(opacity=50);
        }
        .carousel-control.right {
            right: 15px;
            left: auto;
        }
    </style>
    <!--================End Event Area =================-->


    <!--================Clients Logo Area =================-->
    <section class="clients_logo_area">
        <?php include"include/clients_logo.php"; ?>
    </section>
    <!--================End Clients Logo Area =================-->


    <!--================ start footer Area  =================-->
    <!-- Footer -->

    <footer class="footerR">
        <?php include "include/rodape.php";

        ?>
    </footer>

    <!--================ End footer Area  =================-->


    <div class="btn-back-to-top bg0-hov" id="myBtn" style="display: flex;">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
    </div>

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

    <script src="../../../js/jquery-3.2.1.min.js"></script>
    <script src="../../../js/calendario.js"></script>
    <script src="../../../js/popper.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
    <script src="../../../js/stellar.js"></script>
    <script src="../../../vendors/lightbox/simpleLightbox.min.js"></script>
    <script src="../../../vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="../../../vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="../../../vendors/isotope/isotope-min.js"></script>
    <script src="../../../vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="../../../js/jquery.ajaxchimp.min.js"></script>
    <script src="../../../js/mail-script.js"></script>
    <script src="../../../js/theme.js"></script>

    <!-- counter -->
    <script src="../../plugins/jquery-3.2.1.min.js"></script>
    <script src="../../plugins/greensock/TweenMax.min.js"></script>
    <script src="../../plugins/greensock/TimelineMax.min.js"></script>
    <script src="../../plugins/scrollmagic/ScrollMagic.min.js"></script>
    <script src="../../plugins/greensock/animation.gsap.min.js"></script>
    <script src="../../plugins/greensock/ScrollToPlugin.min.js"></script>
    <script src="../../plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="../../plugins/easing/easing.js"></script>
    <script src="../../plugins/parallax-js-master/parallax.min.js"></script>
    <script src="../../plugins/custom.js"></script>


    <!-- Bootstrap core JavaScript
        ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../../slider/js/jquery.js"></script>
    <script src="../../slider/js/bootstrap.min.js"></script>
    <script src="../../slider/js/holder.js"></script>
    <!-- Nav Manu -->
    <script src="../../slider/js/jquery.slicknav.min.js"></script>
    <script src="../../slider/js/custom_home.js"></script>
    <!-- Slide -->
    <script src="../../slider/js/slides.min.jquery.js"></script>
    <script src="../../slider/js/custom_slide.js"></script>
    <!-- PrettyPhoto -->
    <script src="../../slider/js/jquery.prettyPhoto.js"></script>
    <script src="../../slider/js/custom_prettyPhoto.js"></script>
    <!-- Layer Slider -->
    <script src="../../slider/layerslider/jQuery/jquery-easing-1.3.js" type="text/javascript"></script>
    <script src="../../slider/layerslider/jQuery/jquery-transit-modified.js" type="text/javascript"></script>
    <script src="../../slider/layerslider/js/layerslider.transitions.js" type="text/javascript"></script>
    <script src="../../slider/layerslider/js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>
    <script src="../../slider/js/layer_custom.js"></script>

    </body>
    </html>
<?php

}   ?>