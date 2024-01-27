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
$nome = $_GET['esquadra'];
$id=$_GET['id_esquadra'];
if($id==""){

    echo "
<META HTTP-EQUIV=REFRESH CONTENT = '0;
URL =http://localhost/Projecto%20Final%20-%20Loide%20Laura/php/angosearch/admin/principal_admin.php'>
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
        <small>Painel de Controle</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-circle-o"></i> Esquadra</a></li>
        <li class="active">Visualizar</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
<!-- Small boxes (Stat box) -->
<div class="row" id="resumo" style="">
    <br>
    <center>
        <?php
        if($_GET["id_esquadra"]!=""){



            $sql=$con->query("select id_esquadra, esquadra, numero, dataRegistro,func_esquadra,estado,func_foto,registrado_por, tipoEsquadra,
bairro
 from esquadra,tipoesquadra,bairro where id_esquadra='$id' and
 fk_tipoEsquadra=id_tipoEsquadra
 and fk_bairro=id_bairro ORDER  by id_esquadra desc ");




                while ($dados = mysqli_fetch_assoc($sql)) {

                    if($dados['estado']==1){
                        $est="<span class='text-primary'>Activa</span>";
                    }
                    elseif($dados['estado']==0){
                        $est="<span class='text-danger'>Excluída</span>";
                    }

                    echo "<br><a href='gerarPdfEsquadra.php?id_esquadra=".$dados['id_esquadra']."'  style='position:absolute;left: 232px '>
        <span class='fa fa-print  text-danger'></span> imprimir
    </a>";
                    echo "<table  class='table table-bordered table-striped' style='border: 0; width: 70%;background: #fff'>".
                        "<thead>"."<tr>
                <th>Funcionário(a)</th>
                <th>Detalhes</th>
            </tr>
            </thead><tbody>
            <tr>
        <td ><img width = 'auto' height='200' style='border-radius:100%;'
                 src='../admin/midia/img/".
                        $dados['func_foto']."' alt='".$dados['esquadra']."'/></td></tr>

                <tr>
                <td class='td' >Nº do Processo</td><td class='td' style='text-align:center;'>".
                        $dados['id_esquadra']."</td></tr><tr>
                <td class='td' >Funcionário(a) Esquadra</td><td class='td' style='text-align:center;'>".
                        $dados['func_esquadra']."</td></tr><tr>
                <td class='td'>Número</td><td class='td' style='text-align:center;'>".
                        $dados['numero']."</td></tr><tr>
                <td class='td'>Tipo</td><td class='td' style='text-align:center;'>".
                        $dados['tipoEsquadra']."</td></tr><tr>
                <td class='td'>Bairro</td><td class='td' style='text-align:center;'>".
                        $dados['bairro']."</td></tr><tr>
                <td class='td'>Data de Registro</td><td class='td' style='text-align:center;'>".
                        $dados['dataRegistro']."</td></tr><tr>
                <td class='td'>Registrado Por</td><td class='td' style='text-align:center;'>".
                        $dados['registrado_por']."</td></tr><tr><td class='td'>Estado :</td><td class='td' style='text-align:center;'>
                        ".$est."</td></tr>
                </tbody></table><br><br>
                 ";

                }





        } else{

            echo"<script language='javascript'>alert('Digite o Id da esquadra!')</script>";
            echo '<script type="text/javascript">window.location ="index.php"</script>';
        }




        ?></center></div>
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