
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
     $removido_por=$_SESSION['nome_admin'];

        $t="<script language='javascript'> document.write(confirm('Deseja Realmente Excluir Este Desaparecido'));</script>";


        $id_desaparecido = $_POST['id_desaparecido'];
    if($t==true) {

        $del = $con->query("update desaparecidos set estado='0',dataExcluido='$data',removido_por='$removido_por'
where id_desaparecido='$id_desaparecido'
 and estado='1'")
        or die("Erro Ao Eliminar");



        header("Location:visualizar_desaparecidos.php?msg=excluir");
    }
        else if($t==false){
            header("Location:visualizar_desaparecidos.php?msg=cancelar");
        }



}
?>

<!doctype html>
<html lang="pt-pt">
<head>
    <!-- Required meta tags -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Visualizar Desaparecidos</title>
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
                <h2><span	class="glyphicon	glyphicon-th-list"></span> Desaparecidos Registrados</h2>
                <div class="page_link">
                    <a href="principal_admin.php">Registrar Desaparecidos</a>

                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->
<br>
<!--================Welcome Area =================-->
<div style="">

    <?Php
    if(isset($_REQUEST["msg"])) {
        if ($_REQUEST["msg"] == "excluir") {

            ?>
            <span class='notification n-success'>Removido dos desaparecidos.......!!</span>
        <?php }


else if($_REQUEST["msg"]=="cancelado"){
    ?>
    <span class='notification n-success'>Cancelado.......!!</span>
    <?php }
    elseif($_REQUEST["msg"]="edit") {

        ?>
        <span class='notification n-success'>Editado com sucesso.......!!</span>
    <?php
    }
    }?>
</div>
<style>
    .vd td, .vd th{
        color: #005cbf;
    }
</style>
<!--================End Welcome Area =================-->
<center>
<div class="table-responsive" style="  width: 100%;
color:#005cbf; background-color: #fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px; padding-left: 20px;padding-right: 20px;">

    <?php

    $con=conecta();

    $desaparecidos = $con->query("select * from desaparecidos where estado='1'");
    $totalDesaparecidos = mysqli_num_rows($desaparecidos);

    $sql=$con->query("SELECT id_desaparecido,nome_completo,idade,nome_pai,nome_mae,data_desaparecimento,foto,
telefone1,telefone2,dataRegistro,postado_por,bairro,genero,provincia FROM
`desaparecidos`,bairro,genero,provincia WHERE estado = '1' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia ORDER  BY  dataRegistro DESC ");


    ?>
<h5 align="left" style="color: #999;"><?php echo $totalDesaparecidos; ?> Pessoas Desaparecidas</h5>
    <a href="desaparecido_pdf.php"  style="position: absolute;left: 50px;">
        <span class="glyphicon glyphicon-print"></span> Imprimir
    </a><br>
    <table  style="text-align: center;"  width="100%" class="table table-bordered table-hover" >
        <thead style="color: #fff;"> <tr class="bg-primary">
            <th width="96" align="center">Fotografia</th>
            <th  align="center"id="bt4"width="40" height="">Processo Nº</th>
            <th width="96" align="center">Nome</th>
            <th width="96" align="center">Idade</th>
            <th width="96" align="center">Filiaçao</th>
            <th width="96" align="center">Telefone</th>
            <th width="96" align="center">Desaparecimento</th>
            <th width="96" align="center">Registro no Sistema</th>
            <th width="96" align="center">Postado Por</th>
            <th width="96" align="center"></th>
            <th width="96" align="center"></th>
            <th width="96" align="center"><a href="historico_desaparecidos.php">
                    <button class="btn btn-outline-info" style="font-size: 12px; color: #fff;">Ver os Encontrados </button>
                </a></th>




        </tr></thead>
        <?php while($dados=mysqli_fetch_array($sql)){ $ft=$dados['foto'];?>
            <tr class="vd">
                <td width="92" align=""><input type="hidden" value="<?php echo ($dados['id_desaparecido']);?>" name="id_desaparecido">
                    <img src="midia/foto_desaparecido/<?php echo $ft; ?>" alt="<?php echo $ft; ?>"
                         width = 'auto' height='100px' style='border-radius:3px;'></td>
                <td width="92" align=""id="bt4"><?php echo $dados['id_desaparecido'];?></td>
                <td width="92" align=""><?php echo $dados['nome_completo'];?></td>
                <td width="62" align=""><?php echo $dados['idade'];?></td>
                <td width="92" align=""id="bt4"><?php echo $dados['nome_pai']." e ".$dados['nome_mae'];?></td>
                <td width="92" align=""id="bt4"><?php echo $dados['telefone1'];?></td>
                <td width="92" align=""id="bt4"><?php echo $dados['data_desaparecimento'];?></td>
                <td width="92" align=""><?php echo $dados['dataRegistro'];?></td>
                <td width="92" align=""><?php echo $dados['postado_por'];?></td>


                <td> <a href="maisDesaparecidos.php?id_desaparecido=<?php echo ($dados['id_desaparecido']);?> &&
                nome=<?php echo ($dados['nome_completo']);?> "
                        style="">
                        <button class="btn btn-warning" style="font-size: 12px;color: #fff"><span	class="glyphicon	glyphicon-eye-open"></span>
                            Visualizar </button></a></td>
                    <td> <a href="editar_desaparecido.php?id_desaparecido=<?php echo ($dados['id_desaparecido']);?> "
                            style="">
                            <button class="btn btn-primary" style="font-size: 12px;"><span	class="glyphicon	glyphicon-edit"></span>
                                Editar </button></a></td>
                <form method="post" action="">
                    <input type="hidden" class="form-control" id="dat" name="dt">
                    <input type="hidden" value="<?php echo ($dados['id_desaparecido']);?>" name="id_desaparecido">
                    <td><a  href="visualizar_desaparecidos.php?id_desaparecido=<?php echo ($dados['id_desaparecido']);?> ">
                        <button class="btn btn-danger" style="font-size: 12px;" type="submit" name="excluir"><span	class="glyphicon	glyphicon-remove"></span>
                            Remover dos Desaparecidos </button></a></td>
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