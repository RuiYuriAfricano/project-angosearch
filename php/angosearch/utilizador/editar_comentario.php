<?php
session_start();


if ( !$_SESSION['utilizador']) {
    header("Location:../../login-usuario.php");
} else {
    ?>
    <?php


    include 'include/conexao.php';
    $con=conecta();
    $id_comment= $_GET['id_comment'];
    $id_desaparecido= $_GET['fk_ds'];

    $c=$con->query("SELECT id_comentario,comentario,fk_desaparecido,data_comentario,nome_completo,foto
            FROM comentario,utilizador WHERE  fk_desaparecido='$id_desaparecido' and id_comentario='$id_comment' and id_utilizador=utilizador and estado_comment='1'
                                            ORDER  BY  id_comentario  DESC  LIMIT 1 ");

    if(isset($_POST['editar'])) {

        $comment = $_POST['comentario'];
        $ut = $_SESSION['utilizador'];

        $con=conecta();

        try {
            $s=$con->query("select id_utilizador from utilizador where nome_completo='$ut'");
            $pega=mysqli_fetch_array($s);
            $id_ut=$pega['id_utilizador'];

            $del = $con->query("update comentario set comentario='$comment' where id_comentario='$id_comment' and utilizador='$id_ut'");
            if ($del === FALSE) {
                throw new Exception('Problemas: ' . $con->errno . ' --- ' . $con->error . '<br />');
            } else {
                echo" <script type='text/javascript'>
                    window.onload = function()
                    {
                        alert('Comentário Editado!')
                    }

        </script> ";
        header("Location:maisDesaparecido.php?id_desaparecido=".$id_desaparecido);// enviado com sucesso
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
        <!-- Required meta tags -->
        <meta http-equiv="Content­Type" content="text/html;charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">
        <title>Editar Comentário</title>
        <!-- Bootstrap CSS -->

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

    </head>
    <body class="skin-blue layout-top-nav">

    <!--================Header Menu Are
    a =================-->
    <header class="header_area">
        <?php include"include/header.php"; ?>
    </header>
    <!--================Header Menu Area =================-->
    <div class="content-wrapper" style="margin-top: 50px">
       <br><br> <center>
            <div>
<?php
$dados1 = mysqli_fetch_assoc($c);

$result=$con->query("select nome_completo from desaparecidos WHERE id_desaparecido='$id_desaparecido'");
$pega= mysqli_fetch_assoc($result);
?>


                <h2 class="section-title mb-3" style="color: #555;">Editar Comentário - Desaparecido "<?php echo $pega['nome_completo'] ?>" </h2>

                <form method="post" action="" data-aos="fade" style="color: #000;">



                            <textarea class="form-control" name="comentario" style="color: #222; width: 50%" id="" cols="3" rows="3"
                                      placeholder="Escreva o teu Comentário Aqui" required="required"><?php echo utf8_encode($dados1['comentario']); ?></textarea>


<br>
                            <button class="btn btn-primary" type="submit"  name="editar"/>
                            <span	class="glyphicon	glyphicon-comment"></span> Editar Comentário
                            </button>  <a class="btn btn-danger" href="maisDesaparecido.php?id_desaparecido=<?php echo $id_desaparecido; ?>" />
                    <span	class="glyphicon	glyphicon-remove"></span> Cancelar
                    </a>


                </form>

            </div>
        </center>

        <br><br><br><br><br><br><br><br><br><br><br>
    </div>



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