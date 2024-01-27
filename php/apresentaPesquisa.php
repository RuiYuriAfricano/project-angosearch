<?php include "include/conexao.php";?>
<?php
$nome = $_POST['valor_pesquisa'];
if($nome==""){

    echo "
<META HTTP-EQUIV=REFRESH CONTENT = '0; URL =http://localhost/Projecto%20Final%20-%20Loide%20Laura/php/index.php'>
<script type=\"text/javascript\">

alert(\"Escreva alguma coisa para pesquisar\");
</script>";
}
else{
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../midia/img/fav-iconAngo.jpg" type="image/jpg">
    <title>Resultados da Pesquisa</title>
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

    <link rel="stylesheet" href="angosearch/admin/css/glyphicon.css">
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

<h1 class="text-heading" align="center">Resultado para: " <?php echo $nome; ?> "</h1>
<!--================End Welcome Area =================-->
<?php

$nd = $con->query("select * from documentos where estado!='2' and nome_doc LIKE  '$nome%' or codigo_doc = '$nome'");
$tnd = mysqli_num_rows($nd);

$np = $con->query("select * from desaparecidos where estado='1' and nome_completo like '$nome%' or idade='$nome'");
$tnp = mysqli_num_rows($np);

$desaparecidos=$con->query("SELECT id_desaparecido,nome_completo,idade,nome_pai,nome_mae,data_desaparecimento,foto,
dataRegistro,descricao,caracteristicas_especiais,telefone1,telefone2,bairro,genero,provincia,postado_por FROM
desaparecidos,bairro,genero,provincia WHERE estado = '1' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia and nome_completo like '$nome%'or idade='$nome'  ORDER  BY  nome_completo asc limit $tnp  ")
or die("erro ao consultar ".mysql_error());

$doc=$con->query("SELECT * FROM documentos WHERE estado != '2' and nome_doc LIKE  '$nome%' or codigo_doc = '$nome'

 ORDER  BY  nome_doc asc limit $tnd ");

$linhas = mysqli_num_rows($desaparecidos);
$linhas1 = mysqli_num_rows($doc);
?>
<?php if(($linhas==0) && ($linhas1==0)){?>
    <br><center class="bg-white"><h3 class="text-warning"><span class="glyphicon glyphicon-alert   text-warning">
                </span> Valor digitado pelo utilizador , não foi encontrado.</h3></center>
<?php } ?>



    <?php if(($linhas >0) && ($linhas1>0)){?>
   <center>
       <?php
       while ($dados = mysqli_fetch_assoc($desaparecidos)) {


           echo "<h3 align='center'>".$dados['nome_completo']."</b></h3>";
           echo "<table width='80%' style='width: 70%' class='table table-bordered table-striped'>".
               "<thead>"."<tr>
                <th>Desaparecido(a)</th>
                <th>Detalhes</th>
            </tr>
            </thead><tbody>
            <tr>
                <td><img width = 'auto' height='150' style='border-radius:26px;'
                 src='angosearch/admin/midia/foto_desaparecido/".
               $dados['foto']."' alt='".$dados['nome_completo']."'/></td></tr>

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
       ?>

   </center>



        <center>


            <?php
            while ($dados = mysqli_fetch_assoc($doc)) {

                if($dados['estado']==1){
                    $est="<span class='text-primary'>Perdido</span>";
                }else if($dados['estado']==0){
                    $est="<span class='text-success'>Encontrado desde, ". date('d-m-Y',strtotime($dados['dataEncontrado']))."</span>";
                }
                elseif($dados['estado']==2){
                    $est="<span class='text-danger'>Excluído</span>";
                }
                echo "<hr><br><h3 align='center'>".$dados['nome_doc']."</b></h3>";
                echo "<table  style='width: 70%'  class='table table-bordered table-striped'>".
                    "<thead>"."<tr>
                    <th>Documento</th>
                    <th>Detalhes</th>
                </tr>
                </thead><tbody>
                <tr>
                    <td >Imagem</td><td><img width = '200' height='150' style='border-radius:26px;float:right;'
                                            src='angosearch/admin/midia/documentos/".
                    $dados['fotografia']."' alt='".$dados['fotografia']."'/></td></tr><tr>
                <td class='td'>Designação</td><td class='td'>".
                    $dados['nome_doc']."</td></tr>

                <tr>
                <td class='td'>Descrição</td><td class='td'>".
                    $dados['detalhe']."</td></tr><tr>
                <td class='td'>Código</td><td class='td'>".
                    $dados['codigo_doc']."</td></tr><tr>
                <td class='td'>Data de Registro</td><td class='td'>".
                    $dados['dataRegistro']."</td></tr><tr>
                <td class='td'>Registrado Por</td><td class='td'>".
                    $dados['postado_por']."</td></tr>

                        <tfoot><tr><td class='td'>Estado :</td><td>".$est."</td></tr></tfoot></tbody></table><br><br>
            ";

            }?>
        </center>




        <?php }?>

    <?php if(($linhas >0) ){?>
        <center>
            <?php
            while ($dados = mysqli_fetch_assoc($desaparecidos)) {


                echo "<h3 align='center'>".$dados['nome_completo']."</b></h3>";
                echo "<table width='80%' style='width: 70%'  class='table table-bordered table-striped'>".
                    "<thead>"."<tr>
                <th>Desaparecido(a)</th>
                <th>Detalhes</th>
            </tr>
            </thead><tbody>
            <tr>
                <td><img width = 'auto' height='150' style='border-radius:26px;'
                 src='angosearch/admin/midia/foto_desaparecido/".
                    $dados['foto']."' alt='".$dados['nome_completo']."'/></td></tr>

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
            ?>

        </center>


    <?php }//end if ?>

<?php if(($linhas1 >0) ){?>
<center>


    <?php
            while ($dados = mysqli_fetch_assoc($doc)) {
                if($dados['estado']==1){
                    $est="<span class='text-primary'>Perdido</span>";
                }else if($dados['estado']==0){
                    $est="<span class='text-success'>Encontrado desde, ". date('d-m-Y',strtotime($dados['dataEncontrado']))."</span>";
                }
                elseif($dados['estado']==2){
                    $est="<span class='text-danger'>Excluído</span>";
                }

            echo "<hr><br><h3 align='center'>".$dados['nome_doc']."</b></h3>";
            echo "<table   style='width: 70%'  class='table table-bordered table-striped'>".
                "<thead>"."<tr>
                    <th>Documento</th>
                    <th>Detalhes</th>
                </tr>
                </thead><tbody>
                <tr>
                    <td >Imagem</td><td><img width = '200' height='150' style='border-radius:26px;float:right;'
                                            src='angosearch/admin/midia/documentos/".
                    $dados['fotografia']."' alt='".$dados['fotografia']."'/></td></tr><tr>
                <td class='td'>Designação</td><td class='td'>".
                $dados['nome_doc']."</td></tr>

                <tr>
                <td class='td'>Descrição</td><td class='td'>".
                $dados['detalhe']."</td></tr><tr>
                <td class='td'>Código</td><td class='td'>".
                $dados['codigo_doc']."</td></tr><tr>
                <td class='td'>Data de Registro</td><td class='td'>".
                $dados['dataRegistro']."</td></tr><tr>
                <td class='td'>Registrado Por</td><td class='td'>".
                $dados['postado_por']."</td></tr>

                        <tfoot><tr><td class='td'>Estado :</td><td>".$est."</td></tr></tfoot></tbody></table><br><br>
            ";

            }?>
     </center>
<?php }//end if ?>
        <!--================Feature Area =================-->

<!--===============End Feature Area =================-->

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

<?php } ?>