<?php

session_start();
if($_SESSION['nome_admin']) {
?>

    <?php
include '../admin/include/conexao.php';
$con= conecta();

$sql =$con ->query("select * from definicoes where id_definicoes='1' ") or die(mysql_error());

$linhas = mysqli_num_rows($sql);
$dados = mysqli_fetch_assoc($sql);

/* rodape base de dados*/
$sq =$con ->query("select * from rodape where id_rodape='1' ") or die(mysql_error());

$linha = mysqli_num_rows($sq);
$dado = mysqli_fetch_assoc($sq);

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
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $nome; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?php include "include/links.php"; ?>
</head>
<body class="skin-blue" onload="setInterval('apresentaData()',1000);">
<div class="wrapper">

<header class="main-header">
    <!-- Logo -->
    <?php include "include/cabecalhoTopo.php"; ?>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <?php include "include/cabecalho.php"; ?>
</aside>

<!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Mais Sobre : <?php echo $nome; ?>
        <small>Painel de Controlo</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Documentos Perdidos</a></li>
        <li class="active">Visualizar</li>
    </ol>
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
    </a><h3 align='center'>".$dados['nome_doc']."</b></h3>";
                    echo "<table  class='table table-bordered table-striped' width='80%' style='width: 70%;background: #fff;'>".
                        "<thead>"."<tr>
                <th>Documento</th>
                <th>Detalhes</th>
            </tr>
            </thead><tbody>
            <tr>
                <td>Imagem</td><td><img width = '250' height='150' style='border-radius:26px;float:right;'
                 src='../admin/midia/documentos/".
                        $dados['fotografia']."' alt='".$dados['fotografia']."'/></td></tr><tr>
                <td>Designação</td><td>".
                        $dados['nome_doc']."</td></tr>

                <tr>
                <td>Descrição</td><td>".
                        $dados['detalhe']."</td></tr><tr>
                <td>Código</td><td>".
                        $dados['codigo_doc']."</td></tr><tr>
                <td>Data de Registro</td><td>".
                        $dados['dataRegistro']."</td></tr><tr>
                <td>Registrado Por</td><td>".
                        $dados['postado_por']."</td></tr>

                        <tfoot><tr><td>Estado :</td><td>".$est."</td></tr></tfoot></tbody></table><br><br>
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
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<footer class="main-footer">
    <?php include "include/rodape.php"; ?>
</footer>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.3 -->
<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
<!-- jQuery UI 1.11.2 -->
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Morris.js charts -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js" type="text/javascript"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js" type="text/javascript"></script>
</body>
</html>

<?php }}else{
    header("Location:../../login-usuario.php");
} ?>