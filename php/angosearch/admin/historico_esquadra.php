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



    $del = $con->query("update esquadra set estado='1' where id_esquadra='$id_esquadra' and estado='0'")
    or die("Erro Ao Eliminar");
    $del_login = $con->query("update login set estado='1' where fk_esquadra='$id_esquadra' and estado='0'")
    or die("Erro Ao Eliminar esquadra");

    header("Location:historico_esquadra.php?msg=excluir");

}

?>

<!doctype html>
<html lang="pt-pt">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Histórico Esquadra</title>
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
                <h2><span	class="glyphicon    glyphicon-remove" ></span>  Esquadras Excluidas</h2>
                <div class="page_link">
                    <a href="principal_admin.php"><span	class="glyphicon	glyphicon-home" > </span> Inicio</a>
                </div>
            </div>
        </div>
    </div>
</section>

<br>

<div style="">
    <?Php
    if(isset($_REQUEST["msg"])) {
        if ($_REQUEST["msg"] == "excluir") {

            ?>
            <span class='notification n-success'>Restaurado Com Sucesso .......!!</span>
        <?php }


        if($_REQUEST["msg"]=="cancelado"){
            ?>
            <span class='notification n-success'>Cancelado.......!!</span>
        <?php }}?>
</div>
<!--================End Home Banner Area =================-->

<!--================Welcome Area =================-->
<style>
    .vd th , .vd td{
        color: #005fcb;
    }
</style>
<!--================End Welcome Area =================-->
<center>
<div class="col-lg-9    table-responsive" style=" width: 100%;
background:#fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px;">

    <?php

    $con=conecta();

    $sql=$con->query("select id_esquadra, esquadra, numero, data_excluido,func_esquadra,func_foto,removido_por, tipoEsquadra, bairro
 from esquadra,tipoesquadra,bairro where estado='0'and
 fk_tipoEsquadra=id_tipoEsquadra
 and fk_bairro=id_bairro ORDER  by data_excluido asc");

    ?><i class="fa fa-ey"></i>gggggg

    <table style="text-align: center;"  width="100%" class="table table-bordered table-hover">
        <thead style="color: #fff;"> <tr class="bg-primary">
            <th width="96" align="center">Foto do Funcionário</th>
            <th width="96" align="center">Funcionário</th>
            <th width="96" align="center">Esquadra</th>
            <th width="96" align="center">Número</th>
            <th width="96" align="center">Tipo</th>
            <th width="96" align="center">Barro</th>
            <th width="196" align="center">Excluido Por</th>
            <th width="96" align="center">Excluido Em</th>
            <th width="96" align="center"></th>
            <th width="96" align="center"><a href="visualizar_esquadra.php">
                    <button class="btn btn-outline-info" style="font-size: 12px; color: #fff;"> Voltar </button></a></th>



        </tr></thead>
        <?php while($dados=mysqli_fetch_array($sql)){ $ft = $dados['func_foto']?>
            <tr class="vd">
                <td width="92" align="">
                    <img src="../admin/midia/img/<?php echo $ft; ?>" alt="<?php echo $ft; ?>"
                         width = '90px' height='90px' style='border-radius:40%;'></td>
                <td width="202" align=""><?php echo $dados['func_esquadra'];?></td>

                <td width="202" align=""><?php echo $dados['esquadra'];?></td>
                <td width="202" align=""><?php echo $dados['numero'];?></td>
                <td width="60" align=""id="bt4"><?php echo $dados['tipoEsquadra'];?></td>
                <td width="202" align=""><?php echo $dados['bairro'];?></td>
                <td width="202" align=""><?php echo $dados['removido_por'];?></td>
                <td width="202" align=""><?php echo $dados['data_excluido'];?></td>
<form action="" method="post">
    <input type="hidden" name="id_esquadra" value="<?php echo $dados['id_esquadra'];?>">
                <td> <a href="historico_esquadra.php?id_esquadra=<?php echo ($dados['id_esquadra']);?> "
                        style="">
                        <button class="btn btn-primary" style="font-size: 12px;" type="submit" name="excluir"><span	class="glyphicon	glyphicon-log-in" ></span>
                            Restaurar </button></a></td>
</form>

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