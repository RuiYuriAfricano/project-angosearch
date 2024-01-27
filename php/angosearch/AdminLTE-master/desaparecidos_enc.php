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


        $con = conecta();

        $data = $_POST['dt'];


        $id_desaparecido = $_POST['id_desaparecido'];


        $del = $con->query("update desaparecidos set estado='1' where id_desaparecido='$id_desaparecido'
 and estado='0'")
        or die("Erro Ao Eliminar");

        header("Location:desaparecidos_enc.php?msg=excluir");




    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pessoas Encontradas | Angosearch</title>
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
        Pessoas Encontradas
        <small>Painel de Controle</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="glyphicon glyphicon-user"></i> Pessoas Desaparecidas</a></li>
        <li class="active">Visualizar</li> <li class="active">Encontrados</li>
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
                <span class='notification n-success'>Removido dos Encontrados.......!!</span>
            <?php }


            if($_REQUEST["msg"]=="cancelado"){
                ?>
                <span class='notification n-success'>Cancelado.......!!</span>
            <?php }}?>
    </div>
    <!-- left column -->
    <style>
        .vd td, .vd th{
            color: #005cbf;
        }
    </style>
    <!--================End Welcome Area =================-->

        <div class="table-responsive    no-padding" style="  width: 100%;background-color: #fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px; padding-left: 20px;padding-right: 20px;">

            <?php

            $con=conecta();

            $desaparecidos = $con->query("select * from desaparecidos where estado='0'");
            $totalDesaparecidos = mysqli_num_rows($desaparecidos);

            $sql=$con->query("SELECT id_desaparecido,nome_completo,idade,nome_pai,nome_mae,data_desaparecimento,foto,
telefone1,telefone2,dataRegistro,postado_por,removido_por,dataExcluido,dataEncontrado,bairro,genero,provincia FROM
`desaparecidos`,bairro,genero,provincia WHERE estado = '0' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia ORDER  BY  dataExcluido DESC ");


            ?>
            <h5 align="left" style=""><?php if($totalDesaparecidos > 1){
                    echo $totalDesaparecidos." Pessoas Encontradas";}
                else if($totalDesaparecidos == 0){
                    echo "Nenhuma Pessoa Encontrada";
                }
                if($totalDesaparecidos == 1){
                    echo $totalDesaparecidos." Pessoa Encontrada";}
                ?> </h5>
            <a href=''  style='float: right'>
                <span class='fa fa-file-pdf-o  text-danger'></span> Imprimir
            </a><br><br>
            <table  style="text-align: center;"  width="100%" id="example1" class="table table-bordered table-hover" >
                <thead style="color: #fff;background-color: #3c8dbc"> <tr >
                    <th width="96" align="center">Fotografia</th>
                    <th  align="center"id="bt4"width="40" height="">Processo Nº</th>
                    <th width="96" align="center">Nome</th>
                    <th width="96" align="center">Idade</th>

                    <th width="96" align="center">Telefone</th>
                    <th width="96" align="center">Encontrado(a) desde</th>


                    <th width="96" align="center">Removido(a) desde</th>
                    <th width="96" align="center">Removido(a) por</th>

                    <th width="96" align="center"></th>
                    <th width="296" align="left"> <div class="btn-group">
                            <button type="button" class="btn btn-default"><span	class="glyphicon	glyphicon-list"></span>
                                Ver</button>
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="view_desaparecidos.php">Desaparecidos</a> </li>
                                <li><a href="desap_excluidos.php">Excluidos</a> </li>

                            </ul>
                        </div>
                    </th>




                </tr></thead>
                <?php while($dados=mysqli_fetch_array($sql)){ $ft=$dados['foto'];?>
                    <tr class="vd">
                        <td width="92" align=""><input type="hidden" value="<?php echo ($dados['id_desaparecido']);?>" name="id_desaparecido">
                            <img src="../admin/midia/foto_desaparecido/<?php echo $ft; ?>" alt="<?php echo $ft; ?>"
                                 width = 'auto' height='80px' style='border-radius:50%;'></td>
                        <td width="92" align=""id="bt4"><?php echo $dados['id_desaparecido'];?></td>
                        <td width="92" align=""><?php echo $dados['nome_completo'];?></td>
                        <td width="62" align=""><?php echo $dados['idade'];?></td>

                        <td width="92" align=""id="bt4"><?php echo $dados['telefone1'];?></td>
                        <td width="92" align=""id="bt4"><?php echo date('d-m-Y',strtotime($dados['dataEncontrado']));?></td>


                        <td width="92" align=""><?php echo date('d-m-Y',strtotime($dados['dataExcluido']));?></td>
                        <td width="92" align=""><?php echo $dados['removido_por'];?></td>


                        <td> <a href="mais_encontrados.php?id_desaparecido=<?php echo ($dados['id_desaparecido']);?> &&
                nome=<?php echo ($dados['nome_completo']);?> "
                                style="">
                                <button class="btn btn-warning" style="font-size: 12px;color: #fff"><span	class="glyphicon	glyphicon-eye-open"></span>
                                    Visualizar </button></a></td>


                            <td>
                                <a href="excluir_desap.php?id_desaparecido=<?php echo ($dados['id_desaparecido']);?> &&
                nome=<?php echo ($dados['nome_completo']);?> &&
                foto=<?php echo ($dados['foto']);?> "
                                   style="">
                                    <button class="btn btn-danger" style="font-size: 12px;" type="button" name="excluir"><span	class="glyphicon	glyphicon-remove"></span>
                                        Excluir</button></a></td>



                    </tr>


                <?php }//end if ?></table>
        </div></div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<footer class="main-footer">
    <?php include "include/rodape.php"; ?>
</footer>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.3 -->
<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>

<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- jQuery UI 1.11.2 -->
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->
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
<script src="plugins/jquery/dist/jquery.min.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src='plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js" type="text/javascript"></script>
<script src="dist/js/demo.js" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js" type="text/javascript"></script>

<!-- AdminLTE for demo purposes -->


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

<?php }else{
    header("Location:../../login-usuario.php");
} ?>