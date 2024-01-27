<?php
session_start();
if($_SESSION['nome_admin']) {


?>


<?php
include 'include/conexao.php';

$con=conecta();

if(isset($_POST['editar'])) {
    $fb = $_POST['facebook'];
    $wt = $_POST['whatsapp'];
    $sk = $_POST['sype'];
    $tw = $_POST['twitter'];
    $sobre=$_POST['sobre'];
    $navegacao=$_POST['navegacao'];
    $novidades=$_POST['novidades'];

    if ($sobre == "" and $navegacao == "" and $novidades=="" and $fb=="") {
        header('Location:editar_rodape.php?msg=erro');
    } else {



        $atualiza = $con->query("update  rodape  set facebook='$fb' , whatsapp='$wt',  skype='$sk',
 twitter='$tw', sobre='$sobre' , navegacao='$navegacao', novidades='$novidades' where  id_rodape='1'")
        or die(mysql_error()."erro ao atualizar");


        header('Location:editar_rodape.php?msg=add');

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

    <title>Definições Rodapé</title>
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

<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="banner_content text-center">
                <h2><span class="glyphicon glyphicon-info-sign"></span>Definições-Rodapé</h2>
                <div class="page_link">
                    <a href="principal_admin.php"><span class="glyphicon glyphicon-home"></span> Principal</a>

                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Welcome Area =================-->

<!--================End Welcome Area =================-->
<br><br>
<div style="">
    <?Php

    if($_REQUEST["msg"]=="add")
    {

        ?>
        <span class='notification n-success'>Editado com Sucesso.......!!</span>
    <?php }

    if($_REQUEST["msg"]=="erro")
    {

        ?>
        <span class="notification n-error">Erro: Preencha os Campos.</span>
    <?php }?></div>
<div class="col-lg-9" style="border: solid 1px; margin-left:100px ; width: 90%;
background:linear-gradient(45deg,	#002a80	37%,	#005cbf	80%);
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px;">

    <?php


    $sql=$con->query("select * from rodape where id_rodape='1'");

    ?>
    <form class="row contact_form" action="" method="post" id="contactForm" novalidate="novalidate" onsubmit="ap();">
        <table  border="0px" cellspacing="10px" cellpadding="2px"style="width: 100%;">

            <?php while($dados=mysqli_fetch_array($sql)){ ?>
                <tr>
                    <td  align="right" style="width: auto;">Facebook : </td>
                    <td  align="left">

                        <input type="text" name="facebook" id="title" value="<?php echo $dados['facebook'];?>"
                               class="input-medium" /></td>
                </tr>

                <tr>
                    <td  align="right" style="width: auto;">Whatsapp : </td>
                    <td  align="left">

                        <input type="text" name="whatsapp" id="page_title"
                               value="<?php echo $dados['whatsapp'];?>" class="input-medium"/></td>
                </tr>

                <tr>
                    <td  align="right">Skype: </td>
                    <td  align="left">
                        <input type="text" name="skype" id="met_tags"
                               value="<?php echo $dados['skype'];?>" class="input-medium" /></td>
                </tr>


                <tr>
                    <td  align="right">Twitter : </td>
                    <td  align="left">
                        <input type="text" name="twitter" id="meta_description"
                               value="<?php echo $dados['twitter'];?>" class="input-medium" /></td>
                </tr>

                <tr>
                    <td  align="right" style="vertical-align:top;">Sobre: </td>

                    <td align="left" style="width: 100%;"><textarea name="sobre" rows="3"    id="sobre"  >
                     <?php echo $dados['sobre'];?></textarea>
                        <script type="text/javascript">
                            var editor = CKEDITOR.replace( 'sobre', {
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
                    <td  align="right" style="vertical-align:top;">Navegação: </td>

                    <td align="left" style="width: 100%;"><textarea name="navegacao" rows="3"    id="navegacao"  >
                     <?php echo $dados['navegacao'];?></textarea>
                        <script type="text/javascript">
                            var editor = CKEDITOR.replace( 'navegacao', {
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
                    <td  align="right" style="vertical-align:top;">Novidades: </td>

                    <td align="left" style="width: 100%;"><textarea name="novidades" rows="3"    id="novidades"  >
                     <?php echo $dados['novidades'];?></textarea>
                        <script type="text/javascript">
                            var editor = CKEDITOR.replace( 'novidades', {
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

                    <td align="left">                <br>


                        <input class="bg-green" style="border: green; color: white;height: 30px" type="submit" value="Editar"  name="editar"/>


                        <input type="button" class="bg-danger" style="border: red; color: white;height: 30px" value="Cancelar"
                               onclick="javascript:window.location='rodape.php';" > <br>
                    </td> </tr>


            <?php }//end if ?></table></form>
</div>
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