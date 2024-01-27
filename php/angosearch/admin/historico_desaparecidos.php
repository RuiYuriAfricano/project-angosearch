<?php
session_start();
if($_SESSION['nome_admin']) {


    ?>

<?php
include 'include/conexao.php'; ?>
<?php
if(isset($_POST['excluir'])) {


    $con = conecta();

    $data = $_POST['dt'];


    $id_desaparecido = $_POST['id_desaparecido'];


    $del = $con->query("update desaparecidos set estado='1' where id_desaparecido='$id_desaparecido'
 and estado='0'")
    or die("Erro Ao Eliminar");

    header("Location:historico_desaparecidos.php?msg=excluir");




}
?>


<!doctype html>
<html lang="pt-pt">
<head>
    <!-- Required meta tags -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Historico Desaparecidos</title>
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
    <script src="../../../js/calendario.js"></script>
</head>
<body onload="setInterval('apresentaData()',1000);">
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
                <h2><span	class="glyphicon	glyphicon-ok" style="color: greenyellow;"></span> Desaparecidos Encontrados</h2>
                <div class="page_link">
                    <a href="principal_admin.php"><span	class="glyphicon	glyphicon-home" > </span> Inicio</a>

                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Welcome Area =================-->

<!--================End Welcome Area =================-->
<br>
<div style="">
    <?Php
    if(isset($_REQUEST["msg"])) {
        if ($_REQUEST["msg"] == "excluir") {

            ?>
            <span class='notification n-success'>Removido dos Encontrados.......!!</span>
        <?php }


        if($_REQUEST["msg"]=="cancelado"){
            ?>
            <span class='notification n-success'>Cancelado.......!!</span>
        <?php }}?>
</div>
<style>
    .vd th , .vd td{
        color: #005fcb;
    }
</style>
<center>
<div class="table-responsive" style="width: 100%;
background:#fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px; padding-left: 20px;padding-right: 20px;">

    <?php

    $con=conecta();

    $desaparecidos = $con->query("select * from desaparecidos where estado='0'");
    $totalDesaparecidos = mysqli_num_rows($desaparecidos);

    $sql=$con->query("SELECT id_desaparecido,nome_completo,nascimento,nome_pai,nome_mae,data_desaparecimento,foto,
telefone1,telefone2,dataRegistro,dataExcluido,removido_por,bairro,genero,provincia FROM
`desaparecidos`,bairro,genero,provincia WHERE estado = '0' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia order by dataExcluido desc ");

    ?>
    <h5 align="left" style="color: #999;"><?php echo $totalDesaparecidos; ?> Pessoas Encontradas</h5>
    <table style="text-align: center;"  width="100%" class="table table-bordered table-hover" >
        <thead style="color: #fff;"> <tr class="bg-primary">
            <th width="96" align="center">Fotografia</th>
            <th  align="center"id="bt4"width="40" height="">Processo Nº</th>
            <th width="96" align="center">Nome</th>
            <th width="96" align="center">Nascimento</th>
            <th width="96" align="center">Pai</th>
            <th width="96" align="center">Mãe</th>
            <th width="96" align="center">Telefone</th>
            <th width="96" align="center">Telefone Alternativo</th>
            <th width="96" align="center">Desaparecimento</th>
            <th width="96" align="center">Registro no Sistema</th>
            <th width="96" align="center">Remoção</th>
            <th width="96" align="center">Removido Por</th>
            <th width="96" align="center"></th>

            <th width="96" align="center"><a href="visualizar_desaparecidos.php">
                    <button class="btn btn-outline-info" style="font-size: 12px; color: #fff;">Voltar </button>
                </a></th>




        </tr></thead>
        <?php while($dados=mysqli_fetch_array($sql)){ ?>
            <tr class="vd">
                <td width="92" align=""><img width = 'auto' height='auto' style='border-radius:3px;'
                                             src="midia/foto_desaparecido/<?php echo $dados['foto']; ?>" alt=""/></td>
                <td width="92" align=""id="bt4"><?php echo $dados['id_desaparecido'];?></td>
                <td width="92" align=""><?php echo $dados['nome_completo'];?></td>
                <td width="92" align=""><?php echo $dados['nascimento'];?></td>
                <td width="92" align=""id="bt4"><?php echo $dados['nome_pai'];?></td>
                <td width="92" align=""><?php echo $dados['nome_mae'];?></td>
                <td width="92" align=""id="bt4"><?php echo $dados['telefone1'];?></td>
                <td width="92" align=""><?php echo $dados['telefone2'];?></td>
                <td width="92" align=""id="bt4"><?php echo $dados['data_desaparecimento'];?></td>
                <td width="92" align=""><?php echo $dados['dataRegistro'];?></td>
                <td width="92" align=""><?php echo $dados['dataExcluido'];?></td>
                <td width="92" align=""><?php echo $dados['removido_por'];?></td>

                <td></td>
                <td> <a href="historico_desaparecidos.php?id_desaparecido=<?php echo ($dados['id_desaparecido']);?> "
                        style=""><form  method="post">
                            <input type="hidden" value="<?php echo ($dados['id_desaparecido']);?>" name="id_desaparecido">
                            <input type="hidden" class="form-control" id="dat" name="dt">
                        <button class="btn btn-primary" style="font-size: 12px;" name="excluir"><span	class="glyphicon	glyphicon-log-in" > </span>
                             Remover dos Encontrados </button></a></td>
                </form>

            </tr>


        <?php }//end if ?></table>
</div>
</center>
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