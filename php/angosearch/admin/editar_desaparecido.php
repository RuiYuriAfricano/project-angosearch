<?php
session_start();
if($_SESSION['nome_admin']) {


    ?>


    <?php
    include 'include/conexao.php';
    $con = conecta();


    ?>


    <?php

    $id_desaparecido = $_GET['id_desaparecido'];
    if ($id_desaparecido != "") {

        if (isset($_POST['sub'])) {

            $nome = $_POST['nome'];
            $nascimento = $_POST['nascimento'];
            $nome_pai = $_POST['pai'];
            $nome_mae = $_POST['mae'];
            $desaparecimento = $_POST['dt_desaparecimento'];
            $t1 = $_POST['telefone1'];
            $t2 = $_POST['telefone2'];
            $dataRegistro = date('Y') . "-" . date('m') . "-" . date('d');

            $provincia = $_POST['provincia'];
            $bairro = $_POST['bairro'];
            $genero = $_POST['genero'];
            $caracteristica = $_POST['carateristica'];
            $descricao = $_POST['descricao'];

            if ($nome == "") {

                $nome = "";
            }
            if ($nascimento == "") {

                $nascimento = "";

            }
            if ($nome_pai == "") {
                $nome_pai = "";

            }
            if ($nome_mae == "") {
                $nome_mae = "";

            }
            if ($desaparecimento == "") {
                $desaparecimento = "";

            }
            if ($t1 == "") {
                $t1 = 0;

            }
            if ($t2 == "") {
                $t2 = 0;
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

            $update = $con->query("update desaparecidos set nome_completo='$nome', nome_pai='$nome_pai', nome_mae='$nome_mae',
nascimento='$nascimento', fk_bairro='$bairro', data_desaparecimento='$desaparecimento', telefone1='$t1', telefone2='$t2', descricao='$descricao',
caracteristicas_especiais='$caracteristica', fk_genero='$genero', fk_provincia='$provincia' WHERE  id_desaparecido='$id_desaparecido'");

            header('Location:visualizar_desaparecidos.php?msg=edit'); // enviado com sucesso


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
        </head>
        <body>

        <!--================Header Menu Are
        a =================-->
        <header class="header_area">
            <?php include "include/cabecalho.php"; ?>
        </header>
        <!--================Header Menu Area =================-->
<?php
                  $s=$con->query("select nome_completo from desaparecidos WHERE  id_desaparecido='$id_desaparecido'");
                    $pega_nome=mysqli_fetch_assoc($s);
?>
        <!--================Home Banner Area =================-->
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0"
                     data-background=""></div>
                <div class="container">
                    <div class="banner_content text-center">
                        <h2><span class="glyphicon	glyphicon-edit"></span>
                            Editar Desaparecido: <?php echo $pega_nome['nome_completo']; ?></h2>

                        <div class="page_link">
                            <a href="visualizar_desaparecidos.php">Visualizar Desaparecidos</a>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br><br>

        <div style="">
            <?Php
            if (isset($_REQUEST["msg"])) {
                if ($_REQUEST["msg"] == "1") {

                    ?>
                    <span class='notification n-success'>Editado com Sucesso.......!!</span>
                <?php
                }

                if ($_REQUEST["msg"] == "2") {

                    ?>
                    <span
                        class="notification n-error">Erro: Fotografia Muito grande, escolhe uma de tamanho menor .</span>
                <?php
                }
                if ($_REQUEST["msg"] == "3") {
                    ?>
                    <span class='notification n-error'>Erro: Extensão Inválida</span>



                <?php
                }


                if ($_REQUEST["msg"] == "4") {

                    ?>


                    <span class='notification n-success'>Registrado sem Nenhuma Fotográfia ...!</span>



                <?php
                }
            }?>
        </div>
        <!--================End Home Banner Area =================-->

        <!--================Welcome Area =================-->
        <style type="text/css">
            form input[placeholder] {
                color: #002a80;
            }

            label {
                color: #fff;
            }

            input {
                font-weight: bold;
            }

        </style>
        <?php


        $sql=$con->query("SELECT id_desaparecido,nome_completo,nascimento,nome_pai,nome_mae,data_desaparecimento,caracteristicas_especiais,descricao,
telefone1,telefone2,dataRegistro,bairro,genero,provincia FROM
desaparecidos,bairro,genero,provincia WHERE estado = '1' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia and id_desaparecido='$id_desaparecido'");
        ?>
        <!--================End Welcome Area =================-->
        <center>
        <div class="col-lg-9    table-responsive" style="border: solid 1px; text-align: center;  width: 80%;
background:#999; color: #808080;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px;">

        <?php $dep=mysqli_fetch_array($sql); ?>

            <form class="row contact_form" action="" method="post"
                  id="contactForm" novalidate="novalidate" enctype="multipart/form-data">
                <div class="col-md-6">
                    <div class="form-group" style="width: 100%;">
                        <label>Nome Completo</label>


                        <input type="text" class="form-control" id="name" name="nome" placeholder="Nome Completo"
                               style="color:#444;" value="<?php echo $dep['nome_completo'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Nome do Pai</label>

                        <input type="text" class="form-control" id="number" name="pai" placeholder="Nome do Pai"
                               style="color:#444;" value="<?php echo $dep['nome_pai'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Nome da Mãe</label>

                        <input type="text" class="form-control" id="number" name="mae" placeholder="Nome da Mãe"
                               style="color:#444;" value="<?php echo $dep['nome_mae'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Data de Nascimento</label>

                        <input type="date" class="form-control" id="date" name="nascimento"
                               style="color:#444;" value="<?php echo $dep['nascimento'] ?>">

                        <label>Data de Desaparecimento</label>

                        <input type="date" class="form-control" id="date" name="dt_desaparecimento"
                               style="color:#444;" value="<?php echo $dep['data_desaparecimento'] ?>">
                    </div>
                    <div class="form-group">
                        <label style="color: #fff;">Telefones</label>

                        <input type="number" class="form-control" id="number" name="telefone1" placeholder="949135094"
                               style="color:#444;" value="<?php echo $dep['telefone1'] ?>">
                        <br>

                        <input type="number" class="form-control" id="number" name="telefone2" placeholder="949595563"
                               style="color:#444;" value="<?php echo $dep['telefone2'] ?>">
                        <br></div>
                </div>

                <div class="col-md-6" style="position: relative; top: 0px;left: 0px;">
                    <div class="form-group" style="" class="col-md-6">
                        <label>Genero</label>

                        <select name="genero" style="color:#444;" class="form-select">
                            <option><?php echo $dep['genero'] ?></option>
                            <?php $sql = $con->query("select genero
 from genero") or die("Erro na Busca");


                            $linhas = mysqli_num_rows($sql);

                            if ($linhas > 0) {

                                while ($dados1 = mysqli_fetch_assoc($sql)) {
                                    ?>
                                    <option style="color:#002a80;"><?php echo $dados1["genero"]; ?></option><?php }
                            } ?>
                        </select>
                    </div>
                    <br>


                    <div class="form-group">
                        <label>Bairro</label>
                        <select name="bairro" style="color:#444;" class="form-select">
                            <option><?php echo $dep['bairro'] ?></option>
                            <?php $sql = $con->query("select bairro
 from bairro") or die("Erro na Busca");


                            $linhas = mysqli_num_rows($sql);

                            if ($linhas > 0) {

                                while ($dados = mysqli_fetch_assoc($sql)) {
                                    ?>
                                    <option style="color:#002a80;"><?php echo $dados["bairro"]; ?></option><?php }
                            } ?>
                        </select>
                        <br>
                        <label>Natural de :</label>

                        <select name="provincia" style="color:#444;position: relative;" class="form-select">
                            <option><?php echo $dep['provincia'] ?></option>
                            <?php $sql = $con->query("select provincia
 from provincia") or die("Erro na Busca");


                            $linhas2 = mysqli_num_rows($sql);

                            if ($linhas2 > 0) {

                                while ($dados2 = mysqli_fetch_assoc($sql)) {
                                    ?>
                                    <option
                                        style="color:#444;position:relative;"><?php echo $dados2["provincia"]; ?></option><?php }
                            } ?>
                        </select>

                        <br><br><br>

                        <br>
                        <label>Caracteristicas Especiais:</label>
                        <textarea class="form-control" id="arquivo" name="carateristica"
                                  style="color:#444;border-radius: 20px;" ><?php echo $dep['caracteristicas_especiais'] ?>
                        </textarea><br>
                        <label>Descrição:</label>
                        <textarea class="form-control" id="arquivo" name="descricao"
                                  style="color:#444;border-radius: 20px;" ><?php echo $dep['descricao'] ?>
                        </textarea><br>

                    </div>
                </div>
                <br><br>

                <div class="col-md-12 text-left" style="margin-top: 7px;">
                    <tr>
                        <td></td>
                        <td align="left" height="45">
                            <button class="btn btn-success" type="submit" name="sub"/>
                            <span class="glyphicon	glyphicon-ok"></span> Editar
                            </button>
                            <a href="adicionar_desaparecidos.php"><input class="btn btn-danger" type="button"
                                                                         value="Cancelar"/></a></td>
                    </tr>
                </div>
            </form>
        </div></center>
        <!--================Causes Area =================-->

        <!--================End Causes Area =================-->


        <!--================Event Area =================-->
        <!--================End Event Area =================-->


        <!--================Clients Logo Area =================-->

        <!--================End Clients Logo Area =================-->


        <!--================ start footer Area  =================-->
        <footer class="footer-area section_gap">
            <?php include "include/rodape.php"; ?>
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
        </body>
        </html>

    <?php
    }
    else{
        echo "
<META HTTP-EQUIV=REFRESH CONTENT = '0;
URL =http://localhost/Projecto%20Final%20-%20Loide%20Laura/php/angosearch/admin/visualizar_desaparecidos.php'>
<script type=\"text/javascript\">";

    }
}
else{
    header("Location:../../login-usuario.php");
}
?>