<?php
session_start();
if($_SESSION['nome_admin']) {


    ?>


    <?php
    include 'include/conexao.php';
    $con=conecta();


    ?><?php
    $nome = $_POST['valor_pesquisa'];
    if($nome==""){

        echo "
<META HTTP-EQUIV=REFRESH CONTENT = '0; URL
=http://localhost/Projecto%20Final%20-%20Loide%20Laura/php/angosearch/admin/principal_admin.php'>
<script type=\"text/javascript\">

alert(\"Escreva alguma coisa para pesquisar\");
</script>";
    }
    else{
        ?>



    <!doctype html>
    <html lang="pt-pt">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Pesquisa</title>
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

    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0"
                 data-background=""></div>
            <div class="container">
                <div class="banner_content text-center">
                    <h2> <span	class="glyphicon	glyphicon-search"></span>  Resultado da Pesquisa : <?php echo $nome; ?></h2>
                    <div class="page_link">
                        <a href=""> <span	class="glyphicon	glyphicon-home"></span> Inicio</a>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--================Causes Area =================-->
    <?php



    $desaparecidos=$con->query("SELECT id_desaparecido,nome_completo,nascimento,nome_pai,nome_mae,data_desaparecimento,foto,
dataRegistro,descricao,caracteristicas_especiais,bairro,genero,provincia,postado_por FROM
desaparecidos,bairro,genero,provincia WHERE estado = '1' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia and nome_completo like '%$nome%'  ORDER  BY  id_desaparecido  ")
    or die("erro ao consultar ".mysql_error());

    $doc=$con->query("SELECT * FROM documentos WHERE estado = '1' and nome_doc LIKE  '$nome' ORDER  BY  id_doc DESC ");

    $linhas = mysqli_num_rows($desaparecidos);
    $linhas1 = mysqli_num_rows($doc);

    if($linhas > 0)
    {


        ?>
        <section class="causes_area p_120">
            <div class="container"  >

                <center id="sectionPessoas"> <h2 ><a href="visualizar_desaparecidos.php" style="color: #666;">Pessoas Desaparecidas</a></h2></center>
                <center><div class="causes_slider owl-carousel" >
                        <?php while($dado=mysqli_fetch_array($desaparecidos)){ ?>
                            <div class="item">
                                <div class="causes_item">
                                    <div class="causes_img">
                                        <img class="img-fluid" style="width: auto; height: 200px;"
                                             src="midia/foto_desaparecido/<?php echo $dado['foto']; ?>"
                                             alt="<?php echo $dado['nome_completo'];?>">
                                        <div class="c_parcent">


                                        </div>
                                    </div>
                                    <div class="causes_text">
                                        <h4><?php echo $dado['nome_completo'];?></h4>
                                        <p><?php echo  $dado['nascimento'];?>, desaparecido(a) desde o dia
                                            <?php echo $dado['data_desaparecimento'];?>
                                            , vive no bairro <?php echo $dado['bairro'];?>. <br><br> Post :
                                <span style="font-weight: bold;"><?php echo $dado['postado_por'];?>, aos
                                    <?php echo $dado['dataRegistro'];?></span></p>
                                    </div>
                                    <div class="causes_bottom">
                                        <a href="maisDesaparecidos.php?id_desaparecido=<?php echo ($dado['id_desaparecido']);?> &&
                nome=<?php echo ($dado['nome_completo']);?>">Saber Mais</a>

                                    </div>
                                </div>
                            </div>
                        <?php }//end if ?>
                    </div></center></div></section>


    <?php }
    else if($linhas1 > 0){
        ?>
        <section class="causes_area p_120" >

            <div class="container"  >
                <center id="sectionDocumentos">
                    <h2 style="color: #000;"><a href="visualizar_documentos.php" style="color: #666;">Documentos Desaparecidos</a></h2></center>
                <div class="causes_slider owl-carousel" >
                    <?php while($dado=mysqli_fetch_array($doc)){ ?>
                        <div class="item">
                            <div class="causes_item">
                                <div class="causes_img">
                                    <img class="img-fluid" style="width: 360px; height: 260px;"
                                         src="midia/documentos/<?php echo $dado['fotografia']; ?>"
                                         alt="<?php echo $dado['fotografia'];?>">
                                    <div class="c_parcent">
                                        <span id="spanDoc"></span>
                                    </div>
                                </div>
                                <div class="causes_text">
                                    <h4><?php echo $dado['nome_doc'] ?> </php></h4>
                                    <p> <?php echo "Detalhes:<br> ".
                                            $dado['detalhe'] ?>. <br> Postado Por :
                                        <span style="font-weight: bold;"><?php echo $dado['postado_por'];?></span></p>
                                </div>
                                <div class="causes_bottom">
                                    <a href="visualizar_documentos.php ">Saber Mais</a>

                                </div>
                            </div>
                        </div>
                    <?php }//end if ?>
                </div>
            </div>

        </section>
    <?php } else{?>
        <br><br><span class="notification n-error"> Valor digitado pelo utilizador , não foi encontrado.</span>
    <?php } ?>

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
    </body>
    </html>
    <?php } ?>
<?php
}
else{
    header("Location:../../login-usuario.php");
}
?>