
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


    if(isset($_POST['editar'])) {
        $rodape = $_POST['rodape'];


        if ($rodape == "" ) {
            header('Location:rodape.php?msg=erro');
        } else {


            try{
            $atualiza = $con->query("UPDATE rodape SET rodape='$rodape' WHERE id_rodape='1'");

            if($atualiza===FALSE):
                throw new Exception('problemas'.$con->errno.'---'.$con->error.'<br/>');
                else:
            header('Location:rodape.php?msg=add');
                    endif;
                }
            catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Editar Rodapé</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <script type="text/javascript" src="../admin/js/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="../admin/js/ckfinder/ckfinder.js"></script>
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
                    Administrador
                    <small>Painel de Controle</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-gears"></i> Definições</a></li>
                    <li class="active">Editar Rodapé</li>
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
                        if($_REQUEST["msg"]=="add")
                        {

                            ?>
                            <span class='notification n-success'>Alterações Efectuada com Sucesso.......!!</span>
                        <?php }

                        if($_REQUEST["msg"]=="erro")
                        {

                            ?>
                            <span class="notification n-error">Erro: Preencha os Campos.</span>
                        <?php }}?></div>


                    <!-- left column -->

                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Editar Rodapé do Portal</h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->
                            <center>
                                <div class="col-lg-9    table-responsive" style=" width: 100%;
background:#fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px;">

                                    <?php


                                    $sql=$con->query("select * from rodape where id_rodape='1'");

                                    ?>
                                    <form class="row contact_form" action="" method="post" id="contactForm" novalidate="novalidate" onsubmit="ap();">
                                        <table  border="0" cellspacing="10px" cellpadding="2px"style="width: 100%;">

                                            <?php while($dados=mysqli_fetch_array($sql)){ ?>


                                                <tr>
                                                    <td  align="right" style="vertical-align:top;">Rodapé: </td>

                                                    <td align="left" style="width: 100%;"><textarea name="rodape" rows="3"    id="sobre"  >
                                                            <?php echo  ($dados['rodape']);?></textarea>
                                                        <script type="text/javascript">
                                                            var editor = CKEDITOR.replace( 'rodape', {
                                                                filebrowserBrowseUrl : 'js/ckfinder/ckfinder.html',
                                                                filebrowserImageBrowseUrl : 'js/ckfinder/ckfinder.html?type=Images',
                                                                filebrowserFlashBrowseUrl : 'js/ckfinder/ckfinder.html?type=Flash',
                                                                filebrowserUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                                                filebrowserImageUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                                                filebrowserFlashUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                                                            });
                                                            CKFinder.setupCKEditor( editor,'js/' );
                                                        </script>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td align="left"> <br>



                                    <button class="btn btn-primary" style="" type="submit" name="editar">
                                        <span	class="glyphicon	glyphicon-edit"> </span> Efectuar Alterações
                                    </button>

                                                        <input type="button" class="btn btn-danger" style="" value="Cancelar"
                                                               onclick="javascript:window.location='rodape.php';" >
                                                    </td> </tr>


                                            <?php }//end if ?></table></form>
                                </div></center>
                        </div>
            </section></div><!-- /.content -->
        <!-- /.content-wrapper -->
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

    <script src="../admin/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../admin/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    </body>
    </html>

<?php }else{
    header("Location:../../login-usuario.php");
}?>