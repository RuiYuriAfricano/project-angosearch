<?php
include 'include/conexao.php';
session_start();
$con = conecta();
$id=$_GET['id_desaparecido'];
$nome=$_GET['nome'];
if(isset($_POST['sub'])) {

    $senha = md5($_POST['senha']);

    $esq=$_SESSION['esquadra'];
    $esquadra =$con ->query("select * from esquadra where esquadra='$esq'") or die(mysql_error());


    $valores = mysqli_fetch_assoc($esquadra);
    $id_esq=$valores['id_esquadra'];


    $q=$con->query("select usuario from login where fk_esquadra='$id_esq' and estado='1'");
    $pegaUs=mysqli_fetch_array($q);
    $usuario=$pegaUs['usuario'];
    $p= $con->query("select * from login where senha='$senha' and usuario='$usuario' and estado='1'");

    if((mysqli_num_rows($p)) > 0):

        $nome_completo = $_POST['nome'];
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

        $postado_por = "admin: ".$_SESSION['nome_admin'];





        if ($nascimento == "") {

            $nascimento = "Desconhecido";

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
            $desaparecimento = date('d-m-Y ', strtotime($desaparecimento));
        }
        if ($t1 == "") {
            $t1 = "-";
        }
        if ($t2 == "") {
            $t2 = "-";
        }

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
                    if($nome_completo==""){
                        $nome_completo="Desconhecido";
                    }
                    try{
                        $update = $con->query("update desaparecidos set nome_completo='$nome_completo', nome_pai='$nome_pai', nome_mae='$nome_mae',
idade='$nascimento', fk_bairro='$bairro', data_desaparecimento='$desaparecimento', telefone1='$t1', telefone2='$t2',
 descricao='$descricao',
caracteristicas_especiais='$caracteristica', fk_genero='$genero', fk_provincia='$provincia', foto='$uploadfile'
WHERE  id_desaparecido='$id'");
                        if($update===FALSE) {
                            throw new Exception('Problemas: ' . $con->errno . ' --- ' . $con->error . '<br />');
                        }else{
                            header('Location:view_desaparecidos.php?msg=1'); // enviado com sucesso
                        }}catch(Exception $e){
                        //caso haja uma exceção a mensagem é capturada e atribuida a $msg
                        echo $e->getMessage( );
                    }
                }else{

                    header('Location:view_desaparecidos.php?msg=2'); //tamanho grande
                }

            }else{

                header('Location:view_desaparecidos.php?msg=3'); // extensão da foto é invalida
            }
        }else {
            if($nome !=""){
                try{
                    $update = $con->query("update desaparecidos set nome_completo='$nome_completo', nome_pai='$nome_pai', nome_mae='$nome_mae',
idade='$nascimento', fk_bairro='$bairro', data_desaparecimento='$desaparecimento', telefone1='$t1', telefone2='$t2', descricao='$descricao',
caracteristicas_especiais='$caracteristica', fk_genero='$genero', fk_provincia='$provincia'
WHERE  id_desaparecido='$id'");


                    if($update===FALSE) {
                        throw new Exception('Problemas: ' . $con->errno . ' --- ' . $con->error . '<br />');
                    }else{
                        header('Location:view_desaparecidos.php?msg=4'); // Não foi selecionada nenhuma imagem
                    }



                }catch(Exception $e){
                    //caso haja uma exceção a mensagem é capturada e atribuida a $msg
                    echo $e->getMessage( );
                }
            }else{
                header('Location:view_desaparecidos.php?msg=5'); // Não foi selecionada nenhuma imagem
            }


        }

    else:
        header("Location:view_desaparecidos.php?msg=senhaerror");
    endif;
}
?>

<!doctype html>
<html lang="pt-pt">
<head>

    <title>Editar Desaparecidos | Angosearch</title>
    <!-- Bootstrap CSS -->
    <!-- Required meta tags -->
    <meta http-equiv="Content­Type" content="text/html;charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">

    <link rel="stylesheet" href="../adminLTE-master/bootstrap/css/bootstrap.css">



    <link rel="stylesheet" href="../../../css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="../../../vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="../../../vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="../../../vendors/animate-css/animate.css">
    <link href="../adminlte-master/dist/css/skins/_all-skins.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/glyphicon.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="vendors/animate-css/animate.css">
    <link rel="stylesheet" href="Ionicons/css/ionicons.min.css">

    <link rel="stylesheet" href="../adminlte-master/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

    <!-- main css -->
    <link rel="stylesheet" href="css/style.css">
    <link href="../adminLTE-master/plugins/select2/dist/css/select2.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="../adminLTE-master/dist/css/adminLTE.css">
    <script src="../../../js/calendario.js"></script>

    <style>
        #ativo1{
            color: #005cbf;
        }
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

<!--================Home Banner Area =================-->

<!--================End Home Banner Area =================-->
<!-- Small boxes (Stat box) -->

<!-- Small boxes (Stat box) -->
<section class="content">
<div class="row" id="resumo">
<br>

<?php


$sql=$con->query("SELECT id_desaparecido,nome_completo,idade,nome_pai,nome_mae,foto,data_desaparecimento,caracteristicas_especiais,
descricao,telefone1,telefone2,dataRegistro,bairro,genero,id_provincia,provincia FROM
desaparecidos,bairro,genero,provincia WHERE estado = '1' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia and id_desaparecido='$id'");

$dados=mysqli_fetch_array($sql); ?>

<!-- left column -->
<div class="col-md-9">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title"><img src="../admin/midia/foto_desaparecido/<?php echo $dados['foto']; ?>" alt="<?php echo $dados['foto']; ?>"
                                       style="width: 1auto; height:160px;border-radius: 45%;"   alt="User Image" /> Editar : <?php echo $nome; ?></h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action=""  enctype="multipart/form-data">
            <div class="box-body">



                <div class="col-md-6">
                    <div class="form-group" style="width: 100%;">
                        <label>Nome Completo</label>


                        <input value="<?php echo $dados['nome_completo'] ?>" type="text" class="form-control" maxlength="90" minlength="3"
                               id="nome" pattern="[A-Za-zà-ýÀ-Ý-ç ]*" name="nome" placeholder="Nome Completo">
                        <input type="hidden" class="form-control" id="dat" name="dt">
                        <br>
                        <label>Fotográfia:</label>
                        <input type="file" class="" id="arquivo" name="arquivo" style="color:#444;border-radius: 20px;">
                    </div>

                    <div class="form-group" style="" class="col-md-6">
                        <label>Genero</label>

                        <select name="genero" class="form-control" required="required">
                            <option><?php echo $dados['genero']; ?></option>
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
                            <option><?php echo $dados['bairro']; ?></option>

                            <?php $sql = $con->query("select bairro
 from bairro") or die("Erro na Busca");



                            $linhas = mysqli_num_rows($sql);

                            if ($linhas > 0) {

                                while ($dados1 = mysqli_fetch_assoc($sql)) { ?>
                                    <option ><?php echo $dados1["bairro"]; ?></option><?php } } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Natural de :</label>
                        <select name="provincia" class="form-control select2" style="width: 100%;" required="required">
                            <option selected="selected" value="<?php echo $dados["id_provincia"]; ?>"><?php echo utf8_encode($dados['provincia']); ?></option>
                            <?php $sql = $con->query("select id_provincia,provincia
 from provincia") or die("Erro na Busca");



                            $linhas2 = mysqli_num_rows($sql);

                            if ($linhas2 > 0) {

                                while ($dados2 = mysqli_fetch_assoc($sql)) { ?>
                                    <option style="color:#444;position:relative;"
                                            value="<?php echo $dados2["id_provincia"]; ?>"><?php echo utf8_encode($dados2["provincia"]); ?></option><?php } } ?>
                        </select>
                        <br><br>
                        <label>Idade</label>

                        <input type="tel" class="form-control" maxlength="3" pattern="[0-9\-_]*" id="data" name="nascimento" value="<?php echo $dados['idade'] ?>"><br>
                        <label>Data de Desaparecimento</label>

                        <input type="date" class="form-control" required="required" id="date" name="dt_desaparecimento"
                               value="<?php if($dados['data_desaparecimento'] ==""):
                                   $d ="";
                               else:
                                   $d=date('Y-m-d' , strtotime($dados['data_desaparecimento']));
                               endif;
                               echo $d; ?>">




                    </div>
                </div>

                <div class="col-md-6" style="position: relative; top: 0px;left: 0px;">
                    <div>


                        <div class="form-group">
                            <label>Caracteristicas Físicas:</label>
                            <textarea  class="form-control" id="nome" pattern="[A-Za-zà-ýÀ-Ý-ç ]*" required="required"
                                       name="carateristica" ><?php if($dados['caracteristicas_especiais']!=""):
                                    echo $dados['caracteristicas_especiais']; endif; ?></textarea></div><br>
                        <div class="form-group"><label>Descrição:</label>
                            <textarea class="form-control" id="nome" pattern="[A-Za-zà-ýÀ-Ý-ç ]*" name="descricao"><?php if($dados['descricao']!=""): echo $dados['descricao']; endif; ?></textarea></div><br>
                        <div class="form-group">
                            <label>Nome do Pai</label>

                            <input type="text" class="form-control"  maxlength="90" minlength="10"
                                   id="nome" pattern="[A-Za-zà-ýÀ-Ý-ç ]*" name="pai" placeholder="Nome do Pai" value="<?php echo $dados['nome_pai'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Nome da Mãe</label>

                            <input type="text" class="form-control" maxlength="90" minlength="10"
                                   id="nome" pattern="[A-Za-zà-ýÀ-Ý-ç ]*" name="mae" placeholder="Nome da Mãe"
                                   value="<?php echo $dados['nome_mae'] ?>">
                        </div>
                        <div class="form-group">
                            <label >Telefones</label>
                            <br>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" minlength="9" maxlength="9"
                                       value="<?php echo $dados['telefone1'] ?>"  class="form-control" id="telContato" name="telefone1" placeholder=" +(244)"
                                       style="color:#444;"></div>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" minlength="9" maxlength="9"
                                       value="<?php echo $dados['telefone2'] ?>"
                                       class="form-control" id="telContato" name="telefone2" placeholder=" +(244)"
                                       style="color:#444;"></div>
                        </div>
                    </div><br><br></div>




            </div><!-- /.box-body -->
            <body class="hold-transition lockscreen">
            <!-- Automatic element centering -->
            <div class="lockscreen-wrapper">

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
                <span	class="glyphicon	glyphicon-edit"></span> Efectuar Alterações
                </button>
                <a href="view_desaparecidos.php"><input class="btn btn-danger" type="button" value="Cancelar" /></a>
            </div>

        </form>
    </div></div>
</section>
<!--================Welcome Area =================-->

<!--================End Welcome Area =================-->

<!--================Causes Area =================-->

<!--================End Causes Area =================-->



<!--================Event Area =================-->
<!--================End Event Area =================-->


<!--================Clients Logo Area =================-->

<!--================End Clients Logo Area =================-->


<!--================ start footer Area  =================-->
<footer class="footer-area section_gap">
    <?php include"include/rodape.php"; ?>

</footer></div>
<!--================ End footer Area  =================-->


<script src="../adminlte-master/plugins/jQuery/jQuery-2.1.3.min.js"></script>

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