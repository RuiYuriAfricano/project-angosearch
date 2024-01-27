<?php
include 'include/conexao.php';
session_start();
$con = conecta();

?>

<!doctype html>
<html lang="pt-pt">
<head>

    <title>Comunicados</title>
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
                <li><a href="#"><i class="glyphicon glyphicon-user"></i> Pessoas</a></li>
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
                    font-family: "trebuchet MS", Verdana, sans-serif'>Comunicados de Desaparecimento</b></h4>

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
</style><br><div style="">
    <?Php

    if(isset($_REQUEST["msg"])) {
        if ($_REQUEST["msg"] == "1") {

            ?>
            <span class='notification n-success'>Registrado com Sucesso.......!!</span>
        <?php }else if($_REQUEST["msg"]=="senhaerror"){
            ?>
            <span class='notification n-error'>Senha digitada não está correcta..!!</span>
        <?php }

        else if ($_REQUEST["msg"] == "2") {

            ?>
            <span class="notification n-error">Erro: Fotografia Muito grande, escolhe uma de tamanho menor .</span>
        <?php }
        else if ($_REQUEST["msg"] == "3") {
            ?>
            <span class='notification n-error'>Erro: Extensão Inválida</span>



        <?php }


        else if ($_REQUEST["msg"] == "4") {

            ?>


            <span class='notification n-success'>Registrado sem Nenhuma Fotográfia ...!</span>



            <?php
            ?>
        <?php
        }     else if ($_REQUEST["msg"] == "5") {
            ?>
            <span class='notification n-error'>Erro: Insere um Nome ou uma Fotográfia</span>



        <?php }} ?>
</div>
<center>

    <div class="table-responsive" style="  width: 100%;
 background-color: #fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px; padding-left: 20px;padding-right: 20px;">

        <?php

        $con=conecta();

        $desaparecidos = $con->query("select * from desaparecidos where estado='2'");
        $totalDesaparecidos = mysqli_num_rows($desaparecidos);

        $sql=$con->query("SELECT id_desaparecido,nome_completo,idade,nome_pai,nome_mae,data_desaparecimento,dataSolicitacao,foto,
telefone1,telefone2,dataRegistro,postado_por,fk_utilizador,bairro,genero,provincia FROM
`desaparecidos`,bairro,genero,provincia WHERE estado = '2' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia ORDER  BY  id_desaparecido DESC ");


        ?>
        <h5 align="left" style=""><?php if($totalDesaparecidos > 1){
                echo $totalDesaparecidos." Comunicados";}
            else if($totalDesaparecidos == 0){
                echo "Nenhum Comunicado";
            }
            if($totalDesaparecidos == 1){
                echo $totalDesaparecidos." Comunicado";}
            ?> </h5>
        <a href='#'  style='float: right'>
            <span class='fa fa-file-pdf-o  text-danger'></span> Imprimir
        </a><br>
        <table  style="text-align: center;" id="example1"  width="100%" class="table table-bordered table-striped" >
            <thead style="" class="vh"> <tr >
                <th width="96" align="center">Fotografia</th>
                <th  align="center"id="bt4"width="40" height="">Processo Nº</th>
                <th width="96" align="center">Nome</th>
                <th width="96" align="center">Idade</th>

                <th width="96" align="center">Telefone</th>
                <th width="96" align="center">Data de Comunicação</th>
                <th width="96" align="center">Por utilizador</th>

                <th width="96" align="center"></th>
                <th width="96" align="center"></th>





            </tr></thead>
            <?php while($dados=mysqli_fetch_array($sql)){ $ft=$dados['foto'];
                $fk_utilizador=$dados['fk_utilizador'];
                $sq=$con->query("select nome_completo from utilizador WHERE id_utilizador='$fk_utilizador'");
                $r=mysqli_fetch_array($sq);
                $ut=$r['nome_completo'];

                ?>
                <tr class="vd">
                    <td width="92" align=""><input type="hidden" value="<?php echo ($dados['id_desaparecido']);?>" name="id_desaparecido">
                        <img src="../admin/midia/foto_desaparecido/<?php echo $ft; ?>" alt="<?php echo $ft; ?>"
                             width = 'auto' height='100px' style='border-radius:3px;'></td>
                    <td width="92" align=""id="bt4"><?php echo $dados['id_desaparecido'];?></td>
                    <td width="92" align=""><?php echo $dados['nome_completo'];?></td>
                    <td width="62" align=""><?php echo $dados['idade'];?></td>

                    <td width="92" align=""id="bt4"><?php echo $dados['telefone1'];?></td>
                    <td width="92" align=""id="bt4"><?php echo date('d-m-Y H:i:s', strtotime($dados['dataSolicitacao']));?></td>
                    <td width="92" align=""><?php echo $ut;?></td>



                    <td> <a href="maisComunicado.php?id_desaparecido=<?php echo ($dados['id_desaparecido']);?> "
                            style="">
                            <button class="btn btn-warning" style="font-size: 12px;color: #fff"><span	class="glyphicon	glyphicon-eye-open"></span>
                                Visualizar </button></a></td>
                    <td> <a href="aceitar_comunicado.php?id_desaparecido=<?php echo ($dados['id_desaparecido']);?>
                      &&  nome=<?php echo ($dados['nome_completo']);?> "
                            style="">
                            <button class="btn btn-primary" style="font-size: 12px;"><span	class="glyphicon	glyphicon-ok"></span>
                                Registrar </button></a></td>

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