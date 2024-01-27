
<?php
session_start();
if($_SESSION['nome_admin']) {


?>

<?php
include 'include/conexao.php';
?>

<!doctype html>
<html lang="pt-pt">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Página</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/glyphicon.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="vendors/animate-css/animate.css">
    <link rel="stylesheet" href="Ionicons/css/ionicons.min.css">

    <script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="js/ckfinder/ckfinder.js"></script>
    <!--<link rel="stylesheet" href="bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <!--<link rel="stylesheet" href="bootstrap-daterangepicker/daterangepicker.css">
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body>

<!--================Header Menu Are
a =================-->
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
                <h2> <span class="glyphicon glyphicon-info-sign"></span> Conteúdo Página</h2>
                <div class="page_link">
                    <a href="principal_admin.php"><span class="glyphicon glyphicon-home"></span> Inicio</a>

                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Welcome Area =================-->

<!--================End Welcome Area =================-->
<br><br>
<div style="">
    <?Php

    if($_REQUEST["msg"]=="add")
    {

        ?>
        <span class='notification n-success'>Editado com Sucesso.......!!</span>
    <?php }

    if($_REQUEST["msg"]=="erro")
    {

        ?>
        <span class="notification n-error">Erro: Preencha os Campos.</span>
    <?php }?></div>
<style>
    .vd th , .vd td{
        color: #005fcb;
    }
</style>
<div class="col-lg-9" style="border: solid 1px; margin-left:130px ; width: 100%;
background:#fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px;">

    <?php

    $con=conecta();

    $sql=$con->query("select * from pagina where  estado='1'");

    ?>

    <table class="vd"  border="1px" cellspacing="20px" cellpadding="2px">
        <tr>
            <th style="width:4%">#</th>
            <th style="width:20%">Página</th>
            <th style="width:10%">Titulo</th>
            <th style="width:30%">Meta Tags</th>
            <th style="width:30%">Meta Description</th>
            <th style="width:30%">Visualização</th>
            <th style="width:6%">&nbsp; </th>
        </tr>
        <?php while($dados=mysqli_fetch_array($sql)){ ?>
            <tr>
                <td class="align-center"><?php echo $dados['id_pagina'];?></td>
                <td><?php echo $dados['titulo'];?></td>
                <td><?php echo $dados['titulo'];?></td>
                <td> <?php echo $dados['tag_meta'];?></td>
                <td> <?php echo $dados['descricao_meta'];?></td>
                <td> <?php echo $dados['visualizacao'];?></td>
                <td> <a href="EditarPagina.php?id_pagina=<?php echo ($dados['id_pagina']);?> "
                        style="">
                        <button class="btn btn-primary" style="font-size: 12px;"><span	class="glyphicon   glyphicon-edit"></span>
                            Editar </button></a></td>


            </tr>


        <?php }//end if ?></table>
</div>
<!--================Causes Area =================-->

<!--================End Causes Area =================-->


<!--================Event Area =================-->
<!--================End Event Area =================-->


<!--================Clients Logo Area =================-->

<!--================End Clients Logo Area =================-->


<!--================ start footer Area  =================-->
<footer class="footer-area section_gap">
    <?php include"include/rodape.php"; ?>
</footer>
<!--================ End footer Area  =================-->




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

<?php
}
else{
    header("Location:../../login-usuario.php");
}
?>