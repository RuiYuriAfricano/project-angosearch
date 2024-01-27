<?php
include 'include/conexao.php';
session_start();
$con = conecta();

?>

<!doctype html>
<html lang="pt-pt">
<head>

    <title>Documentos Perdidos</title>
    <!-- Bootstrap CSS -->
    <!-- Required meta tags -->
    <meta http-equiv="Content­Type" content="text/html;charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">

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
    <link rel="stylesheet" href="css/glyphicon.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="vendors/animate-css/animate.css">
    <link rel="stylesheet" href="Ionicons/css/ionicons.min.css">
    <!-- main css -->

    <link rel="stylesheet" href="../adminlte-master/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">

    <style>
        #ativo1{
            color: #005cbf;
        }
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
        <section class="content-header" >
            <h1>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                <small><?php echo $valores['func_esquadra']. ""; ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="glyphicon glyphicon-file"></i> Documentos</a></li>
                <li class="active">AngoSearch</li>
            </ol>
        </section></div></div>
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center" >
        <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container"><br><br>
            <div class="banner_content text-center">
                <h2></h2>
                <div class="page_link">
                    <h4  class="text-danger text-heading" style="margin-top: -40px"><b style='font-weight: bolder;
                    font-family: "trebuchet MS", Verdana, sans-serif'>Documentos Perdidos</b></h4>

                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->
<!-- Small boxes (Stat box) -->
<style>
    .vd td {
        color: #444;
    }
    .vh th{
        color: #444;font-weight: bold;
    }
</style>
<br>
<div style="">
    <?Php
    if(isset($_REQUEST["msg"])) {
        if ($_REQUEST["msg"] == "add") {

            ?>
            <span class='notification n-success'>Registrado com Sucesso.......!!</span>
        <?php }

        if ($_REQUEST["msg"] == "2") {

            ?>
            <span class="notification n-error">Erro: Fotografia Muito grande, escolhe uma de tamanho menor .</span>
        <?php }if($_REQUEST["msg"]=="senhaerror"){
            ?>
            <span class='notification n-error'>Senha digitada não está correcta..!!</span>
        <?php }
        if ($_REQUEST["msg"] == "3") {
            ?>
            <span class='notification n-error'>Erro: Extensão Inválida</span>


        <?php }


        if ($_REQUEST["msg"] == "4") {

            ?>


            <span class='notification n-success'>Alterações Efectuada com Sucesso...!</span>


        <?php }


        if ($_REQUEST["msg"] == "erro") {

            ?>


            <span class='notification n-error'>Preencha os campos por favor...!</span>


        <?php
        }
    }?>
</div>
<center>

    <div class="table-responsive" style="  width: 100%;
background:#fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px; padding-left: 20px;padding-right: 20px;">

        <?php

        $con=conecta();

        $docs = $con->query("select * from documentos where estado='1'");
        $totalDocs = mysqli_num_rows($docs);

        $sql=$con->query("SELECT id_doc,nome_doc, fotografia, detalhe,codigo_doc,postado_por,dataRegistro FROM documentos
WHERE estado = '1'ORDER  BY id_doc DESC ");


        ?>
        <h5 align="left" style="color: #999;"><?php if($totalDocs > 1){
                echo $totalDocs." Documentos Perdidos";}
            else if($totalDocs == 0){
                echo "Nenhum Documento Perdido";
            }
            if($totalDocs == 1){
                echo $totalDocs." Documento Perdido";}
            ?></h5> <a href='gerarPdfDocsPerdidos.php'  style='float: right'>
            <span class='fa fa-file-pdf-o  text-danger'></span> Imprimir
        </a><br>

        <table   style="text-align: center;"  id="example1"  width="100%" class="table table-bordered table-striped" >
            <thead style="" class="vh"> <tr >
                <th width="192" align="center">Imagem do Documento</th>
                <th  align="center"id="bt4" width="15" height="">processo Nº</th>

                <th width="192" align="center">Nome do Documento</th>

                <th width="192" align="center">Detalhe</th>
                <th width="192" align="center">Código</th>
                <th width="192" align="center">Postado Por</th>
                <th width="192" align="center">Registro no Sistema</th>
                <th width="192" align="center"></th>
                <th width="192" align="center"></th>






            </tr></thead>
            <?php while($dados=mysqli_fetch_array($sql)){ $ft=$dados['fotografia'];?>
                <tr class="vd">
                    <td width="192" align=""><input type="hidden" value="<?php echo ($dados['id_doc']);?>" name="id_doc">
                        <img src="../admin/midia/documentos/<?php echo $ft; ?>" alt="<?php echo $ft; ?>"
                             width = '150px' height='100px' style='border-radius:3px;'></td>
                    <td width="15" align=""><?php echo $dados['id_doc'];?></td>


                    <td width="192" align=""><?php echo $dados['nome_doc'] ?></td>
                    <td width="192" align=""><?php echo $dados['detalhe'];?></td>
                    <td width="192" align=""><?php echo $dados['codigo_doc'];?></td>
                    <td width="192" align=""><?php echo $dados['postado_por'];?></td>
                    <td width="192" align=""><?php echo $dados['dataRegistro'];?></td>
                    <td width="10" align="center"> <a href="mais_docPerdidos.php?id_doc=<?php echo ($dados['id_doc']);?>&&
                         nome=<?php echo ($dados['nome_doc']);?>"
                                                      style="">
                            <button class="btn btn-warning  text-white" style="font-size: 12px;">
                                <span	class="glyphicon	glyphicon-eye-open  text-white"></span>
                                Visualizar </button></a></td>
                    <td width="10" align="center"> <a href="editar_documento.php?id_doc=<?php echo ($dados['id_doc']);?>
                            && nome_doc=<?php echo ($dados['nome_doc']);?> "
                                                      style="">
                            <button class="btn btn-primary" style="font-size: 12px;"><span	class="glyphicon	glyphicon-edit">
                                    </span>
                                Editar </button></a></td>



                </tr>


            <?php }//end if ?></table>
    </div></center>
<!--================Welcome Area =================-->

<!--================End Welcome Area =================-->

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


<script src="../adminlte-master/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script src="../adminlte-master/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>


<script src="include/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="include/jquery-ui/jquery-ui.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="include/jquery-knob/dist/jquery.knob.min.js"></script>
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