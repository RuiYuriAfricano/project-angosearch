<?php
session_start();

if ( isset($_SESSION['nome_admin'])) {
    header("Location:angosearch/AdminLTE-master/index.php");
} else {
    ?>
    <?php

    include 'include/conexao.php';

    $con=conecta();

    $r=$con ->query("select visualizacao from pagina where id_pagina='1' and estado='1' ") or die(mysql_error());
    $row = mysqli_fetch_assoc($r);
    $visualizacao = $row['visualizacao'];
    $visualizacao_mais = $visualizacao+1;

    $atuliza= $con ->query("update pagina set visualizacao='$visualizacao_mais' where id_pagina ='1'") or die("erro ao atualizar visualização");

    $s =$con ->query("select * from pagina where id_pagina='1' and estado='1' ") or die(mysql_error());

    $linh = mysqli_num_rows($s);
    $dad = mysqli_fetch_assoc($s);



    $desaparecidos = $con->query("select * from desaparecidos where estado='1'");
    $totalDesaparecidos = mysqli_num_rows($desaparecidos);

    $docs = $con->query("select * from documentos where estado='1'");
    $totalDocs = mysqli_num_rows($docs);

    $desaparecidos1 = $con->query("select * from desaparecidos where estado='0'");
    $totalDesaparecidos1 = mysqli_num_rows($desaparecidos1);

    $docs1 = $con->query("select * from documentos where estado='0'");
    $totalDocs1 = mysqli_num_rows($docs1);
    ?>

    <!doctype html>
    <html lang="pt-pt">
    <head>
        <!-- Required meta tags -->
        <meta http-equiv="Content­Type" content="text/html;charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="../midia/img/fav-iconAngo.jpg" type="image/jpg">
        <title>Home</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../vendors/linericon/style.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="../vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" href="../vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="../vendors/animate-css/animate.css">




        <link href="slider/css/style.css" rel="stylesheet" type="text/css"/>
        <!-- Other StyleSheet -->
        <link href="slider/css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="slider/css/slicknav.css" rel="stylesheet" type="text/css"/>
        <link href="slider/css/global.css" rel="stylesheet" type="text/css"/>
        <link href="slider/css/prettyPhoto.css" rel="stylesheet" type="text/css"/>
        <!-- Layer Slider -->
        <link rel="stylesheet" href="slider/layerslider/css/layerslider.css" type="text/css"/>

        <!-- main css -->
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/responsive.css"

        <link rel="stylesheet" href="../js/jq/bootstrap.css">

        <script type="text/javascript" src="../js/jq/jq.js"></script>
        <script type="text/javascript" src="../js/jq/bootstrap.js"></script>
        <style>
            #ativo1{
                color: #005cbf;
            }
        </style>
    </head>
    <body>

    <!--================Header Menu Are
    a =================-->
    <header class="header_area">
        <link rel="stylesheet" href="../css/fonts.css">
        <?php

        $con= conecta();

        $sql =$con ->query("select * from definicoes where id_definicoes='1' ") or die(mysql_error());

        $linhas = mysqli_num_rows($sql);
        $dados = mysqli_fetch_assoc($sql);

        /* rodape base de dados*/
        $sq =$con ->query("select * from rodape where id_rodape='1' ") or die(mysql_error());

        $linha = mysqli_num_rows($sq);
        $dado = mysqli_fetch_assoc($sq);
        ?>

        <div class="top_menu row m0">
            <div class="container">
                <div class="float-left">
                    <ul class="list header_social">
                        <li><a href="www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="www.whatsapp.com"><i class="fa fa-whatsapp"></i></a></li>
                        <li><a href="www.instagram.com"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
                <div class="float-right">
                    <select class="lan_pack" id="pages-select">
                        <option value="0">Language</option>
                        <option value="1">Português</option>
                        <option value="2">English</option>
                        <option value="3">Español</option>
                        <option value="4">Français</option>
                    </select>
                    <a class="ac_btn" href="login-usuario.php">Sign in</a>
                    <a class="dn_btn" href="add_conta.php">Register</a>
                </div>
            </div>
        </div>
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="index.php"><img src="../midia/logotipo/<?php echo $dados['logo'];?>" alt="ANGOSEARCH"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item" ><a class="nav-link" id="ativo1" href="index_eng.php">Home</a></li>

                            <li class="nav-item" ><a class="nav-link" id="ativo2" href="#">About</a></li>
                            <li class="nav-item dropdown" ><a class="nav-link dropdown-toggle" data-toggle="dropdown"
                                                              role="button" aria-haspopup="true" aria-expanded="false"
                                                              href="#" id="ativo3    dropdown04">Missing</a>

                                <div class="dropdown-menu" aria-labelledby="dropdown04">
                                    <a class="dropdown-item" href="#" id="pessoas">People</a>
                                    <a class="dropdown-item" href="#">Documents</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown" ><a class="nav-link dropdown-toggle" data-toggle="dropdown"
                                                              role="button" aria-haspopup="true" aria-expanded="false"
                                                              href="#" id="ativo4    dropdown04">
                                    <span class="fa fa-angle-bottom pull-top"></span>Found</a>

                                <div class="dropdown-menu" aria-labelledby="dropdown04">
                                    <a class="dropdown-item" href="#" id="pessoas">People</a>
                                    <a class="dropdown-item" href="#">Documents</a>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" id="ativo5" href="#">Gallery</a></li>

                            <li class="nav-item"><a class="nav-link" id="ativo6" href="#">Contact Us</a></li>

                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item"><a href="#" class="search" data-toggle="modal" data-target="dalAppointment">
                                    <i class="lnr lnr-magnifier"></i></a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--================Header Menu Area =================-->

    <!--================Home Banner Area =================-->
    <section class="home_banner_area" >
        <section class="slider_section" >

            <div id="layerslider-container-fw" >

                <div id="layerslider" style="width: 100%; height: 300px; margin: 0px auto;">

                    <div class="ls-layer" style="slidedirection: right; transition2d: 24,25,27,28; slidedelay: 7000;">

                        <img class="ls-bg"  src="../midia/img/banner/bannerteste.jpg" alt="Slide background" >

                        <h1 class="ls-s-1 slide_tittle" style="top:60px;left: 190px; slidedirection : top; slideoutdirection : bottom;
                    durationin : 3000; durationout : 1500; delayin : 1500;showuntil : 1000;font-weight: 900;">
                            Welcome to the AngoSearch Portal </h1>
                        <h1 class="ls-s-1 slide_tittle" style="top:155px; left: 190px; slidedirection : right; slideoutdirection : left;
                    durationin : 2000; durationOut : 1000; easingin : easeOutQuint; easingout : easeInOutQuint; delayin : 1500;
                    delayout : 2000; rotatein : 90; rotateout : -90;  showuntil : 1000;"></h1>
                        <p class="ls-s-1 slide_content" style="top:196px; left: 190px; slidedirection : fade;
                   text-transform: uppercase; slideoutdirection : right;durationin : 3000; durationOut : 900; delayin : 1500;
                    delayout : 1500; showuntil : 1000;">Help for those who have lost documents or documents.<br/></p>
                        <div class="ls-s-1 slide_button" style="top:240px; left: 190px; slidedirection : bottom; slideoutdirection : fade;
					 durationin : 3000; durationOut : 1400;delayin : 1500;scalein : 0; scaleout : 3; showuntil : 1000;">
                            <a href="todosDesaparecidos.php"
                               style="background-color:#005cbf;" >Missing people</a></div>
                        <p class="ls-s-1" style="top:30px; left: 73%;slidedirection : left;
					slideoutdirection : right; durationin : 3000; durationOut : 1100;delayin : 1500;showuntil : 1000;">
                            <img class="img-responsive" src="slider/assets/images/slider_image/a_002.jpg" alt="image"
                                 style="border-radius: 50px;display: none;"/></p>
                    </div>



                    <div class="ls-layer" style="slidedirection: left; transition3d: 1,4,5,11; slidedelay: 7000">

                        <img class="ls-bg" style="max-width: 100%;" src="../midia/img/banner/bannerteste.jpg" alt="Slide background" >

                        <h1 class="ls-s-1 slide_tittle" style="display:none;top:60px; left: 190px; slidedirection : top; slideoutdirection : bottom;
					font-weight: 900;durationin : 3000; durationout : 1500; delayin : 1500;showuntil : 1000; scalein : 0; scaleout : 3;">
                            Welcome to the AngoSearch Portal </h1>
                        <h1 class="ls-s-1 slide_tittle" style="display:none;top:155px; left: 190px; slidedirection : right; slideoutdirection : left;durationin : 2000;
                     durationOut : 1000; easingin : easeOutQuint; easingout : easeInOutQuint; delayin : 1500; delayout : 2000; rotatein : 90;
                     rotateout : -90;  showuntil : 1000;"> </h1>
                        <p class="ls-s-1 slide_content" style="display:none;top:196px; left: 190px; slidedirection : fade;
                     slideoutdirection : right;
                    durationin : 3000; durationOut : 900; delayin : 1500; delayout : 1500; showuntil : 1000;">
                        </p>
                        <div class="ls-s-1 slide_button" style="display:none;top:210px; left: 190px; slidedirection : bottom; slideoutdirection : fade;
                    durationin : 3000; durationOut : 1400;delayin : 1500;scalein : 0; scaleout : 3;showuntil : 1000;">
                            <a href="pessoas_encontradas.php" style="background-color:#005cbf;" >Missing people</a></div>
                        <p class="ls-s-1" style="top:30px; left: 73%;slidedirection : left; slideoutdirection : right;
                    durationin : 3000; durationOut : 1100;delayin : 1500;showuntil : 1000;">
                            <img class="img-responsive" src="slider/assets/images/slider_image/welcome-img.jpg" style="
                        display:none;border-radius: 50px" alt="image"/></p>
                    </div>

                </div>

            </div>

        </section>
        <!-- End Slider Section --><br><br><br><br>
        <div class="donation_area">
            <!-- Start faq Area -->
            <section class="faq-area section-gap relative   counter_content">
                <div class="overlay overlay-bg"></div>
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-3 col-md-6">
                            <div class="single-faq  milestone">
                                <div class="circle1">
                                    <div class="inner"></div>
                                </div>
                                <h5><span class="counter    milestone_counter" data-end-value="<?php echo $totalDesaparecidos; ?>">
                                    0</span></h5>
                                <p>
                                    Missing people
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="single-faq">
                                <div class="circle1">
                                    <div class="inner"></div>
                                </div>
                                <h5><span class="counte     milestone_counter" data-end-value="<?php echo $totalDesaparecidos1; ?>">
                                    0</span></h5>
                                <p>
                                    People Found
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="single-faq  milestone">
                                <div class="circle1">
                                    <div class="inner"></div>
                                </div>
                                <h5><span class="counter    milestone_counter" data-end-value="<?php echo $totalDocs; ?>">
                                    0</span></h5>
                                <p>
                                    Lost Documents
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="single-faq  milestone">
                                <div class="circle1">
                                    <div class="inner"></div>
                                </div>
                                <h5><span class="counter    milestone_counter" data-end-value="<?php echo $totalDocs1; ?>">
                                    0</span></h5>
                                <p>
                                    Documents Found
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </section></div>
    </section>
    <section class="causes_area p_120">
        <div class="container"  >
            <div class="main_title">
                <h2>Missing Persons Index Increases</h2>

                <p>Since many years ago Luanda has reported many missing, others are even found dead. There is also talk of
                    a long time ago of a large number of people,
                    who lose their important documents which in turn condition in service places and other institutions.</p>
            </div>
            <?php



            $desaparecidos=$con->query("SELECT id_desaparecido,nome_completo,idade,nome_pai,nome_mae,data_desaparecimento,foto,postado_por,
dataRegistro,descricao,caracteristicas_especiais,bairro,genero,provincia FROM
desaparecidos,bairro,genero,provincia WHERE estado = '1' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia ORDER  BY  id_desaparecido DESC LIMIT 9 ")
            or die("erro ao consultar ".mysql_error());


            ?><center id="sectionPessoas"> <h2 ><a href="todosDesaparecidos.php" style="color: #666;">Missing people</a></h2></center>
            <center><div class="causes_slider owl-carousel" >
                    <?php while(    $dado=mysqli_fetch_array($desaparecidos)){ ?>
                        <div class="item">
                            <div class="causes_item">
                                <div class="causes_img">
                                    <img class="img-fluid" style="width: auto; height: 150px;" src="angosearch/admin/midia/foto_desaparecido/<?php echo $dado['foto']; ?>"
                                         alt="<?php echo $dado['nome_completo'];?>">

                                </div>
                                <div class="causes_text">
                                    <h4><?php echo $dado['nome_completo'];?></h4>
                                    <p><?php echo "de idade". $dado['idade'];?>, desaparecido(a) desde o dia
                                        <?php echo $dado['data_desaparecimento'];?>
                                        , vive no bairro <?php echo $dado['bairro'];?>. <br><br> Post :
                                <span style="font-weight: bold;"><?php echo $dado['postado_por'];?>, aos
                                    <?php echo $dado['dataRegistro'];?></span></p>



                                </div>

                                <div class="causes_bottom">
                                    <a href="maisDesaparecidos.php?id_desaparecido=<?php echo ($dado['id_desaparecido']);?> ">More</a>

                                </div>
                            </div>
                        </div>
                    <?php }//end if ?>
                </div></center></div></section>

    <!--================End Home Banner Area =================-->

    <!--================Welcome Area =================-->
    <section class="welcome_area p_120">
        <div class="container">
            <div class="row welcome_inner">

                <div class="col-lg-6">
                    <div class="welcome_text">
                        <h4>Lost children struggle to survive</h4>

                        <p>especially in Luanda Province, children and adolescents share the same scenarios of pain and loneliness every day.</p>

                        <p>In many parts of the capital `Luanda`, especially the surroundings of 1º de Maio, Airport,
                            Golf II, Bay of Luanda and Vila de Cacuaco, are beggars begging for bread.</p>

                        <p>A survey conducted from March to June 2018 by the International Volunteering for Development
                            organization shows that 80% of street children in Angola are between 8 and 14 years old.</p>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="wel_item">
                                    <h4><span class="milestone_counter" data-end-value="5">0</span>%</h4>

                                    <p>In week</p>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="wel_item">
                                    <h4><span class="milestone_counter" data-end-value="10">0</span>%</h4>

                                    <p>In Month</p>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="wel_item">
                                    <h4><span class="milestone_counter" data-end-value="15">0</span>%</h4>

                                    <p>In Year</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="welcome_img"><img alt="A procura de Desaparecido" class="img-fluid" height="427"
                                                  src="http://localhost/Projecto Final - Loide Laura/webimg/images/0%2Ce4526f42-c975-4ebb-a76a-235a32d56d85.jpg" width="640" /></div>
                </div>



            </div></div>
    </section>
    <!--================End Welcome Area =================-->
    <!--================ Start important-points section =================-->

    <!--================ End important-points section =================-->
    <!--================Causes Area =================-->
    <section class="causes_area p_120" >

        <div class="container"  >
            <div class="container">
                <center>
                    <div class="main_title">
                        <h2>Greatest Concern</h2>

                        <p>Since many years ago Luanda has reported many missing, others are even found dead. There is also talk of a
                            long time ago of a large number of people,
                            who lose their important documents which in turn are conditioned on service places and other institutions.</p>
                    </div>

                    <section class="donation_details pad_top">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 single_donation_box   alert alert-danger bold">
                                    <h4>Disappearance of People</h4>

                                    <p>If you have a missing family member or friend,
                                        you must first register a police report, which can be posted online, through this portal ,
                                        <a href="http://www.ssp.sp.gov.br/nbo/">Having an Account</a> ,
                                        ou no <a href="http://www.ssp.sp.gov.br/servicos/mapaTelefones.aspx">
                                            or at the police station closest to your location.</a></p>
                                </div>

                                <div class="col-lg-3 col-md-6 single_donation_box   alert alert-warning bold">
                                    <h4>People Photos</h4>

                                    <p>To assist in the search, police stations post on the Internet a photo
                                        of the missing person sent to the police department.</p>
                                </div>

                                <div class="col-lg-3 col-md-6 single_donation_box   alert alert-info">
                                    <h4>Document Meeting</h4>
                                    If you have found a document portfolio or even just one document whatsoever it should lead to the nearest police station in your locality.</div>

                                <div class="col-lg-3 col-md-6 single_donation_box   alert alert-success bold">
                                    <h4>People Meeting</h4>
                                    If you have chosen to post the missing person's photo on the Internet, after finding it, also report the police stations.
                                    The communication may be made by telephone, in person or by means of a form.</div>
                            </div>
                        </div>
                    </section>
                </center>

                <div class="main_title">
                    <h2>High Level of Lost Documents</h2>

                    <p>
                        Since many years ago Luanda has recorded many lost documents, It has also been said for a long time that a
                        large number of people are
                        losing their important documents which in turn condition in service places and other institutions.</p>
                </div>
            </div>

            <?php

            $nd = $con->query("select * from documentos where estado='1'");
            $tnd = mysqli_num_rows($nd);

            $doc=$con->query("SELECT * FROM documentos WHERE estado = '1'  ORDER  BY  id_doc DESC LIMIT $tnd ")or die("erro ao apresentar os documentos");


            ?><center id="sectionDocumentos">
                <h2 style="color: #000;"><a href="todosDocDesaparecidos.php" style="color: #666;">Missing Documents</a></h2></center>
            <div class="causes_slider owl-carousel" >
                <?php while($dado=mysqli_fetch_array($doc)){ ?>
                    <div class="item">
                        <div class="causes_item">
                            <div class="causes_img">
                                <img class="img-fluid" style="width: 250px; height: 150px;" src="angosearch/admin/midia/documentos/<?php echo $dado['fotografia']; ?>"
                                     alt="<?php echo $dado['fotografia'];?>">

                            </div>
                            <div class="causes_text">
                                <h4><?php echo $dado['nome_doc'] ?> </php></h4>
                                <p> <?php echo "Detalhes:<br> ".
                                        $dado['detalhe']  ?>. <br><br> Post:
                                    <span style="font-weight: bold;"><?php echo $dado['postado_por'];?>, aos <?php echo $dado['dataRegistro'];?></span></p>


                            </div>
                            <div class="causes_bottom">
                                <a href="saberDoc.php?id_doc=<?php echo ($dado['id_doc']);?> ">More</a>

                            </div>
                        </div>
                    </div>
                <?php }//end if ?>
            </div>
        </div>

    </section>
    <!--================End Causes Area =================-->

    <!--================Testimonials Area =================-->
    <section class="testimonials_area p_120">
        <div class="container">
            <div class="row testimonials_inner">
                <div class="col-lg-4">
                    <div class="testi_left_text">
                        <h4>What the users Says </h4>
                        <p>Here is, below a list of comments done by the users,
                            starting from their bills of the portal <br>« Angosearch » .</p>
                    </div>
                </div>

                <?php


                $c=$con->query("SELECT id_comentario,comentario,data_comentario,nome_completo,foto
            FROM comentario,utilizador WHERE  id_utilizador=utilizador and fk_desaparecido='0'
                                            ORDER  BY  id_comentario  DESC  LIMIT 5 ");


                ?>
                <div class="col-lg-8">
                    <?php $l = mysqli_num_rows($c);
                    ?>
                    <div class="testi_slider owl-carousel   active-review-carusel">
                        <?php
                        if ($l > 0) {


                            while ($dados1 = mysqli_fetch_assoc($c)) { ?>
                                <div class="item    single-feedback-carusel">
                                <div class="testi_item">
                                    <img style="max-width: 80px;max-height: 80px;" src="angosearch/admin/midia/img/<?php echo $dados1['foto']; ?>" alt="">
                                    <p ><i style="width: 30px;
height: 30px;
font-size: 15px;
line-height: 30px;
position: absolute;
color: #666;
background: #d2d6de;
    background-color: rgb(210, 214, 222);
border-radius: 50%;
text-align: center;
left: 18px;

" class="fa fa-comments bg-yellow"></i>       <p style="margin-left: 20px;text-align: left"><?php echo utf8_encode($dados1['comentario']); ?>.</p></p>
                                    <h4><?php echo $dados1['nome_completo']; ?></h4>
                            <span style="color: #999;
text-align: center;
padding: 10px;
font-size: 12px;" class="time"><i class="fa fa-clock-o"></i> <?php echo date('D, d-m-Y H:i',strtotime($dados1['data_comentario'])); ?>
                            </span>


                                </div>
                                </div><?php }}?>
                    </div>
                </div>

    </section>
    <!--================End Testimonials Area =================-->
    <!--================Event Area =================-->


    <style type="text/css">
        .img-thumbnail, .thumbnail {
            -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.075);
            box-shadow: 0 1px 2px rgba(0,0,0,.075);
        }
        .thumbnail {
            display: block;
            padding: 4px;
            padding-right: 4px;
            padding-left: 4px;
            margin-bottom: 20px;
            line-height: 1.42857143;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            -webkit-transition: border .2s ease-in-out;
            -o-transition: border .2s ease-in-out;
            transition: border .2s ease-in-out;
        }

        .carousel-control {
            position: absolute;
            top: 35%;
            left: 15px;
            width: 40px;
            height: 40px;
            margin-top: -20px;
            font-size: 60px;
            font-weight: 100;
            line-height: 28px;
            color: #ffffff;
            text-align: center;
            background: #222222;
            border: 3px solid #ffffff;
            -webkit-border-radius: 23px;
            -moz-border-radius: 23px;
            border-radius: 23px;
            opacity: 0.5;
            filter: alpha(opacity=50);
        }
        .carousel-control.right {
            right: 15px;
            left: auto;
        }
    </style>
    <!--================End Event Area =================-->


    <!--================Clients Logo Area =================-->
    <section class="clients_logo_area">
        <?php include"include/clients_logo.php"; ?>
    </section>
    <!--================End Clients Logo Area =================-->


    <!--================ start footer Area  =================-->
    <!-- Footer -->

    <footer class="footer">
        <?php include"include/rodape.php"; ?>
        <div class="footer_background" style="background-image:url(images/footer_background.png);">&nbsp;</div>

        <div class="container">
            <div class="row footer_row">
                <div class="col">
                    <div class="footer_content">
                        <div class="row">
                            <div class="col-lg-3 footer_col"><!-- Footer About -->
                                <div class="footer_section footer_about">
                                    <div class="footer_logo_container">
                                        <div class="footer_logo_img"><a href="#"><img alt="" height="70" src="../midia/logotipo/search.png" /></a></div>
                                    </div>

                                    <div class="footer_about_text">
                                        <p>Also follow us on social networks, inserted below and at the top of the Portal.</p>
                                    </div>

                                    <div class="footer_social">
                                        <ul>
                                            <li><a href="www.facebook.com"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                            <li><a href="www.whatsapp.com"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                                            <li><a href="www.instagram.com"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                            <li><a href="www.twitter.com"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 footer_col"><!-- Footer Contact -->
                                <div class="footer_section footer_contact">
                                    <div class="footer_title">contact us</div>

                                    <div class="footer_contact_info">
                                        <ul>
                                            <li><span class="fa fa-envelope"></span> Email: angosearch@gmail.com</li>
                                            <li><span class="fa fa-phone"></span> Phone: +(244) 933 988 158</li>
                                            <li><span class="fa fa-map-marker"></span>Luanda, Angola Installed in Police Stations, Police Stations and MonoblocksLuanda, Angola Instalado em Esquadras ,
                                                Postos policias e Monoblocos</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 footer_col"><!-- Footer links -->
                                <div class="footer_section footer_links">
                                    <div class="footer_title">OUR PORTAL</div>

                                    <div class="footer_links_container">
                                        <ul>
                                            <li><a href="index_eng.php">Home</a></li>
                                            <li><a href="#">About</a></li>
                                            <li><a href="#">Missing</a></li>
                                            <li><a href="#">Found</a></li>
                                            <li><a href="#">Gallery</a></li>
                                            <li><a href="#">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 footer_col clearfix"><!-- Footer links -->
                                <div class="footer_section footer_mobile">
                                    <div class="footer_title">Login</div>

                                    <div class="footer_mobile_content">
                                        <div class="footer_image"><a class="btn" href="login-usuario.php"
                                                                     style="background:#005fcb;border: 1px solid white; color: white;&#10;
                                                                      width: 200px">Sing in</a></div>

                                        <div class="footer_image"><a class="btn btn-light" href="criar_conta.php" style="border: 1px solid white;&#10;
                                        width: 200px">Register</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row copyright_row">
                <div class="col">
                    <div class="copyright d-flex flex-lg-row flex-column align-items-center justify-content-start">
                        <div class="cr_text">Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                            All Rights Reserved  | Angosearch</div>

                        <div class="ml-lg-auto cr_links">
                            <ul class="cr_list">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Politica e Policy & Privacy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

    <style>


        header .navbar .dropdown-menu .dropdown-item:hover {
            background: #005fcb;
            color: #fff;
        }

        header .navbar .dropdown-menu .dropdown-item.active {
            background: #005fcb;
            color: #fff;
        }

        header .navbar .dropdown-menu a {
            padding-top: 7px;
            padding-bottom: 7px;
        }
        header .navbar .dropdown.show > a {
            color: #fff;
        }

        header .navbar .dropdown-menu {
            font-size: 14px;
            border-radius: 0px;
            border: none;
            -webkit-box-shadow: 0 2px 30px 0px rgba(0, 0, 0, 0.2);
            box-shadow: 0 2px 30px 0px rgba(0, 0, 0, 0.2);
            min-width: 13em;
            margin-top: -10px;
        }

        header .navbar .dropdown-menu:before {
            bottom: 100%;
            left: 10%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-bottom-color: #fff;
            border-width: 10px;
        }

        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
            z-index: 2;
            color: #fff;
            cursor: default;
            background-color: #337ab7;
            border-color: #337ab7;
        }
        .pagination>li>a {
            background: #fafafa;
            color: #666;
        }
        .pagination>li>a, .pagination>li>span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #337ab7;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        .pagination>li:first-child>a, .pagination>li:first-child>span {
            margin-left: 0;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }
        .pagination>.disabled>a, .pagination>.disabled>a:focus, .pagination>.disabled>a:hover, .pagination>.disabled>span, .pagination>.disabled>span:focus, .pagination>.disabled>span:hover {
            color: #777;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #ddd;
        }
        .pagination>li>a {
            background: #fafafa;
            color: #666;
        }
        .pagination>li>a, .pagination>li>span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #337ab7;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        a {
            color: #3c8dbc;
        }
        a {
            color: #337ab7;
            text-decoration: none;
        }
        iv.dataTables_wrapper div.dataTables_filter input {
            margin-left: 0.5em;
            display: inline-block;
            width: auto;
        }
        @media (min-width: 768px)
            .form-inline .form-control {
                display: inline-block;
                width: auto;
                vertical-align: middle;
            }
            .form-control:not(select) {
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
            }
            input[type=search] {
                -webkit-appearance: none;
            }
            input[type=search] {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }
            input[type=search] {
                -webkit-box-sizing: content-box;
                -moz-box-sizing: content-box;
                box-sizing: content-box;
                -webkit-appearance: textfield;
            }
            .form-control {
                border-radius: 0 !important;
                box-shadow: none;
                border-color: #d2d6de;
            }
            .input-sm {
                height: 30px;
                padding: 5px 10px;
                font-size: 12px;
                line-height: 1.5;
                border-radius: 3px;
            }


    </style>







    <script type="text/javascript">


        $('.carousel').carousel({
            interval: 3000
        });


    </script>

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
    <script src="../js/muda_lingua.js"></script>

    <!-- counter -->
    <script src="plugins/jquery-3.2.1.min.js"></script>
    <script src="plugins/greensock/TweenMax.min.js"></script>
    <script src="plugins/greensock/TimelineMax.min.js"></script>
    <script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
    <script src="plugins/greensock/animation.gsap.min.js"></script>
    <script src="plugins/greensock/ScrollToPlugin.min.js"></script>
    <script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="plugins/easing/easing.js"></script>
    <script src="plugins/parallax-js-master/parallax.min.js"></script>
    <script src="plugins/custom.js"></script>

    <!-- Bootstrap core JavaScript
        ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="slider/js/jquery.js"></script>
    <script src="slider/js/bootstrap.min.js"></script>
    <script src="slider/js/holder.js"></script>
    <!-- Nav Manu -->
    <script src="slider/js/jquery.slicknav.min.js"></script>
    <script src="slider/js/custom_home.js"></script>
    <!-- Slide -->
    <script src="slider/js/slides.min.jquery.js"></script>
    <script src="slider/js/custom_slide.js"></script>
    <!-- PrettyPhoto -->
    <script src="slider/js/jquery.prettyPhoto.js"></script>
    <script src="slider/js/custom_prettyPhoto.js"></script>
    <!-- Layer Slider -->
    <script src="slider/layerslider/jQuery/jquery-easing-1.3.js" type="text/javascript"></script>
    <script src="slider/layerslider/jQuery/jquery-transit-modified.js" type="text/javascript"></script>
    <script src="slider/layerslider/js/layerslider.transitions.js" type="text/javascript"></script>
    <script src="slider/layerslider/js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>
    <script src="slider/js/layer_custom.js"></script>

    </body>
    </html>
<?php

}   ?>