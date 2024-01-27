<?php
include 'include/conexao.php';
session_start();
$con = conecta();

$esq=$_SESSION['esquadra'];
$esquadra =$con ->query("select * from esquadra where esquadra='$esq' ") or die(mysql_error());


$valores = mysqli_fetch_assoc($esquadra);
if(isset($_POST['sub'])) {

    $senha = md5($_POST['senha']);

    $esq=$_SESSION['esquadra'];
    $esquadra =$con ->query("select * from esquadra where esquadra='$esq'") or die(mysql_error());


    $valores = mysqli_fetch_assoc($esquadra);
    $id_esq=$valores['id_esquadra'];


    $q=$con->query("select usuario from login where fk_esquadra='$id_esq' and estado='1'");
    $pegaUs=mysqli_fetch_array($q);
    $usuario=$pegaUs['usuario'];
    $p= $con->query("select * from login where senha='$senha' and usuario='$usuario' and estado='1'");

    if((mysqli_num_rows($p)) > 0):

    $detalhe = $_POST['detalhe'];
    $codigo_doc = $_POST['codigo'];
    $nomeDoc = $_POST['nome_doc'];
    $dataRegistro = $_POST['dt'];
    $postado_por=$valores['func_esquadra'] ." : ".$_SESSION['esquadra'];


    if ($detalhe == "" or $nomeDoc=="") {
        header('Location:add_documento.php?msg=erro');
    } else {




        $imageName = $_FILES["fotografia"]["name"];
        if(!empty($imageName)) {
            $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            $fileAllow = array("jpg","png","jpeg");
            if(in_array($fileExtension,$fileAllow)){

                if($_FILES['fotografia']['size']< 4128943) {


                    $strDtMix = @date("d").substr((string)microtime(), 2, 8);
                    $uploadfile = $strDtMix.".".pathinfo($imageName, PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES['fotografia']['tmp_name'], "../admin/midia/documentos/".$uploadfile);


                    $insere = $con->query("INSERT INTO documentos(id_doc,nome_doc,fotografia,detalhe,codigo_doc,postado_por,dataRegistro,estado )
 VALUES (default,'$nomeDoc','$uploadfile', '$detalhe','$codigo_doc','$postado_por','$dataRegistro', '1')")
                    or die ("erro ao registrar documento".mysql_error());


                    header('Location:add_documento.php?msg=add');
                }else{

                    header('Location:add_documento.php?msg=2'); //tamanho grande
                }

            }else{

                header('Location:add_documento.php?msg=3'); // extensão da foto é invalida
            }
        }else{
            header('Location:add_documento.php?msg=4');
        }


    }
    else:
        header("Location:add_documento.php?msg=senhaerror");
    endif;
}

?>

<!doctype html>
<html lang="pt-pt">
<head>

    <title>Registrar Documento Perdido</title>
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

    <script src="../../../js/calendario.js"></script>

    <style>
        #ativo1{
            color: #005cbf;
        }
    </style>
</head>
<body class="skin-blue layout-top-nav" onload="setInterval('apresentaData()',1000);">

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
                <li><a href="#"><i class="glyphicon glyphicon-file"></i> Registrar</a></li>
                <li class="active">AngoSearch</li>
            </ol>
        </section></div>

<!--================End Home Banner Area =================-->
<!-- Small boxes (Stat box) -->
<div class="content-wrapper">
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row" id="resumo">
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


                        <span class='notification n-error'>Não foi inserida nenhuma imagem...!</span>


                    <?php }


                    if ($_REQUEST["msg"] == "erro") {

                        ?>


                        <span class='notification n-error'>Preencha os campos por favor...!</span>


                    <?php
                    }
                }?>
            </div>


            <!-- left column -->
            <div class="col-md-9">
                <div class="box box-primary" style="width: 80%">
                    <div class="box-header">
                        <h3 class="box-title">Registrar Documento Perdido</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Designação do Documentos</label>
                                <input type="text" class="form-control" id="nome" pattern="[A-Za-zà-ýÀ-Ý-ç ]*" name="nome_doc">
                                <input type="hidden" class="form-control" id="dat" name="dt">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Imagem</label>
                                <input type="file" class="form-file" id="arquivo" name="fotografia">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Detalhes</label>
                                <textarea name="detalhe" rows="3" class="form-control" id="nome" pattern="[A-Za-zà-ýÀ-Ý-ç ]*"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Código do Documento</label>
                                <input type="text" class="form-control" pattern="[A-Za-z0-9!@.\-_]*" name="codigo" placeholder="ex: Nº do BI, de Cédula, etc...">
                            </div>


                        </div><!-- /.box-body -->

                        <body class="hold-transition lockscreen">
                        <!-- Automatic element centering -->
                        <div class="lockscreen-wrapper">

                            <!-- User name -->
                            <div class="lockscreen-name"><div class="help-block text-center">
                                    Digite a sua palavra passe, para efectuar esta tarefa...
                                </div></div>

                            <!-- START LOCK SCREEN ITEM -->
                            <div class="lockscreen-item">
                                <!-- lockscreen image -->

                                <!-- /.lockscreen-image -->

                                <!-- lockscreen credentials (contains the form) -->


                                <div class="input-group">

                                    <input type="password" class="form-control" name="senha"  required="required" placeholder="sua palavra passe">


                                </div>


                                <!-- /.lockscreen credentials -->

                            </div>
                            <!-- /.lockscreen-item -->


                        </div>


                        </body>

                        <div class="box-footer">
                            <button class="btn btn-primary" type="submit"  name="sub"/>
                            <span	class="glyphicon	glyphicon-ok"></span> Registrar
                            </button>
                        </div>
                    </form>
                </div></div>
    </section></div></div><!--================Welcome Area =================-->

<!--================End Welcome Area =================-->

<!--================Causes Area =================-->

<!--================End Causes Area =================-->



<!--================Event Area =================-->
<!--================End Event Area =================-->


<!--================Clients Logo Area =================-->

<!--================End Clients Logo Area =================-->

</div>
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