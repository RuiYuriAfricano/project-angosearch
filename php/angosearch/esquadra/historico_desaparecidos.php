<?php
session_start();
//if($_SESSION['nome_admin']) {


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

    <title>Pessoas Encontradas</title>
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
    <link rel="stylesheet" href="../adminlte-master/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!--<link rel="stylesheet" href="bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <!--<link rel="stylesheet" href="bootstrap-daterangepicker/daterangepicker.css">
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="../../../js/calendario.js"></script>

    <style>
        #ativo4{
            color: #005cbf;
        }
    </style>
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
        <div class="container"><br><br><br><br><br><bR><br><br>
            <div class="banner_content text-center">
                <h2></h2>
                <div class="page_link">
                    <h3 class="" style="color: goldenrod;">
                            <span class="glyphicon	glyphicon-eye-open"></span> Pessoas Encontradas</h3>

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
    .vd td {
        color: #444;
    }
    .vh th{
        color: #444;font-weight: bold;
    }
</style>
<center>
    <div class="table-responsive" style="  width: 100%;
 background-color: #fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 10px; padding-left: 20px;padding-right: 20px;">

        <?php

        $con=conecta();

        $desaparecidos = $con->query("select * from desaparecidos where estado='0'");
        $totalDesaparecidos = mysqli_num_rows($desaparecidos);

        $sql=$con->query("SELECT id_desaparecido,nome_completo,idade,nome_pai,nome_mae,data_desaparecimento,foto,
telefone1,telefone2,dataRegistro,postado_por,removido_por,dataExcluido,bairro,genero,provincia FROM
`desaparecidos`,bairro,genero,provincia WHERE estado = '0' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia ORDER  BY  id_desaparecido DESC ");


        ?>
        <h5 align="left" style=""><?php if($totalDesaparecidos > 1){
                echo $totalDesaparecidos." Pessoas Encontradas";}
            else if($totalDesaparecidos == 0){
                echo "Nenhuma Pessoa Encontrada";
            }
            if($totalDesaparecidos == 1){
                echo $totalDesaparecidos." Pessoa Encontrada";}
            ?> </h5>
        <a href='#'  style='float: right'>
            <span class='fa fa-file-pdf-o  text-danger'></span> Gerar Pdf
        </a><br>
        <table  style="text-align: center;"  id="example1"  width="100%" class="table table-bordered table-striped" >
            <thead style="" class="vh"> <tr >
                <th width="96" align="center">Fotografia</th>
                <th  align="center"id="bt4"width="40" height="">Processo Nº</th>
                <th width="96" align="center">Nome</th>
                <th width="96" align="center">Idade</th>
                <th width="96" align="center">Filiaçao</th>
                <th width="96" align="center">Telefone</th>
                <th width="96" align="center">Data de Desaparecimento</th>


                <th width="96" align="center">Removido(a) Quando</th>
                <th width="96" align="center">Quem Removeu</th>

                <th width="96" align="center"></th>
                <th width="96" align="center"><a href="visualizar_desaparecidos.php">
                        <button class="btn btn-primary" style="font-size: 12px;color: #fff; ">Voltar </button>
                    </a></th>




            </tr></thead>
            <?php while($dados=mysqli_fetch_array($sql)){ $ft=$dados['foto'];?>
                <tr class="vd">
                    <td width="92" align=""><input type="hidden" value="<?php echo ($dados['id_desaparecido']);?>" name="id_desaparecido">
                        <img src="../admin/midia/foto_desaparecido/<?php echo $ft; ?>" alt="<?php echo $ft; ?>"
                             width = 'auto' height='100px' style='border-radius:3px;'></td>
                    <td width="92" align=""id="bt4"><?php echo $dados['id_desaparecido'];?></td>
                    <td width="92" align=""><?php echo $dados['nome_completo'];?></td>
                    <td width="62" align=""><?php echo $dados['idade'];?></td>
                    <td width="92" align=""id="bt4"><?php echo $dados['nome_pai']." e de ".$dados['nome_mae'];?></td>
                    <td width="92" align=""id="bt4"><?php echo $dados['telefone1'];?></td>
                    <td width="92" align=""id="bt4"><?php echo $dados['data_desaparecimento'];?></td>


                    <td width="92" align=""><?php echo $dados['dataExcluido'];?></td>
                    <td width="92" align=""><?php echo $dados['removido_por'];?></td>


                    <td> <a href="mais_desaparecidos.php?id_desaparecido=<?php echo ($dados['id_desaparecido']);?> &&
                nome=<?php echo ($dados['nome_completo']);?> "
                            style="">
                            <button class="btn btn-warning" style="font-size: 12px;color: #fff"><span	class="glyphicon	glyphicon-eye-open"></span>
                                <br> Visualizar</button></a></td>

                    <form method="post" action="">
                        <input type="hidden" class="form-control" id="dat" name="dt">
                        <input type="hidden" value="<?php echo ($dados['id_desaparecido']);?>" name="id_desaparecido">
                        <td><a  href="desaparecidos_enc.php?id_desaparecido=<?php echo ($dados['id_desaparecido']);?> ">
                                <button class="btn btn-danger" style="font-size: 12px;" type="submit" name="excluir"><span	class="glyphicon	glyphicon-remove"></span>
                                    Remover dos<br> Encontrados </button></a></td>
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

<?php/*
}
else{
    header("Location:../../login-usuario.php");
}*/
?>