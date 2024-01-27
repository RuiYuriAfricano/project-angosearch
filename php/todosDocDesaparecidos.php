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
    $r=$con ->query("select visualizacao from pagina where id_pagina='6' and estado='1' ") or die(mysql_error());
    $row = mysqli_fetch_assoc($r);
    $visualizacao = $row['visualizacao'];
    $visualizacao_mais = $visualizacao+1;
    $atuliza= $con ->query("update pagina set visualizacao='$visualizacao_mais' where id_pagina ='6'") or die("erro ao atualizar visualização");
    ?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../midia/img/fav-iconAngo.jpg" type="image/jpg">
    <title>Desaparecidos</title>
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
        #ativo3{
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
                <h2><span	class="glyphicon	glyphicon-file"></span> Documentos Perdidos</h2>
                <div class="page_link">
                    <br><br><a href="#">"Lista de todos documentos Perdidos"</a>
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
    <div class="table-responsive" style="width: 100%;
background:#fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px; padding-left: 20px;padding-right: 20px;">

        <?php




        $desaparecidos = $con->query("select * from documentos where estado='1'");
        $totalDocs = mysqli_num_rows($desaparecidos);


        $doc=$con->query("SELECT * FROM documentos WHERE estado = '1'  ORDER  BY  id_doc DESC  ");


        ?>
        <h5 align="left" style="color: #999;"><?php if($totalDocs > 1){
                echo $totalDocs." Documentos Perdidos";}
            else if($totalDocs == 0){
                echo "Nenhum Documento Perdido";
            }
            if($totalDocs == 1){
                echo $totalDocs." Documento Perdido";}
            ?></h5>
        <table   class="table table-bordered table-striped"      id="example1" >
            <thead > <tr>
                <th width="96" align="left" style="text-align:left ">Documento</th>
                <th width="96" align="left" style="text-align:left ">Nome do Documento</th>


                <th width="292" align="right" style="text-align:left ">Detalhes</th>
                <th width="292" align="right" style="text-align:left ">Código</th>
                <th width="92" align="left" style="text-align:left ">Post</th>
                <th width="92" align="left" style="text-align:left ">Registro</th>
                <th></th>






            </tr></thead>
            <?php while($dado=mysqli_fetch_array($doc)){?>
                <tr style="border-bottom: solid 1px;">


                    <td width="92" align="center" style="text-align:left ">
                        <img src="angosearch/admin/midia/documentos/<?php echo $dado['fotografia']; ?>"
                             alt="<?php echo $dado['fotografia']; ?>"
                             width = '200px' height='100px' style='border-radius:3px;'></td>
                    <td width="92" align="center" style="color: #555;text-align: left">
                        <?php echo $dado['nome_doc']; ?></td>




                    <td width="92" align="center" style="color: #333;text-align: left"><?php echo $dado['detalhe'];?></td>
                    <td width="92" align="center" style="color: #333;text-align: left"><?php echo $dado['codigo_doc'];?></td>
                    <td width="92" align="center" style="color: #555;text-align: left"><?php echo $dado['postado_por']; ?></td>
                    <td width="92" align="center" style="color: #555;text-align: left"><?php echo $dado['dataRegistro']; ?></td>
                    <td> <a href="saberDoc.php?id_doc=<?php echo ($dado['id_doc']);?> "
                            style="">
                            <button class="btn btn-primary" style="font-size: 12px;"><span	class="glyphicon  glyphicon-file"></span>
                                Saber Mais </button></a></td>




                </tr>


            <?php }//end if ?></table>
    </div>


</center>

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
<!--================ End footer Area  =================-->
<div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>
<!--================ End footer Area  =================-->

<script src="plugins/js/jquery-3.2.1.min.js"></script>
<script src="../js/calendario.js"></script>
<script src="plugins/js/jquery-migrate-3.0.0.js"></script>
<script src="plugins/js/popper.min.js"></script>
<script src="plugins/js/bootstrap.min.js"></script>
<script src="plugins/js/owl.carousel.min.js"></script>
<script src="plugins/js/jquery.waypoints.min.js"></script>
<script src="plugins/js/jquery.stellar.min.js"></script>
<script src="plugins/js/jquery.animateNumber.min.js"></script>

<script src="plugins/js/jquery.magnific-popup.min.js"></script>

<script src="plugins/js/main.js"></script>





<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery-3.2.1.min.js"></script>
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
<script language="JavaScript" src="../js/n_max_desaparecido.js">

</script>


<script src="angosearch/adminlte-master/plugins/jquery/dist/jquery.min.js"></script>
<script src="angosearch/adminlte-master/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="angosearch/adminlte-master/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
    $(function () {
        $('#example1').DataTable({ 'language': "pt-BR"})
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            'language': "pt-BR"
        })
    })
</script>
</body>
</html>
<?php

}   ?>