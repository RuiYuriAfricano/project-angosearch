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
        <title>Documentos Encontrados</title>
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




        <link rel="stylesheet" href="../adminlte-master/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css">

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
                    <li><a href="#"><i class="glyphicon glyphicon-file"></i> Documentos</a></li>
                    <li class="active">AngoSearch</li>
                </ol>
            </section></div></div>
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
            <div class="container">
                <div class="banner_content text-center">
                    <h2><span	class="glyphicon	glyphicon-file"></span> Documentos Encontrados</h2>
                    <div class="page_link">
                        <br><br>  <a href="#">"Lista de todos documentos encontrados"</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Welcome Area =================-->
    <?php


    $con=conecta();
    ?>
    <center>
        <div class="table-responsive" style="  width:100%;
background:#fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px; padding-left: 20px;padding-right: 20px;">

            <?php




            $desaparecidos = $con->query("select * from documentos where estado='0'");
            $totalDocs = mysqli_num_rows($desaparecidos);


            $doc=$con->query("SELECT * FROM documentos WHERE estado = '0'  ORDER  BY  id_doc DESC ");


            ?>
            <h5 align="left" style="color: #999;"><?php if($totalDocs > 1){
                    echo $totalDocs." Documentos Encontrados";}
                else if($totalDocs == 0){
                    echo "Nenhum Documento Encontrado";
                }
                if($totalDocs == 1){
                    echo $totalDocs." Documento Encontrado";}
                ?></h5>
            <table   class="table table-bordered table-striped"      id="example1" >
                <thead > <tr>
                    <th width="96" align="left" style="text-align:left ">Documento</th>
                    <th width="96" align="left" style="text-align:left ">Nome do Documento</th>


                    <th width="292" align="right" style="text-align:left ">Detalhes</th>
                    <th width="292" align="right" style="text-align:left ">Código</th>
                    <th width="92" align="left" style="text-align:left ">Post</th>
                    <th width="92" align="left" style="text-align:left ">Encontrado Em:</th>
                    <th></th>







                </tr></thead>
                <?php while($dado=mysqli_fetch_array($doc)){?>
                    <tr style="border-bottom: solid 1px;">


                        <td width="92" align="center" style="text-align:left ">
                            <img src="../admin/midia/documentos/<?php echo $dado['fotografia']; ?>"
                                 alt="<?php echo $dado['fotografia']; ?>"
                                 width = '200px' height='100px' style='border-radius:3px;'></td>
                        <td width="92" align="center" style="color: #555;text-align: left">
                            <?php echo $dado['nome_doc']; ?></td>



                        <td width="92" align="center" style="color: #333;text-align: left"><?php echo $dado['detalhe'];?></td>
                        <td width="92" align="center" style="color: #333;text-align: left"><?php echo $dado['codigo_doc'];?></td>
                        <td width="92" align="center" style="color: #555;text-align: left">
                            <?php echo $dado['postado_por']; ?></td>
                        <td width="92" align="center" style="color: #555;text-align: left">
                            <?php echo $dado['dataExcluido']; ?></td>
                        <td> <a href="maisDocumento.php?id_doc=<?php echo ($dado['id_doc']);?> "
                                style="">
                                <button class="btn btn-primary" style="font-size: 12px;"><span	class="glyphicon  glyphicon-file"></span>
                                    Saber Mais </button></a></td>





                    </tr>


                <?php }//end if ?></table>
        </div>

    </center>
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
    <script src="../adminlte-master/plugins/jquery/dist/jquery.min.js"></script>
    <script src="../adminlte-master/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../adminlte-master/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>

    </body>
    </html>
<?php

}   ?>