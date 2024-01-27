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




        $id_doc = $_POST['id_doc'];


        $del = $con->query("update documentos set estado='1' where id_doc='$id_doc'
 and estado='0'")
        or die("Erro Ao Eliminar");

        header("Location:doc_encontrados.php?msg=excluir");




    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Documentos Encontrados | Angosearch</title>
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
        Documentos Encontrados
        <small>Painel de Controle</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-files-o"></i> Documentos Perdidos</a></li>
        <li class="active">Encontrados</li>
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

        <div class="table-responsive" style="  width: 100%;
background:#fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px; padding-left: 20px;padding-right: 20px;">

            <?php

            $con=conecta();

            $docs = $con->query("select * from documentos where estado='0'");
            $totalDocs = mysqli_num_rows($docs);

            $sql=$con->query("SELECT * FROM documentos
WHERE estado = '0'  ORDER  BY  dataExcluido DESC");


            ?>
            <h5 align="left" style="color: #999;"><?php if($totalDocs > 1){
                    echo $totalDocs." Documentos Encontrados";}
                else if($totalDocs == 0){
                    echo "Nenhum Documento Encontrado";
                }
                if($totalDocs == 1){
                    echo $totalDocs." Documento Encontrado";}
                ?></h5>

            <table   style="text-align: center;"  width="100%" id="example1" class="table table-bordered table-hover" >
                <thead style="color: #fff;background-color: #3c8dbc"> <tr >
                    <th width="192" align="center">Documento</th>
                    <th  align="center"id="bt4" width="15" height="">processo Nº</th>

                    <th width="192" align="center">Nome do Documento</th>

                    <th width="192" align="center">Detalhe</th>
                    <th width="192" align="center">Postado Por</th>
                    <th width="192" align="center">Encontrado desde</th>


                    <th width="192" align="center">Removido desde</th>
                    <th width="192" align="center">Removido Por</th>
                    <th width="192" align="center"></th>


                    <th width="192" align="center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default"><span	class="glyphicon	glyphicon-list"></span>
                                Ver</button>
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="view_docPerdidos.php">Perdidos</a> </li>
                                <li><a href="doc_excluidos.php">Excluidos</a> </li>

                            </ul>
                        </div>
                    </th>




                </tr></thead>
                <?php while($dados=mysqli_fetch_array($sql)){ $ft=$dados['fotografia'];?>
                    <tr class="vd">
                        <td width="192" align=""><input type="hidden" value="<?php echo ($dados['id_doc']);?>" name="id_doc">
                            <img src="../admin/midia/documentos/<?php echo $ft; ?>" alt="<?php echo $ft; ?>"
                                 width = '120' height='80' style='border-radius:3px;'></td>
                        <td width="15" align=""><?php echo $dados['id_doc'];?></td>


                        <td width="192" align=""><?php echo $dados['nome_doc'] ?></td>
                        <td width="192" align=""><?php echo $dados['detalhe'];?></td>
                        <td width="192" align=""><?php echo $dados['postado_por'];?></td>
                        <td width="192" align=""><?php echo $dados['dataEncontrado'];?></td>
                        <td width="192" align=""><?php echo $dados['dataExcluido'];?></td>
                        <td width="192" align=""><?php echo $dados['removido_por'];?></td>
                        <td width="10" align="center"> <a href="mais_documento.php?id_doc=<?php echo ($dados['id_doc']);?>&&
                         nome=<?php echo ($dados['nome_doc']);?>"
                                                          style="">
                                <button class="btn btn-warning" style="font-size: 12px;"><span	class="glyphicon	glyphicon-eye-open"></span>
                                    Visualizar </button></a></td>
                        <form method="post" action="">
                            <input type="hidden" class="form-control" id="dat" name="dt">
                            <input type="hidden" value="<?php echo ($dados['id_doc']);?>" name="id_doc">

                            <td width="92"><a  href="doc_encontrados.php?id_doc=<?php echo ($dados['id_doc']);?> ">
                                    <button class="btn btn-danger" style="font-size: 12px;" type="submit" name="excluir">
                                        <span	class="glyphicon	glyphicon-remove"></span>
                                        Excluir </button></a></td>
                        </form>
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
<script src="plugins/jquery/dist/jquery.min.js"></script>
<script src="plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src='plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js" type="text/javascript"></script>

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
</script></body>
</html>

<?php }else{
    header("Location:../../login-usuario.php");
} ?>