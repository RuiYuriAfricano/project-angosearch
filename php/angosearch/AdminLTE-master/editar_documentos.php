<?php

session_start();
if($_SESSION['nome_admin']) {
?>

<?php
    $id=$_GET['id_doc'];
    $nome=$_GET['nome_doc'];

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
        $senha = md5($_POST['senha']);

        $n=$_SESSION['nome_admin'];
        $q=$con->query("select usuario from login where admin='$n' and estado='1'");
        $pegaUs=mysqli_fetch_array($q);
        $usuario=$pegaUs['usuario'];
        $p= $con->query("select * from login where senha='$senha' and usuario='$usuario' and estado='1'");

        if((mysqli_num_rows($p)) > 0):

        $detalhe = $_POST['detalhe'];
        $codigo_doc = $_POST['codigo'];
        $nomeDoc = $_POST['nome_doc'];
        $dataRegistro = $_POST['dt'];
        $postado_por=$_SESSION['nome_admin'];


        if (($detalhe == "" and $nomeDoc=="")) {
            header('Location:view_docPerdidos.php?msg=erro');
        } else {




            $imageName = $_FILES["fotografia"]["name"];
            if(!empty($imageName)) {
                $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
                $fileAllow = array("jpg","png","jpeg");
                if(in_array($fileExtension,$fileAllow)){

                    if($_FILES['fotografia']['size']< 4128943) {


                        $strDtMix = @date("d").substr((string)microtime(), 2, 8);
                        $uploadfile = $strDtMix.".".pathinfo($imageName, PATHINFO_EXTENSION);
                        move_uploaded_file($_FILES['fotografia']['tmp_name'], "../admin/midia/documentos/".$uploadfile);


                        $up = $con->query("update documentos set nome_doc='$nomeDoc', detalhe='$detalhe',codigo_doc='$codigo_doc',
fotografia ='$uploadfile' where id_doc='$id' ")
                        or die ("erro ao atualizar documento".mysql_error());


                        header('Location:view_docPerdidos.php?msg=add');
                    }else{

                        header('Location:view_docPerdidos.php?msg=2'); //tamanho grande
                    }

                }else{

                    header('Location:view_docPerdidos.php?msg=3'); // extensão da foto é invalida
                }
            }else{
                $up = $con->query("update documentos set nome_doc='$nomeDoc', detalhe='$detalhe',codigo_doc='$codigo_doc'
 WHERE id_doc='$id'")
                or die ("erro ao atualizar documento".mysql_error());
                header('Location:view_docPerdidos.php?msg=4');
            }


        }
        else:
            header("Location:view_docPerdidos.php?msg=senhaerror");
        endif;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Documentos | Angosearch</title>
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
        <li><a href="#"><i class="fa fa-files-o"></i> Documentos Perdidos</a></li>
        <li class="active">Visualizar</li><li class="active">Editar</li>
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


                <span class='notification n-error'>Não foi inserida nenhuma imagem...!</span>


            <?php }


            if ($_REQUEST["msg"] == "erro") {

                ?>


                <span class='notification n-error'>Preencha os campos por favor...!</span>


            <?php
            }
        }?>
    </div>
    <?php
    $sql=$con->query("SELECT id_doc,nome_doc, fotografia, detalhe,codigo_doc,postado_por,dataRegistro FROM documentos
WHERE id_doc='$id' and estado = '1' limit 1");
    $dados=mysqli_fetch_array($sql);
    ?>

    <!-- left column -->
    <div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                    <img src="../admin/midia/documentos/<?php echo $dados['fotografia']; ?>" alt="<?php echo $dados['fotografia']; ?>"
                    style="width: 160px;"  alt="User Image" />

                Editar Documento Perdido: <?php echo $nome; ?> </h3>
        </div><!-- /.box-header -->
        <!-- form start -->

        <form role="form" method="post" action="" enctype="multipart/form-data">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Designação do Documentos</label>
                    <input type="text" class="form-control"  id="nome" pattern="[A-Za-zà-ýÀ-Ý-ç ]*" name="nome_doc" value="<?php echo $dados['nome_doc']; ?>">
                    <input type="hidden" class="form-control" id="dat" name="dt">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Imagem</label>
                    <input type="file" class="form-file " id="arquivo" name="fotografia">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Detalhes</label>
                    <textarea name="detalhe" rows="3" class="form-control" ><?php echo $dados['detalhe']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Código do Documento</label>
                    <input type="text" class="form-control" pattern="[A-Za-z0-9!@.\-_]*" name="codigo" placeholder="ex: Nº do BI, de Cédula, etc..."
                           value="<?php echo $dados['codigo_doc']; ?>">
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
                <a href="view_docPerdidos.php" class="btn btn-danger" />
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