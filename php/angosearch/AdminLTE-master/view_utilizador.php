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



    if(isset($_POST['activar'])) {


        $id=$_POST['id_user'];

        $del = $con->query("update login set estado='1' where fk_utilizador='$id' and estado='0' and acesso='utilizador'")
        or die("Erro Ao Eliminar");
        /*$del1 = $con->query("update utilizador set estado='1' where id_utilizador='$id' and estado='0' ")
        or die("Erro Ao Eliminar");*/


        header("Location:view_utilizador.php");

    }
    else if(isset($_POST['desactivar'])) {

        $id=$_POST['id_user'];

        $del = $con->query("update login set estado='0' where fk_utilizador='$id' and estado='1' and acesso='utilizador'")
        or die("Erro Ao Eliminar");
       /* $del1 = $con->query("update utilizador set estado='0' where id_utilizador='$id' and estado='1' ") or die("Erro Ao Eliminar");

*/
        header("Location:view_utilizador.php");

    }
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Utilizadores | Angosearch</title>
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
                    Utilizadores Registrados
                    <small>Painel de Controle</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-user"></i> Utilizadores</a></li>

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
                            <?php }else if($_REQUEST["msg"]=="senhaerror"){
                                ?>
                                <span class='notification n-error'>Senha digitada não está correcta..!!</span>
                            <?php }


                            else if($_REQUEST["msg"]=="cancelado"){
                                ?>
                                <span class='notification n-success'>Cancelado.......!!</span>
                            <?php }
                            else if($_REQUEST["msg"]="edit") {

                                ?>
                                <span class='notification n-success'>Editado com sucesso.......!!</span>
                            <?php
                            }
                            else if($_REQUEST["msg"]="erro"){

                                ?><span class='notification n-error'>erro: Preencha os campos por favor!</span>
                            <?php }


                            else if ($_REQUEST["msg"] == "add") {

                                ?>
                                <span class='notification n-success'>Login Adcionado com Sucesso.......!!</span>
                            <?php

                            }else if ($_REQUEST["msg"] == "desativar") {

                                ?>
                                <span class='notification n-success'>usuário desativado com sucesso.......!!</span>
                            <?php

                            }}
                        ?></div>

                    <!-- left column -->
                    <div class="col-lg-9    table-responsive no-padding" style="  width: 100%;
background:#fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px;">
                        <style>
                            .vd th , .vd td{
                                color: #005fcb;
                            }
                        </style>
                        <?php

                        $con=conecta();

                        $ut = $con->query("select * from utilizador where estado='1'");
                        $totalUt = mysqli_num_rows($ut);

                        $sql=$con->query("SELECT `id_utilizador`, `nome_completo`, `foto`, estado,`bi`, `nascimento`,
 `telefone`, `email`, `dataRegistro`,bairro,genero FROM `utilizador`,bairro,genero  WHERE
  fk_bairro=id_bairro and fk_genero=id_genero  and estado='1' ORDER  BY id_utilizador desc");

                        ?>
                        <h5 align="left" style="color: #999;"><?php if($totalUt > 1){
                                echo $totalUt." Utilizadores Registrados";}
                            else if($totalUt == 0){
                                echo "Nenhum utilizador registrado";
                            }
                            if($totalUt == 1){
                                echo $totalUt." Utilizador registrado";}
                            ?></h5> <a href='#'  style='float: right '>
                            <span class='fa fa-print  text-danger'></span> Imprimir
                        </a><br>

                        <table  style="text-align: center;" id="example1"  width="100%" class="table table-bordered table-hover">
                            <thead style="color: #fff;background-color: #3c8dbc"> <tr >
                                <th width="96" align="center">Fotográfia</th>
                                <th width="96" align="center">Nome</th>
                                <th width="96" align="center">Nascimento</th>
                                <th width="96" align="center">BI</th>
                                <th width="96" align="center">Morada</th>
                                <th width="46" align="center">Telefone</th>

                                <th width="96" align="center">Email</th>
                                <th width="96" align="center">Usuario</th>
                                <th width="96" align="center"><small>Registro</small></th>
                                <th width="96" align="center"><small>Estado</small></th>
                                <th width="96" align="center"></th>



                            </tr></thead>
                            <?php while($dados=mysqli_fetch_array($sql)){ $ft = $dados['foto'];
                                $idut=$dados['id_utilizador'];
                                 $sql_login=$con->query("select estado,usuario,dtActivado,dtDesactivado from login where fk_utilizador='$idut'");
        $pega=mysqli_fetch_array($sql_login);
        $est=$pega['estado'];

                                ?>
                                <tr class="vd">
                                    <td width="92" align="">
                                        <img src="../admin/midia/img/<?php echo $ft; ?>" alt="<?php echo $ft; ?>"
                                             width = '70px' height='70px' style='border-radius:100%;'></td>
                                    <td width="202" align=""><?php echo $dados['nome_completo'];?></td>
                                    <td width="202" align=""><?php if($dados['nascimento']=="0000-00-00" or $dados['nascimento']==""){
                                            echo "";
                                        }else {
                                            echo date('d-m-Y', strtotime($dados['nascimento']));
                                        }?></td>
                                    <td width="202" align=""><?php echo $dados['bi'];?></td>
                                    <td width="60" align=""id="bt4"><?php echo $dados['bairro'];?></td>
                                    <td width="46" align=""><?php echo $dados['telefone'];?></td>


                                        <td align="center">
                                            <?php echo $dados['email'];?>
                                        </td>
                                    <td width="96" align="center"><?php echo $pega['usuario'];?></td>


                                    <td align="center"><small><?php echo date('d-m-Y, h:m:i', strtotime($dados['dataRegistro']));?> </small></td>
                                    <td>
                                        <?php if($est=='1'){ ?>
                                            <span class="label label-success">Activado desde<br/>
                                                <?php echo date('d-m-Y', strtotime($pega['dtActivado']));?></span>
                                        <?php }
                                        else if($est=='0'){
                                            ?>
                                            <span class="label label-danger">Inactivado desde<br/>
                                                <?php echo date('d-m-Y', strtotime($pega['dtDesactivado']));?></span>
                                        <?php } ?>
                                    </td>
                                    <td align="left">
                                        <?php if($est=='0'){ ?>


                                            <a href="activar_utilizador.php?id_utilizador=<?php echo ($dados['id_utilizador']);?> &&
                nome=<?php echo ($dados['nome_completo']);?> &&
                foto=<?php echo ($dados['foto']);?> "
                                               style="">
                                                <button type="submit" name="activar" class="btn btn-success">
                                                    <span	class="glyphicon	glyphicon-ok"></span> Activar</button></a>
                                        <?php }
                                        else if($est=='1'){
                                            ?>


                                            <a href="desactivar_utilizador.php?id_utilizador=<?php echo ($dados['id_utilizador']);?> &&
                nome=<?php echo ($dados['nome_completo']);?> &&
                foto=<?php echo ($dados['foto']);?> "
                                               style="">
                                                <button type="submit" name="desactivar" class="btn btn-danger">
                                                    <span	class="glyphicon	glyphicon-remove"></span> Desactivar</button></a>
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