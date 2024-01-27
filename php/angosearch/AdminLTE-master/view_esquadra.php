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
    $dataExcluido = $_POST['dt'];
    $removido_por = "admin: ".$_SESSION['nome_admin'];

    $id_esquadra = $_POST['id_esquadra'];



    $del = $con->query("update esquadra set estado='0',data_excluido='$dataExcluido',removido_por='$removido_por'
 where id_esquadra='$id_esquadra' and estado='1'")
    or die("Erro Ao Eliminar");
    $del_login = $con->query("update login set estado='0' where fk_esquadra='$id_esquadra' and estado='1'")
    or die("Erro Ao Eliminar esquadra");

    header("Location:view_esquadra.php?msg=excluir");

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
        Esquadras Registradas
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
<div class="row" id="resumo">
    <br>
    <div style="">
        <?Php
        if(isset($_REQUEST["msg"])) {
            if ($_REQUEST["msg"] == "excluir") {

                ?>
                <span class='notification n-success'>Esquadra excluída.......!!</span>
            <?php }


            if($_REQUEST["msg"]=="cancelado"){
                ?>
                <span class='notification n-success'>Cancelado.......!!</span>
            <?php }
            if($_REQUEST["msg"]=="edit") {

                ?>
                <span class='notification n-success'>Editado com sucesso.......!!</span>
            <?php
            }
            if($_REQUEST["msg"]=="erro"){

                ?>
                <span class='notification n-error'>erro: Preencha os campos por favor!</span>
            <?php }
             if($_REQUEST["msg"]=="senhaerror"){
            ?>
            <span class='notification n-error'>Senha digitada não está correcta..!!</span>
        <?php }


            if ($_REQUEST["msg"] == "add") {

                ?>
                <span class='notification n-success'>Login Adcionado com Sucesso.......!!</span>
            <?php

            } if ($_REQUEST["msg"] == "desativar") {

                ?>
                <span class='notification n-success'>usuário desativado com sucesso.......!!</span>
            <?php

            }}
        ?></div>

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

        $docs = $con->query("select * from esquadra where estado='1'");
        $totalDocs = mysqli_num_rows($docs);

        $sql=$con->query("select id_esquadra, esquadra, numero, dataRegistro,email,telefone,func_esquadra,func_foto,registrado_por, tipoEsquadra, bairro
 from esquadra,tipoesquadra,bairro where estado='1'and
 fk_tipoEsquadra=id_tipoEsquadra
 and fk_bairro=id_bairro ORDER  by id_esquadra desc ");

        ?>
        <h5 align="left" style="color: #999;"><?php if($totalDocs > 1){
                echo $totalDocs." Esquadras Registradas";}
            else if($totalDocs == 0){
                echo "Nenhuma Esquadra Registrada";
            }
            if($totalDocs == 1){
                echo $totalDocs." Esquadra Registrada";}
            ?></h5> <a href='gerarPdfEsquadras.php'  style='float: right '>
            <span class='fa fa-print  text-danger'></span> Imprimir
        </a><br>

        <table  style="text-align: center;" id="example1"  width="100%" class="table table-bordered table-hover">
            <thead style="color: #fff;background-color: #3c8dbc"> <tr >
                <th width="96" align="center">Fotográfia</th>
                <th width="96" align="center">Funcionário(a)</th>
                <th width="96" align="center">Esquadra</th>
                <th width="96" align="center">Número</th>
                <th width="96" align="center">Tipo</th>
                <th width="46" align="center">Bairro</th>
                <th width="46" align="center">Telefone & E-mail</th>


                <th width="96" align="center"><small>Acesso no Sistema</small></th>
                <th width="96" align="center"><small>Esquadra Registrada</small></th>
                <th width="96" align="center"><a href="esquadras_excuidas.php">
                        <button class="btn btn-default" >Excluídas </button></a></th>



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
                    <td width="46" align=""><?php echo $dados['bairro'];?></td>
                    <td width="46" align=""><?php echo $dados['telefone'] .'  '.$dados['email'];?></td>



                    <td align="center" width="192">
                        <div class="margin"> <div class="btn-group">
                                <button type="button" class="btn btn-warning"><span	class="glyphicon	glyphicon-list"></span>
                                </button>
                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <form method="post" action="add_loginEsquadra.php">
                                            <input type="hidden" class="form-control"  name="func" value="<?php echo ($dados['func_foto']);?>">
                                            <input type="hidden" value="<?php echo ($dados['id_esquadra']);?>" name="id_esquadra">
                                            <input type="hidden" value="<?php echo ($dados['esquadra']);?>" name="esquadra">

                                            <a href="add_loginEsquadra.php?id_esquadra=<?php echo ($dados['id_esquadra']);?> &&
                     esquadra=<?php echo ($dados['esquadra']);?>&&
                     func=<?php echo ($dados['func_esquadra']);?>"
                                           style="">
                                            <button class="btn btn-link" style="font-size: 12px;" type="submit"><span	class="glyphicon   glyphicon-plus"></span>
                                                Usuário </button></a></form></li>
                                    <li><a href="ver_loginEsquadra.php?id_esquadra=<?php echo ($dados['id_esquadra']);?> &&
                     esquadra=<?php echo ($dados['esquadra']);?>&&
                     func=<?php echo ($dados['func_esquadra']);?>"
                                           style="">
                                            <button class="btn btn-link" style="font-size: 12px;"><span	class="glyphicon   glyphicon-eye-open"></span>
                                                Ver usuário </button></a></li>

                                </ul>
                            </div></div>

                        </td>



                    <td align="center" width="192">
                        <div class="margin"> <div class="btn-group">
                            <button type="button" class="btn btn-primary"><span	class="glyphicon	glyphicon-list"></span>
                                </button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="editar_esquadra.php?id_esquadra=<?php echo ($dados['id_esquadra']);?> "
                                       style=""><span	class="glyphicon   glyphicon-edit"></span>
                                            Editar </a></li>
                                <li><a href="mais_esquadra.php?id_esquadra=<?php echo ($dados['id_esquadra']);?> &&
                     esquadra=<?php echo ($dados['esquadra']);?>"
                                       style=""><span	class="glyphicon   glyphicon-eye-open"></span>
                                            Visualizar </a></li>

                            </ul>
                        </div></div>

                    </td>


                        <td align="center"> <div class="margin">
                                <div class="btn-group"><a href="excluir_esquadra.php?id_esquadra=<?php echo ($dados['id_esquadra']);?> &&
                esquadra=<?php echo ($dados['esquadra']);?> &&
                foto=<?php echo ($dados['func_foto']);?> ">

                                <button class="btn btn-danger" style="font-size: 12px;" type="submit" name="excluir"><span	class="glyphicon	glyphicon-remove"></span>
                                    Excluir </button></a></div></div></td>



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
</script>
</body>
</html>

<?php }else{
    header("Location:../../login-usuario.php");
} ?>