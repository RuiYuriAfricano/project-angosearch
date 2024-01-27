<?php
session_start();


if ( !$_SESSION['utilizador']) {
    header("Location:../../login-usuario.php");
} else {
    ?>
<?php

    include 'include/conexao.php';
include_once '../adminLTE-master/classes/Traffic.php';
    new Traffic();
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

    if(isset($_POST['sub'])) {


        $comentario = utf8_decode($_POST['comentario']);

        $ut=$_SESSION['utilizador'];




        $data=date('Y-m-d H:i:s');

        $con=conecta();

        try {
            $s=$con->query("select id_utilizador from utilizador where nome_completo='$ut'");
            $pega=mysqli_fetch_array($s);
            $id_ut=$pega['id_utilizador'];

            $insere = $con->query("INSERT INTO comentario (id_comentario, utilizador, comentario,fk_desaparecido, data_comentario,estado_comment)
 VALUES (DEFAULT ,'$id_ut', '$comentario.','0', '$data','1')");
            if ($insere === FALSE) {
                throw new Exception('Problemas: ' . $con->errno . ' --- ' . $con->error . '<br />');
            } else {
                echo" <script type='text/javascript'>
                    window.onload = function()
                    {
                        notif('Comentário efectuado com sucesso...!');
                    }
        </script> ";// enviado com sucesso
            }
        } catch (Exception $e) {
            //caso haja uma exceção a mensagem é capturada e atribuida a $msg
            echo $e->getMessage();
        }




    }
    if(isset($_POST['excluir'])) {



        $id = $_POST['id_comment'];
        $ut = $_SESSION['utilizador'];

        $con=conecta();

        try {
            $s=$con->query("select id_utilizador from utilizador where nome_completo='$ut'");
            $pega=mysqli_fetch_array($s);
            $id_ut=$pega['id_utilizador'];

            $del = $con->query("update comentario set estado_comment='0' where estado_comment='1' and utilizador='$id_ut' and id_comentario='$id'");
            if ($del === FALSE) {
                throw new Exception('Problemas: ' . $con->errno . ' --- ' . $con->error . '<br />');
            } else {
                echo" <script type='text/javascript'>
                    window.onload = function()
                    {
                        alert('Comentário Excluido!')
                    }
        </script> ";// enviado com sucesso
            }
        } catch (Exception $e) {
            //caso haja uma exceção a mensagem é capturada e atribuida a $msg
            echo $e->getMessage();
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
    <title>Página Inicial</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../adminLTE-master/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/bootstracss">
    <link rel="stylesheet" href="../adminLTE-master/dist/css/adminLTE.css">
    <link rel="stylesheet" href="../../../vendors/linericon/style.css">
    <link rel="stylesheet" href="../../../css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="../../../vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="../../../vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="../../../vendors/animate-css/animate.css">



    <link rel="stylesheet" href="../../../vendors/linericon/style.css">
    <link rel="stylesheet" href="../../../css/font-awesome.min.css">

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
    <link rel="stylesheet" href="../../../css/responsive.css">

  <style>
      #ativo1{
          color: #005cbf;
      }
      .navbar {
          position: relative;
          min-height: 50px;
          margin-bottom: 20px;
          border: 1px solid transparent;
      }
      @media (min-width: 768px) {
          .navbar {
              border-radius: 4px;
          }
      }
      @media (min-width: 768px) {
          .navbar-header {
              float: left;
          }
      }
      .navbar-collapse {
          padding-right: 15px;
          padding-left: 15px;
          overflow-x: visible;
          -webkit-overflow-scrolling: touch;
          border-top: 1px solid transparent;
          -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1);
          box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1);
      }
      .navbar-collapse.in {
          overflow-y: auto;
      }
      @media (min-width: 768px) {
          .navbar-collapse {
              width: auto;
              border-top: 0;
              -webkit-box-shadow: none;
              box-shadow: none;
          }
          .navbar-collapse.collapse {
              display: block !important;
              height: auto !important;
              padding-bottom: 0;
              overflow: visible !important;
              visibility: visible !important;
          }
          .navbar-collapse.in {
              overflow-y: visible;
          }
          .navbar-fixed-top .navbar-collapse,
          .navbar-static-top .navbar-collapse,
          .navbar-fixed-bottom .navbar-collapse {
              padding-right: 0;
              padding-left: 0;
          }
      }
      .navbar-fixed-top .navbar-collapse,
      .navbar-fixed-bottom .navbar-collapse {
          max-height: 340px;
      }
      @media (max-device-width: 480px) and (orientation: landscape) {
          .navbar-fixed-top .navbar-collapse,
          .navbar-fixed-bottom .navbar-collapse {
              max-height: 200px;
          }
      }
      .container > .navbar-header,
      .container-fluid > .navbar-header,
      .container > .navbar-collapse,
      .container-fluid > .navbar-collapse {
          margin-right: -15px;
          margin-left: -15px;
      }
      @media (min-width: 768px) {
          .container > .navbar-header,
          .container-fluid > .navbar-header,
          .container > .navbar-collapse,
          .container-fluid > .navbar-collapse {
              margin-right: 0;
              margin-left: 0;
          }
      }
      .navbar-static-top {
          z-index: 1000;
          border-width: 0 0 1px;
      }
      @media (min-width: 768px) {
          .navbar-static-top {
              border-radius: 0;
          }
      }

      .navbar-nav {
          margin: 7.5px -15px;
      }
      .navbar-nav > li > a {
          padding-top: 10px;
          padding-bottom: 10px;
          line-height: 20px;
      }
      @media (max-width: 767px) {
          .navbar-nav .open .dropdown-menu {
              position: static;
              float: none;
              width: auto;
              margin-top: 0;
              background-color: transparent;
              border: 0;
              -webkit-box-shadow: none;
              box-shadow: none;
          }
          .navbar-nav .open .dropdown-menu > li > a,
          .navbar-nav .open .dropdown-menu .dropdown-header {
              padding: 5px 15px 5px 25px;
          }
          .navbar-nav .open .dropdown-menu > li > a {
              line-height: 20px;
          }
          .navbar-nav .open .dropdown-menu > li > a:hover,
          .navbar-nav .open .dropdown-menu > li > a:focus {
              background-image: none;
          }
      }
      @media (min-width: 768px) {
          .navbar-nav {
              float: left;
              margin: 0;
          }
          .navbar-nav > li {
              float: left;
          }
          .navbar-nav > li > a {
              padding-top: 15px;
              padding-bottom: 15px;
          }
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
<div class="container-fluid">
<!-- Content Header (Page header) -->
<section class="content-header" >
    <h1>
        Olá, seja bem vindo
        <small><?php echo$_SESSION['utilizador']. ". Apreveite do melhor que há, em ser utilizador regular do \"AngoSearch\" ."; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">AngoSearch</li>
    </ol>
</section></div></div>
<!--================Home Banner Area =================-->
<section class="home_banner_area" >
    <section class="slider_section" >

        <div id="layerslider-container-fw" >

            <div id="layerslider" style="width: 100%; height: 300px; margin: 0px auto;">

                <div class="ls-layer" style="slidedirection: right; transition2d: 24,25,27,28; slidedelay: 7000;">

                    <img class="ls-bg"  src="../../../midia/img/banner/bannerteste.jpg" alt="Slide background" >

                    <h1 class="ls-s-1 slide_tittle" style="top:60px;left: 190px; slidedirection : top; slideoutdirection : bottom;
                    durationin : 3000; durationout : 1500; delayin : 1500;showuntil : 1000;font-weight: 900;">Bem Vindo ao Portal AngoSearch</h1>
                    <h1 class="ls-s-1 slide_tittle" style="top:155px; left: 190px; slidedirection : right; slideoutdirection : left;
                    durationin : 2000; durationOut : 1000; easingin : easeOutQuint; easingout : easeInOutQuint; delayin : 1500;
                    delayout : 2000; rotatein : 90; rotateout : -90;  showuntil : 1000;"></h1>
                    <p class="ls-s-1 slide_content" style="top:196px; left: 190px; slidedirection : fade;
                   text-transform: uppercase; slideoutdirection : right;durationin : 3000; durationOut : 900; delayin : 1500;
                    delayout : 1500; showuntil : 1000;">Ajuda para aqueles que tem seus parentes ou documento perdidos .<br/></p>
                    <div class="ls-s-1 slide_button" style="top:240px; left: 190px; slidedirection : bottom; slideoutdirection : fade;
					 durationin : 3000; durationOut : 1400;delayin : 1500;scalein : 0; scaleout : 3; showuntil : 1000;">
                        <a href="todosDesaparecidos.php"
                           style="background-color:#005cbf;" >Saiba dos Desaparecidos</a></div>
                    <p class="ls-s-1" style="top:30px; left: 73%;slidedirection : left;
					slideoutdirection : right; durationin : 3000; durationOut : 1100;delayin : 1500;showuntil : 1000;">
                        <img class="img-responsive" src="../../slider/assets/images/slider_image/a_002.jpg" alt="image"
                             style="border-radius: 50px;display: none;"/></p>
                </div>



                <div class="ls-layer" style="slidedirection: left; transition3d: 1,4,5,11; slidedelay: 7000">

                    <img class="ls-bg" style="max-width: 100%;" src="../../../midia/img/banner/bannerteste.jpg" alt="Slide background" >

                    <h1 class="ls-s-1 slide_tittle" style="display:none;top:60px; left: 190px; slidedirection : top; slideoutdirection : bottom;
					font-weight: 900;durationin : 3000; durationout : 1500; delayin : 1500;showuntil : 1000; scalein : 0; scaleout : 3;">
                        Bem Vindo ao Portal AngoSearch</h1>
                    <h1 class="ls-s-1 slide_tittle" style="display:none;top:155px; left: 190px; slidedirection : right; slideoutdirection : left;durationin : 2000;
                     durationOut : 1000; easingin : easeOutQuint; easingout : easeInOutQuint; delayin : 1500; delayout : 2000; rotatein : 90;
                     rotateout : -90;  showuntil : 1000;"> </h1>
                    <p class="ls-s-1 slide_content" style="display:none;top:196px; left: 190px; slidedirection : fade;
                     slideoutdirection : right;
                    durationin : 3000; durationOut : 900; delayin : 1500; delayout : 1500; showuntil : 1000;">
                       </p>
                    <div class="ls-s-1 slide_button" style="display:none;top:210px; left: 190px; slidedirection : bottom; slideoutdirection : fade;
                    durationin : 3000; durationOut : 1400;delayin : 1500;scalein : 0; scaleout : 3;showuntil : 1000;">
                        <a href="pessoas_encontradas.php" style="background-color:#005cbf;" >Saiba dos Encontrados</a></div>
                    <p class="ls-s-1" style="top:30px; left: 73%;slidedirection : left; slideoutdirection : right;
                    durationin : 3000; durationOut : 1100;delayin : 1500;showuntil : 1000;">
                        <img class="img-responsive" src="../../slider/assets/images/slider_image/welcome-img.jpg" style="
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
                                Pessoas Desaparecidas
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
                                Pessoas Encontradas
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
                                Documentos Perdidos
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
                                 Documentos Encontrados
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
                    <h2>O índice de Pessoas Desaparecidas Aumenta</h2>

                    <p>Desde muitos anos atr&aacute;s que Luanda registra muitos desaparecidos, outros at&eacute; s&atilde;o encontrados j&aacute; morto. J&aacute; se fala tamb&eacute;m a muito tempo de um n&uacute;mero elevados de pessoas , que perdem seus documentos importantes que por sua vez condicionam nos locais de servi&ccedil;os e nas outras institui&ccedil;&otilde;es.</p>
                </div>
        <?php



        $desaparecidos=$con->query("SELECT id_desaparecido,nome_completo,idade,nome_pai,nome_mae,data_desaparecimento,foto,postado_por,
dataRegistro,descricao,caracteristicas_especiais,bairro,genero,provincia FROM
desaparecidos,bairro,genero,provincia WHERE estado = '1' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia ORDER  BY  id_desaparecido DESC LIMIT 9 ")
        or die("erro ao consultar ".mysql_error());


        ?><center id="sectionPessoas"> <h2 ><a href="pessoas_desap.php" style="color: #666;">Pessoas Desaparecidas</a></h2></center>
        <center><div class="causes_slider owl-carousel" >
            <?php while(    $dado=mysqli_fetch_array($desaparecidos)){ ?>
                <div class="item">
                    <div class="causes_item">
                        <div class="causes_img">
                            <img class="img-fluid" style="width: auto; height: 150px;" src="../admin/midia/foto_desaparecido/<?php echo $dado['foto']; ?>"
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
                            <a href="maisDesaparecido.php?id_desaparecido=<?php echo ($dado['id_desaparecido']);?> ">Saber Mais</a>

                        </div>
                    </div>
                </div>
            <?php }//end if ?>
            </div></center></div></section>

<!--================End Home Banner Area =================-->

<!--================Welcome Area =================-->
<!--================End Welcome Area =================-->
<!--================ Start important-points section =================-->

<!--================ End important-points section =================-->
<!--================Causes Area =================-->
<section class="causes_area p_120" >

    <div class="container"  >

        <?php

        $nd = $con->query("select * from documentos where estado='1'");
        $tnd = mysqli_num_rows($nd);

        $doc=$con->query("SELECT * FROM documentos WHERE estado = '1'  ORDER  BY  id_doc DESC LIMIT $tnd ")or die("erro ao apresentar os documentos");


        ?><center id="sectionDocumentos">
                <h2 style="color: #000;"><a href="todosDocDesaparecidos.php" style="color: #666;">Documentos Desaparecidos</a></h2></center>
        <div class="causes_slider owl-carousel" >
            <?php while($dado=mysqli_fetch_array($doc)){ ?>
            <div class="item">
                <div class="causes_item">
                    <div class="causes_img">
                        <img class="img-fluid" style="width: 250px; height: 150px;" src="../admin/midia/documentos/<?php echo $dado['fotografia']; ?>"
                             alt="<?php echo $dado['fotografia'];?>">

                    </div>
                    <div class="causes_text">
                        <h4><?php echo $dado['nome_doc'] ?> </php></h4>
                        <p> <?php echo "Detalhes:<br> ".
                                $dado['detalhe']  ?>. <br><br> Post:
                            <span style="font-weight: bold;"><?php echo $dado['postado_por'];?>, aos <?php echo $dado['dataRegistro'];?></span></p>


                    </div>
                    <div class="causes_bottom">
                        <a href="maisDocumento.php?id_doc=<?php echo ($dado['id_doc']);?> ">Saber Mais</a>

                    </div>
                </div>
            </div>
            <?php }//end if ?>
</div>
            </div>

</section>
<!--================End Causes Area =================-->

<!--================Testimonials Area =================-->
<section class="testimonials_area p_120 col-md-12">

    <div class="container">
        <div class="row testimonials_inner">
            <div class="col-lg-4">



                <h3 class="section-title mb-3" style="color: #555;">Deixe o seu Comentário Sobre a Nossa Página</h3>

                <form method="post" data-aos="fade" style="color: #000;">
                    <div class="form-group row">
                        <div class="col-md-6 mb-3 mb-lg-0">
                            <input type="hidden" name="id_desaparecido" value="<?php echo $id; ?>">

                            <textarea class="form-control" name="comentario" style="color: #222;max-width: 100%" id="" cols="3" rows="3"
                                      placeholder="Escreva o teu Comentário Aqui" required="true"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <button class="btn btn-primary" type="submit"  name="sub"/>
                            <span	class="glyphicon	glyphicon-comment"></span> Comentar
                            </button>
                        </div>
                    </div>

                </form>

            </div>
    <?php


    $c=$con->query("SELECT id_comentario,comentario,data_comentario,nome_completo,foto
            FROM comentario,utilizador WHERE  id_utilizador=utilizador and fk_desaparecido='0' and estado_comment='1'
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
                            <img style="max-width: 80px;max-height: 80px;" src="../admin/midia/img/<?php echo $dados1['foto']; ?>" alt="">
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
                            <?php if($_SESSION['utilizador']==$dados1['nome_completo']): ?>
                                <div class='timeline-footer' style="padding: 10px;">
                                    <form method="post" action="">
                                        <a class="btn btn-warning btn-flat btn-xs"
                                           href="editar_coment.php?id_comment=<?php echo ($dados1['id_comentario']);?>" >Editar</a>


                                        <input type="hidden" name="id_comment" value="<?php echo $dados1['id_comentario']; ?>"/>
                                        <button type="submit" name="excluir" class="btn btn-danger btn-flat btn-xs">Excluir</button>
                                    </form>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div><?php }}?>
                    <div class="item    single-feedback-carusel">
                        <div class="testi_item">
                            <img src="../../../midia/img/testimonials/jose.png" width="80" height="80" alt="">
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

" class="fa fa-comments bg-yellow"></i>       <p style="margin-right: 20px">so para informar que gostei muito da página, pois que esta página ajudará muito as pessoas,
                                a fim de elas encontrarem os seus parente,a crítica que eu tenho é que a página não tem muitas segurança.
                               </p> </p>
                            <h4>José Kibuco</h4>
                            <h6>Utilizador do Sistema</h6>
                        </div>
                    </div>

                </div>
            </div>
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


<!-- Bootstrap core JavaScript
	================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../../slider/js/jquery.js"></script>
<script src="../../slider/js/bootstrap.min.js"></script>
<script src="../../slider/js/holder.js"></script>
<!-- Nav Manu -->
<script src="../../slider/js/jquery.slicknav.min.js"></script>
<script src="../../slider/js/custom_home.js"></script>
<!-- Slide -->
<script src="../../slider/js/slides.min.jquery.js"></script>
<script src="../../slider/js/custom_slide.js"></script>
<!-- PrettyPhoto -->
<script src="../../slider/js/jquery.prettyPhoto.js"></script>
<script src="../../slider/js/custom_prettyPhoto.js"></script>
<!-- Layer Slider -->
<script src="../../slider/layerslider/jQuery/jquery-easing-1.3.js" type="text/javascript"></script>
<script src="../../slider/layerslider/jQuery/jquery-transit-modified.js" type="text/javascript"></script>
<script src="../../slider/layerslider/js/layerslider.transitions.js" type="text/javascript"></script>
<script src="../../slider/layerslider/js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>
<script src="../../slider/js/layer_custom.js"></script>

</body>
</html>
<?php

}   ?>