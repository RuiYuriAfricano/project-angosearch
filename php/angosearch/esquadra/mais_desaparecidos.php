
<?php
session_start();
/*if($_SESSION['nome_admin']) {*/


?>


<?php
include 'include/conexao.php';
$con = conecta();
$esq=$_SESSION['esquadra'];
$esquadra =$con ->query("select * from esquadra where esquadra='$esq' ") or die(mysql_error());


$valores = mysqli_fetch_assoc($esquadra);
?>


<?php
$nome = $_GET['nome'];
$id=$_GET['id_desaparecido'];
if($id==""){

    echo "
<META HTTP-EQUIV=REFRESH CONTENT = '0; URL =http://localhost/Projecto%20Final%20-%20Loide%20Laura/php/angosearch/admin/principal_admin.php'>
<script type=\"text/javascript\">

alert(\"nao encontrado\");
</script>";
}
else{
?>

<!doctype html>
<html lang="pt-pt">
<head>
    <!-- Required meta tags -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $nome; ?></title>
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

<!--================Header Menu Are
a =================-->
<header class="header_area">
    <?php include"include/cabecalho.php"; ?>
</header>
<!--================Header Menu Area =================-->

<!--================Home Banner Area =================-->
<br><br><br><br><br><br><br><br>
<!--================End Home Banner Area =================-->
<br>
<!--================Welcome Area =================-->

<style>
    .vd td, .vd th{
        color: #005cbf;
    }
</style>
<!--================End Welcome Area =================-->
<div class="content-wra">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="text-align: center">
        <ol class="breadcrumb">
            <li><a href="principal_esquadra.php"><i class="fa fa-home"></i> Principal</a></li>
            <li class="active">AngoSearch</li>
        </ol><h1>
            Mais Sobre : <?php echo $nome; ?>

        </h1>

    </section>
    <center>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row" id="resumo">
            <br>

                <?php
                if($_GET["id_desaparecido"]!=""){



                    $desaparecidos=$con->query("SELECT id_desaparecido,nome_completo,idade,nome_pai,nome_mae,data_desaparecimento,foto,
telefone1,telefone2,dataRegistro,postado_por,descricao,caracteristicas_especiais,bairro,genero,provincia FROM
desaparecidos,bairro,genero,provincia WHERE estado = '1' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia and id_desaparecido='$id' ORDER  BY  id_desaparecido DESC LIMIT 1 ");




                    while ($dados = mysqli_fetch_assoc($desaparecidos)) {


                        echo "<br><a href='gerarPdfDesaparecido.php?id_desaparecido=".$dados['id_desaparecido']."'
                    style=''>
        <span class='fa fa-file-pdf-o  text-danger'></span> Gerar Pdf
    </a>";
                        echo "<table width='80%'  style='width: 70%' class='table table-bordered table-striped'>".
                            "<thead>"."<tr>
                <th>Desaparecido(a)</th>
                <th>Detalhes</th>
            </tr>
            </thead><tbody>
            <tr>
        <td ><img width = '150px' height='150px' style='border-radius:100%;'
                 src='../admin/midia/foto_desaparecido/".
                            $dados['foto']."' alt='".$dados['nome_completo']."'/></td></tr>

                <tr>
                <td class='td' >Nº do Processo</td><td class='td' style='text-align:center;'>".
                            $dados['id_desaparecido']."</td></tr><tr>
                <td class='td' >Nome Completo</td><td class='td' style='text-align:center;'>".
                            $dados['nome_completo']."</td></tr><tr>
                <td class='td'>Idade</td><td class='td' style='text-align:center;'>".
                            $dados['idade']."</td></tr><tr>
                <td class='td'>Pai</td><td class='td' style='text-align:center;'>".
                            $dados['nome_pai']."</td></tr><tr>
                <td class='td'>Mãe</td><td class='td' style='text-align:center;'>".
                            $dados['nome_mae']."</td></tr><tr>
                <td class='td'>Telefone</td><td class='td' style='text-align:center;'>".
                            $dados['telefone1']."</td></tr><tr>
                <td class='td'>Telefone Alternativo</td><td class='td' style='text-align:center;'>".
                            $dados['telefone2']."</td></tr>
                <tr>
                 <td class='td'>Descrição</td><td class='td' style='text-align:center;'>".
                            $dados['descricao']."</td>
</tr><tr>
                 <td class='td'>Caracteristicas Especiais</td><td class='td' style='text-align:center;'>".
                            $dados['caracteristicas_especiais']."
</td></tr>
                <tr>
                <td class='td'>Desaparecimento</td><td class='td' style='text-align:center;'>".
                            $dados['data_desaparecimento']."</td></tr><br><tr>
                <td class='td'>Registro no Sistema</td><td class='td' style='text-align:center;'>".
                            $dados['dataRegistro']."</td></tr><tr>
                <td class='td'>Registrado Por</td><td class='td' style='text-align:center;'>".
                            $dados['postado_por']."</td></tr></tbody></table><br><br>
                 ";

                    }





                } else{

                    echo"<script language='javascript'>alert('Digite o Id do Desaparecido!')</script>";
                    echo '<script type="text/javascript">window.location ="index.php"</script>';
                }




                ?></div>
    </section></center><!-- /.content -->
</div><!-- /.content-wrapper -->

</div>

<style>
    thead	{
        background-color: #999;
    }
    thead th	{
        font-weight:	bold;
        padding: 0.3em 1em;
        text-align:	center;
        color: #fff;
    }
    td, .td	{
        padding: 0.3em;
        color: #555;
        font-weight: bold;
        font-size: 15px;
        border: 0px;
    }
    tr:nth-child(2n)	{
        background-color: #ccc;
    }
    td:first-child	{
        font-style: normal;
    }
</style>

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
    }/*
}
else{
    header("Location:../../login-usuario.php");
}*/
?>