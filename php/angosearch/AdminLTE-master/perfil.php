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
    if (isset($_POST['sub'])) {

        $nome = $_POST['nome'];
        $email = $_POST['email'];


        $id = $_POST['id'];

        if ($nome != "") {
            try {

                $atualiza = $con->query("update login set admin='$nome' where id_login='$id'");
                if ($atualiza === FALSE) {
                    throw new Exception('Problemas: ' . $con->errno . ' --- ' . $con->error . '<br />');
                } else {
                    session_destroy();

                    header('Location:../../login-usuario.php');
                }


            } catch (Exception $e) {
                //caso haja uma exceção a mensagem é capturada e atribuida a $msg
                echo $e->getMessage();
            }
        }if ($email!="") {
            try {

                $atualiza = $con->query("update login set  email_admin='$email' where id_login='$id'");
                if ($atualiza === FALSE) {
                    throw new Exception('Problemas: ' . $con->errno . ' --- ' . $con->error . '<br />');
                } else {
                    header('Location:perfil.php?msg=4'); // Não foi selecionada nenhuma imagem
                }


            } catch (Exception $e) {
                //caso haja uma exceção a mensagem é capturada e atribuida a $msg
                echo $e->getMessage();
            }
        }

    }

    else if(isset($_POST['seguranca'])){

        $usuario = $_POST['usuario'];
        $senhaAntiga = $_POST['senhaAntiga'];
        $senhaNova = $_POST['senhaNova'];
        $senhaR = $_POST['senhaR'];

        $id = $_POST['id'];

        $u=$con->query("select * from login where id_login=".$id."");
        $pega_u=mysqli_fetch_array($u);

        if($pega_u['senha']!=md5($senhaAntiga)){

            header('Location:perfil.php?msg=passwordError');
        }else{

            if($senhaNova!=$senhaR){

                header('Location:perfil.php?msg=passwordDf');
            }
            else{
                if($senhaNova==$senhaAntiga){

                    header('Location:perfil.php?msg=passwordAIN');
                }
                else{
                    $se=md5($senhaNova);
                    $u=$con->query("update login set usuario='$usuario', senha='$se' where id_login=".$id."");
                    header('Location:perfil.php?msg=passworOk');
                }
            }
        }


    }

    else if(isset($_POST['alterar_foto'])){

        $id = $_POST['id'];
        $imageName = $_FILES["arquivo"]["name"];
        if (!empty($imageName)) {
            $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            $fileAllow = array("jpg", "png", "jpeg");
            if (in_array($fileExtension, $fileAllow)) {

                if ($_FILES['arquivo']['size'] < 500000) {


                    $strDtMix = @date("d") . substr((string)microtime(), 2, 8);
                    $uploadfile = $strDtMix . "." . pathinfo($imageName, PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES['arquivo']['tmp_name'], "../admin/midia/img/" . $uploadfile);

                    try {
                        $atualiza = $con->query("update login set foto_admin='$uploadfile' where id_login='$id'");
                        if ($atualiza === FALSE) {
                            throw new Exception('Problemas: ' . $con->errno . ' --- ' . $con->error . '<br />');
                        } else {
                            header('Location:perfil.php?msg=uploadok'); // enviado com sucesso
                        }
                    } catch (Exception $e) {
                        //caso haja uma exceção a mensagem é capturada e atribuida a $msg
                        echo $e->getMessage();
                    }
                } else {

                    header('Location:perfil.php?msg=2'); //tamanho grande
                }

            } else {

                header('Location:perfil.php?msg=3'); // extensão da foto é invalida
            }
        }
        else {
            header('Location:perfil.php?msg=6'); // Não foi selecionada nenhuma imagem
        }
    }


    ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Perfil ADMIN</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?php include "include/links.php"; ?>
    <script type="text/javascript">

        function informa() {
            alert("Sr. Administrador...!      " +
            "Terminaremos sua Sessão se Actualizares o seu Nome. Por sua vez terás de Iniciar outra vez. Obrigado!");
        }
    </script>
</head>
<body class="skin-blue" onload="informa();">
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
        Meu Perfil
        <small>Painel de Controle</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-edit"></i> Perfil</a></li>

    </ol>
</section>
<br><br>
<div style="">
    <?Php
    if(isset($_REQUEST["msg"])) {
        if ($_REQUEST["msg"] == "1") {

            ?>
            <span class='notification n-success'>Dados atualizados com Sucesso.......!!</span>
        <?php }

        else if ($_REQUEST["msg"] == "2") {

            ?>
            <span class="notification n-error">Erro: Fotografia Muito grande, escolhe uma de tamanho menor .</span>
        <?php }
        else if ($_REQUEST["msg"] == "3") {
            ?>
            <span class='notification n-error'>Erro: Extensão Inválida</span>



        <?php }


        else if ($_REQUEST["msg"] == "4") {

            ?>


            <span class='notification n-success'>Dados actualizados com sucessos ...!</span>



            <?php
            ?>
        <?php
        }     else if ($_REQUEST["msg"] == "5") {
            ?>
            <span class='notification n-error'>Erro: Preencha o formulário por favor</span>
        <?php
        }     else if ($_REQUEST["msg"] == "6") {
            ?>
            <span class='notification n-error'>Erro: Não inseriu nenhuma fotográfia</span>

        <?php
        }     else if ($_REQUEST["msg"] == "uploadok") {
            ?>
            <span class='notification n-success'>Alterada com sucesso</span>

        <?php
        }     else if ($_REQUEST["msg"] == "passwordError") {
            ?>
            <span class='notification n-error'>Erro: A senha antiga não está correcta</span>
        <?php
        }     else if ($_REQUEST["msg"] == "passwordDf") {
            ?>
            <span class='notification n-error'>Erro: Nova senha diferente, por favor digite a mesma para o campo «Confirme a Senha»</span>
        <?php
        }     else if ($_REQUEST["msg"] == "passwordAIN") {
            ?>
            <span class='notification n-error'>Erro: A senha nova não pode ser igual a senha antiga</span>
        <?php
        }     else if ($_REQUEST["msg"] == "passworOk") {
            ?>
            <span class='notification n-success'> Alterações Feitas com Sucesso!</span>
        <?php }} ?>
</div>
<section class="content">
<?php
$nu=$_SESSION['nome_admin'];
$p=$con->query("select id_login,admin,foto_admin,email_admin,dtRegistro,adminRegister from login where admin='$nu'");
$pega=mysqli_fetch_array($p);


?>
<div class="row">
<div class="col-md-3">

    <!-- Profile Image -->
    <div class="box box-primary">
        <div class="box-body box-profile">
           <a href="../admin/midia/img/<?php echo $pega['foto_admin']; ?>"> <img class="profile-user-img img-responsive img-circle"
                 src="../admin/midia/img/<?php echo $pega['foto_admin']; ?>" style="margin: 0 auto;

width: 100px;

padding: 3px;

border: 3px solid #d2d6de; max-height: 128px;" alt="User profile picture"></a>
            <center><small><a href="#timeline"  data-toggle="tab">Alterar foto de Perfil</a></small></center>
            <h3 class="profile-username text-center"><?php echo $pega['admin']; ?></h3>

            <p class="text-muted text-center">utilizador
                <small>desde <?php echo date('d-m-Y', strtotime($pega['dtRegistro'])); ?></p>

            <ul class="list-group list-group-unbordered">
                <?php $comunicado=$con->query("select * from desaparecidos where postado_por='admin: ".$pega['admin']."'");
                $conta=mysqli_num_rows($comunicado);

                $comunicado1=$con->query("select * from documentos where postado_por='".$pega['admin']."'");
                $conta1=mysqli_num_rows($comunicado1);
                ?>  <li class="list-group-item">

                    <b style="color: #444">Registros de Desaparecidos</b> <a class="pull-right"><?php echo $conta; ?></a>
                </li>
                <li class="list-group-item">

                    <b style="color: #444">Registros de Documentos</b> <a class="pull-right" href="perfil.php"><?php echo $conta1; ?></a>
                </li>

            </ul>

            <a href="#" class="btn btn-primary btn-block"><b style="color: #fff">Registrar Desaparecido</b></a>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <!-- About Me Box -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Sobre Me</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">


                <strong><i class="fa fa-user margin-r-5"></i> Meu Nome</strong>

                <p><?php echo $pega['admin']; ?></p>
                <hr>
                <strong><i class="fa fa-envelope margin-r-5"></i> E-mail</strong>

                <p><?php echo $pega['email_admin']; ?></p>
                <hr>

                <strong><i class="fa fa-file-text-o margin-r-5"></i> Registrado Por</strong>

                <p><?php echo $pega['adminRegister']; ?></p>

        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
<!-- /.col -->
<div class="col-md-9">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">

            <li class="active"><a href="#settings" data-toggle="tab">Meus Dados</a></li>
            <li ><a href="#timeline" data-toggle="tab">Foto de Perfil</a></li>
            <li ><a href="#seg" data-toggle="tab">Segurança</a></li>
        </ul>
        <div class="tab-content">


            <!-- /.tab-pane -->



            <div class="active  tab-pane    " id="settings" >
                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="">

                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nome: <a><?php echo $pega['admin']; ?></a></label>

                        <div class="col-sm-10">
                            <input type="text" maxlength="60" minlength="6"
                                   id="nome" pattern="[A-Za-zà-ýÀ-Ý-ç ]*"
                                   name="nome" placeholder="Actualize o nome"  value=""/>
                            <input type="hidden" name="id"  value="<?php echo $pega['id_login']; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Email: <a><?php echo $pega['email_admin']; ?></a></label>

                        <div class="col-sm-10">
                            <input type="email" pattern="[A-z0-9._+-]+@[A-z0-9.-]+\.[A-z]{2,4}$"
                                   maxlength="60" placeholder="Actualize o email" name="email"   value=""/>
                        </div>
                    </div>




                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name="sub" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="timeline">
                <form class="form-horizontal"   enctype="multipart/form-data" method="post" action="">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Altere sua foto</label>
                        <br>
                        <div class="col-sm-10">
                            <input type="file" class="" id="arquivo" name="arquivo" style="">
                            <input type="hidden" name="id"  value="<?php echo $pega['id_login']; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name="alterar_foto" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>

            <?php $u=$con->query("select * from login where id_login=".$pega['id_login']."");
            $pega_u=mysqli_fetch_array($u);


            ?>

            <div class="tab-pane" id="seg">
                <form class="form-horizontal"   enctype="multipart/form-data" method="post" action="">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">usuario</label>

                        <div class="col-sm-10">
                            <input type="hidden" name="id"  value="<?php echo $pega['id_login']; ?>"/>
                            <input id="val-login" type="text" maxlength="80" pattern="[A-Za-z0-9!@.\-_]*"
                                   required="required"  name="usuario" value="<?php echo $pega_u['usuario']; ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Senha Antiga</label>

                        <div class="col-sm-10">
                            <input type="password" placeholder="" minlength="8" maxlength="30"
                                   pattern="[A-Za-z0-9!@.]*" id="senha" required="required"
                                   autocomplete="off" name="senhaAntiga" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nova Senha</label>

                        <div class="col-sm-10">
                            <input type="password" placeholder="" minlength="8" maxlength="30"
                                   pattern="[A-Za-z0-9!@.]*" id="senha" required="required"
                                   autocomplete="off" name="senhaNova"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Confirme a Senha</label>

                        <div class="col-sm-10">
                            <input type="password" placeholder="" minlength="8" maxlength="30"
                                   pattern="[A-Za-z0-9!@.]*" id="senha" required="required"
                                   autocomplete="off" name="senhaR"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name="seguranca" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->

</section>
<!-- /.content -->
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
</script></body>
</html>

<?php }else{
    header("Location:../../login-usuario.php");
} ?>