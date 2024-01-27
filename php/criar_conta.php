<?php
/*ini_set("mail.log","/tmp/mail.log");
ini_set("mail.add_x_header",true);*/


session_start();

if ( isset($_SESSION['nome_admin'])) {
    header("Location:angosearch/AdminLTE-master/index.php");
} else {
    ?>
    <?php include "include/conexao.php";
    $con=conecta();

    if(isset($_POST['cadastrarBotao'])) {

        $nome = $_POST['nome']; //nome da pessoa ou da empresa
        $pessoa = $_POST['pessoa'];//F e J
        $func_empresa = $_POST['nomeContato'];

        $email = $_POST['email'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $telefone = $_POST['telefone'];
        $genero = $_POST['genero'];
        $dataRegistro=date('Y-m-d H:i:s');
                ?>


        <?php


        if ($genero != "") {
            $sql6 = $con->query("select * from genero") or die
            ("Erro");
            $linhas6 = mysqli_num_rows($sql6);

            if ($linhas6 > 0) {


                while ($dados6 = mysqli_fetch_assoc($sql6)) {

                    $dados6["genero"];
                    $dados6["id_genero"];

                    if ($genero == $dados6["genero"]) {

                        $genero = $dados6["id_genero"];
                    }
                }

            }
        } else {
            $genero = 3;
        }

        ?>

        <?php



        if($pessoa=="F") {
            try {
                $insere = $con->query("INSERT INTO utilizador(id_utilizador, nome_completo, pessoa,
  fk_genero, telefone, email,dataRegistro, estado) VALUES
  (DEFAULT , '$nome' , 'sim','$genero','$telefone','$email','$dataRegistro','0')");
                $id=$con->query("select id_utilizador from utilizador WHERE  nome_completo='$nome'");
                $pega_id=mysqli_fetch_assoc($id);
                $idd= $pega_id['id_utilizador'];
                $md5=md5($idd);

                require'include/PHPMailer-master/src/PHPMailerAutoload.php';
                $Mailer = new PHPMail;
                //define que será usado SMTP
                $Mailer->isSMTP();
                //enviar e-mail em HTML
                $Mailer->isHTML(true);

                //aceitar caracteres especiais
                $Mailer->CharSet='UTF-8';
                //configurações
                $Mailer->SMTPAuth=true;
                $Mailer->SMTPSecure='tls';

                //nome do servidor
                $Mailer->Host='smtp.hmail.com';
                //porta de saída de e-mail
                $Mailer->Port=587;

                //dados do e-mail de saída - autenticação
                $Mailer->Username='ruimalemba11@gmail.com';
                $Mailer->Password='malemba11';

                //emaildo remetente (deve ser o mesmo de quem fez a autenicação)
                $Mailer->From ='ruimalemba11@gmail.com';
                //nome do remetente
                $Mailer->FromName='Rui Malemba';


                //assunto da mensagem
                $Mailer->Subject='Confirme seu Cadastro';
                $msg = "Olá <br><br>";
                $msg .= "Confirme seu E-mail para acessar ao sistema de procura de pessoas desaparecidas<br><br>";
                    $msg .= "<a href='http://localhost/Projecto%20Final%20-%20Loide%20Laura/php/criar_conta.php?id=".$md5."'>
 Clique aqui para confirmar o seu E-mail</a><br><br>";
                $msg .= "Se você recebeu esta mensagem por engano , simplesmente exclua. <br><br>";
                $msg .= "~~ Yuri Africano";

                //corpo da mensagem
                $Mailer->Body=$msg;
                //corpo da mensagem em texto
                $Mailer->AltBody='conteúdo do E-mail em texto';

                //destinatário
                $Mailer->AddAddress($email);

                if($Mailer->isSendmail()){
                    echo "E-mail enviado com sucesso";
                }else{
                    echo "Erro no envio do e-mail".$Mailer->ErrorInfo;
                }
                /*
                $to=$email;
                $subject="Confirme seu Cadastro";
                $link="http://localhost/Projecto%20Final%20-%20Loide%20Laura/php/criar_conta.php?id=".$md5;
                $txt="Clique aqui para confirmar o seu cadastro ".$link;
                $header="From : ruimalemba11@gmail.com";
                @mail($to,$subject,$txt,$header);*/



                if ($insere === FALSE) {
                    throw new Exception('Problemas: ' . $con->errno . ' --- ' . $con->error . '<br />');
                } else {
                   echo" <script>
                    window.onload = function()
                    {
                        alert('Receberás uma mensagem no seu email para autenticar o seu cadastro!');
                    }
        </script> ";// enviado com sucesso
                }
            } catch (Exception $e) {
                //caso haja uma exceção a mensagem é capturada e atribuida a $msg
                echo $e->getMessage();
            }
        }

        else if($pessoa=="J"){

        try {
            $insere = $con->query("INSERT INTO utilizador(id_utilizador,nome_empresa ,func_empresa,pessoa, telefone,email,dataRegistro estado) VALUES
  (DEFAULT ,'$nome' ,'$func_empresa','não','$telefone','$email','$dataRegistro','0')");
            if ($insere === FALSE) {
                throw new Exception('Problemas: ' . $con->errno . ' --- ' . $con->error . '<br />');
            } else {
                echo" <script>
                    window.onload = function()
                    {
                        alert('Cadastro com Sucesso...!<br>Já és um  usuário  do AngoSearch!');
                    }
        </script> "; // enviado com sucesso
            }
        } catch (Exception $e) {
            //caso haja uma exceção a mensagem é capturada e atribuida a $msg
            echo $e->getMessage();
        }
            }

        }

    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="../midia/img/fav-iconAngo.jpg" type="image/jpg">
        <title>Cadastro-AngoSearch</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../vendors/linericon/style.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="../vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" href="../vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="../vendors/animate-css/animate.css">
        <!-- main css -->
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/estilo.css">
        <link rel="stylesheet" href="../css/notifIt.css">
        <link href="Cadastro%20-%20DevMedia_arquivos/css.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/responsive.css">


    </head>
    <body>

    <!--================Header Menu Area =================-->
    <header class="header_area">
        <?php include"include/cabecalho.php"; ?>
    </header>
    <!--================Header Menu Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
            <div class="container">
                <div class="banner_content text-center">
                    <h2>Cadastre - se</h2>
                    <div class="page_link">
                        <a href="index.php">" Crie sua conta no Portal Angosearch, para ter mais previlégio ! "</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <main class="content-site-devmedia  table-responsive" ><section class="signup-wrapper" data-status="" data-msg="">
    <div class="signup-section " id="novoChamadoForm">
        <div class="signup-container">
            <div class="form-header">
                <div class="form-header-image">
                    <img src="../midia/new-user.svg">
                </div>

                <div class="form-header-info">
                    <label>Criar conta</label>
                    <span>Novo usuário</span>
                </div>
            </div>

            <form class="allForm signup-form" method="post" action="">
                <div class="type-container">
                    <div class="individuals-container">
                        <input id="fisica" class="pessoa" type="radio" name="pessoa" value="F" checked="checked" required="required">

                        <label class="input-radio" for="fisica">
                            Pessoa Física
                        </label>
                    </div>

                    <div class="company-container">
                        <input id="juridica" class="pessoa" type="radio" name="pessoa" value="J" required="required">

                        <label class="input-radio   fa fa-search" for="juridica">
                            Empresa
                        </label>
                    </div>
                </div>

                <div class="form-container">
                    <div class="input-container">
                        <label class="input-label" id="lbl-nome" for="nome">
                            Nome
                        </label>

                        <input type="text" maxlength="60" name="nome" id="nome" pattern="[A-Za-zà-ýÀ-Ý0-9ç ]*"
                               required="required" placeholder="Seu nome">
                    </div>




                    <div class="input-container" id="genero-container">
                        <label for="pais" class="input-label">Genero:</label>
                        <div class="dropdown-container">
                            <select id="estado" name="genero" required="required" class="input-group" >
                               <option></option>
                                <?php $sql = $con->query("select genero
 from genero ORDER  BY  id_genero asc") or die("Erro na Busca");



                                $linhas = mysqli_num_rows($sql);

                                if ($linhas > 0) {

                                    while ($dados1 = mysqli_fetch_assoc($sql)) { ?>
                                        <option ><?php echo $dados1["genero"]; ?></option><?php } } ?>



                            </select>


                        </div>
                    </div>

                    <div class="input-container nomeContato" style="display: none;">
                        <label class="input-label" for="nomeContato">Seu nome:</label>
                        <input id="nomeContato" maxlength="50" pattern="[A-Za-zà-ýÀ-Ý0-9ç ]*" type="text" name="nomeContato" placeholder="Seu nome">
                    </div><br>
                    <div class="input-container">
                        <label class="input-label" for="email">
                            Email
                        </label> 

                        <input type="email" id="email" pattern="[A-z0-9._+-]+@[A-z0-9.-]+\.[A-z]{2,4}$" name="email"
                               maxlength="60" required="required" placeholder="Seu email">
                        <label class="email-error" id="aviso-email"></label>
                    </div>
                    <div class="input-container esconde-item" id="container-email-links">
                        <label class="input-label" for="login" id="email-error-links">
                            <a id="error-link-login">Entrar</a> | <a href="#">Lembrar Senha</a>
                        </label>
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="login">
                            Login
                        </label>

                        <input id="val-login" type="text" maxlength="80" pattern="[A-Za-z0-9!@.\-_]*" name="login" required="required"
                               placeholder="Nome de usuário">
                        <label class="login-error" id="aviso-login"></label>
                    </div>

                    <div class="input-container">
                        <label class="input-label" for="senha">
                            Senha
                        </label>

                        <input id="senha" minlength="5" maxlength="30" type="password" pattern="[A-Za-z0-9!@.]*" name="senha"
                               required="required"
                               autocomplete="off" placeholder="Sua senha">
                    </div>
                    <div class="input-container">
                        <label class="input-label" for="senha">
                            Confirme a Senha
                        </label>

                        <input id="senha" minlength="5" maxlength="30" type="password" pattern="[A-Za-z0-9!@.]*" name="Rsenha" required="required"
                               autocomplete="off" placeholder="Sua senha">
                    </div>


                    <div class="input-container">
                        <label class="input-label" for="telContato" >Telefone</label>

                        <div class="phone-container">
                            <input id="telContatoDDD" maxlength="3" pattern="[0-9]+$" type="tel" name="telContatoDDD" value="+244" readonly="readonly" placeholder=""
                                   required="required">
                            <input id="telContato" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" placeholder="9xx-xxx-xxx"
                                   type="tel" name="telefone" required="required" class="input-group">
                        </div>
                    </div>



                    <!-- <div class="captcha-container">
                        <div class="g-recaptcha" data-sitekey="6Lf0ASMTAAAAAKdDEmWyrADpH1bOM7AfmbqZxnts"></div>
                    </div> -->

                    <div class="form-button-container">
                        <input type="hidden" name="funcao" value="cadastrarUsuario">
                        <button type="submit" id="cadastrarBotao" name="cadastrarBotao">
                            Enviar
                        </button>
                    </div>
                </div>
                <input type="hidden" name="ret" value="chat/">
            </form>
            <label class="lbl-link">Já tem conta? <a id="form-header-login">Entrar</a></label>
        </div>
    </div>


    <div class="login-section exibe-item" id="login-form">
        <div class="login-container">
            <div class="form-header">
                <div class="form-header-image">
                    <img src="../midia/user.svg">
                </div>

                <div class="form-header-info">
                    <label>Login</label>
                    <span>Já sou usuário</span>
                </div>
            </div>
            <form name="form1" class="allForm login-form" method="post" action="#">
                <div class="input-container">
                    <label class="login-error" id="aviso-login"></label>
                    <label class="input-label" for="user-login">
                        Login:
                    </label>

                    <input type="text" name="usuario" id="usuario" required="true" autocomplete="off">
                </div>

                <div class="input-container">
                    <label class="input-label" for="senha-login">
                        Senha:
                    </label>

                    <input type="password" name="senha" required="true">
                </div>

                <div class="input-container">
                    <input type="hidden" name="ac" value="1">
                    <input type="hidden" name="erro" value="-1">
                    <div class="login-button-form">
                        <a class="forgot" href="#">
                            Esqueci minha senha
                        </a>

                        <button class="login-button">
                            Entrar
                        </button>
                    </div>
                </div>
                <input type="hidden" name="ret" value="chat/">
            </form>
            <label class="lbl-link">Novo no AngoSearch? <a id="form-header-cadastro">Cadastre-se</a></label>
        </div>
    </div>
    <!-- <div class="botoes-mobile ">
            <button id="btn-login" class="esconde-item">Já sou usuário</button>
            <button id="btn-cadastro" class="">Novo usuário</button>
        </div> -->
    </section>
    </main>




    <!--================Clients Logo Area =================-->
    <section class="clients_logo_area">
        <?php include"include/clients_logo.php"; ?>
    </section>
    <!--================End Clients Logo Area =================-->


    <!--================ start footer Area  =================-->
    <footer class="footer">
        <?php require "include/rodape.php";
        echo utf8_encode($dados['rodape']);
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
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/calendario.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/stellar.js"></script>
    <script src="../vendors/lightbox/simpleLightbox.min.js"></script>
    <script src="../vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="../vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="../vendors/isotope/isotope-min.js"></script>
    <script src="../vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="../js/jquery.ajaxchimp.min.js"></script>
    <script src="../js/mail-script.js"></script>
    <script src="../js/theme.js"></script>
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