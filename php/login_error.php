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
    ?>
    <!DOCKTYPE html>
    <html>
    <head>
        <meta http-equiv="Content­Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="../midia/img/fav-iconAngo.jpg" type="image/jpg">
        <title>Entrar</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="angosearch/admin/css/glyphicon.css">
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
    <body  onload="setInterval('apresentaData()',1000);">

    <!--================Header Menu Are
    a =================-->

    <!--================Header Menu Area =================-->




    </body>
    <body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="index.php"></a>
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

                echo $_SESSION['erroLogin'];?></p>
            <form action="verificaLogin.php" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="usuario" placeholder="usuario"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="senha" placeholder="senha"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Lembrar Me
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                    </div><!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- OU -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Entra usando Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i>
                    Entra usando Gmail</a>
            </div><!-- /.social-auth-links -->

            <a href="#">Esqueci a senha ?</a><br>
            <a href="add_conta.php" class="text-center">Novo usuário</a>

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
    </body>
    </html>

<?php

}   ?>