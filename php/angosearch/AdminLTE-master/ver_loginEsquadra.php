<?php

session_start();
if($_SESSION['nome_admin']) {
    ?>

    <?php

    $id=$_GET['id_esquadra'];
    $nome=$_GET['esquadra'];
    $func=$_GET['func'];

    if(empty($id)){
        echo" <script>

                        alert('Nenhuma Esquadra Anotada!');
                        window.location('view_esquadra.php');
        </script> ";
    }else{

    include '../admin/include/conexao.php';
    $con= conecta();

    $sql =$con ->query("select * from definicoes where id_definicoes='1' ") or die(mysql_error());

    $linhas = mysqli_num_rows($sql);
    $dados = mysqli_fetch_assoc($sql);

    /* rodape base de dados*/
    $sq =$con ->query("select * from rodape where id_rodape='1' ") or die(mysql_error());

    $linha = mysqli_num_rows($sq);
    $dado = mysqli_fetch_assoc($sq);

        $sql_login=$con->query("select estado from login where fk_esquadra='$id'");
        $pega=mysqli_fetch_array($sql_login);
        $est=$pega['estado'];
    ?>
    <?php




        if(isset($_POST['activar'])) {




            $del = $con->query("update login set estado='1' where fk_esquadra='$id' and estado='0'")
            or die("Erro Ao Eliminar");




        }
        else if(isset($_POST['desactivar'])) {

            $id=$_POST['id_user'];

            $del = $con->query("update login set estado='0' where fk_esquadra='$id' and estado='1'")
            or die("Erro Ao Eliminar");



        }

    if(isset($_POST['excluir'])) {
        $data = date('d') . "-" . date('m') . "-" . date('Y');


        $id_esquadra = $_POST['id_esquadra'];



        $del = $con->query("update esquadra set estado='0',data_excluido='$data' where id_esquadra='$id_esquadra' and estado='1'")
        or die("Erro Ao Eliminar");

        header("Location:visualizar_esquadra.php?msg=excluir");

    }
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Usuário Esquadra | Angosearch</title>
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
                    Usuário da  <?php echo $nome; ?>
                    <small>Painel de Controle</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Esquadra</a></li>
                    <li class="active">Visualizar</li><li class="active">Ver Usuário</li>
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
                            if ($_REQUEST["msg"] == "add") {

                                ?>
                                <span class='notification n-success'>Alterado com Sucesso.......!!</span>
                            <?php
                            }

                            if ($_REQUEST["msg"] == "erro") {

                                ?>
                                <span class="notification n-error">Erro: Preencha os Campos.</span>
                            <?php
                            }
                        }?></div>
                    <!-- left column -->
                    <div class="col-lg-9    table-responsive" style="  width: 100%;
background:#fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px;">

                        <?php

                        $con=conecta();

                        $sql=$con->query("select id_login,usuario,senha,esquadra,func_foto,func_esquadra from login,esquadra where fk_esquadra='$id'
and id_esquadra = '$id'limit 1 ");
                        if(mysqli_num_rows($sql)==0){
                            echo "<h5>Esta Esquadra não tem Acesso</h5>";
                        }
                        ?>

                        <table style="text-align: left;"  width="100%" class="table table-bordered table-hover">
                            <thead style="color: #fff;background-color: #3c8dbc"> <tr >
                                <th  align="center"id="bt4"width="40" height="">Fotográfia</th>
                                <th width="96" align="center">Funcionário(a) da Esquadra </th>
                                <th width="96" align="center">Usuário ou Email</th>
                                <th width="96" align="center">Estado</th>


                                <th width="96" align="center"></th>
                                <th width="96" align="center"></th>



                            </tr></thead>
                            <?php while($dados=mysqli_fetch_array($sql)){ $ft=$dados['func_foto']; ?>
                                <tr class="vd">
                                    <td width="60" align=""id="bt4"><img src="../admin/midia/img/<?php echo $ft; ?>" alt="<?php echo $ft; ?>"
                                                                         width = '90px' height='90px' style='border-radius:100%;'></td>
                                    <td width="242" align=""id="bt4"><?php echo $func;?></td>
                                    <td width="242" align=""><?php echo $dados['usuario'];?></td>
                                    <td width="242" align="">
                                        <?php if($est=='1'){ ?>
                                            <span class="label label-success">Activado</span>
                                        <?php }
                                        else if($est=='0'){
                                            ?>
                                            <span class="label label-danger">Inactivado</span>
                                        <?php } ?>
                                    </td>




                                    <td align="center"> <a href="editar_login_esquadra.php?id_login=<?php echo ($dados['id_login']);?>&&
                                     func_esquadra=<?php echo ($dados['func_esquadra']);?> && esquadra=<?php echo ($dados['esquadra']);?>
                                     && func_foto=<?php echo ($dados['func_foto']);?>"
                                                           style="">
                                            <button class="btn btn-primary" style="font-size: 12px;"><span	class="glyphicon   glyphicon-edit"></span>
                                                Editar </button></a></td>
                                    <td>
                                        <?php if($est=='0'){ ?>
                                            <form action="" method="post">
                                                <input type="hidden" name="id_user" value="<?php echo $dados['id_login'];?>">
                                                <button type="submit" name="activar" class="btn btn-success">Activar</button>
                                            </form>
                                        <?php }
                                        else if($est=='1'){
                                            ?>
                                            <form action="" method="post">
                                                <input type="hidden" name="id_user" value="<?php echo $dados['id_login'];?>">
                                                <button type="submit" name="desactivar" class="btn btn-danger">Desactivar</button>
                                            </form>
                                        <?php } ?>
                                    </td>



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

<?php }}else{
    header("Location:../../login-usuario.php");
} ?>