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
    $id=$_GET['id_login'];
    $nome=$_GET['admin'];
    $foto =$_GET['foto'];


    if(empty($id) && empty($nome) && empty($foto)){
        header("Location:view_desaparecidos.php");
    }

    if(isset($_POST['remover'])) {


        $dataDesactivado=date("Y-m-d");
        $senha = md5($_POST['senha']);

        $n=$_SESSION['nome_admin'];
        $q=$con->query("select usuario from login where admin='$n' and estado='1'");
        $pegaUs=mysqli_fetch_array($q);
        $usuario=$pegaUs['usuario'];
        $p= $con->query("select * from login where senha='$senha' and usuario='$usuario' and estado='1'");

        if(mysqli_num_rows($p) > 0):

            $testaExiste=$con->query("select * from login where id_login='$id' and admin='$n' and estado='1'");

            if(mysqli_num_rows($testaExiste) > 0){

                header("Location:view_admin.php?msg=adminAct");
            }
            else {
                $del = $con->query("update login set estado='0',dtDesactivado='$dataDesactivado' where id_login='$id' and estado='1'
and acesso='admin'")
                or die("Erro Ao Eliminar");


                header("Location:view_admin.php");
            }

        else:
            header("Location:view_admin.php?msg=senhaerror");
        endif;


    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Desactivar ADMIN | Angosearch</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php include "include/links.php"; ?>
    </head>

    <body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <a href="index.php"><img style="width: 140px;height: 49px"
                                     src="../../../midia/logotipo/<?php echo $dados['logo'];?>" alt="ANGOSEARCH"></b></a>
        </div>
        <!-- User name -->
        <div class="lockscreen-name">Desactivar ADMIN  " <?php echo $nome; ?> "</div>
        <br>

        <!-- START LOCK SCREEN ITEM -->
        <div class="lockscreen-item">
            <!-- lockscreen image -->
            <div class="lockscreen-image">
                <img src="../admin/midia/img/<?php echo $foto; ?>" alt="User Image" />
            </div>
            <!-- /.lockscreen-image -->

            <!-- lockscreen credentials (contains the form) -->
            <form class="lockscreen-credentials" action="" method="post">

                <div class="input-group">

                    <input type="password" class="form-control" name="senha"  required="required" placeholder="sua palavra passe">

                    <div class="input-group-btn">
                        <button type="submit" name="remover" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                    </div>
                </div>

            </form>
            <!-- /.lockscreen credentials -->

        </div>
        <!-- /.lockscreen-item -->
        <div class="help-block text-center">
            Digite a sua palavra passe para, efectuar esta tarefa...
        </div>
        <div class="text-center">
            <a href="view_admin.php">Regressar a página anterior</a>
        </div>

    </div>

    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>

    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>


    </body>
    </html>

<?php }else{
    header("Location:../../login-usuario.php");
} ?>