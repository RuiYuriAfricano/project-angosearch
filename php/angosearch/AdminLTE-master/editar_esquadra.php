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

    $id_esquadra=$_GET['id_esquadra'];

    if(isset($_POST['sub'])) {
        $senha = md5($_POST['senha']);

        $n=$_SESSION['nome_admin'];
        $q=$con->query("select usuario from login where admin='$n' and estado='1'");
        $pegaUs=mysqli_fetch_array($q);
        $usuario=$pegaUs['usuario'];
        $p= $con->query("select * from login where senha='$senha' and usuario='$usuario' and estado='1'");

        if((mysqli_num_rows($p)) > 0):

        $bairro = $_POST['bairro'];
        $esquadra = $_POST['esquadra'];
        $numero = $_POST['numero'];
        $tipo_esquadra = $_POST['Tesquadra'];
        $func_esquadra = $_POST['func_esquadra'];

        if ($bairro == "" or $esquadra == "" or $tipo_esquadra == "") {
            header('Location:view_esquadra.php?msg=erro');
        } else {
            $sql = $con->query("select * from bairro") or die
            ("Erro");
            $linhas2 = mysqli_num_rows($sql);

            if ($linhas2 > 0) {


                while ($dados2 = mysqli_fetch_assoc($sql)) {

                    $dados2["bairro"];
                    $dados2["id_bairro"];
                    if ($bairro == $dados2["bairro"]) {
                        $bairro = $dados2["id_bairro"];
                    }


                }


            }

            $s = $con->query("select * from tipoesquadra") or die
            ("Erro");
            $li = mysqli_num_rows($s);

            if ($li > 0) {


                while ($d = mysqli_fetch_assoc($s)) {

                    $d["tipoEsquadra"];
                    $d["id_tipoEsquadra"];
                    if ($tipo_esquadra == $d["tipoEsquadra"]) {
                        $tipo_esquadra = $d["id_tipoEsquadra"];
                    }


                }


            }


            $atualiza = $con->query("update esquadra set esquadra='$esquadra' , numero='$numero',
fk_bairro='$bairro' , fk_tipoEsquadra='$tipo_esquadra', func_esquadra='$func_esquadra' where  id_esquadra='$id_esquadra'")
            or die(mysql_error()."erro ao atualizar");


            header('Location:view_esquadra.php?msg=edit');

        }
        else:
            header("Location:view_esquadra.php?msg=senhaerror");
        endif;
    }
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Editar Esquadra | Angosearch</title>
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
                    <li><a href="#"><i class="fa fa-circle-o"></i> Esquadra</a></li>
                    <li class="active">Visualizar</li><li class="active">Editar</li>
                </ol>
            </section>
            <?php
            $s=$con->query("select esquadra,func_foto from esquadra WHERE  id_esquadra='$id_esquadra'");
            $pega_nome=mysqli_fetch_assoc($s);
            ?>
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
                                <h3 class="box-title"><img src="../admin/midia/img/<?php echo $pega_nome['func_foto']; ?>"
                                                           alt="<?php echo $pega_nome['func_foto']; ?>"
                                                           style="width: 1auto; height:160px;border-radius: 100%;"   alt="User Image" />
                                    Editar : <?php echo $pega_nome['esquadra'] ?></h3>
                            </div><!-- /.box-header -->
                            <!-- form start -->

                                <?php

                                $con=conecta();

                                $sq=$con->query("select id_esquadra, esquadra, numero,func_esquadra, tipoEsquadra, bairro
 from esquadra,tipoesquadra,bairro where estado='1'and
 fk_tipoEsquadra=id_tipoEsquadra
 and fk_bairro=id_bairro and id_esquadra='$id_esquadra'");

                                $dado=mysqli_fetch_array($sq);
                                ?>

                            <form role="form" method="post" action="" enctype="multipart/form-data">
                                <div class="box-body"  style="border-bottom: solid #333">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Esquadra</label>
                                        <input type="text" name="esquadra" id="uname" class="form-control"
                                               value="<?php echo $dado["esquadra"]; ?>"/>
                                        <input type="hidden" class="form-control" id="dat" name="dt">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Número</label>
                                        <input type="text" name="numero" id="uname" class="form-control"
                                               value="<?php echo $dado["numero"]; ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Tipo Esquadra</label>
                                        <select class="form-control" name="Tesquadra" id="type" >
                                        <option><?php echo $dado["tipoEsquadra"]; ?></option>
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
                                        <select class="form-control" name="bairro" id="type" >
                                            <option><?php echo $dado["bairro"]; ?></option>
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
                                        <input type="text" name="func_esquadra" id="uname" class="form-control"
                                               value="<?php echo $dado["func_esquadra"]; ?>"/>
                                    </div>



                                </div><!-- /.box-body -->
                                <body class="hold-transition lockscreen" >
                                <!-- Automatic element centering -->
                                <div class="lockscreen-wrapper" >

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

                                            <input type="password" class="form-control" name="senha"  required="required" placeholder="sua palavra passe">


                                        </div>


                                        <!-- /.lockscreen credentials -->

                                    </div>
                                    <!-- /.lockscreen-item -->


                                </div>


                                </body>
                                <div class="box-footer">
                                    <button class="btn btn-primary" type="submit"  name="sub"/>
                                    <span	class="glyphicon	glyphicon-edit"></span> Efectuar Alterações
                                    </button>
                                    <a class="btn btn-danger" href="view_esquadra.php"  name="cancel"/>
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
    <script src="dist/js/demo.js" type="text/javascript"></script>
    </body>
    </html>

<?php }else{
    header("Location:../../login-usuario.php");
}?>