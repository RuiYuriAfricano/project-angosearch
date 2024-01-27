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


    if(isset($_POST['excluir'])) {
        $data = date('d') . "-" . date('m') . "-" . date('Y');


        $id_esquadra = $_POST['id_esquadra'];



        $del = $con->query("update esquadra set estado='1' where id_esquadra='$id_esquadra' and estado='0'")
        or die("Erro Ao Eliminar");
        $del_login = $con->query("update login set estado='1' where fk_esquadra='$id_esquadra' and estado='0'")
        or die("Erro Ao Eliminar esquadra");

        header("Location:esquadras_excuidas.php?msg=excluir");

    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Visualizar Esquadra | Angosearch</title>
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
        Esquadras Excluídas
        <small>Painel de Controle</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-circle-o"></i> Esquadra</a></li>
        <li class="active">Visualizar</li><li class="active">Excluídas</li>
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
            if ($_REQUEST["msg"] == "excluir") {

                ?>
                <span class='notification n-success'>Restaurado Com Sucesso .......!!</span>
            <?php }


            if($_REQUEST["msg"]=="cancelado"){
                ?>
                <span class='notification n-success'>Cancelado.......!!</span>
            <?php }}?>
    </div>
    <!-- left column -->
    <div class="col-lg-9    table-responsive" style="  width: 100%;
background:#fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px;">
        <style>
            .vd th , .vd td{
                color: #005fcb;
            }
        </style>
        <?php

        $con=conecta();

        $docs = $con->query("select * from esquadra where estado='0'");
        $totalDocs = mysqli_num_rows($docs);

        $sql=$con->query("select id_esquadra, esquadra, numero, dataRegistro,func_esquadra,func_foto,registrado_por,data_excluido,
 removido_por,tipoEsquadra, bairro
 from esquadra,tipoesquadra,bairro where estado='0'and
 fk_tipoEsquadra=id_tipoEsquadra
 and fk_bairro=id_bairro ORDER  by data_excluido desc ");

        ?> <h5 align="left" style="color: #999;"><?php if($totalDocs > 1){
                echo $totalDocs." Esquadras Excluidas";}
            else if($totalDocs == 0){
                echo "Nenhuma Esquadra Excluida";
            }
            if($totalDocs == 1){
                echo $totalDocs." Esquadra Excluida";}
            ?></h5>

        <table  style="text-align: center;"  width="100%" class="table table-bordered table-hover">
            <thead style="color: #fff;background-color: #3c8dbc"> <tr >
                <th width="96" align="center">Fotográfia</th>
                <th width="96" align="center">Funcionário</th>
                <th width="96" align="center">Esquadra</th>
                <th width="96" align="center">Número</th>
                <th width="96" align="center">Tipo</th>
                <th width="196" align="center">Registrado Por</th>
                <th width="96" align="center">Data de Registro</th>
                <th width="196" align="center">Excluida Por</th>
                <th width="96" align="center">Excluída desde</th>
                <th></th>

                <th width="96" align="right"><a href="view_esquadra.php">
                        <button class="btn btn-default" style="float:right;">Voltar</button></a></th>



            </tr></thead>
            <?php while($dados=mysqli_fetch_array($sql)){ $ft = $dados['func_foto']?>
                <tr class="vd">
                    <td width="92" align="">
                        <img src="../admin/midia/img/<?php echo $ft; ?>" alt="<?php echo $ft; ?>"
                             width = '90px' height='90px' style='border-radius:100%;'></td>
                    <td width="202" align=""><?php echo $dados['func_esquadra'];?></td>
                    <td width="202" align=""><?php echo $dados['esquadra'];?></td>
                    <td width="202" align=""><?php echo $dados['numero'];?></td>
                    <td width="60" align=""id="bt4"><?php echo $dados['tipoEsquadra'];?></td>
                    <td width="196" align=""><?php echo $dados['registrado_por'];?></td>
                    <td width="202" align=""><?php echo $dados['dataRegistro'];?></td>
                    <td width="196" align=""><?php echo $dados['removido_por'];?></td>

                    <td width="202" align=""><?php echo date('d-m-Y',strtotime($dados['data_excluido']));?></td>


                    <td align="center"> <a href="mais_esquadra.php?id_esquadra=<?php echo ($dados['id_esquadra']);?> &&
                     esquadra=<?php echo ($dados['esquadra']);?>"
                                           style="">
                            <button class="btn btn-warning" style="font-size: 12px;"><span	class="glyphicon   glyphicon-eye-open"></span>
                                Visualizar </button></a></td>
                    <td align="center"> <a href="#"
                                           style="">
                            <button class="btn btn-primary" style="font-size: 12px;"><span	class="glyphicon   glyphicon-sign-out"></span>
                                Restaurar </button></a></td>

                </tr>


            <?php }//end if ?></table>
    </div></center></div>
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

<?php }else{
    header("Location:../../login-usuario.php");
} ?>