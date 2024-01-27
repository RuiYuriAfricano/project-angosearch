<?php
session_start();

if ( isset($_SESSION['nome_admin'])) {
    header("Location:angosearch/AdminLTE-master/index.php");
} else if( isset($_SESSION['esquadra'])) {
    header("Location:angosearch/esquadra/principal_esquadra.php");
}
else if( isset($_SESSION['utilizador'])) {
    header("Location:angosearch/utilizador/index.php");
}
else {
    ?>

    <?php
    include "include/conexao.php";
    $con = conecta();

    $sql = $con->query("select * from definicoes where id_definicoes='1' ") or die(mysql_error());

    $linhas = mysqli_num_rows($sql);
    $dados = mysqli_fetch_assoc($sql);

    $id=$_GET['id'];
    $nome=$_GET['nome'];


    if(isset($_POST['ok'])) {

        $senha = md5($_POST['senha']);
        $rsenha = md5($_POST['rsenha']);

        if($senha==$rsenha) {

            $pesq_adm = $con->query("select * from login where id_login='$id' and acesso='admin' and estado='1'");
            $pesq = $con->query("select * from login where fk_utilizador='$id' and acesso='utilizador'");
            $pesq_esquadra = $con->query("select * from login where fk_esquadra='$id' and acesso='esquadra'");


        if (mysqli_num_rows($pesq_adm) > 0) {

                $pegDad = mysqli_fetch_array($pesq_adm);

                if ($pegDad['senha'] == $senha) {

                    echo " <script>

                        alert('Erro : A nova senha, não pode ser igual a antiga.');

        </script> ";
                } else {

                    $up = $con->query("update login set senha='$senha' where id_login='$id' and acesso='admin' and estado='1'");

                    echo " <script>

                        alert('Sucesso : Senha actualizada, a sua conta foi recuperada.');

                        window.location='login-usuario.php';

        </script> ";

                }
            }
            else if (mysqli_num_rows($pesq) > 0) {

                $pegDados = mysqli_fetch_array($pesq);

                if ($pegDados['senha'] == $senha) {

                    echo " <script>

                        alert('Erro : A nova senha, não pode ser igual a antiga.');

        </script> ";
                } else {

                    $up = $con->query("update login set senha='$senha' where fk_utilizador='$id' and estado='1'");

                    echo " <script>

                        alert('Sucesso : Senha actualizada, a sua conta foi recuperada.');

                        window.location='login-usuario.php';

        </script> ";

                }
            }

            else if (mysqli_num_rows($pesq_esquadra) > 0) {

                $pegDados = mysqli_fetch_array($pesq_esquadra);

                if ($pegDados['senha'] == $senha) {

                    echo " <script>

                        alert('Erro : A nova senha, não pode ser igual a antiga.');

        </script> ";
                } else {

                    $up = $con->query("update login set senha='$senha' where fk_esquadra='$id' and estado='1'");

                    echo " <script>

                        alert('Sucesso : Senha actualizada, a sua conta foi recuperada.');

                        window.location='login-usuario.php';

        </script> ";

                }
            }


        } else {

            echo " <script>

                        alert('Erro : As senhas não correspondem.');

        </script> ";

        }
    }
    ?>
    <!DOCKTYPE html>
    <html>
    <head>
        <meta http-equiv="Content­Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="../midia/img/fav-iconAngo.jpg" type="image/jpg">
        <title>Alterar senha</title>
        <link href="angosearch/adminlte-master/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="angosearch/adminlte-master/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="angosearch/adminlte-master/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <!-- main css -->
        <script src="../js/calendario.js"></script>
        <style>
            .form-header { width: 100%; display: flex; align-items: center;}
            .form-header-image { display: block; margin-right: 15px;}
            .form-header-image img { display: block; }
            .form-header-image { width: 64px; height: 50px;}
            .form-header-image img { width: 64px; height: 50px;}
            .form-header-info { width: calc(100% - 64px);}
            .form-header-info label { width: 100%; display: block; color: #253A44; font-size: 20px; font-weight: 500;}
            .form-header-info span { width: 100%; display: block; color: #8795A2; font-size: 14px; font-weight: 300;}
        </style>
    </head>


    <body class="login-page" onload="setInterval('apresentaData()',1000);">
    <div class="login-box">
        <div class="login-logo">
            <a href="index.php">
                <img height="70px" src="../midia/logotipo/<?php echo $dados['logo'];?>" alt="ANGOSEARCH">
            </a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">
            <div class="form-header">
                <div class="form-header-image">
                    <img src="../midia/user.svg">
                </div>

                <div class="form-header-info">
                    <label><?php echo $nome; ?> </label>
                    <span>Cria uma nova senha</span>
                </div>
            </div>
            </p>
            <form action="" method="post">
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="senha" placeholder="Nova senha" minlength="8" maxlength="30"
                           pattern="[A-Za-z0-9!@.]*" id="senha" required="required"
                           autocomplete="off"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="rsenha" placeholder="Confirme a senha" minlength="8" maxlength="30"
                           pattern="[A-Za-z0-9!@.]*" id="senha" required="required"
                           autocomplete="off"/>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" name="ok" class="btn btn-primary btn-block btn-flat">Confirmar</button>
                    </div><!-- /.col -->
                </div>
            </form>

            <!-- /.social-auth-links -->


            <a href="login-usuario.php" class="text-center">Retroceder</a>

        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="../../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="../../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    <script src="Cadastro%20-%20DevMedia_arquivos/api.js"></script>
    <script src="Cadastro%20-%20DevMedia_arquivos/api_002.js"></script>
    <script type="text/javascript" src="Cadastro%20-%20DevMedia_arquivos/jquery_002.js"></script>
    <script type="text/javascript" src="Cadastro%20-%20DevMedia_arquivos/jquery-ui.js"></script>
    <script type="text/javascript" src="Cadastro%20-%20DevMedia_arquivos/notifIt.js"></script>
    <script type="text/javascript" src="Cadastro%20-%20DevMedia_arquivos/index.js"></script>
    </body>
    </html>

<?php

}   ?>