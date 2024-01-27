<?php
session_start();
/*if($_SESSION['nome_admin']) {*/

?>

<?php
include'include/conexao.php';
$id=$_GET['id_doc'];
$nome=$_GET['nome_doc'];
$con=conecta();

if(isset($_POST['sub'])) {

    $detalhe = $_POST['detalhe'];
    $codigo_doc = $_POST['codigo'];
    $nomeDoc = $_POST['nome_doc'];
    $dataRegistro = $_POST['dt'];
    $postado_por=$_SESSION['nome_admin'];


    if ($detalhe == "" and $nomeDoc==""  ) {
        header('Location:visualizar_documentos.php?msg=erro');
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


                    $up = $con->query("update documentos set nome_doc='$nomeDoc', detalhe='$detalhe',codigo_doc='$codigo_doc',
fotografia ='$uploadfile' where id_doc='$id' ")
                    or die ("erro ao atualizar documento".mysql_error());


                    header('Location:visualizar_documentos.php?msg=add');
                }else{

                    header('Location:visualizar_documentos.php?msg=2'); //tamanho grande
                }

            }else{

                header('Location:visualizar_documentos.php?msg=3'); // extensão da foto é invalida
            }
        }else{
            $up = $con->query("update documentos set nome_doc='$nomeDoc', detalhe='$detalhe',codigo_doc='$codigo_doc'
 WHERE id_doc='$id'")
            or die ("erro ao atualizar documento".mysql_error());
            header('Location:visualizar_documentos.php?msg=4');
        }


    }
}?>

    <!doctype html>
    <html lang="pt-pt">
    <head>
        <!-- Required meta tags -->
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Editar Documentos</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link href="../adminLTE-master/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" >
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
    <div>

        <!--================Header Menu Are
        a =================-->
        <header class="header_area">
            <?php include"include/cabecalho.php"; ?>
        </header>
        <!--================Header Menu Area =================-->

        <!--================Home Banner Area =================-->
<br><br><br><br><br><br><br><br>
        <!--================End Home Banner Area =================-->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Editar Documento
                    <small>Painel de Controlo</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> Principal</a></li>
                    <li class="active">AngoSearch</li>
                </ol>
            </section>

            <!-- Main content -->
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
                    <?php
                    $sql=$con->query("SELECT id_doc,nome_doc, fotografia, detalhe,codigo_doc,postado_por,dataRegistro FROM documentos
WHERE id_doc='$id' and estado = '1' limit 1");
                    $dados=mysqli_fetch_array($sql);
                    ?>

                    <!-- left column -->
                    <div class="col-md-12" >
                        <div class="box box-primary" style="width: 80%">
                            <div class="box-header">
                                <h3 class="box-title">
                                    <img src="../admin/midia/documentos/<?php echo $dados['fotografia']; ?>" alt="<?php echo $dados['fotografia']; ?>"
                                         style="width: 160px;"  alt="User Image" />

                                    <span class="glyphicon	glyphicon-edit"></span>  Editar Documento Perdido: <?php echo $nome; ?> </h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->

                            <form role="form" method="post" action="" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Designação do Documentos</label>
                                        <input type="text" class="form-control" id="arquivo" name="nome_doc"
                                               value="<?php echo $dados['nome_doc']; ?>">
                                        <input type="hidden" class="form-control" id="dat" name="dt">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Imagem</label>
                                        <input type="file" class="form-file " id="arquivo" name="fotografia">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Detalhes</label>
                                        <textarea name="detalhe" rows="3" class="form-control" ><?php echo $dados['detalhe']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Código do Documento</label>
                                        <input type="text" class="form-control" name="codigo" placeholder="ex: Nº do BI, de Cédula, etc..."
                                               value="<?php echo $dados['codigo_doc']; ?>">
                                    </div>


                                </div><!-- /.box-body -->

                                <div class="box-footer">
                                    <button class="btn btn-primary" type="submit"  name="sub"/>
                                    <span	class="glyphicon	glyphicon-edit"></span> Efectuar Alterações
                                    </button>
                                    <a href="view_docPerdidos.php" class="btn btn-danger" />
                                    <span	class="glyphicon	glyphicon-remove"></span> Cancelar
                                    </a>
                                </div>
                            </form>
                        </div></div>
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

    </div>
    <!--================End Causes Area =================-->

    <style>
        table{

        }
        table td {
            background-color: transparent;
            padding: 12px;
            font-size: 16px;
            color:#fff;
            font-weight: bold;
            border: none;



        }
        input.input-short, input.input-medium, input.input-long, select {
            height: 35px;
        }
        input.input-short, input.input-medium, input.input-long, select, textarea {
            background: url(../images/input-bg.gif) top left repeat-x #f6f6f6;
            border: 0;
            border: 1px solid #cccccc;
        }
        .input-medium {
            width: 50%;
        }
        .input-short, .input-medium, .input-long {
            padding: 3px;
            border: 1px solid #999;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            -khtml-border-radius: 5px;
            border-radius: 5px;
        }
    </style>
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

<?php/*
}
else{
    header("Location:../../login-usuario.php");
}*/
?>