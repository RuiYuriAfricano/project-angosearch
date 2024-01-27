<?php include "include/conexao.php";
$con=conecta();
?>
<?php

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

if(isset($_POST['enviar'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $rsenha = $_POST['rsenha'];
    $tel = $_POST['tel'];
    $usuario = $_POST['usuario'];
    $dataRegistro=date('Y-m-d H:i:s');

        if($senha==$rsenha) {

            $sql = $con->query("select email from utilizador where email='$email'") or die("Erro");
            $contaEmail = mysqli_num_rows($sql);
            if ($contaEmail > 0) {
                header('Location:add_conta.php?msg=emailExistente');
            } else {
                $sql1 = $con->query("select usuario from login where usuario='$usuario'") or die("Erro");
                $contaUsuario = mysqli_num_rows($sql1);
                if ($contaUsuario > 0) {
                    header('Location:add_conta.php?msg=usuarioExistente');
                } else {
                    $insere = $con->query("insert into utilizador(id_utilizador,nome_completo,foto,telefone,email,estado,dataRegistro,
cod_confirmacao,fk_bairro,fk_genero)
                                  values(DEFAULT , '$nome','usuario.png','$tel','$email','0','$dataRegistro','492069','5','3')");

                    $id_user = mysqli_insert_id($con);
                    $nova_senha=md5($senha);

                    $insere = $con->query("insert into login(id_login,usuario,senha,acesso,estado,fk_utilizador)
                                  values(DEFAULT , '$usuario','$nova_senha','utilizador','0','$id_user')");
                    //header('Location:add_conta.php?msg=add');
                    header('Location:confirmar_conta.php?id='.$id_user.'&& email='.$email);
                }
            }
        }
    else{
        header('Location:add_conta.php?msg=senhaDf');
    }

}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Criar Conta</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      <link rel="icon" href="../midia/img/fav-iconAngo.jpg" type="image/jpg">
    <!-- Bootstrap 3.3.2 -->
    <link href="angosearch/adminlte-master/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="../css/font-awesome.min.css">
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="angosearch/adminlte-master/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="angosearch/adminlte-master/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

    <![endif]-->
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
  <body class="register-page">
    <div class="register-box">
      <div class="register-logo">
        <a href="index.php">
          <img height="70px" src="../midia/logotipo/<?php echo $dados['logo'];?>" alt="ANGOSEARCH">
          </a>
      </div>


      <div class="register-box-body">
          <div style="">
              <?Php
              if(isset($_REQUEST["msg"])) {
                  if ($_REQUEST["msg"] == "emailExistente") {

                      ?>
                      <b class="text-danger"><span class='fa fa-warning'></span> Email inserido já existe. Por favor,
                          digite outro !</b>
                  <?php }

                  if ($_REQUEST["msg"] == "add") {

                      ?>
                      <b class="text-success"><span class='fa fa-send'></span> Cadastrado com sucesso. Bem Vindo ao Sistema!</b>
                  <?php }
                  if ($_REQUEST["msg"] == "usuarioExistente") {
                      ?>
                      <b class="text-danger"><span class='fa fa-warning'></span> Usuário inserido já existe. Por favor,
                          digite outro !</b>


                  <?php }


                  if ($_REQUEST["msg"] == "senhaDf") {

                      ?>


                      <b class="text-danger"><span class='fa fa-warning'></span> Por favor digite senhas iguais !</b>


                  <?php }


                  if ($_REQUEST["msg"] == "erro") {

                      ?>


                      <span class='notification n-error'>Preencha os campos por favor...!</span>


                  <?php
                  }
              }?>
          </div>

          <p class="login-box-msg"><div class="form-header">
              <div class="form-header-image">
                  <img src="../midia/new-user.svg">
              </div>

              <div class="form-header-info">
                  <label>Criar conta</label>
                  <span>Novo usuário</span>
              </div>
          </div></p>
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="nome" placeholder="nome completo" maxlength="90" minlength="6"
                   id="nome" pattern="[A-Za-zà-ýÀ-Ý-ç ]*"
                   required="required"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" pattern="[A-z0-9._+-]+@[A-z0-9.-]+\.[A-z]{2,4}$"
                   maxlength="60" required="required"name="email" placeholder="Email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
            <div class="form-group has-feedback input-group">
                <div class="input-group-addon">
                    <i class="fa fa-phon">+244</i>
                </div>
                <input type="tel" class="form-control" name="tel" placeholder="9xx-xxx-xxx" id="telContato"
                       pattern="[0-9]{3} [0-9]{3} [0-9]{3}"/>
                <span style="padding-top: 9px" class="glyphicon fa fa-phone form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="val-login" type="text" maxlength="80" pattern="[A-Za-z0-9!@.\-_]*" required="required" class="form-control"
                       name="usuario" placeholder="nome de usuário"/>
                <span style="padding-top: 9px" class="glyphicon fa fa-user form-control-feedback"></span>
            </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="senha" placeholder="Senha" minlength="8" maxlength="30"
                   pattern="[A-Za-z0-9!@.]*" id="senha" required="required"
                   autocomplete="off"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="rsenha" placeholder="confirme a senha" minlength="8" maxlength="30"
                   pattern="[A-Za-z0-9!@.]*" id="senha" required="required"
                   autocomplete="off"/>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" required="required"> Eu aceito os <a href="#">termos</a>
                </label>
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" name="enviar" class="btn btn-primary btn-block btn-flat">Enviar</button>
            </div><!-- /.col -->
          </div>
        </form>        

        <div class="social-auth-links text-center">
          <p>- OU -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Entra usando Facebook</a>
        </div>

        Se já possui uma conta<a href="login-usuario.php" class="text-center"> Clique aqui</a>
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->

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