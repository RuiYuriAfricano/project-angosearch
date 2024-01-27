

    <?php
    include 'include/conexao.php';
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
    $id=$_GET['id'];
    $email=$_GET['email'];
    $nome=$_GET['nome'];
    $foto=$_GET['foto'];



    if(empty($id) && empty($nome)){
        header("Location:login-usuario.php");
    }

    if(isset($_POST['ok'])) {

        $cod = $_POST['cod'];


        $pesq=$con->query("select * from login where cod_recuperacao='$cod'");
        if(mysqli_num_rows($pesq) > 0){

            header('Location:alterar_senha.php?id='.$id.'&& nome='.$nome);
        }

        else{
            echo" <script>
                    window.onload = function()
                    {
                        alert('O código introduzido não corresponde ao que foi enviado');
                    }
        </script> ";
        }



    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Recuperar Conta | Angosearch</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="angosearch/adminlte-master/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="angosearch/adminlte-master/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    </head>

    <body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <a href="index.php"><img style="width: 140px;height: 49px"
                                     src="../midia/logotipo/<?php echo $dados['logo'];?>" alt="ANGOSEARCH"></b></a>
        </div>
        <!-- User name -->
        <div class="lockscreen-name">Recuperar Conta «<?php echo $nome; ?>»</div>
        <br>

        <!-- START LOCK SCREEN ITEM -->
        <div class="lockscreen-item">
            <!-- lockscreen image -->
            <div class="lockscreen-image">
                <img src="angosearch/admin/midia/img/<?php echo $foto; ?>" alt="User Image" />
            </div>
            <!-- /.lockscreen-image -->

            <!-- lockscreen credentials (contains the form) -->
            <form class="lockscreen-credentials" action="" method="post">

                <div class="input-group">

                    <input type="number" class="form-control" minlength="6" maxlength="8" name="cod"  required="required" placeholder="código de confirmação">

                    <div class="input-group-btn">
                        <button type="submit" name="ok" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                    </div>
                </div>

            </form>
            <!-- /.lockscreen credentials -->

        </div>
        <!-- /.lockscreen-item -->
        <div class="help-block text-center">
            Enviamos um código para o E-mail <br>« <?php echo $email; ?> »
        </div>
        <div class="text-center">
            <a href="login-usuario.php">Regressar a página anterior</a>
        </div>

    </div>

    <script src="angosearch/adminlte-master/plugins/jQuery/jQuery-2.1.3.min.js"></script>

    <script src="angosearch/adminlte-master/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>


    </body>
    </html>
