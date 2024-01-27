<?php
session_start();

if ( isset($_SESSION['nome_admin'])) {
    header("Location:angosearch/AdminLTE-master/index.php");
} else {
?>

<?php include 'include/conexao.php'; ?>

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
</head>
<body>

<!--================Header Menu Area =================-->
<header class="header_area">
    <?php include"include/cabecalho.php"; ?>
</header>
<!--================Header Menu Area =================-->

<!--================Home Banner Area =================-->
<br><br><br><br><br><br><br><br>
<!--================End Home Banner Area =================-->

<!--================Welcome Area =================-->
<?php


$con=conecta();
?>
<center>
    <?php
    if($_GET["id_doc"]!=""){

        $id=$_GET["id_doc"];

        $doc=$con->query("SELECT * FROM documentos WHERE estado != '2'  and id_doc='$id'");


        $linhas = mysqli_num_rows($sql);

        if ($linhas > 0) {


            while ($dados = mysqli_fetch_assoc($doc)) {
                if($dados['estado']==1){
                    $est="<span class='text-primary'>Perdido</span>";
                }else if($dados['estado']==0){
                    $est="<span class='text-success'>Encontrado desde, ". date('d-m-Y',strtotime($dados['dataEncontrado']))."</span>";
                }
                elseif($dados['estado']==2){
                    $est="<span class='text-danger'>Excluído</span>";
                }

                echo "<h3 align='center'>Saber Mais Sobre o Documento: ".$dados['nome_doc']."</b></h3>";
                echo "<table width='80%' style='width: 60%' class='table table-bordered table-striped'>".
                    "<thead>"."<tr>
                <th>Desaparecido</th>
                <th>Detalhes</th>
            </tr>
            </thead><tbody>
            <tr>
                <td>Imagem</td><td><a href='angosearch/admin/midia/documentos/".
                    $dados['fotografia']."'><img width = '250' height='150' style='border-radius:26px;float:right;'
                 src='angosearch/admin/midia/documentos/".
                    $dados['fotografia']."' alt='".$dados['fotografia']."'/></a></td></tr><tr>
                <td class='td'>Designação</td><td class='td'>".
                    $dados['nome_doc']."</td></tr>

                <tr>
                <td class='td'>Descrição</td><td class='td'>".
                    $dados['detalhe']."</td></tr><tr>
                <td class='td'>Código</td><td class='td'>".
                    $dados['codigo_doc']."</td></tr><tr>
                <td class='td'>Data de Registro</td><td class='td'>".
                    $dados['dataRegistro']."</td></tr><tr>
                <td class='td'>Registrado Por</td><td class='td'>".
                    $dados['postado_por']."</td></tr>

                        <tfoot><tr><td class='td'>Estado :</td><td>".$est."</td></tr></tfoot></tbody></table><br><br>
                 ";

            }



        }else{

            echo"<script language='javascript'>alert('documento não encontrado.!')</script>";
            echo '<script type="text/javascript">window.location ="index.php"</script>';

        }

    } else{

        echo"<script language='javascript'>alert('Digite o Id do Documento!')</script>";
        echo '<script type="text/javascript">window.location ="index.php"</script>';
    }




    ?>
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