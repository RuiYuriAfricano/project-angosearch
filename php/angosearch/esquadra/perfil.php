<?php
session_start();


if ( !$_SESSION['esquadra']) {
    header("Location:../../login-usuario.php");
} else {
    ?>
    <?php
    include 'include/conexao.php';



    $con=conecta();

    if (isset($_POST['sub'])) {

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];


        $id = $_POST['id'];

        if ($nome != "") {

            $tst=$con->query("select * from esquadra where email='$email' and id_esquadra!='$id'");
            $tst_pega=mysqli_num_rows($tst);
            if($tst_pega > 0){

                header('Location:perfil.php?msg=emailIG');
            }
            else{

            try {

                $atualiza = $con->query("update esquadra set func_esquadra='$nome' where id_esquadra='$id'");
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

        if ($email!="") {

            $tst=$con->query("select * from esquadra where email='$email' and id_esquadra!='$id'");
            $tst_pega=mysqli_num_rows($tst);
            if($tst_pega > 0){

                header('Location:perfil.php?msg=emailIG');
            }
            else{

                try {

                    $atualiza = $con->query("update esquadra set email='$email'  where id_esquadra='$id'");
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
        if ($tel!="") {

            $tst=$con->query("select * from esquadra where email='$email' and id_esquadra!='$id'");
            $tst_pega=mysqli_num_rows($tst);
            if($tst_pega > 0){

                header('Location:perfil.php?msg=emailIG');
            }
            else{

                try {

                    $atualiza = $con->query("update esquadra set telefone='$tel' where id_esquadra='$id'");
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





    }


    else if(isset($_POST['seguranca'])){

        $usuario = $_POST['usuario'];
        $senhaAntiga = $_POST['senhaAntiga'];
        $senhaNova = $_POST['senhaNova'];
        $senhaR = $_POST['senhaR'];

        $id = $_POST['id'];

        $u=$con->query("select * from login where fk_esquadra=".$id."");
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
                    $u=$con->query("update login set usuario='$usuario', senha='$se' where fk_esquadra=".$id."");
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
                        $atualiza = $con->query("update esquadra set func_foto='$uploadfile' where id_esquadra='$id'");
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

    <!doctype html>
    <html lang="pt-pt">
    <head>
        <!-- Required meta tags -->
        <meta http-equiv="Content­Type" content="text/html;charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">
        <title>Perfil do usuário</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../../../css/bootstracss">
        <link rel="stylesheet" href="../adminLTE-master/dist/css/adminLTE.css">

        <link rel="stylesheet" href="../adminLTE-master/bootstrap/css/bootstrap.css">

        <link rel="stylesheet" href="../../../vendors/linericon/style.css">
        <link rel="stylesheet" href="../../../css/font-awesome.min.css">
        <link rel="stylesheet" href="../../../vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="../../../vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" href="../../../vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="../../../vendors/animate-css/animate.css">
        <link href="../adminlte-master/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />





        <!-- main css -->
        <link rel="stylesheet" href="../../../css/style.css">


        <style>
            #ativo1{
                color: #005cbf;
            }

            /*--------------------*/
            /* HOME COURSE SECTION */
            /*--------------------*/



        </style>
    </head>
    <body class="skin-blue layout-top-nav">

    <!--================Header Menu Are
    a =================-->
    <header class="header_area">
        <?php include"include/header.php"; ?>
    </header>
    <!--================Header Menu Area =================-->
    <div class="content-wrapper" style="margin-top: 50px">
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <section class="content-header" >
                <h1>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a><small><?php echo $valores['func_esquadra'];?></small></h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="glyphicon glyphicon-edit"></i> Perfil</a></li>
                    <li class="active">AngoSearch</li>
                </ol>
            </section></div></div>
    <!--================Home Banner Area =================-->

    <!--================End Home Banner Area =================-->

    <!--================Welcome Area =================-->

    <br>
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

            else if ($_REQUEST["msg"] == "emailIG") {

                ?>
                <span class="notification n-error">Erro: Este email já existe, Insira outro !</span>
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


        ?>
    <div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
               <a href="../admin/midia/img/<?php echo $valores['func_foto']; ?>"> <img class="profile-user-img img-responsive img-circle"
                     src="../admin/midia/img/<?php echo $valores['func_foto']; ?>" style="margin: 0 auto;

width: 100px;

padding: 3px;

border: 3px solid #d2d6de; max-height: 128px;" alt="User profile picture"></a>
                <center><small><a href="#timeline"  data-toggle="tab">Alterar foto de Perfil</a></small></center>
                <h3 class="profile-username text-center"><?php echo $valores['func_esquadra']; ?></h3>

                <p class="text-muted text-center">utilizador
                    <small>desde <?php echo date('d-m-Y', strtotime('21-02-2019')); ?></p>

                <?php
                $n=$valores['func_esquadra']." : ".$valores['esquadra'];
                $p=$con->query("select * from desaparecidos where postado_por='".$n."'");
                $conta=mysqli_num_rows($p);

                $d=$con->query("select * from documentos where postado_por='".$n."'");
                $conta_d=mysqli_num_rows($d);
                ?>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b style="color: #444">Registro de Pessoas Desaparecidas</b> <a class="pull-right"><?php echo $conta; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b style="color: #444">Registro de Documentos Perdidos</b> <a class="pull-right"><?php echo $conta_d; ?></a>
                    </li>

                </ul>

                <a href="add_Pdesaparecida.php" class="btn btn-primary btn-block"><b style="color: #fff">Registrar Pessoa Desaparecida</b></a>
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
                <strong><i class="fa fa-database margin-r-5"></i> Esquadra</strong>

                <p><?php echo $valores['esquadra']; ?></p>

                <hr> <strong><i class="fa fa-user margin-r-5"></i> Meu Nome</strong>

                <p><?php echo $valores['func_esquadra']; ?></p>

                <hr>
                <strong><i class="fa fa-envelope margin-r-5"></i> E-mail</strong>

                <p><?php echo $valores['email']; ?></p>
                <hr>

                <strong><i class="fa fa-phone margin-r-5"></i> Telefone</strong>

                <p><?php echo $valores['telefone']; ?></p>


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



    <div class="active  tab-pane" id="settings" >
        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="">

            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Nome: <a><?php echo $valores['func_esquadra']; ?></a></label>

                <div class="col-sm-10">
                    <input type="text"  maxlength="60" minlength="6"
                           id="nome" pattern="[A-Za-zà-ýÀ-Ý-ç ]*" name="nome" style="" value=""  placeholder="actualize seu nome"/>
                    <input type="hidden" name="id"  value="<?php echo $valores['id_esquadra']; ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Email: <a><?php echo $valores['email']; ?></a></label>

                <div class="col-sm-10">
                    <input type="text" pattern="[A-z0-9._+-]+@[A-z0-9.-]+\.[A-z]{2,4}$"
                           maxlength="60"  name="email" style="" value=""  placeholder="actualize seu e-mail"/>

                </div>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Telefone: <a><?php echo $valores['telefone']; ?></a></label>

                <div class="col-sm-10">
                    <input type="tel" placeholder="actualize seu número" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" minlength="9" maxlength="9"
                           name="tel" style="" value=""/>

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
                        <input type="hidden" name="id"  value="<?php echo $valores['id_esquadra']; ?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="alterar_foto" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>

        <?php $u=$con->query("select * from login where fk_esquadra=".$valores['id_esquadra']."");
        $pega_u=mysqli_fetch_array($u);


        ?>

        <div class="tab-pane" id="seg">
            <form class="form-horizontal"   enctype="multipart/form-data" method="post" action="">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">usuario</label>

                    <div class="col-sm-10">
                        <input type="hidden" name="id"  value="<?php echo $valores['id_esquadra']; ?>"/>
                        <input id="val-login" type="text" maxlength="80" pattern="[A-Za-z0-9!@.\-_]*" required="required"  name="usuario" value="<?php echo $pega_u['usuario']; ?>"/>
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
    </div>

    <!--================End Event Area =================-->


    <!--================Clients Logo Area =================-->
    <section class="clients_logo_area">
        <?php include"include/clients_logo.php"; ?>
    </section>
    <!--================End Clients Logo Area =================-->


    <!--================ start footer Area  =================-->
    <!-- Footer -->

    <footer class="footerR">
        <?php include "include/rodape.php";

        ?>
    </footer>

    <!--================ End footer Area  =================-->


    <div class="btn-back-to-top bg0-hov" id="myBtn" style="display: flex;">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
    </div>

    <style>
        .symbol-btn-back-to-top {

            font-size: 22px;
            color: white;
            line-height: 1em;

        }
        .btn-back-to-top:hover {

            cursor: pointer;

        }
        .btn-back-to-top {
            display: none;
            position: fixed;
            width: 40px;
            height: 40px;
            bottom: 40px;
            right: 40px;
            background-color: black;
            opacity: 0.5;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            border-radius: 4px;
            transition: all 0.4s;
            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            font-weight: 400;
            font-size: 16px;
            line-height: 1.5;
        }
    </style>




    <script src="../adminlte-master/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="../adminlte-master/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="../../../js/jquery-3.2.1.min.js"></script>
    <script src="../../../js/calendario.js"></script>
    <script src="../../../js/popper.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
    <script src="../../../js/stellar.js"></script>
    <script src="../../../vendors/lightbox/simpleLightbox.min.js"></script>
    <script src="../../../vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="../../../vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="../../../vendors/isotope/isotope-min.js"></script>
    <script src="../../../vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="../../../js/jquery.ajaxchimp.min.js"></script>
    <script src="../../../js/mail-script.js"></script>
    <script src="../../../js/theme.js"></script>

    <!-- counter -->
    <script src="../../plugins/jquery-3.2.1.min.js"></script>
    <script src="../../plugins/greensock/TweenMax.min.js"></script>
    <script src="../../plugins/greensock/TimelineMax.min.js"></script>
    <script src="../../plugins/scrollmagic/ScrollMagic.min.js"></script>
    <script src="../../plugins/greensock/animation.gsap.min.js"></script>
    <script src="../../plugins/greensock/ScrollToPlugin.min.js"></script>
    <script src="../../plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="../../plugins/easing/easing.js"></script>
    <script src="../../plugins/parallax-js-master/parallax.min.js"></script>
    <script src="../../plugins/custom.js"></script>

    <script src="../../Cadastro%20-%20DevMedia_arquivos/api.js"></script>
    <script src="../../Cadastro%20-%20DevMedia_arquivos/api_002.js"></script>
    <script type="text/javascript" src="../../Cadastro%20-%20DevMedia_arquivos/jquery_002.js"></script>
    <script type="text/javascript" src="../../Cadastro%20-%20DevMedia_arquivos/jquery-ui.js"></script>
    <script type="text/javascript" src="../../Cadastro%20-%20DevMedia_arquivos/notifIt.js"></script>
    <script type="text/javascript" src="../../Cadastro%20-%20DevMedia_arquivos/index.js"></script>


    </body>
    </html>
<?php

}   ?>