<?php
session_start();
if($_SESSION['nome_admin']) {


    ?>


    <?php
include 'include/conexao.php';

$con=conecta();
$id_pagina=$_GET['id_pagina'];
if(isset($_POST['editar'])) {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    $tag_meta = $_POST['tag_meta'];
    $descricao_meta = $_POST['descricao_meta'];
    $texto=$_POST['texto'];
    $texto_add=$_POST['texto_add'];

    if ($conteudo == "" and $titulo == "" and $texto=="" and $texto_add=="") {
        header('Location:editarPagina_process.php?msg=erro');
    } else {



        $atualiza = $con->query("update  pagina  set titulo='$titulo' , conteudo='$conteudo',  texto_inicial='$texto',
 texto_adicional='$texto_add', tag_meta='$tag_meta' , descricao_meta='$descricao_meta' where  id_pagina='$id_pagina'")
        or die(mysql_error()."erro ao atualizar");


        header('Location:editarPagina_process.php?msg=add');

    }
}
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
<?php
$id_pagina=$_GET['id_pagina'];

$con=conecta();

$sql=$con->query("select * from pagina where id_pagina='$id_pagina' and estado='1'");
$d=mysqli_fetch_assoc($sql);
$pega_titulo= $d['titulo'];

?>
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="banner_content text-center">
                <h2><span class="glyphicon glyphicon-edit"></span> Editar : <?php echo $pega_titulo; ?></h2>
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
<center>
<div class="col-lg-9    table-responsive" style=" width: 100%;
background:#fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px;">

    <?php


    $sql1=$con->query("select * from pagina where id_pagina='$id_pagina' and estado='1'");


    ?>
    <form class="row contact_form" action="" method="post" id="contactForm" novalidate="novalidate" onsubmit="ap();">
    <table  border="1px" cellspacing="10px" cellpadding="2px"style="width: 100%;">

        <?php while($dados=mysqli_fetch_array($sql1)){ ?>
            <tr>
                <td  align="right" style="width: auto;">Nome da Pagina : </td>
                <td  align="left">
                    <input type="hidden" value="<?php echo $dados['id_pagina'];?>" name="pid" id="pid">
                    <input type="text" name="title" id="title" value="<?php echo $dados['titulo'];?>"
                           class="input-medium" readonly="readonly"/></td>
            </tr>

            <tr>
                <td  align="right" style="width: auto;">Titulo : </td>
                <td  align="left">

                    <input type="text" name="titulo" id="page_title"
                           value="<?php echo $dados['titulo'];?>" class="input-medium"/></td>
            </tr>

            <tr>
                <td  align="right">Meta Keywords: </td>
                <td  align="left">
                    <input type="text" name="tag_meta" id="met_tags"
                           value="<?php echo $dados['tag_meta'];?>" class="input-medium" /></td>
            </tr>


            <tr>
                <td  align="right">Meta Description : </td>
                <td  align="left">
                    <input type="text" name="descricao_meta" id="meta_description"
                           value="<?php echo $dados['descricao_meta'];?>" class="input-medium" /></td>
            </tr>

            <tr>
                <td  align="right" style="vertical-align:top;">Texto Principal: </td>

                <td align="left" style="width: 100%;"><textarea name="texto" rows="3"    id="tPrincipal"  >
                     <?php echo $dados['texto_inicial'];?></textarea>
                    <script type="text/javascript">
                        var editor = CKEDITOR.replace( 'tPrincipal', {
                            filebrowserBrowseUrl : 'js/ckfinder/ckfinder.html',
                            filebrowserImageBrowseUrl : 'js/ckfinder/ckfinder.html?type=Images',
                            filebrowserFlashBrowseUrl : 'js/ckfinder/ckfinder.html?type=Flash',
                            filebrowserUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                            filebrowserImageUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                            filebrowserFlashUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                        });
                        CKFinder.setupCKEditor( editor,'js/' );
                    </script>
                </td>
            </tr>
            <tr>
                <td  align="right" style="vertical-align:top;">Bem-Vindo: </td>

                <td align="left" style="width: 100%;"><textarea name="conteudo" rows="3"    id="description"  >
                     <?php echo $dados['conteudo'];?></textarea>
                    <script type="text/javascript">
                        var editor = CKEDITOR.replace( 'description', {
                            filebrowserBrowseUrl : 'js/ckfinder/ckfinder.html',
                            filebrowserImageBrowseUrl : 'js/ckfinder/ckfinder.html?type=Images',
                            filebrowserFlashBrowseUrl : 'js/ckfinder/ckfinder.html?type=Flash',
                            filebrowserUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                            filebrowserImageUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                            filebrowserFlashUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                        });
                        CKFinder.setupCKEditor( editor,'js/' );
                    </script>
                </td>
            </tr>
            <tr>
                <td  align="right" style="vertical-align:top;">Texto Adicional: </td>

                <td align="left" style="width: 100%;"><textarea name="texto_add" rows="3"    id="texto_add"  >
                     <?php echo $dados['texto_adicional'];?></textarea>
                    <script type="text/javascript">
                        var editor = CKEDITOR.replace( 'texto_add', {
                            filebrowserBrowseUrl : 'js/ckfinder/ckfinder.html',
                            filebrowserImageBrowseUrl : 'js/ckfinder/ckfinder.html?type=Images',
                            filebrowserFlashBrowseUrl : 'js/ckfinder/ckfinder.html?type=Flash',
                            filebrowserUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                            filebrowserImageUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                            filebrowserFlashUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                        });
                        CKFinder.setupCKEditor( editor,'js/' );
                    </script>
                </td>
            </tr>
            <tr>
                <td></td>
                <td align="left">
                    <input class="btn btn-primary" style="" type="submit" value="Editar"  name="editar"/>


                    <input type="button" class="btn btn-danger" style="" value="Cancelar"
                           onclick="javascript:window.location='EditarPagina.php';" >
                </td> </tr>


        <?php }//end if ?></table></form>
</div></center>
<!--================Causes Area =================-->
<style>
    table td {
        background-color: #ffffff;
        padding: 2px;
        font-size: 16px;
        color:grey;
        font-weight: bold;


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