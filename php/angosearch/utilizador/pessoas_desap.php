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
    <title>Pessoas Desaparecidas</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../adminLTE-master/dist/css/adminLTE.css">

    <link rel="stylesheet" href="../adminLTE-master/bootstrap/css/bootstrap.css">

        <link rel="stylesheet" href="../adminlte-master/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="../../../vendors/linericon/style.css">
    <link rel="stylesheet" href="../../../css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="../../../vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="../../../vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="../../../vendors/animate-css/animate.css">
    <link href="../adminLTE-master/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="../adminlte-master/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css">




    <link href="../../slider/css/style.css" rel="stylesheet" type="text/css"/>
    <!-- Other StyleSheet -->
    <link href="../../slider/css/responsive.css" rel="stylesheet" type="text/css"/>


    <!-- main css -->
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="../../../css/responsive.css"


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
                    <li><a href="#"><i class="glyphicon glyphicon-user"></i> Pessoas</a></li>
                    <li class="active">AngoSearch</li>
                </ol>
            </section></div></div>
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
            <div class="container">
                <div class="banner_content text-center">
                    <h2><span	class="glyphicon	glyphicon-user"></span> Pessoas Desaparecidas</h2>
                    <div class="page_link">
                        <br><br> <a href="#">"Lista de pessoas desaparecidas" </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php


    $con=conecta();
    ?>
    <center>
        <div class="table-responsive" style="  width: 100%;
background:#fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px; padding-left: 20px;padding-right: 20px;">

            <?php



            $desaparecidos = $con->query("select * from desaparecidos where estado='1'");
            $totalDesaparecidos = mysqli_num_rows($desaparecidos);

            $sql=$con->query("SELECT id_desaparecido,nome_completo,idade,nome_pai,nome_mae,data_desaparecimento,foto,
telefone1,telefone2,dataRegistro,postado_por,bairro,genero,provincia FROM
desaparecidos,bairro,genero,provincia WHERE estado = '1' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia ORDER  BY  id_desaparecido DESC   ");


            ?>
            <h5 align="left" style="color: #999;"><?php if($totalDesaparecidos > 1){
                    echo $totalDesaparecidos." Pessoas Desaparecidas";}
                else if($totalDesaparecidos == 0){
                    echo "Nenhuma Pessoa Desaparecida";
                }
                if($totalDesaparecidos == 1){
                    echo $totalDesaparecidos." Pessoa Desaparecida";}
                ?> </h5>
            <table  style="text-align: center;" id="example1" width="100%" class="table table-bordered table-striped" >
                <thead style=""> <tr class="">

                    <th width="96" align="center">Fotografia</th>
                    <th width="96" align="center">Nome</th>
                    <th width="96" align="center">Idade</th>
                    <th width="96" align="center">Pai</th>
                    <th width="96" align="center">Mãe</th>
                    <th width="96" align="center">Telefone</th>
                    <th width="96" align="center">Desaparecimento</th>
                    <th width="190" align="center">Post</th>
                    <th width="190" align="center">Registro</th>


                    <th width="390px" align="left"  style=" width:390px;"></th>





                </tr></thead>
                <?php while($dados=mysqli_fetch_array($sql)){ $ft=$dados['foto'];?>
                    <tr style="border-bottom: solid 1px;">

                        <td width="92" align="center">
                            <img src="../admin/midia/foto_desaparecido/<?php echo $ft; ?>" alt="<?php echo $ft; ?>"
                                 width = 'auto' height='70px' style=''></td>
                        <td width="92" align=""><?php echo $dados['nome_completo'];?></td>
                        <td width="92" align=""><?php echo $dados['idade'];?></td>
                        <td width="92" align=""id="bt4"><?php echo $dados['nome_pai'];?></td>
                        <td width="92" align=""><?php echo $dados['nome_mae'];?></td>
                        <td width="92" align=""id="bt4"><?php echo $dados['telefone1']." / ".$dados['telefone2'];?></td>

                        <td width="92" align=""id="bt4"><?php if($dados['data_desaparecimento']!=''):
                                echo date('d/m/Y ',strtotime($dados['data_desaparecimento'])); endif; ?></td>
                        <td width="90" align=""id="bt4"><?php echo $dados['postado_por'];?></td>
                        <td width="90" align=""id="bt4"><?php echo $dados['dataRegistro'];?></td>
                        <td> <a href="maisDesaparecido.php?id_desaparecido=<?php echo ($dados['id_desaparecido']);?> "
                                style="">
                                <button class="btn btn-primary" style="font-size: 12px;"><span	class="glyphicon	glyphicon-user"></span>
                                    Saber Mais </button></a></td>




                    </tr>


                <?php }//end if





                ?></table>
        </div>


    </center>
    <style>

        td{
            color: #444;
        }
        td a{
            color: #005cbf;
        }
        td a:hover{
            text-decoration: underline;
            color: #005cbf;

        }
    </style>
    <!--================End Event Area =================-->


    <!--================Clients Logo Area =================-->

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