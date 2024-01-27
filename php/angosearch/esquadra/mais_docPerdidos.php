
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
$id=$_GET["id_doc"];;
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

        <title>Visualizar</title>
        <!-- Bootstrap CSS -->
        <!-- Required meta tags -->
        <meta http-equiv="Content­Type" content="text/html;charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../../../css/bootstracss">
        <link rel="stylesheet" href="../adminLTE-master/dist/css/adminLTE.css">

        <link rel="stylesheet" href="../adminLTE-master/bootstrap/css/bootstrap.css">


        <link rel="stylesheet" href="../../../css/font-awesome.min.css">

        <link href="../adminlte-master/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/glyphicon.css">
        <link rel="stylesheet" href="vendors/linericon/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">

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
<body onload="setInterval('apresentaData()',1000);" class="skin-blue layout-top-nav">
<!--================Header Menu Are
a =================-->
<header class="header_area">
    <?php include"include/header.php"; ?>
</header>
<!--================Header Menu Area =================-->

<!--================Home Banner Area =================-->
<br><br>
<!--================End Home Banner Area =================-->
<br>
<!--================Welcome Area =================-->
<center>

<div class="content-">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">

        </ol> <h1>
            Mais Sobre : <?php echo $nome; ?>

        </h1>

    </section>

    <!-- Main content -->

    <section class="content">
        <!-- Small boxes (Stat box) -->

        <br>
        <center>
            <?php
            if($_GET["id_doc"]!=""){

                $id=$_GET["id_doc"];

                $doc=$con->query("SELECT * FROM documentos WHERE  id_doc='$id'");


                $linhas = mysqli_num_rows($sql);

                if ($linhas > 0) {


                    while ($dados = mysqli_fetch_assoc($doc)) {
                        if($dados['estado']==1){
                            $est="<span class='text-primary'>Perdido</span>";
                        }else if($dados['estado']==0){
                            $est="<span class='text-success'>Encontrado desde, ". date('d-m-Y',strtotime($dados['dataEncontrado']))."</span>";
                        }
                        elseif($dados['estado']==2){
                            $est="<span class='text-danger'>Excluído</span>";
                        }

                        echo "<br><a href='gerarPdfDocPerdido.php?id_doc=".$dados['id_doc']."'  style='position:absolute;left: 232px '>
        <span class='fa fa-print  text-danger'></span> Imprimir
    </a><br>";
                        echo "<table  class='table table-bordered table-striped' width='80%' style='width: 70%'>".
                            "<thead>"."<tr>
                <th>Documento</th>
                <th>Detalhes</th>
            </tr>
            </thead><tbody>
            <tr>
                <td>Imagem</td><td><img width = '250' height='150' style='border-radius:26px;float:right;'
                 src='../admin/midia/documentos/".
                            $dados['fotografia']."' alt='".$dados['fotografia']."'/></td></tr><tr>
                <td class='td'>Designação</td><td class='td'>".
                            $dados['nome_doc']."</td></tr>

                <tr>
                <td class='td'>Descrição</td><td class='td'>".
                            $dados['detalhe']."</td></tr><tr>
                <td class='td'>Código</td><td class='td'>".
                            $dados['codigo_doc']."</td></tr><tr>
                <td class='td'>Data de Registro</td><td class='td'>".
                            $dados['dataRegistro']."</td></tr><tr>
                <td class='td'>Registrado Por</td><td class='td'>".
                            $dados['postado_por']."</td></tr>

                        <tfoot><tr><td class='td'>Estado :</td><td>".$est."</td></tr></tfoot></tbody></table><br><br>
                 ";

                    }



                }else{

                    echo"<script language='javascript'>alert('documento não encontrado.!')</script>";
                    echo '<script type="text/javascript">window.location ="index.php"</script>';

                }

            } else{

                echo"<script language='javascript'>alert('Digite o Id do Documento!')</script>";
                echo '<script type="text/javascript">window.location ="index.php"</script>';
            }




            ?>
        </center>
    </section></center><!-- /.content -->
</div>

<!--================Causes Area =================-->

<!--================End Causes Area =================-->


<!--================Event Area =================-->
<!--================End Event Area =================-->


<!--================Clients Logo Area =================-->

<!--================End Clients Logo Area =================-->

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

        border: 0px;
    }
    tr:nth-child(2n)	{
        background-color: #ccc;
    }
    td:first-child	{
        font-style: normal;
    }
</style>
<!--================ start footer Area  =================-->
<br><br><br><br>
<footer class="footer-area section_gap">
    <?php include"include/rodape.php"; ?>
</footer>
<!--================ End footer Area  =================-->

<script src="../adminlte-master/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script src="../adminlte-master/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>



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