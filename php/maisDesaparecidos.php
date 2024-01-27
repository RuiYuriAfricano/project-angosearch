<?php
session_start();

if ( isset($_SESSION['nome_admin'])) {
    header("Location:angosearch/AdminLTE-master/index.php");
} else {
?>

<?php include 'include/conexao.php';

    $con=conecta();

    if(isset($_POST['sub'])) {

        $visualizador = $_POST['visualizador'];
        $comentario = $_POST['comentario'];
        $fk_desaparecido = $_POST['id_desaparecido'];

        $dia = date('d');
        $mes = date('M');
        $ano = date('Y');
        $h= date('H')-1;
        $m = date('i');
        $s = date('s');

        $data=$dia.'/'.$mes.'/'.$ano.' , '.$h.':'.$m.':'.$s;



        try {
            $insere = $con->query("INSERT INTO comentario (id_comentario, visualizador, comentario, fk_desaparecido, data_comentario)
 VALUES (DEFAULT ,'$visualizador', '$comentario', '$fk_desaparecido', '$data'");
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



    ?>

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
    <link rel="stylesheet" href="angosearch/admin/css/glyphicon.css">
    <link rel="stylesheet" href="angosearch/adminLTE-master/dist/css/adminLTE.css">
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

<!--================Home Banner Area =================-->

<br><br><br><br><br><br><br><br>
<!--================End Home Banner Area =================-->

<!--================Welcome Area =================-->
<?php



?>
<center>
<?php
if($_GET["id_desaparecido"]!=""){

    $id=$_GET["id_desaparecido"];

    $desaparecidos=$con->query("SELECT id_desaparecido,nome_completo,idade,nome_pai,nome_mae,data_desaparecimento,foto,
telefone1,telefone2,dataRegistro,descricao,caracteristicas_especiais,postado_por,bairro,genero,provincia FROM
`desaparecidos`,bairro,genero,provincia WHERE estado = '1' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia and id_desaparecido='$id' ORDER  BY  id_desaparecido DESC LIMIT 1 ");


    $linhas = mysqli_num_rows($sql);

    if ($linhas > 0) {


        while ($dados = mysqli_fetch_assoc($desaparecidos)) {


            echo "<h3 align='center'>Saber Mais Sobre: ".$dados['nome_completo']."</b></h3>";
            echo "<table width='80%' style='width: 70%' class='table table-bordered table-striped'>".
                "<thead>"."<tr>
                <th>Desaparecido(a)</th>
                <th>Detalhes</th>
            </tr>
            </thead><tbody>
            <tr>
                <td><a href='angosearch/admin/midia/foto_desaparecido/".
                $dados['foto']."'><img width = 'auto' height='150' style='border-radius:100%;'
                 src='angosearch/admin/midia/foto_desaparecido/".
                $dados['foto']."' alt='".$dados['nome_completo']."'/></a></td></tr>

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
                <td class='td'>Desaparecimento</td><td class='td' style='text-align:center;'>".
                $dados['data_desaparecimento']."</td></tr><br><tr>
                <td class='td'>Registro no Sistema</td><td class='td' style='text-align:center;'>".
                $dados['dataRegistro']."</td></tr><tr>
                <td class='td'>Registrado Por</td><td class='td' style='text-align:center;'>".
                $dados['postado_por']."</td></tr></tbody></table><br><br>
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


<div class="site-section bg-light   col-md-12" id="contact-section" style="color: #999;">
    <div class="container">
        <br><br>
        <div class="row justify-content">
            <div class="col-md-1">



            </div>
            <div class="col-md-8">
                <section class="content">
                    <h5><span	class="glyphicon	glyphicon-comment"></span> Comentários</h5>
                    <br>
                    <?php


                    $c=$con->query("SELECT id_comentario,comentario,fk_desaparecido,data_comentario,nome_completo,foto
            FROM comentario,utilizador WHERE  fk_desaparecido='$id' and id_utilizador=utilizador and estado_comment='1'
                                            ORDER  BY  id_comentario  DESC  LIMIT 5 ");


                    $l = mysqli_num_rows($c);

                    if ($l > 0) {


                        while ($dados1 = mysqli_fetch_assoc($c)) { ?>


                            <!-- row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- The time line -->
                                    <ul class="timeline"> <li>
                                            <i class="fa fa-comments bg-yellow"></i>
                                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> <?php echo
                                    date('D, d-m-Y H:i',strtotime($dados1['data_comentario'])); ?></span>
                                                <h3 class="timeline-header"><a href="#"><?php echo $dados1['nome_completo']; ?></a>
                                                    deixou o seguinte comentário: </h3>
                                                <div class="timeline-body">
                                                    <?php echo utf8_encode($dados1['comentario']); ?>
                                                </div>
                                            </div>
                                        </li></ul></div></div> <?php }} ?>
                </section>
                </div>

            </div>
        </div>
    </div>

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