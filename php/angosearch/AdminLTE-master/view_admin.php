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


    if(isset($_POST['activar'])) {


        $id=$_POST['id_user'];

        $del = $con->query("update login set estado='1' where id_login='$id' and estado='0' and acesso='admin'")
        or die("Erro Ao Eliminar");


        header("Location:view_admin.php");

    }
    else if(isset($_POST['desactivar'])) {

        $id=$_POST['id_user'];

        $del = $con->query("update login set estado='0' where id_login='$id' and estado='1' and acesso='admin'")
        or die("Erro Ao Eliminar");


        header("Location:view_admin.php");

    }
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Visualizar Admin | Angosearch</title>
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
                    Administrador
                    <small>Painel de Controle</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-user"></i> Administrador</a></li>
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
                            if ($_REQUEST["msg"] == "adminAct") {

                                ?>
                                <span class='notification n-error'>Não é possivel desactivar este Usuário , pelo facto de estar Online.. </span>
                            <?php }
                            else if ($_REQUEST["msg"] == "excluirP") {

                                ?>
                                <span class='notification n-success'>Excluído de forma permanente.</span>
                            <?php }

                            else if($_REQUEST["msg"]=="senhaerror"){
                                ?>
                                <span class='notification n-error'>Senha digitada não está correcta..!!</span>
                            <?php }


                        }?>
                    </div>

                    <?php

                    $con=conecta();

                    $docs = $con->query("select * from esquadra where estado='1'");
                    $totalDocs = mysqli_num_rows($docs);

                    $sql=$con->query("select id_login,admin,dtRegistro,dtActivado,dtDesactivado,estado,foto_admin,adminRegister from
                                                          login where acesso='admin' ORDER  BY dtRegistro desc");

                    ?>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Registrados</h3>

                                    <div class="box-tools">
                                        <div class="input-group input-group-sm" style="width: 150px;">

                                            <div class="input-group-btn">
                                                <a href="add_admin.php"><button type="button" class="btn btn-default">
                                                        <i class="fa fa-plus"></i> Novo ADMIN</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>ID</th>
                                            <th>User</th>
                                            <th>Data de Registro</th>
                                            <th>Registro por</th>
                                            <th>Estado</th>
                                            <th>Fotográfia</th>
                                        </tr>

                     <?php while($dados=mysqli_fetch_array($sql)){ ?>
                                        <tr>
                                            <td><?php echo $dados['id_login'];?></td>
                                            <td><?php echo $dados['admin'];?></td>
                                            <td><?php echo date('d-m-Y', strtotime($dados['dtRegistro']));?></td>
                                            <td><?php echo $dados['adminRegister'];?></td>
                                            <td>
                                                <?php if(($dados['estado'])=='1'){ ?>
                                                <span class="label label-success">Activado desde
                                                    <?php echo date('d-m-Y', strtotime($dados['dtActivado']));?></span>
                                        <?php }
                                                else if(($dados['estado'])=='0'){
                                                    ?>
                                        <span class="label label-danger">Inactivado desde
                                            <?php echo date('d-m-Y', strtotime($dados['dtDesactivado']));?></span>
                                                <?php } ?>
                                            </td>
                                            <td><img src="../admin/midia/img/<?php echo $dados['foto_admin']; ?>" alt="<?php echo $dados['foto_admin']; ?>"
                                                     width = '30px' height='30px' style='border-radius:100%;'></td>

                                            <td>
                                                <?php if(($dados['estado'])=='0'){ ?>

                                                <a href="activar_admin.php?id_login=<?php echo ($dados['id_login']);?> &&
                admin=<?php echo ($dados['admin']);?> &&
                foto=<?php echo ($dados['foto_admin']);?> "
                                                   style="">
                                                    <button type="submit" name="activar" class="btn btn-success">
                                                        <span	class="glyphicon	glyphicon-ok"></span> Activar</button></a>
                                                <?php }
                                                else if(($dados['estado'])=='1'){
                                                    ?>

                                                    <a href="desactivar_admin.php?id_login=<?php echo ($dados['id_login']);?> &&
                admin=<?php echo ($dados['admin']);?> &&
                foto=<?php echo ($dados['foto_admin']);?> "
                                                       style="">
                                                        <button type="submit" name="desactivar" class="btn btn-danger">
                                                            <span	class="glyphicon	glyphicon-remove"></span> Desactivar</button></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
        <?php } ?>

                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>

                        </div></div>
            </section><!-- /.content -->
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
    </body>
    </html>

<?php } else{
    header("Location:../../login-usuario.php");
}?>