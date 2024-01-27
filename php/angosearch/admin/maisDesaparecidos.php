<?php
session_start();
if($_SESSION['nome_admin']) {


    ?>


    <?php
    include 'include/conexao.php';
    $con=conecta();


    ?><?php
    $nome = $_GET['nome'];
    $id=$_GET["id_desaparecido"];
    if($id==""){

        echo "
<META HTTP-EQUIV=REFRESH
 CONTENT = '0; URL =http://localhost/Projecto%20Final%20-%20Loide%20Laura/php/angosearch/admin/principal_admin.php'>
<script type=\"text/javascript\">

alert(\"nao encontrado\");
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

            <title><?php echo $nome;?></title>
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
                        <h2> <span	class="glyphicon	glyphicon-eye-open"></span>  Mais Sobre : <?php echo $nome; ?></h2>
                        <div class="page_link">
                            <a href=""> <span	class="glyphicon	glyphicon-home"></span> Inicio</a>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--================Causes Area =================-->
        <center>
        <?php
        if($_GET["id_desaparecido"]!=""){



            $desaparecidos=$con->query("SELECT id_desaparecido,nome_completo,nascimento,nome_pai,nome_mae,data_desaparecimento,foto,
telefone1,telefone2,dataRegistro,postado_por,descricao,caracteristicas_especiais,bairro,genero,provincia FROM
`desaparecidos`,bairro,genero,provincia WHERE estado = '1' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia and id_desaparecido='$id' ORDER  BY  id_desaparecido DESC LIMIT 1 ");


            $linhas = mysqli_num_rows($desaparecidos);

            if ($linhas > 0) {


                while ($dados = mysqli_fetch_assoc($desaparecidos)) {


                    echo "<br><a href='#'  style='position: absolute;left: 150px;'>
        <span class='glyphicon glyphicon-print'></span> Imprimir
    </a>";
                    echo "<table width='80%'  style='border: 0'>".
                        "<thead>"."<tr>
                <th>Desaparecido(a)</th>
                <th>Detalhes</th>
            </tr>
            </thead><tbody>
            <tr>
        <td ><img width = '250' height='200' style='border-radius:26px;'
                 src='midia/foto_desaparecido/".
                        $dados['foto']."' alt='".$dados['nome_completo']."'/></td></tr>

                <tr>
                <td class='td' >Nº do Processo</td><td class='td' style='text-align:center;'>".
                        $dados['id_desaparecido']."</td></tr><tr>
                <td class='td' >Nome Completo</td><td class='td' style='text-align:center;'>".
                        $dados['nome_completo']."</td></tr><tr>
                <td class='td'>Nascimento</td><td class='td' style='text-align:center;'>".
                        $dados['nascimento']."</td></tr><tr>
                <td class='td'>Pai</td><td class='td' style='text-align:center;'>".
                        $dados['nome_pai']."</td></tr><tr>
                <td class='td'>Mãe</td><td class='td' style='text-align:center;'>".
                        $dados['nome_mae']."</td></tr><tr>
                <td class='td'>Telefone</td><td class='td' style='text-align:center;'>".
                        $dados['telefone1']."</td></tr><tr>
                <td class='td'>Telefone Alternativo</td><td class='td' style='text-align:center;'>".
                        $dados['telefone2']."</td></tr>
                <tr>
                 <td class='td'>Descrição</td><td class='td' style='text-align:center;'>".
                        $dados['descricao']."</td>
</tr><tr>
                 <td class='td'>Caracteristicas Especiais</td><td class='td' style='text-align:center;'>".
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




        ?></center>

        <!--================End Causes Area =================-->


        <!--================Event Area =================-->
        <!--================End Event Area =================-->


        <!--================Clients Logo Area =================-->

        <!--================End Clients Logo Area =================-->

        <style>
             thead	{
                background-color: #999;
            }
             thead th	{
                font-weight:	bold;
                padding: 0.3em 1em;
                text-align:	center;
                color: #fff;
            }
               td, .td	{
                padding: 0.3em;
                color: #555;
                font-weight: bold;
                font-size: 15px;
                   border: 0px;
            }
            tr:nth-child(2n)	{
                background-color: #ccc;
            }
            td:first-child	{
                font-style: normal;
            }
        </style>
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