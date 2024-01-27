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
$id=$_GET['id_desaparecido'];
if($id==""){

    echo "
<META HTTP-EQUIV=REFRESH CONTENT = '0; URL =http://localhost/Projecto%20Final%20-%20Loide%20Laura/php/angosearch/
adminLTE-master/index.php'>
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
        <li><a href="#"><i class="glyphicon glyphicon-user"></i> Pessoas Desaparecidas</a></li>
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
        if($_GET["id_desaparecido"]!=""){



            $desaparecidos=$con->query("SELECT id_desaparecido,nome_completo,idade,nome_pai,nome_mae,data_desaparecimento,foto,
telefone1,telefone2,dataRegistro,postado_por,descricao,caracteristicas_especiais,bairro,genero,provincia FROM
desaparecidos,bairro,genero,provincia WHERE estado = '1' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia and id_desaparecido='$id' ORDER  BY  id_desaparecido DESC LIMIT 1 ");




                while ($dados = mysqli_fetch_assoc($desaparecidos)) {
            $ds= $dados['nome_completo'];

                    echo "<br><a href='gerarPdfDesaparecido.php?id_desaparecido=".$dados['id_desaparecido']."'
                    style='float:left;'>
        <span class='fa fa-print  text-danger'></span> Imprimir
    </a>";
                    echo "<table class='table table-bordered table-striped'  style='border: 1px;width: 70%;background: #fff;'>".
                        "<thead>"."<tr>
                <th>Desaparecido(a)</th>
                <th>Detalhes</th>
            </tr>
            </thead><tbody>
            <tr>
        <td ><img width = 'auto' height='100px' style='border-radius:100%;'
                 src='../admin/midia/foto_desaparecido/".
                        $dados['foto']."' alt='".$dados['nome_completo']."'/></td></tr>

                <tr>
                <td class='td' >Nº do Processo</td><td class='td' style='text-align:center;'>".
                        $dados['id_desaparecido']."</td></tr><tr>
                <td class='td' >Nome Completo</td><td class='td' style='text-align:center;'>".
                        $dados['nome_completo']."</td></tr><tr>
                <td class='td'>Idade</td><td class='td' style='text-align:center;'>".
                        $dados['idade']."</td></tr><tr>
                <td class='td'>Naturalidade</td><td class='td' style='text-align:center;'>".
                        utf8_encode($dados['provincia'])."</td></tr><tr>
                <td class='td'>Pai</td><td class='td' style='text-align:center;'>".
                        $dados['nome_pai']."</td></tr><tr>
                <td class='td'>Mãe</td><td class='td' style='text-align:center;'>".
                        $dados['nome_mae']."</td></tr><tr>
                <td class='td'>Bairro</td><td class='td' style='text-align:center;'>".
                        $dados['bairro']."</td></tr><tr>
                <td class='td'>Telefone</td><td class='td' style='text-align:center;'>".
                        $dados['telefone1']." / ".$dados['telefone2']."</td></tr>
                <tr>
                 <td class='td'>Descrição</td><td class='td' style='text-align:center;'>".
                        $dados['descricao']."</td>
</tr><tr>
                 <td class='td'>Caracteristicas Físicas</td><td class='td' style='text-align:center;'>".
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




        ?></center>
    <div class="site-section bg-light   col-md-12" id="contact-section" style="color: #999;">
        <div class="container">
            <br><br>
            <div class="row justify-content">
                <div class="col-md-1">



                </div>
                <div class="col-md-8">
                    <section class="content">
                        <h5><span	class="glyphicon	glyphicon-comment"></span> Comentários</h5>
                        <br>
                        <?php


                        $c=$con->query("SELECT id_comentario,comentario,fk_desaparecido,data_comentario,nome_completo,foto
            FROM comentario,utilizador WHERE  fk_desaparecido='$id' and id_utilizador=utilizador and estado_comment='1'
                                            ORDER  BY  id_comentario  DESC  LIMIT 5 ");


                        $l = mysqli_num_rows($c);

                        if ($l > 0) {


                            while ($dados1 = mysqli_fetch_assoc($c)) { ?>


                                <!-- row -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- The time line -->
                                        <ul class="timeline"> <li>
                                                <i class="fa fa-comments bg-yellow"></i>
                                                <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> <?php echo
                                    date('D, d-m-Y H:i',strtotime($dados1['data_comentario'])); ?></span>
                                                    <h3 class="timeline-header"><a href="#"><?php echo $dados1['nome_completo']; ?></a>
                                                        comentou sobre , <?php echo $ds; ?></h3>
                                                    <div class="timeline-body">
                                                        <?php echo utf8_encode($dados1['comentario']); ?>
                                                    </div>

                                                </div>
                                            </li></ul></div></div> <?php }} ?>
                    </section>
                </div>

            </div>
        </div>
    </div>
</div>
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
</body>
</html>

<?php }}else{
    header("Location:../../login-usuario.php");
} ?>