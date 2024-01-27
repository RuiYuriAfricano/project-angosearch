<?php
session_start();
if($_SESSION['nome_admin']) {


?>


<?php
include'include/conexao.php';
$id_esquadra=$_GET['id_esquadra'];
$con=conecta();
if(isset($_POST['sub'])) {
    $bairro = $_POST['bairro'];
    $esquadra = $_POST['esquadra'];
    $numero = $_POST['numero'];
    $tipo_esquadra = $_POST['Tesquadra'];

    if ($bairro == "" or $esquadra == "" or $tipo_esquadra == "") {
        header('Location:visualizar_esquadra.php?msg=erro');
    } else {
        $sql = $con->query("select * from bairro") or die
        ("Erro");
        $linhas2 = mysqli_num_rows($sql);

        if ($linhas2 > 0) {


            while ($dados2 = mysqli_fetch_assoc($sql)) {

                $dados2["bairro"];
                $dados2["id_bairro"];
                if ($bairro == $dados2["bairro"]) {
                    $bairro = $dados2["id_bairro"];
                }


            }


        }

        $s = $con->query("select * from tipoesquadra") or die
        ("Erro");
        $li = mysqli_num_rows($s);

        if ($li > 0) {


            while ($d = mysqli_fetch_assoc($s)) {

                $d["tipoEsquadra"];
                $d["id_tipoEsquadra"];
                if ($tipo_esquadra == $d["tipoEsquadra"]) {
                    $tipo_esquadra = $d["id_tipoEsquadra"];
                }


            }


        }


        $atualiza = $con->query("update esquadra set esquadra='$esquadra' , numero='$numero', 
fk_bairro='$bairro' , fk_tipoEsquadra='$tipo_esquadra' where  id_esquadra='$id_esquadra'") or die(mysql_error()."erro ao atualizar");


        header('Location:visualizar_esquadra.php?msg=edit');

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

    <title>Editar Esquadra</title>
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
<!--================Header Menu Area =================-->
<?php
$s=$con->query("select esquadra from esquadra WHERE  id_esquadra='$id_esquadra'");
$pega_nome=mysqli_fetch_assoc($s);
?>
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="banner_content text-center">
                <h2><span	class="glyphicon	glyphicon-edit"></span> Editar Esquadra : <?php echo $pega_nome['esquadra']; ?></h2>
                <div class="page_link">
                    <a href=""><span	class="glyphicon	glyphicon-home"></span> Inicio</a>

                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Welcome Area =================-->

<script language="JavaScript" src="js/apresentaMSG.js"></script>
<div style="">

    <!--================End Welcome Area =================-->
    <center>
    <div class="col-lg-9    table-responsive" style="border: solid 1px; text-align: center;  width: 80%;

margin-bottom: 160px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px;">
        <?php

        $con=conecta();

        $sq=$con->query("select id_esquadra, esquadra, numero, dataRegistro, tipoEsquadra, bairro
 from esquadra,tipoesquadra,bairro where estado='1'and
 fk_tipoEsquadra=id_tipoEsquadra
 and fk_bairro=id_bairro and id_esquadra='$id_esquadra'");

        $dado=mysqli_fetch_array($sq);
        ?>
        <form name="" action="" method="post">
            <table width="100%">

                <tr>
                    <td height="45"  align="right">Esquadra :</td>
                    <td width="582" align="left"><input type="text" name="esquadra" id="uname" class="input-medium"
                                                        value="<?php echo $dado["esquadra"]; ?>"/>

                    </td>
                </tr>
                <tr>
                    <td height="45"  align="right">Número :</td>
                    <td width="582" align="left"><input type="text" name="numero" id="uname" class="input-medium"
                                                        value="<?php echo $dado["numero"]; ?>"/>

                    </td>
                </tr>
                <tr>
                    <td width="297" height="45" align="right">Caracteristica :</td>
                    <td><select class="input-medium" name="Tesquadra" id="type" >
                        <option><?php echo $dado["tipoEsquadra"]; ?></option>
                        <?php $sql = $con->query("select tipoEsquadra
 from tipoesquadra") or die("Erro na Busca");



                        $linhas = mysqli_num_rows($sql);

                        if ($linhas > 0) {

                            while ($dados1 = mysqli_fetch_assoc($sql)) { ?>
                                <option><?php echo $dados1["tipoEsquadra"]; ?></option><?php } } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td height="45"  align="right">Localização / Bairro :</td>
                    <td><select class="input-medium" name="bairro" id="type" >
                            <option><?php echo $dado["bairro"]; ?></option>
                        <?php $sql = $con->query("select bairro
 from bairro") or die("Erro na Busca");



                        $linhas = mysqli_num_rows($sql);

                        if ($linhas > 0) {

                            while ($dados = mysqli_fetch_assoc($sql)) { ?>
                                <option><?php echo $dados["bairro"]; ?></option><?php } } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td align="left" height="45">
                        <button class="btn btn-success" type="submit"  name="sub"/>
                        <span	class="glyphicon	glyphicon-ok"></span> Registrar
                        </button>
                        <a href="adicionar_esquadra.php"><input class="btn btn-danger" type="button" value="Cancelar" /></a></td>
                </tr>
            </table></form
    </div></center>
    <!--================Causes Area =================-->

    <!--================End Causes Area =================-->


    <!--================Event Area =================-->
    <!--================End Event Area =================-->


    <!--================Clients Logo Area =================-->

    <!--================End Clients Logo Area =================-->

    <style>
        table{

        }
        table td {
            background-color: #ffffff;
            padding: 12px;
            font-size: 16px;
            color:grey;
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