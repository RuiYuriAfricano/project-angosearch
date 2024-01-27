<?php
session_start();


if ( !$_SESSION['utilizador']) {
    header("Location:../../login-usuario.php");
} else {
    ?>
    <?php

    include 'include/conexao.php';
    $con=conecta();

    if(isset($_POST['sub'])) {

        $senha = md5($_POST['senha']);

        $ut=$_SESSION['utilizador'];
        $utilizador =$con ->query("select * from utilizador where nome_completo='$ut'") or die(mysql_error());


        $valores = mysqli_fetch_assoc($utilizador);
        $id_ut=$valores['id_utilizador'];


        $q=$con->query("select usuario from login where fk_utilizador='$id_ut' and estado='1'");
        $pegaUs=mysqli_fetch_array($q);
        $usuario=$pegaUs['usuario'];
        $p= $con->query("select * from login where senha='$senha' and usuario='$usuario' and estado='1'");

        if((mysqli_num_rows($p)) > 0):

        $nome = $_POST['nome'];
        $nascimento = $_POST['nascimento'];

        $nome_pai = $_POST['pai'];
        $nome_mae = $_POST['mae'];
        $desaparecimento = $_POST['dt_desaparecimento'];

        $t1 = $_POST['telefone1'];
        $t2 = $_POST['telefone2'];
        $dataSolicitacao = date('Y-m-d H:i:s');

        $provincia = $_POST['provincia'];
        $bairro = $_POST['bairro'];
        $genero = $_POST['genero'];
        $caracteristica = $_POST['carateristica'];
        $descricao = $_POST['descricao'];

        $postado_por =$_SESSION['utilizador'];




            $dt=date('d-m-Y');

            if(strtotime($desaparecimento) > strtotime($dt)):
                echo" <script>
                   alert('Insira uma data válida...!');

        </script> ";

            else:
                $desaparecimento = date('d-m-Y ', strtotime($desaparecimento)); if ($t1 == "") {
            $t1 = "-";
        }
        if ($t2 == "") {
            $t2 = "-";
        }
        $p=$con->query("select id_utilizador from utilizador where nome_completo='$postado_por'");
        $pega=mysqli_fetch_array($p);
        $id_utilizador=$pega['id_utilizador'];
        ?>


        <?php


        if ($bairro != "") {
            $sql2 = $con->query("select * from bairro") or die
            ("Erro");
            $linhas2 = mysqli_num_rows($sql2);

            if ($linhas2 > 0) {


                while ($dados2 = mysqli_fetch_assoc($sql2)) {

                    $dados2["bairro"];
                    $dados2["id_bairro"];
                    if ($bairro == $dados2["bairro"]) {
                        $bairro = $dados2["id_bairro"];
                    }


                }


            }
        } else {
            $bairro = 5;
        }

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

        $imageName = $_FILES["arquivo"]["name"];
        if(!empty($imageName)) {
            $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            $fileAllow = array("jpg","png","jpeg");
            if(in_array($fileExtension,$fileAllow)){

                if($_FILES['arquivo']['size']< 500000) {


                    $strDtMix = @date("d").substr((string)microtime(), 2, 8);
                    $uploadfile = $strDtMix.".".pathinfo($imageName, PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES['arquivo']['tmp_name'], "../admin/midia/foto_desaparecido/".$uploadfile);
                    if($nome==""){
                        $nome="Desconhecido";
                    }
                    try{


                        $insere = $con->query("INSERT INTO desaparecidos(id_desaparecido, nome_completo,idade, fk_bairro,
nome_pai,nome_mae, data_desaparecimento,foto, telefone1, telefone2,caracteristicas_especiais,descricao, estado, fk_genero,
 fk_provincia,fk_utilizador,dataSolicitacao)
 VALUES  (DEFAULT , '$nome' , '$nascimento', '$bairro', '$nome_pai','$nome_mae','$desaparecimento','$uploadfile',
 '$t1','$t2',
 '$caracteristica','$descricao','2',
 '$genero','$provincia','$id_utilizador','$dataSolicitacao')");
                        if($insere===FALSE) {
                            throw new Exception('Problemas: ' . $con->errno . ' --- ' . $con->error . '<br />');
                        }else{
                            $id=mysqli_insert_id($con);
                            header('Location:gerarPdfDesaparecido.php?id_desaparecido='.$id); // enviado com sucesso
                        }}catch(Exception $e){
                        //caso haja uma exceção a mensagem é capturada e atribuida a $msg
                        echo $e->getMessage( );
                    }
                }else{

                    header('Location:registrar_desaparecido.php?msg=2'); //tamanho grande
                }

            }else{

                header('Location:registrar_desaparecido.php?msg=3'); // extensão da foto é invalida
            }
        }else {
            if($nome !=""){
                try{

                    $insere = $con->query("INSERT INTO desaparecidos(id_desaparecido, nome_completo, idade, fk_bairro,
nome_pai,nome_mae, data_desaparecimento, telefone1, telefone2,caracteristicas_especiais,descricao, estado, fk_genero,
 fk_provincia,foto,fk_utilizador,dataSolicitacao)
 VALUES  (DEFAULT , '$nome' , '$nascimento', '$bairro', '$nome_pai','$nome_mae','$desaparecimento','$t1','$t2',
 '$caracteristica','$descricao','2',
 '$genero','$provincia','usuario.png','$id_utilizador','$dataSolicitacao')");
                    if($insere===FALSE) {
                        throw new Exception('Problemas: ' . $con->errno . ' --- ' . $con->error . '<br />');
                    }else{$id=mysqli_insert_id($con);
                        header('Location:gerarPdfDesaparecido.php?id_desaparecido='.$id); // Não foi selecionada nenhuma imagem
                    }



                }catch(Exception $e){
                    //caso haja uma exceção a mensagem é capturada e atribuida a $msg
                    echo $e->getMessage( );
                }
            }else{
                header('Location:registrar_desaparecido.php?msg=5'); // Não foi selecionada nenhuma imagem
            }


        } endif;

        else:
            header("Location:registrar_desaparecido.php?msg=senhaerror");
        endif;

    }

    ?>

    <!doctype html>
    <html lang="pt-pt">
    <head>
        <!-- Required meta tags -->
        <meta http-equiv="Content­Type" content="text/html;charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">
        <title>Fazer Comunicado</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../adminLTE-master/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="../adminlte-master/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css">

        <link rel="stylesheet" href="../adminLTE-master/dist/css/adminLTE.css">
        <!-- iCheck -->
        <link href="../adminlte-master/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="../adminlte-master/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="../adminlte-master/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

        <link href="select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../../../vendors/linericon/style.css">
        <link rel="stylesheet" href="../../../css/font-awesome.min.css">
        <link rel="stylesheet" href="../../../vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="../../../vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" href="../../../vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="../../../vendors/animate-css/animate.css">
        <link href="../adminLTE-master/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />







        <!-- main css -->
        <link rel="stylesheet" href="../../../css/style.css">
        <link rel="stylesheet" href="../../../css/responsive.css"



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
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a> <small><?php echo$_SESSION['utilizador'];?></small></h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="glyphicon glyphicon-user"></i> Pessoas</a></li>
                    <li class="active">AngoSearch</li>
                </ol>
            </section></div>
    <!--================Home Banner Area =================-->

    <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row" id="resumo">
    <br>
    <div style="">
        <?Php
        if(isset($_REQUEST["msg"])) {
            if ($_REQUEST["msg"] == "1") {

                ?>
                <span class='notification n-success'>Registrado com Sucesso.......!!</span>
            <?php }

            else if ($_REQUEST["msg"] == "2") {

                ?>
                <span class="notification n-error">Erro: Fotografia Muito grande, escolhe uma de tamanho menor .</span>
            <?php }
            else if ($_REQUEST["msg"] == "3") {
                ?>
                <span class='notification n-error'>Erro: Extensão Inválida</span>



            <?php }else if($_REQUEST["msg"]=="senhaerror"){
                ?>
                <span class='notification n-error'>Senha digitada não está correcta..!!</span>
            <?php }


            else if ($_REQUEST["msg"] == "4") {

                ?>


                <span class='notification n-success'>Registrado sem Nenhuma Fotográfia ...!</span>



                <?php
                ?>
            <?php
            }     else if ($_REQUEST["msg"] == "5") {
                ?>
                <span class='notification n-error'>Erro: Insere um Nome ou uma Fotográfia</span>



            <?php }} ?>
    </div>


    <!-- left column -->
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Faça comunicado de um desaparecimento</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action=""  enctype="multipart/form-data">
                <div class="box-body">



                    <div class="col-md-6">
                        <div class="form-group" style="width: 100%;">
                            <label>Nome Completo</label>


                            <input type="text" class="form-control" id="name" name="nome" placeholder="Nome Completo"
                                   maxlength="90" minlength="3"
                                   id="nome" pattern="[A-Za-zà-ýÀ-Ý-ç ]*">
                            <input type="hidden" class="form-control" id="dat" name="dt">
                            <br>
                            <label>Fotográfia:</label>
                            <input type="file" class="" id="arquivo" name="arquivo" style="color:#444;border-radius: 20px;">
                        </div>

                        <div class="form-group" style="" class="col-md-6">
                            <label>Genero</label>

                            <select name="genero" class="form-control" required="required">
                                <option></option>
                                <?php $sql = $con->query("select genero
 from genero ORDER BY id_genero ASC ") or die("Erro na Busca");



                                $linhas = mysqli_num_rows($sql);

                                if ($linhas > 0) {

                                    while ($dados1 = mysqli_fetch_assoc($sql)) { ?>
                                        <option style="color:#002a80;"><?php echo $dados1["genero"]; ?></option><?php } } ?>
                            </select>
                        </div>



                        <div class="form-group">
                            <label>Bairro</label>
                            <select name="bairro"  class="form-control select2" style="width: 100%;">
                                <option></option>
                                <option selected="selected"></option>
                                <?php $sql = $con->query("select bairro
 from bairro") or die("Erro na Busca");



                                $linhas = mysqli_num_rows($sql);

                                if ($linhas > 0) {

                                    while ($dados = mysqli_fetch_assoc($sql)) { ?>
                                        <option ><?php echo $dados["bairro"]; ?></option><?php } } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Natural de :</label>

                            <select name="provincia" required="required" class="form-control select2" style="width: 100%;">
                                <option></option>
                                <?php $sql = $con->query("select id_provincia,provincia
 from provincia") or die("Erro na Busca");



                                $linhas2 = mysqli_num_rows($sql);

                                if ($linhas2 > 0) {

                                    while ($dados2 = mysqli_fetch_assoc($sql)) { ?>
                                        <option style="color:#444;position:relative;"
                                                value="<?php echo $dados2["id_provincia"]; ?>"><?php echo utf8_encode($dados2["provincia"]); ?></option><?php } } ?>
                            </select><br><br>
                            <label>Idade</label>

                            <input type="tel" class="form-control" name="nascimento"
                                   maxlength="3" pattern="[0-9\-_]*"
                                >
                            <label>Data de Desaparecimento</label>

                            <input type="date" class="form-control" id="date" name="dt_desaparecimento" required="required">




                        </div>
                    </div>

                    <div class="col-md-6" style="position: relative; top: 0px;left: 0px;">
                        <div>



                            <div class="form-group">
                                <label>Caracteristicas Físicas</label>

                                <textarea id="nome" pattern="[A-Za-zà-ýÀ-Ý-ç ]*"required="required"  name="carateristica"
                                          class="form-control" rows="3" placeholder="Altura, cor do cabelo, pele..."></textarea>
                            </div>

                            <div class="form-group">
                                <label>Descrição</label>
                                <textarea id="nome" pattern="[A-Za-zà-ýÀ-Ý-ç ]*"  name="descricao" class="form-control" rows="3"
                                          placeholder="como aconteceu ?" ></textarea></div>
                            <div class="form-group">
                                <label>Nome do Pai</label>

                                <input type="text" class="form-control" id="number" name="pai" placeholder="Nome do Pai"
                                       id="nome" pattern="[A-Za-zà-ýÀ-Ý-ç ]*">
                            </div>
                            <div class="form-group">
                                <label>Nome da Mãe</label>

                                <input type="text" class="form-control" id="number" name="mae" placeholder="Nome da Mãe"
                                       id="nome" pattern="[A-Za-zà-ýÀ-Ý-ç ]*">
                            </div>
                            <div class="form-group">
                                <label >Telefones</label>
                                <br>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="tel"  pattern="[0-9]{3}[0-9]{3}[0-9]{3}" minlength="9" maxlength="9"
                                           class="form-control" minlength="9" name="telefone1" placeholder=" +(244)"
                                           style="color:#444;"></div>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="tel"
                                           pattern="[0-9]{3}[0-9]{3}[0-9]{3}" minlength="9" maxlength="9"
                                           class="form-control" id="telContato" name="telefone2" placeholder=" +(244)"
                                           style="color:#444;"></div>
                            </div>
                        </div><br><br></div>




                </div><!-- /.box-body -->

                <body class="hold-transition lockscreen" >
                <!-- Automatic element centering -->
                <div class="lockscreen-wrapper" >

                    <!-- User name -->
                    <div class="lockscreen-name"><div class="help-block text-center">
                            Digite a sua palavra passe, para efectuar esta tarefa...
                        </div></div>

                    <!-- START LOCK SCREEN ITEM -->
                    <div class="lockscreen-item">
                        <!-- lockscreen image -->

                        <!-- /.lockscreen-image -->

                        <!-- lockscreen credentials (contains the form) -->


                        <div class="input-group">

                            <input type="password" class="form-control" name="senha"  required="required" placeholder="sua palavra passe">


                        </div>


                        <!-- /.lockscreen credentials -->

                    </div>
                    <!-- /.lockscreen-item -->


                </div>


                </body>

                <div class="box-footer" style="text-align: right">
                    <button class="btn btn-primary" type="submit"  name="sub"/>
                    <span	class="glyphicon	glyphicon-ok"></span> Registrar
                    </button>
                    <a href="registrar_desaparecido.php"><input class="btn btn-danger" type="button" value="Cancelar" /></a>
                </div>
            </form>
        </div></div>
    </section><!-- /.content -->

    <!--================End Event Area =================-->


    <!--================Clients Logo Area =================-->
    <section class="clients_logo_area">
        <?php include"include/clients_logo.php"; ?>
    </section>
    <!--================End Clients Logo Area =================-->


    <!--================ start footer Area  =================-->
    <!-- Footer -->
</div>
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



    <!-- counter -->

    <script src="../adminlte-master/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="../../../js/calendario.js"></script>

    <script src="../adminlte-master/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="../adminlte-master/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="../adminlte-master/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="../adminlte-master/plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <script src="../adminlte-master/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../adminlte-master/plugins/select2/dist/js/select2.full.min.js"></script>


    <script src="../adminlte-master/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../adminlte-master/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../adminlte-master/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="../adminlte-master/dist/js/app.min.js" type="text/javascript"></script>


    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

        })
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()

    </script>


    </body>
    </html>
<?php

}   ?>