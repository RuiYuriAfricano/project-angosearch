                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php

session_start();
if($_SESSION['nome_admin']) {


    if(!$_GET['id_esquadra']){
        echo" <script>

                        alert('Nenhum Esquadra Anotada!');
                        window.location('view_esquadra.php');
        </script> ";
    }else{
        $id=$_GET['id_esquadra'];
        $esq = $_GET['esquadra'];
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



        if(isset($_POST['sub'])) {
            $usuario = $_POST['usuario'];
            $senha = $_POST['senha'];
            $esquadra = $_POST['esquadra'];


            if ($usuario == "" or $senha == "" or $esquadra == "") {
                header('Location:adicionar_loginEsquadra.php?msg=erro');
            } else {

                $s = $con->query("select id_esquadra from esquadra where esquadra='$esquadra'") or die
                ("Erro");
                $li = mysqli_num_rows($s);

                if ($li > 0) {


                    while ($d = mysqli_fetch_assoc($s)) {


                        $esquadra = $d['id_esquadra'];


                    }


                }

                $nova_senha = md5($senha);


                $insere = $con->query("INSERT INTO login(id_login,usuario,senha,acesso,estado,fk_esquadra)
 VALUES (default,'$usuario', '$nova_senha', 'esquadra','1', '$esquadra')")
                or die ("erro ao cadastrar esquadra".mysql_error());


                header('Location:adicionar_loginEsquadra.php?msg=add');

            }
        }


        $teste = $con->query("select * from login where fk_esquadra='$id'") or die("erro login".mysql_error());

        if(mysqli_num_rows($teste) > 0){
            echo" <script>

                        alert('Esta Esquadra Já Possui Acesso!');
                        window.location('view_esquadra.php');
        </script> ";
        }else{

            ?>

            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8">
                <title>Adicionar Login | Angosearch</title>
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
                            <small>Painel de Controlo</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-home"></i> Principal</a></li>
                            <li class="active">AngoSearch</li>
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
                                    if ($_REQUEST["msg"] == "1") {

                                        ?>
                                        <span class='notification n-success'>Registrado com Sucesso.......!!</span>
                                    <?php }

                                    if ($_REQUEST["msg"] == "2") {

                                        ?>
                                        <span class="notification n-error">Erro: Fotografia Muito grande, escolhe uma de tamanho menor .</span>
                                    <?php }
                                    if ($_REQUEST["msg"] == "3") {
                                        ?>
                                        <span class='notification n-error'>Erro: Extensão Inválida</span>



                                    <?php }


                                    if ($_REQUEST["msg"] == "4") {

                                        ?>


                                        <span class='notification n-error'>Insira a foto do Funcionário !</span>



                                    <?php }
                                    ?><?php

                                    if($_REQUEST["msg"]=="erro")
                                    {

                                        ?>
                                        <span class="notification n-error">Erro: Preencha os Campos.</span>
                                    <?php }}?>
                            </div>


                            <!-- left column -->
                            <div class="col-md-9">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <h3 class="box-title">Adicionar Login a : <?php echo $esq; ?></h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <form role="form" method="post" action="" enctype="multipart/form-data">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Esquadra</label>
                                                <input type="text" name="esquadra" id="uname" class="form-control" value=""/>
                                                <input type="hidden" class="form-control" id="dat" name="dt">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Número</label>
                                                <input type="text" name="numero" id="uname" class="form-control" value=""/>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile">Tipo Esquadra</label>
                                                <select class="form-control" name="Tesquadra" id="type" />
                                                <?php $sql = $con->query("select tipoEsquadra
 from tipoesquadra") or die("Erro na Busca");



                                                $linhas = mysqli_num_rows($sql);

                                                if ($linhas > 0) {

                                                    while ($dados1 = mysqli_fetch_assoc($sql)) { ?>
                                                        <option><?php echo $dados1["tipoEsquadra"]; ?></option><?php } } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile">Localização</label>
                                                <select class="form-control" name="bairro" id="type" />
                                                <?php $sql = $con->query("select bairro
 from bairro") or die("Erro na Busca");



                                                $linhas = mysqli_num_rows($sql);

                                                if ($linhas > 0) {

                                                    while ($dados = mysqli_fetch_assoc($sql)) { ?>
                                                        <option><?php echo $dados["bairro"]; ?></option><?php } } ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Funcionário da Esquadra</label>
                                                <input type="text" name="func_esquadra" id="uname" class="form-control" value=""/>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Foto do Funcionário</label>
                                                <input type="file" class="input-medium"  name="foto_func">
                                            </div>

                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> Check me out
                                                </label>
                                            </div>
                                        </div><!-- /.box-body -->

                                        <div class="box-footer">
                                            <button class="btn btn-primary" type="submit"  name="sub"/>
                                            <span	class="glyphicon	glyphicon-ok"></span> Registrar
                                            </button>
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

        <?php   }
    }
}else{
    header("Location:../../login-usuario.php");
}?>