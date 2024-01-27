
<?php
session_start();
if($_SESSION['nome_admin']) {


?>


<?php
include 'include/conexao.php';
$con = conecta();
if(isset($_POST['excluir'])) {
    $data = date('d') . "-" . date('m') . "-" . date('Y');


    $id_esquadra = $_POST['id_esquadra'];



    $del = $con->query("update esquadra set estado='0',data_excluido='$data' where id_esquadra='$id_esquadra' and estado='1'")
    or die("Erro Ao Eliminar");

    header("Location:visualizar_esquadra.php?msg=excluir");

}
?>

<!doctype html>
<html lang="pt-pt">
<head>
    <!-- Required meta tags -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Visualizar Login</title>
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
                <h2><span	class="glyphicon	glyphicon-th-list"></span> Esquadra: Visualizar Login</h2>
                <div class="page_link">
                    <a href="adicionar_loginEsquadra.php">Adicionar Login</a>

                </div>
            </div>
        </div>
    </div>
</section>
<br>


    <div style="">
        <?Php
        if(isset($_REQUEST["msg"])) {
            if ($_REQUEST["msg"] == "add") {

                ?>
                <span class='notification n-success'>Alterado com Sucesso.......!!</span>
            <?php
            }

            if ($_REQUEST["msg"] == "erro") {

                ?>
                <span class="notification n-error">Erro: Preencha os Campos.</span>
            <?php
            }
        }?></div>
<!--================End Home Banner Area =================-->

<!--================Welcome Area =================-->
<style>
    .vd th, .vd td{
        color: #005fcb;
    }
</style>
<!--================End Welcome Area =================-->
<center>
<div class="col-lg-9    table-responsive" style="  width: 100%;
background:#fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px;">

    <?php

    $con=conecta();

    $sql=$con->query("select id_login,usuario,senha,esquadra from login,esquadra where fk_esquadra=id_esquadra");

    ?>

    <table style="text-align: center;"  width="100%" class="table table-bordered table-hover">
        <thead style="color: #fff;"> <tr class="bg-primary">
            <th  align="center"id="bt4"width="40" height="">#</th>
            <th width="96" align="center">Usuário ou Email</th>
            <th width="96" align="center">Senha </th>
            <th width="96" align="center">Pertence a Esquadra </th>

            <th width="96" align="center"></th>
            <th width="96" align="center"><a href="#">
                    <button class="btn btn-outline-info" style="font-size: 12px; color: #fff;">Ver Histórico </button></a></th>



        </tr></thead>
        <?php while($dados=mysqli_fetch_array($sql)){ ?>
            <tr class="vd">
                <td width="60" align=""id="bt4"><?php echo $dados['id_login'];?></td>
                <td width="242" align=""><?php echo $dados['usuario'];?></td>
                <td width="242" align=""><?php echo $dados['senha'];?></td>
                <td width="242" align=""id="bt4"><?php echo $dados['esquadra'];?></td>



                <td align="center"> <a href="editar_login_esquadra.php?id_login=<?php echo ($dados['id_login']);?> "
                        style="">
                        <button class="btn btn-primary" style="font-size: 12px;"><span	class="glyphicon   glyphicon-edit"></span>
                            Editar </button></a></td>
                    <td align="center"><a href="editar_LoginEsquadra.php?id_login=<?php echo ($dados['id_login']);?> ">

                            <button class="btn btn-danger" style="font-size: 12px;" type="submit" name="excluir"><span	class="glyphicon	glyphicon-remove"></span>
                                Excluir </button></a></td>


                
            </tr>


        <?php }//end if ?></table>
</div></center>

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