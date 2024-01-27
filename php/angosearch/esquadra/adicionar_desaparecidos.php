<?php
session_start();
/*if($_SESSION['nome_admin']) {*/



?>


<?php
include 'include/conexao.php';
$con=conecta();
$esq=$_SESSION['esquadra'];
$esquadra =$con ->query("select * from esquadra where esquadra='$esq' ") or die(mysql_error());


$valores = mysqli_fetch_assoc($esquadra);

?>


<?php

if(isset($_POST['sub'])) {

    $nome = $_POST['nome'];
    $nascimento = $_POST['nascimento'];

    $nome_pai = $_POST['pai'];
    $nome_mae = $_POST['mae'];
    $desaparecimento = $_POST['dt_desaparecimento'];

    $t1 = $_POST['telefone1'];
    $t2 = $_POST['telefone2'];
    $dataRegistro = $_POST['dt'];

    $provincia = $_POST['provincia'];
    $bairro = $_POST['bairro'];
    $genero = $_POST['genero'];
    $caracteristica = $_POST['carateristica'];
    $descricao = $_POST['descricao'];

    $postado_por =  $valores['func_esquadra'] ." : ".$_SESSION['esquadra'];




    if ($nascimento == "") {

        $nascimento = "Desconhecido";

    }else{

        $nascimento = date('d/m/Y ', strtotime($nascimento));
    }
    if ($nome_pai == "") {
        $nome_pai = "Desconhecido";

    }
    if ($nome_mae == "") {
        $nome_mae = "Desconhecido";

    }
    if ($desaparecimento == "") {
        $desaparecimento = "Desconhecido";

    }else {
        $desaparecimento = date('d/m/Y ', strtotime($desaparecimento));
    }
    if ($t1 == "") {
        $t1 = "-";
    }
    if ($t2 == "") {
        $t2 = "-";
    }

    ?>


    <?php
    if ($provincia != "") {
        $sql = $con->query("select * from provincia") or die
        ("Erro");
        $linhas = mysqli_num_rows($sql);

        if ($linhas > 0) {


            while ($dados = mysqli_fetch_assoc($sql)) {

                $dados["provincia"];
                $dados["id_provincia"];
                if ($provincia == $dados["provincia"]) {
                    $provincia = $dados["id_provincia"];
                }


            }


        }
    } else {
        $provincia = 19;

    }

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
                    $insere = $con->query("INSERT INTO desaparecidos(id_desaparecido, nome_completo, idade, fk_bairro,
nome_pai,nome_mae, data_desaparecimento,foto, telefone1, telefone2,caracteristicas_especiais,descricao, estado, fk_genero,
 fk_provincia,postado_por,dataRegistro)
 VALUES  (DEFAULT , '$nome' , '$nascimento', '$bairro', '$nome_pai','$nome_mae','$desaparecimento','$uploadfile',
 '$t1','$t2',
 '$caracteristica','$descricao','1',
 '$genero','$provincia','$postado_por','$dataRegistro')");
                    if($insere===FALSE) {
                        throw new Exception('Problemas: ' . $con->errno . ' --- ' . $con->error . '<br />');
                    }else{
                        header('Location:adicionar_desaparecidos.php?msg=1'); // enviado com sucesso
                    }}catch(Exception $e){
                    //caso haja uma exceção a mensagem é capturada e atribuida a $msg
                    echo $e->getMessage( );
                }
            }else{

                header('Location:adicionar_desaparecidos.php?msg=2'); //tamanho grande
            }

        }else{

            header('Location:adicionar_desaparecidos.php?msg=3'); // extensão da foto é invalida
        }
    }else {
        if($nome !=""){
            try{

                $insere = $con->query("INSERT INTO desaparecidos(id_desaparecido, nome_completo, idade, fk_bairro,
nome_pai,nome_mae, data_desaparecimento, telefone1, telefone2,caracteristicas_especiais,descricao, estado, fk_genero,
 fk_provincia,postado_por,dataRegistro,foto)
 VALUES  (DEFAULT , '$nome' , '$nascimento', '$bairro', '$nome_pai','$nome_mae','$desaparecimento','$t1','$t2',
 '$caracteristica','$descricao','1',
 '$genero','$provincia','$postado_por','$dataRegistro','usuario.png')");
                if($insere===FALSE) {
                    throw new Exception('Problemas: ' . $con->errno . ' --- ' . $con->error . '<br />');
                }else{
                    header('Location:adicionar_desaparecidos.php?msg=4'); // Não foi selecionada nenhuma imagem
                }



            }catch(Exception $e){
                //caso haja uma exceção a mensagem é capturada e atribuida a $msg
                echo $e->getMessage( );
            }
        }else{
            header('Location:adicionar_desaparecidos.php?msg=5'); // Não foi selecionada nenhuma imagem
        }


    }


}
?>
<!doctype html>
<html lang="pt-pt">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Registro de Desaparecidos</title>
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="../adminLTE-master/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="css/glyphicon.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="vendors/animate-css/animate.css">
    <link rel="stylesheet" href="Ionicons/css/ionicons.min.css">
    <!--<link rel="stylesheet" href="bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <!--<link rel="stylesheet" href="bootstrap-daterangepicker/daterangepicker.css">
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/responsive.css">

    <script src="../../../js/calendario.js"></script>

    <style>
        #ativo2{
            color: #005cbf;
        }
    </style>
</head>
<body onload="setInterval('apresentaData()',1000);">

<!--================Header Menu Are
a =================-->
<header class="header_area">
    <?php include "include/cabecalho.php"; ?>
</header>
<!--================Header Menu Area =================-->

<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0"
             data-background=""></div>
        <div class="container"><br><br><br><br><br><bR>
            <div class="banner_content text-center">
                <h2></h2>
                <div class="page_link">
                    <h3 class="text-danger"><b style='font-weight: bolder;'>
                            <span class="glyphicon	glyphicon-plus"></span> Desaparecido</b></h3>

                </div>
            </div>
        </div>
    </div>
</section>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $_SESSION['esquadra']; ?>
        <small>Painel de Controlo</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="principal_esquadra.php"><i class="fa fa-home"></i> Principal</a></li>
        <li class="active">AngoSearch</li>
    </ol>
</section>

<!-- Main content -->
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
        <div class="col-md-12">
            <div class="box box-primary" style="width: 80%">
                <div class="box-header">
                    <h3 class="box-title">Registrar Desaparecidos</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action=""  enctype="multipart/form-data">
                    <div class="box-body">


                        <div class="col-md-9">
                            <div class="form-group" style="width: 100%;">
                                <label>Nome Completo</label>


                                <input type="text" class="form-control" id="name" name="nome" placeholder="Nome Completo"
                                    >
                                <input type="hidden" class="form-control" id="dat" name="dt">
                            </div>
                            <div class="form-group">
                                <label>Nome do Pai</label>

                                <input type="text" class="form-control" id="number" name="pai" placeholder="Nome do Pai"
                                    >
                            </div>
                            <div class="form-group">
                                <label>Nome da Mãe</label>

                                <input type="text" class="form-control" id="number" name="mae" placeholder="Nome da Mãe"
                                    >
                            </div>
                            <div class="form-group">
                                <label>Idade</label>

                                <input type="number" class="form-control" id="data" name="nascimento"
                                    >

                                <label>Data de Desaparecimento</label>

                                <input type="date" class="form-control" id="date" name="dt_desaparecimento"
                                    >
                            </div>
                            <div class="form-group" style="width: 60%;align-items: center">
                                <label >Telefones</label>
                                <br>
                                <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" class="form-control" id="telContato" name="telefone1"
                                       placeholder="ex: 949135094" style="color:#444;">


                                <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" class="form-control" id="telContato" name="telefone2" placeholder="ex: 949595563"
                                       style="color:#444;">
                                <br>
                                <label>Fotográfia:</label>
                                <input type="file" class="" id="arquivo" name="arquivo" style="color:#444;border-radius: 20px;">
                            </div>
                            <div class="form-group" style="" >
                                <label>Genero</label>

                                <select name="genero" class="form-control">
                                    <option></option>
                                    <?php $sql = $con->query("select genero
 from genero ORDER BY id_genero ASC ") or die("Erro na Busca");



                                    $linhas = mysqli_num_rows($sql);

                                    if ($linhas > 0) {

                                        while ($dados1 = mysqli_fetch_assoc($sql)) { ?>
                                            <option style="color:#002a80;"><?php echo $dados1["genero"]; ?></option><?php } } ?>
                                </select>
                            </div>
                            <br>


                            <div class="form-group">
                                <label>Bairro</label>
                                <select name="bairro"  class="form-control">
                                    <option></option>
                                    <?php $sql = $con->query("select bairro
 from bairro") or die("Erro na Busca");



                                    $linhas = mysqli_num_rows($sql);

                                    if ($linhas > 0) {

                                        while ($dados = mysqli_fetch_assoc($sql)) { ?>
                                            <option ><?php echo $dados["bairro"]; ?></option><?php } } ?>
                                </select>
                                <br>
                                <label>Natural de :</label>

                                <select name="provincia" class="form-control">
                                    <option></option>
                                    <?php $sql = $con->query("select provincia
 from provincia") or die("Erro na Busca");



                                    $linhas2 = mysqli_num_rows($sql);

                                    if ($linhas2 > 0) {

                                        while ($dados2 = mysqli_fetch_assoc($sql)) { ?>
                                            <option style="color:#444;position:relative;"><?php echo utf8_encode($dados2["provincia"]); ?>
                                            </option><?php } } ?>
                                </select>

                                <br>

                                <label>Caracteristicas Especiais:</label>
                                <textarea class="form-control" id="arquivo" name="carateristica" >
                                </textarea><br>
                                <label>Descrição:</label>
                                <textarea class="form-control" id="arquivo" name="descricao">
                                </textarea>

                            </div></div>




                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button class="btn btn-primary" type="submit"  name="sub">
                        <span	class="glyphicon	glyphicon-ok"></span> Registrar
                        </button>
                        <a href="adicionar_desaparecidos.php"><input class="btn btn-danger" type="button" value="Cancelar" ></a>
                    </div>
                </form>
            </div></div>
</section></div></div>
<!--================Causes Area =================-->

<!--================End Causes Area =================-->


<!--================Event Area =================-->
<!--================End Event Area =================-->


<!--================Clients Logo Area =================-->

<!--================End Clients Logo Area =================-->


<!--================ start footer Area  =================-->
<footer class="footer-area section_gap" >
    <?php include"include/rodape.php"; ?>
</footer>
<!--================ End footer Area  =================-->




<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/stellar.js"></script>
<script src="vendors/lightbox/simpleLightbox.min.js"></script>
<script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
<script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
<script src="vendors/isotope/isotope-min.js"></script>
<script src="vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/mail-script.js"></script>
<script src="js/theme.js"></script>
<script src="bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>


<script src="../../Cadastro%20-%20DevMedia_arquivos/api.js"></script>
<script src="../../Cadastro%20-%20DevMedia_arquivos/api_002.js"></script>
<script type="text/javascript" src="../../Cadastro%20-%20DevMedia_arquivos/jquery_002.js"></script>
<script type="text/javascript" src="../../Cadastro%20-%20DevMedia_arquivos/jquery-ui.js"></script>
<script type="text/javascript" src="../../Cadastro%20-%20DevMedia_arquivos/notifIt.js"></script>
<script type="text/javascript" src="../../Cadastro%20-%20DevMedia_arquivos/index.js"></script>

</body>
</html>

<?php /*
}
else{
    header("Location:../../login-usuario.php");
}*/
?>