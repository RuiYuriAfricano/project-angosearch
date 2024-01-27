<?php
session_start();


if ( !$_SESSION['esquadra']) {
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
        <title>Saber Mais</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../adminLTE-master/bootstrap/css/bootstrap.css">

        <link rel="stylesheet" href="../adminLTE-master/dist/css/adminLTE.css">


        <link rel="stylesheet" href="../../../vendors/linericon/style.css">
        <link rel="stylesheet" href="../../../css/font-awesome.min.css">
        <link rel="stylesheet" href="../../../vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="../../../vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" href="../../../vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="../../../vendors/animate-css/animate.css">
        <link href="../adminlte-master/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />




        <!-- main css -->
        <link rel="stylesheet" href="../../../css/style.css">
        <link rel="stylesheet" href="../../../css/responsive.css"



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
    <center>
        <?php
        if($_GET["id_desaparecido"]!=""){

            $id=$_GET["id_desaparecido"];

            $desaparecidos=$con->query("SELECT id_desaparecido,nome_completo,idade,nome_pai,nome_mae,data_desaparecimento,foto,
telefone1,telefone2,dataRegistro,dataExcluido,dataEncontrado,postado_por,descricao,caracteristicas_especiais,bairro,genero,provincia FROM
`desaparecidos`,bairro,genero,provincia WHERE estado = '0' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia and id_desaparecido='$id' ORDER  BY  id_desaparecido DESC LIMIT 1 ");


            $linhas = mysqli_num_rows($sql);

            if ($linhas > 0) {


                while ($dados = mysqli_fetch_assoc($desaparecidos)) {

                    $_SESSION['ds']=$dados['nome_completo'];
                    echo "<h3 align='center'>Saber Mais Sobre: ".$dados['nome_completo']."</b></h3>";
                    echo "<table width='80%' style='width: 70%' class='table table-bordered table-striped'>".
                        "<thead>"."<tr>
                <th>Encontrado(a)</th>
                <th>Detalhes</th>
            </tr>
            </thead><tbody>
            <tr>
                <td><img width = 'auto' height='150' style='border-radius:100%;'
                 src='../admin/midia/foto_desaparecido/".
                        $dados['foto']."' alt='".$dados['nome_completo']."'/></td></tr>

                <tr>
                <td class='td' >Nº do Processo</td><td class='td' style='text-align:center;'>".
                        $dados['id_desaparecido']."</td></tr><tr>
                <td class='td' >Nome Completo</td><td class='td' style='text-align:center;'>".
                        $dados['nome_completo']."</td></tr><tr>
                <td class='td'>Idade</td><td class='td' style='text-align:center;'>".
                        $dados['idade']."</td></tr><tr>
                <td class='td'>Naturalidade</td><td class='td' style='text-align:center;'>".
                        utf8_encode($dados['provincia'])."</td></tr><tr>
                <td class='td'>Pai</td><td class='td' style='text-align:center;'>".
                        $dados['nome_pai']."</td></tr><tr>
                <td class='td'>Mãe</td><td class='td' style='text-align:center;'>".
                        $dados['nome_mae']."</td></tr><tr>
                <td class='td'>Bairro</td><td class='td' style='text-align:center;'>".
                        $dados['bairro']."</td></tr><tr>
                <td class='td'>Telefone</td><td class='td' style='text-align:center;'>".
                        $dados['telefone1']." / ".$dados['telefone2']."</td></tr>
                <tr>
                 <td class='td'>Descrição</td><td class='td' style='text-align:center;'>".
                        $dados['descricao']."</td>
</tr><tr>
                 <td class='td'>Caracteristicas Físicas</td><td class='td' style='text-align:center;'>".
                        $dados['caracteristicas_especiais']."
</td></tr>
                <tr>
                <td class='td'>Encontrado desde</td><td class='td' style='text-align:center;'>".
                        date('d-m-Y',strtotime($dados['dataEncontrado']))."</td></tr><br><tr>
                <td class='td'>Registro no Sistema</td><td class='td' style='text-align:center;'>".
                        $dados['dataRegistro']."</td></tr><tr>
                <td class='td'>Registrado Por</td><td class='td' style='text-align:center;'>".
                        $dados['postado_por']."</td></tr></tbody></table><br><br>
                 ";

                }



            }else{

                echo"<script language='javascript'>alert('desaparecido não encontrado.!')</script>";
                echo '<script type="text/javascript">window.location ="index.php"</script>';

            }

        } else{

            echo"<script language='javascript'>alert('Digite o Id do Desaparecido!')</script>";
            echo '<script type="text/javascript">window.location ="index.php"</script>';
        }




        ?>
    </center>


    <div class="site-section bg-light   col-md-12" id="contact-section" style="color: #999;">
    <div class="container">
        <br><br>
        <div class="row justify-content">
            <div class="col-md-2">



            </div>
            <div class="col-md-8">
                <section class="content">
                    <h5><span	class="glyphicon	glyphicon-comment"></span> Comentários</h5>
                    <br>
                    <?php


                    $c=$con->query("SELECT id_comentario,comentario,fk_desaparecido,data_comentario,nome_completo,foto
            FROM comentario,utilizador WHERE  fk_desaparecido='$id' and id_utilizador=utilizador
                                            ORDER  BY  id_comentario  DESC  LIMIT 5 ");


                    $l = mysqli_num_rows($c);

                    if ($l > 0) {


                        while ($dados1 = mysqli_fetch_assoc($c)) { ?>


                            <!-- row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- The time line -->
                                    <ul class="timeline"> <li>
                                            <i class="fa fa-comments bg-yellow"></i>
                                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> <?php echo
                                    date('D, d-m-Y H:i',strtotime($dados1['data_comentario'])); ?></span>
                                                <h3 class="timeline-header"><a href="#"><?php echo $dados1['nome_completo']; ?></a>
                                                    comentou sobre , <?php echo $_SESSION['ds']; ?></h3>
                                                <div class="timeline-body">
                                                    <?php echo utf8_encode($dados1['comentario']); ?>
                                                </div>

                                            </div>
                                        </li></ul></div></div> <?php }} ?>
                </section>
                </div>

            </div>
        </div>
    </div>



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

    <footer class="footer">
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





    <script src="../adminlte-master/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="../adminlte-master/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>


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