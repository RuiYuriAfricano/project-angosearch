<?php

session_start();
if($_SESSION['nome_admin']) {
    ?>

    <?php
    $id=$_POST['id_esquadra'];
    $esq = $_POST['esquadra'];
    $func = $_POST['func'];
    if(empty($id)){
        echo" <script>

                        alert('Nenhuma Esquadra Anotada!');
                        window.location('view_esquadra.php');
        </script> ";
    }else{

    include '../admin/include/conexao.php';
    $con= conecta();



        $teste = $con->query("select * from login where fk_esquadra='$id'") or die("erro login".mysql_error());

        if(mysqli_num_rows($teste) > 0){
            echo" <script>

                        alert('Esta Esquadra Já Possui Acesso!');
                        window.location='view_esquadra.php';
        </script> ";
        }else{



    $sql =$con ->query("select * from definicoes where id_definicoes='1' ") or die(mysql_error());

    $linhas = mysqli_num_rows($sql);
    $dados = mysqli_fetch_assoc($sql);

    /* rodape base de dados*/
    $sq =$con ->query("select * from rodape where id_rodape='1' ") or die(mysql_error());

    $linha = mysqli_num_rows($sq);
    $dado = mysqli_fetch_assoc($sq);




    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Adicionar Usuário | Angosearch</title>
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
                    Adicionar Usuário
                    <small>Painel de Controle</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Esquadra</a></li>
                    <li class="active">Visualizar</li><li class="active">+ usuário</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Small boxes (Stat box) -->
                <div class="row" id="resumo">
                    <br>


                    <!-- left column -->
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title"><img src="../admin/midia/img/<?php echo $func; ?>"
                                                           alt="<?php echo $func; ?>"
                                                           style="width: 1auto; height:160px;border-radius: 100%;"   alt="User Image" />
                                    <?php echo $esq; ?></h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" method="post" action="processa_add_login.php" >
                                <div class="box-body" style="border-bottom: solid #333">
                                    <div class="form-group has-feedback">
                                        <label for="exampleInputEmail1">Usuário</label>
                                        <input type="text" name="usuario" id="uname" class="form-control" value=""/>
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                        <input type="hidden" class="form-control" id="dat" name="dt">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="exampleInputPassword1">Senha</label>
                                        <input type="password" name="senha" id="uname" class="form-control" value=""/>
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                        <input type="hidden" class="form-control"  name="esquadraID" value="<?php echo $id; ?>">
                                    </div>



                                </div><!-- /.box-body -->

                                <body class="hold-transition lockscreen">
                                <!-- Automatic element centering -->
                                <div class="lockscreen-wrapper">

                                    <!-- User name -->
                                    <div class="lockscreen-name"><div class="help-block text-center">
                                            Digite a sua palavra passe, para efectuar esta tarefa...
                                        </div></div>

                                    <!-- START LOCK SCREEN ITEM -->
                                    <div class="lockscreen-item">
                                        <!-- lockscreen image -->

                                        <!-- /.lockscreen-image -->

                                        <!-- lockscreen credentials (contains the form) -->


                                        <div class="input-group">

                                            <input type="password" class="form-control" name="senhaADM"  required="required" placeholder="sua palavra passe">


                                        </div>


                                        <!-- /.lockscreen credentials -->

                                    </div>
                                    <!-- /.lockscreen-item -->


                                </div>


                                </body>
                                <div class="box-footer">
                                    <button class="btn btn-primary" type="submit"  name="sub">
                                    <span	class="glyphicon	glyphicon-ok"></span> Enviar
                                    </button>
                                    <a href="view_esquadra.php" class="btn btn-danger" >
                                    <span	class="glyphicon	glyphicon-remove"></span> Cancelar
                                    </a>
                                </div>
                            </form>
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
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    </body>
    </html>

<?php }}}else{
    header("Location:../../login-usuario.php");
}?>