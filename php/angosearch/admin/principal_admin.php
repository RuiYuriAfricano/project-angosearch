
<?php
session_start();
if($_SESSION['nome_admin']) {


    ?>


    <?php
    include 'include/conexao.php';
    $con = conecta();
    $v1 = $con->query("select visualizacao from pagina where id_pagina='1'  and estado='1' ") or die(mysql_error());
    $row1 = mysqli_fetch_assoc($v1);
    $v2 = $con->query("select visualizacao from pagina where id_pagina='2'  and estado='1' ") or die(mysql_error());
    $row2 = mysqli_fetch_assoc($v2);
    $v3 = $con->query("select visualizacao from pagina where id_pagina='3' and estado='1' ") or die(mysql_error());
    $row3 = mysqli_fetch_assoc($v3);
    $v4 = $con->query("select visualizacao from pagina where id_pagina='4'and estado='1' ") or die(mysql_error());
    $row4 = mysqli_fetch_assoc($v4);
    $v5 = $con->query("select visualizacao from pagina where id_pagina='5' and estado='1' ") or die(mysql_error());
    $row5 = mysqli_fetch_assoc($v5);
    $v6 = $con->query("select visualizacao from pagina where id_pagina='6'  and estado='1' ") or die(mysql_error());
    $row6 = mysqli_fetch_assoc($v6);
    $v7 = $con->query("select visualizacao from pagina where id_pagina='7'  and estado='1' ") or die(mysql_error());
    $row7 = mysqli_fetch_assoc($v7);
    $v8 = $con->query("select visualizacao from pagina where id_pagina='8'  and estado='1' ") or die(mysql_error());
    $row8 = mysqli_fetch_assoc($v8);



    $visualizacao = $row1['visualizacao']+$row2['visualizacao']+$row3['visualizacao']+$row4['visualizacao']+$row5['visualizacao']
        +$row6['visualizacao']+$row7['visualizacao']+$row8['visualizacao'];

    $esquadras = $con->query("select * from esquadra where estado='1'");
    $totalEsquadra = mysqli_num_rows($esquadras);

    $desaparecidos = $con->query("select * from desaparecidos where estado='1'");
    $totalDesaparecidos = mysqli_num_rows($desaparecidos);

    $docs = $con->query("select * from documentos where estado='1'");
    $totalDocs = mysqli_num_rows($docs);

    $total = $totalDesaparecidos + $totalDocs;
    ?>

    <!doctype html>
    <html lang="pt-pt">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Admin</title>
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
        <!-- Date Picker -->
        <link rel="stylesheet" href="bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="bootstrap-daterangepicker/daterangepicker.css">
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
                    <h2>Área Administrativa</h2>

                    <div class="page_link">
                        <a href="">Esquadras</a>
                        <a href="">Utilizadores</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->
    <!-- Small boxes (Stat box) -->
    <br>

    <div class="row" id="resumo">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue" style="background: #002a80;">
                <div class="inner">
                    <h3><?php echo $totalEsquadra; ?></h3>

                    <p><br>Esquadras Registradas</p>
                </div>
                <div class="icon">
                    <i class="ion  ion-android-list"> </i>
                </div>
                <a href="visualizar_esquadra.php" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo $total; ?></h3>

                    <p>Desaparecidos: Pessoas e Documentos</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-search"></i>
                </div>
                <a href="visualizar_desaparecidos.php" class="small-box-footer">Mais info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>44</h3>

                    <p><br>Usuários Registrados</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?php echo $visualizacao; ?></h3>

                    <p><br>Visualizações</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="pagina.php" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <!--================Welcome Area =================-->
    <section class="welcome_area p_120">
        <div class="container">
            <div class="row welcome_inner">
                <div class="col-lg-6">
                    <div class="welcome_text">
                        <h4>Sistema ANGOSEARCH</h4>

                        <p>Bem-Vindo ao Sistema , Sr . Administrador <span class="text-primary">
                            <?php echo $_SESSION['nome_admin']; ?></span></p>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="welcome_img">
                        <img class="img-fluid" src="midia/img/welcome2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Welcome Area =================-->

    <!--================Causes Area =================-->

    <!--================End Causes Area =================-->



    <!-- /.box -->


    <!--================Event Area =================-->
    <!--================End Event Area =================-->


    <!--================Clients Logo Area =================-->

    <!--================End Clients Logo Area =================-->


    <!--================ start footer Area  =================-->
    <footer class="footer-area section_gap">
        <?php include "include/rodape.php"; ?>

    </footer>
    <!--================ End footer Area  =================-->


    <script src="include/jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="include/jquery-ui/jquery-ui.min.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="include/jquery-knob/dist/jquery.knob.min.js"></script>
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
    header("Location:../../login-usuario.php");
}
    ?>