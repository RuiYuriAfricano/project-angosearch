<?php


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
        include_once 'face.php';
        $con = conecta();

        $sql = $con->query("select * from definicoes where id_definicoes='1' ") or die(mysql_error());

        $linhas = mysqli_num_rows($sql);
        $dados = mysqli_fetch_assoc($sql);
        ?>
        <!DOCKTYPE html>
        <html>
        <head>
            <meta http-equiv="Content­Type" content="text/html; charset=utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="icon" href="../midia/img/fav-iconAngo.jpg" type="image/jpg">
            <title>Entrar</title>
            <link href="angosearch/adminlte-master/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="../css/font-awesome.min.css">
            <!-- Font Awesome Icons -->
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
            <!-- Theme style -->
            <link href="angosearch/adminlte-master/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
            <!-- iCheck -->
            <link href="angosearch/adminlte-master/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

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


        <body class="login-page" onload="setInterval('apresentaData()',1000);" >
        <div class="login-box" onload="mostra();">
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
                        <label>Login</label>
                        <span>Já sou usuário</span>
                    </div>
                </div>
                </p><p><?php
                    if(!empty($_SESSION['erroLogin'])){
                echo $_SESSION['erroLogin']; } session_destroy();?></p>
                <form action="verificaLogin.php" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="usuario" placeholder="usuario"
                               maxlength="80" pattern="[A-Za-z0-9!@.\-_]*" required="required" class="form-control"/>
                        <input name="dt" id="dat" type="hidden">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="senha" placeholder="senha"
                               minlength="8" maxlength="30"
                               pattern="[A-Za-z0-9!@.]*" id="senha" required="required"
                               autocomplete="off" />
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>

                                    <button style="background: #fff; border: solid 1px #dcdcdc;
                                    padding: 3px;" type="button" onclick="mostrarSenha()"><span id="ok" class="glyphicon glyphicon-ok"></span>
                                    </button> Mostrar senha
                                </label>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                        </div><!-- /.col -->
                    </div>
                </form>
                <style>
                    #ok{
                        opacity: 0;
                    }
                </style>
                <script>
                    function mostrarSenha(){
                        var tipo = document.getElementById("senha");
                        var m = document.getElementById("ok");
                        if(tipo.type == "password"){
                            tipo.type = "text";
                            m.style="opacity:1";

                        }else{
                            tipo.type = "password";
                            m.style="opacity:0";
                        }
                    }
                </script>
                <div class="social-auth-links text-center">
                    <p>- OU -</p>
                    <a href="<?php echo $loginUrl; ?>" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Entra usando Facebook</a>

                </div><!-- /.social-auth-links -->

                Ainda não possui uma conta?<a href="add_conta.php"> Crie grátis</a><br>
                <a href="esqueci_senha.php" class="text-center">Esqueceu a senha?</a>

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->


        <!-- jQuery 2.1.3 -->

        <script src="angosearch/adminlte-master/plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="angosearch/adminlte-master/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="angosearch/adminlte-master/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
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