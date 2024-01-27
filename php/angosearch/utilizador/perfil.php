<?php
session_start();


if ( !$_SESSION['utilizador']) {
    header("Location:../../login-usuario.php");
} else {
    ?>
    <?php
    include 'include/conexao.php';



    $con=conecta();
    if (isset($_POST['sub'])) {

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $nascimento = $_POST['nascimento'];
        $tel = $_POST['tel'];
        $nota = $_POST['nota'];

        $id = $_POST['id'];

        if ($nome != "") {
            try {

                $atualiza = $con->query("update utilizador set nome_completo='$nome' where id_utilizador='$id'");
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

                $atualiza = $con->query("update utilizador set  email='$email' where id_utilizador='$id'");
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
        if ($tel!="") {
            try {

                $atualiza = $con->query("update utilizador set  telefone='$tel' where id_utilizador='$id'");
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
        if (!empty($nota)) {
            try {

                $atualiza = $con->query("update utilizador set nota='$nota' where id_utilizador='$id'");
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

        $u=$con->query("select * from login where fk_utilizador=".$id."");
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
                    $u=$con->query("update login set usuario='$usuario', senha='$se' where fk_utilizador=".$id."");
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
                        $atualiza = $con->query("update utilizador set foto='$uploadfile' where id_utilizador='$id'");
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




        <link href="../../slider/css/style.css" rel="stylesheet" type="text/css"/>
        <!-- Other StyleSheet -->
        <link href="../../slider/css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="../../slider/css/slicknav.css" rel="stylesheet" type="text/css"/>
        <link href="../../slider/css/global.css" rel="stylesheet" type="text/css"/>
        <link href="../../slider/css/prettyPhoto.css" rel="stylesheet" type="text/css"/>
        <!-- Layer Slider -->
        <link rel="stylesheet" href="../../slider/layerslider/css/layerslider.css" type="text/css"/>

        <!-- main css -->
        <link rel="stylesheet" href="../../../css/style.css">
        <link rel="stylesheet" href="../../../css/responsive.css"

        <link rel="stylesheet" href="../../../js/jq/bootstrap.css">

        <script type="text/javascript" src="../../../js/jq/jq.js"></script>
        <script type="text/javascript" src="../../../js/jq/bootstrap.js"></script>
        <style>
            #ativo1{
                color: #005cbf;
            }

            /*--------------------*/
            /* HOME COURSE SECTION */
            /*--------------------*/



        </style>


        <script type="text/javascript">

            function informa() {
                alert("Caro utilizador.......!      " +
                "Terminaremos sua Sessão se Actualizares o seu Nome. Por sua vez terás de Iniciar outra vez. Obrigado!");
            }
                        </script>
    </head>
    <body class="skin-blue layout-top-nav" onload="informa();">

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
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a> <small><?php echo$_SESSION['utilizador'];?></small></h1>
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
        $nu=$_SESSION['utilizador'];
        $p=$con->query("select id_utilizador from utilizador where nome_completo='$nu'");
        $pega_id=mysqli_fetch_array($p);

        $s=$con->query("select nome_completo,bi,nascimento,id_bairro,bairro,genero,id_genero,telefone,email,nota from
                        utilizador,bairro,genero where estado='1' and fk_bairro=id_bairro and fk_genero=id_genero and
                        id_utilizador=".$pega_id['id_utilizador']." ");
        if(mysqli_num_rows($s)>0):
        $pega_dd=mysqli_fetch_array($s);

        else:
            $ss=$con->query("select nome_completo,bi,nascimento,id_bairro,bairro,genero,id_genero,telefone,email,nota from
                        utilizador,bairro,genero where estado='1' and
                        id_utilizador='".$pega_id['id_utilizador']."' ");
            $pega_dd=mysqli_fetch_array($ss);
            endif;

        ?>
    <div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <a href="../admin/midia/img/<?php echo $pega['foto']; ?>"><img class="profile-user-img img-responsive img-circle"
                     src="../admin/midia/img/<?php echo $pega['foto']; ?>" style="margin: 0 auto;

width: 100px;

padding: 3px;

border: 3px solid #d2d6de; max-height: 128px;" alt="User profile picture"></a>
            <center><small><a href="#timeline"  data-toggle="tab">Alterar foto de Perfil</a></small></center>
                <h3 class="profile-username text-center"><?php echo $pega['nome_completo']; ?></h3>

                <p class="text-muted text-center">utilizador
                    <small>desde <?php echo date('d-m-Y', strtotime($pega['dataRegistro'])); ?></p>

                <ul class="list-group list-group-unbordered">
                    <?php $comunicado=$con->query("select * from desaparecidos where fk_utilizador='".$pega_id['id_utilizador']."'");
                    $conta=mysqli_num_rows($comunicado);
                    ?>  <li class="list-group-item">

                        <b style="color: #444">Comunicados feitos</b> <a class="pull-right"><?php echo $conta; ?></a>
                    </li>
                    <li class="list-group-item">

                        <b style="color: #444">Meus comunicados</b> <a class="pull-right" href="perfil.php"> Ver</a>
                    </li>

                </ul>

                <a href="#" class="btn btn-primary btn-block"><b style="color: #fff">Fazer Comunicado</b></a>
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
            <?php
            if(!empty($pega_dd['id_bairro'])):
                $ex=$con->query("select municipio,id_municipio from bairro,municipio where id_bairro=".$pega_dd['id_bairro']."
        and fk_municipio=id_municipio");

                $pega_ex=mysqli_fetch_array($ex);

                $ex1=$con->query("select provincia from municipio,provincia where id_municipio=".$pega_ex['id_municipio']." and
        fk_provincia=id_provincia");
                $pega_ex1=mysqli_fetch_array($ex1);

            ?>

                <strong><i class="fa fa-map-marker margin-r-5"></i> Minha Localização</strong>

                <p class="text-muted"><?php echo $pega_dd['bairro']; ?>, <?php echo $pega_ex['municipio']; ?>,
                    <?php echo $pega_ex1['provincia']; ?></p>


                <hr>


                <strong><i class="fa fa-database margin-r-5"></i> Nº do Bi</strong>

                <p><?php echo $pega_dd['bi']; ?></p>
                <hr>
                <strong><i class="fa fa-envelope margin-r-5"></i> E-mail</strong>

                <p><?php echo $pega_dd['email']; ?></p>
                <hr>

                <strong><i class="fa fa-file-text-o margin-r-5"></i> Sobre</strong>

                <p><?php echo $pega_dd['nota']; ?></p>

                <?php endif; ?>
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
                <label for="inputName" class="col-sm-2 control-label">Nome: <a><?php echo $pega_dd['nome_completo']; ?></a></label>

                <div class="col-sm-10">
                    <input type="text" maxlength="60" minlength="6"
                           id="nome" pattern="[A-Za-zà-ýÀ-Ý-ç ]*"
                          name="nome" placeholder="Actualize o nome"  value=""/>
                    <input type="hidden" name="id"  value="<?php echo $pega_id['id_utilizador']; ?>"/>
                </div>
            </div>

    <?php if($pega_dd['genero']==""){ ?>
            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Seleccione seu Genero</label>

                <div class="col-sm-10">
                    <select name="genero" class="form-control">

                        <?php $sql = $con->query("select id_genero,genero
 from genero ORDER BY id_genero ASC ") or die("Erro na Busca");



                        $linhas = mysqli_num_rows($sql);

                        if ($linhas > 0) {

                            while ($dados1 = mysqli_fetch_assoc($sql)) { ?>
                                <option value="<?php echo $dados1["id_genero"]; ?>" style="color:#002a80;"><?php echo $dados1["genero"]; ?></option><?php } } ?>
                    </select>
                </div>
            </div> <?php } ?>
            <?php if($pega_dd['nascimento']==""){ ?>
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Data de Nascimento: <?php echo date('Y-m-d', strtotime($pega_dd['nascimento'])); ?></label>

                <div class="col-sm-10">
                    <input type="date" class="form-control" id="inputName" name="nascimento"
                           value="">
                </div>
            </div>
<?php } ?>
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Email: <a><?php echo $pega_dd['email']; ?></a></label>

                <div class="col-sm-10">
                    <input type="email" pattern="[A-z0-9._+-]+@[A-z0-9.-]+\.[A-z]{2,4}$"
                           maxlength="60" placeholder="Actualize o email" name="email"   value=""/>
                </div>
            </div>

            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Telefone: <a><?php echo $pega_dd['telefone']; ?></a></label>

                <div class="col-sm-10">
                    <input type="tel" class="" id=""  pattern="[0-9]{3}[0-9]{3}[0-9]{3}" minlength="9" maxlength="9" name="tel" style="" placeholder="Actualize seu telefone" value=""/>
                </div>
            </div>
    <?php if($pega_dd['bairro']==""){ ?>
            <div class="form-group">
                <label for="inputExperience" class="col-sm-2 control-label">Seleccione seu Bairro</label>

                <div class="col-sm-10">
                    <select name="bairro"  class="form-control select2" style="width: 100%;">

                        <?php $sql = $con->query("select id_bairro, bairro
 from bairro") or die("Erro na Busca");



                        $linhas = mysqli_num_rows($sql);

                        if ($linhas > 0) {

                            while ($dados = mysqli_fetch_assoc($sql)) { ?>
                                <option value="<?php echo $dados["id_bairro"]; ?>" ><?php echo $dados["bairro"]; ?></option><?php } } ?>
                    </select>
                </div>
            </div><?php } ?>
            <div class="form-group">
                <label for="inputSkills" class="col-sm-2 control-label">Sobre me</label>

                <div class="col-sm-10">
                    <textarea type="text" class="form-control" name="nota" id="inputSkills" placeholder=""><?php echo $pega_dd['nota']; ?></textarea>
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
                        <input type="hidden" name="id"  value="<?php echo $pega_id['id_utilizador']; ?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="alterar_foto" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>

        <?php $u=$con->query("select * from login where fk_utilizador=".$pega_id['id_utilizador']."");
        $pega_u=mysqli_fetch_array($u);


        ?>

        <div class="tab-pane" id="seg">
            <form class="form-horizontal"   enctype="multipart/form-data" method="post" action="">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">usuario</label>

                    <div class="col-sm-10">
                        <input type="hidden" name="id"  value="<?php echo $pega_id['id_utilizador']; ?>"/>
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
    <!-- Bootstrap core JavaScript
        ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../adminlte-master/plugins/jquery/dist/jquery.min.js"></script>
    <script src="../adminlte-master/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../adminlte-master/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
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
    </script>

    </body>
    </html>
<?php

}   ?>