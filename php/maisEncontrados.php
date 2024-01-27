<?php
session_start();

if ( isset($_SESSION['nome_admin'])) {
    header("Location:angosearch/AdminLTE-master/index.php");
} else {
?>

<?php include 'include/conexao.php'; ?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../midia/img/fav-iconAngo.jpg" type="image/jpg">
    <title>Desaparecidos</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../vendors/linericon/style.css">
    <link rel="stylesheet" href="../css/themify-icons.css">
    <link rel="stylesheet" href="../css/flaticon.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="../vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="../vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="../vendors/animate-css/animate.css">
    <link rel="stylesheet" href="plugins/css/style.css">
    <!-- main css -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
</head>
<body>

<!--================Header Menu Area =================-->
<header class="header_area">
    <?php include"include/cabecalho.php"; ?>
</header>
<!--================Header Menu Area =================-->
<br><br><br><br><br><br><br><br>

<!--================End Home Banner Area =================-->

<!--================Welcome Area =================-->
<?php


$con=conecta();
?>
<center>
    <?php
    if($_GET["id_desaparecido"]!=""){

        $id=$_GET["id_desaparecido"];

        $desaparecidos=$con->query("SELECT id_desaparecido,nome_completo,idade,nome_pai,nome_mae,dataExcluido,foto,
telefone1,telefone2,postado_por,dataRegistro,data_desaparecimento,dataEncontrado,descricao,caracteristicas_especiais,bairro,genero,provincia FROM
`desaparecidos`,bairro,genero,provincia WHERE estado = '0' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia and id_desaparecido='$id' ORDER  BY  id_desaparecido DESC LIMIT 1 ");


        $linhas = mysqli_num_rows($sql);

        if ($linhas > 0) {


            while ($dados = mysqli_fetch_assoc($desaparecidos)) {


                echo "<h3 align='center'>Saber Mais Sobre: ".$dados['nome_completo']."</b></h3>";
                echo "<table width='80%' style='width: 70%' class='table table-bordered table-striped'>".
                    "<thead>"."<tr>
                <th>Desaparecido</th>
                <th>Detalhes</th>
            </tr>
            </thead><tbody>
            <tr>
                <td><a href='angosearch/admin/midia/foto_desaparecido/".
                    $dados['foto']."'><img width = 'auto' height='150' style='border-radius:26px;'
                 src='angosearch/admin/midia/foto_desaparecido/".
                    $dados['foto']."' alt='".$dados['nome_completo']."'/></a></td><td align='center'>Fotográfia</td></tr>

                <tr>
                <td class='td' >Nº do Processo</td><td class='td' style='text-align:center;'>".
                    $dados['id_desaparecido']."</td></tr><tr>
                <td class='td' >Nome Completo</td><td class='td' style='text-align:center;'>".
                    $dados['nome_completo']."</td></tr><tr>
                <td class='td'>Idade</td><td class='td' style='text-align:center;'>".
                    $dados['idade']."</td></tr><tr>
                <td class='td'>Naturalidade</td><td class='td' style='text-align:center;'>".
                    utf8_encode($dados['provincia'])."</td></tr><tr>
                <td class='td'>Pai</td><td class='td' style='text-align:center;'>".
                    $dados['nome_pai']."</td></tr><tr>
                <td class='td'>Mãe</td><td class='td' style='text-align:center;'>".
                    $dados['nome_mae']."</td></tr><tr>
                <td class='td'>Bairro</td><td class='td' style='text-align:center;'>".
                    $dados['bairro']."</td></tr><tr>
                <td class='td'>Telefone</td><td class='td' style='text-align:center;'>".
                    $dados['telefone1']." / ".$dados['telefone2']."</td></tr>
                <tr>
                 <td class='td'>Descrição</td><td class='td' style='text-align:center;'>".
                    $dados['descricao']."</td>
</tr><tr>
                 <td class='td'>Caracteristicas Físicas</td><td class='td' style='text-align:center;'>".
                    $dados['caracteristicas_especiais']."
</td></tr>
                <tr>
                <td class='td'>Registro no Sistema</td><td class='td' style='text-align:center;'>".
                    $dados['dataRegistro']."</td></tr><tr>
                <td class='td'>Registrado Por</td><td class='td' style='text-align:center;'>".
                    $dados['postado_por']."</td></tr>
                <td>Desaparecimento</td><td style='text-align:center;'>".
                    $dados['data_desaparecimento']."</td></tr>
                        <tr>
                <td class='td'>Encontrado desde</td><td class='td' style='text-align:center;'>".
                    date('d-m-Y',strtotime($dados['dataEncontrado']))."</td></tr></tbody></table><br><br>
                 ";

            }



        }else{

            echo"<script language='javascript'>alert('desaparecido não encontrado.!')</script>";
            echo '<script type="text/javascript">window.location ="index.php"</script>';

        }

    } else{

        echo"<script language='javascript'>alert('Digite o Id do Desaparecido!')</script>";
        echo '<script type="text/javascript">window.location ="index.php"</script>';
    }




    ?>
</center>

<!--================End Welcome Area =================-->

<!--================Feature Area =================-->

<!--================End Feature Area =================-->

<!--================Testimonials Area =================-->
<!--================End Testimonials Area =================-->

<!--================Clients Logo Area =================-->
<section class="clients_logo_area">
    <?php include"include/clients_logo.php"; ?>
</section>
<!--================End Clients Logo Area =================-->


<!--================ start footer Area  =================-->
<footer class="footer-area area-padding-top">

    <?php include_once "include/rodape.php";

    ?>

</footer>
<!--================ End footer Area  =================-->
<div class="btn-back-to-top bg0-hov" id="myBtn" style="display: flex;">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
</div>
<div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>
<!--================ End footer Area  =================-->

<script src="plugins/js/jquery-3.2.1.min.js"></script>
<script src="../js/calendario.js"></script>
<script src="plugins/js/jquery-migrate-3.0.0.js"></script>
<script src="plugins/js/popper.min.js"></script>
<script src="plugins/js/bootstrap.min.js"></script>
<script src="plugins/js/owl.carousel.min.js"></script>
<script src="plugins/js/jquery.waypoints.min.js"></script>
<script src="plugins/js/jquery.stellar.min.js"></script>
<script src="plugins/js/jquery.animateNumber.min.js"></script>

<script src="plugins/js/jquery.magnific-popup.min.js"></script>

<script src="plugins/js/main.js"></script>
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
</body>
</html>
<?php

}   ?>