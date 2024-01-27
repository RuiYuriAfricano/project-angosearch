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


        if(isset($_POST['ok'])) {

            $usuario = $_POST['usuario'];
            $email = $_POST['email'];
            $dt=date('Y-m-d');

            $pesq=$con->query("select * from utilizador where email='$email' and estado ='1'");
            $pesq_esquadra=$con->query("select * from esquadra where email='$email' and estado ='1'");
            $pesq_admin=$con->query("select * from login where email_admin='$email' and estado ='1'");

            if(mysqli_num_rows($pesq) > 0) {
                $pegaDados = mysqli_fetch_array($pesq);
                $id=$pegaDados['id_utilizador'];
                $nome=$pegaDados['nome_completo'];
                $foto=$pegaDados['foto'];
                $pesq1 = $con->query("select * from login where usuario='$usuario' and fk_utilizador='$id' and estado ='1'");

                if (mysqli_num_rows($pesq1) > 0) {

                    header('Location:recuperar_conta.php?id='.$id.'&& email='.$email.'&& nome='.$nome.'&& foto='.$foto);

                } else{

                    echo " <script type='text/javascript'>

                        alert('Erro : O usuário não corresponde ao E-mail introduzido.');
                        </script> ";
                    }
                                        }


            else if(mysqli_num_rows($pesq_esquadra) > 0) {
                $pegaDados = mysqli_fetch_array($pesq_esquadra);
                $id=$pegaDados['id_esquadra'];
                $nome=$pegaDados['esquadra'].', '.$pegaDados['func_esquadra'];
                $foto=$pegaDados['func_foto'];
                $pesq1 = $con->query("select * from login where usuario='$usuario' and fk_esquadra='$id' and estado ='1'");

                if (mysqli_num_rows($pesq1) > 0) {

                    header('Location:recuperar_conta.php?id='.$id.'&& email='.$email.'&& nome='.$nome.'&& foto='.$foto);

                } else{

                    echo " <script type='text/javascript'>

                        alert('Erro : O usuário não corresponde ao E-mail introduzido.');
                        </script> ";
                }
            }

            else if(mysqli_num_rows($pesq_admin) > 0) {
                $pegaDados = mysqli_fetch_array($pesq_admin);
                $id=$pegaDados['id_login'];
                $nome="Administrador, ".$pegaDados['admin'];
                $foto=$pegaDados['foto_admin'];
                $pesq1 = $con->query("select * from login where usuario='$usuario' and id_login='$id' and estado ='1'");

                if (mysqli_num_rows($pesq1) > 0) {

                    header('Location:recuperar_conta.php?id='.$id.'&& email='.$email.'&& nome='.$nome.'&& foto='.$foto);

                } else{

                    echo " <script type='text/javascript'>

                        alert('Erro : O usuário não corresponde ao E-mail introduzido.');
                        </script> ";
                }
            }


            else{
                    echo" <script type='text/javascript'>

                        alert('O E-mail introduzido não corresponde');
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
            <title>Esqueci a senha</title>
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
                        <label>Esqueci a minha senha </label>
                        <span>Recuperar</span>
                    </div>
                </div>
                </p><p><?php
                    if($_SESSION){
                echo $_SESSION['erroLogin']; } session_destroy();?></p>
                <form action="" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="usuario" placeholder="digite o seu usuario"
                               maxlength="80" pattern="[A-Za-z0-9!@.\-_]*" required="required" class="form-control"/>
                        <input name="dt" id="dat" type="hidden">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" pattern="[A-z0-9._+-]+@[A-z0-9.-]+\.[A-z]{2,4}$"
                               maxlength="60" required="required"name="email" placeholder="digite o seu E-mail"/>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="row">
                       <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" name="ok" class="btn btn-primary btn-block btn-flat">Enviar</button>
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