<?php
session_start();
/*if($_SESSION['nome_admin']) {*/


?>


<?php
include 'include/conexao.php'; ?>
<?php
if(isset($_POST['excluir'])) {


    $con = conecta();




    $id_doc = $_POST['id_doc'];


        $del = $con->query("update documentos set estado='1' where id_doc='$id_doc'
 and estado='0'")
        or die("Erro Ao Eliminar");

        header("Location:doc_encontrados.php?msg=excluir");




}
?>

<!doctype html>
<html lang="pt-pt">
<head>
    <!-- Required meta tags -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="icon" href="../../../midia/img/fav-iconAngo.jpg" type="image/jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Documentos Encontrados</title>
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
    <link rel="stylesheet" href="../adminlte-master/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!--<link rel="stylesheet" href="bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <!--<link rel="stylesheet" href="bootstrap-daterangepicker/daterangepicker.css">
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/responsive.css">

    <style>
        #ativo4{
            color: #005cbf;
        }
    </style>
</head>
<body>

<!--================Header Menu Are
a =================-->
<header class="header_area">
    <?php include"include/cabecalho.php"; ?>
</header>
<!--================Header Menu Area =================-->

<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container"><br><br><br><br><br><bR>
            <div class="banner_content text-center">
                <h2></h2>
                <div class="page_link">
                    <h3 style="color: goldenrod;">
                            <span class="glyphicon	glyphicon-eye-open"></span> Documentos Encontrados</h3>

                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->
<br>
<!--================Welcome Area =================-->
<div style="">
    <?Php
    if(isset($_REQUEST["msg"])) {
        if ($_REQUEST["msg"] == "excluir") {

            ?>
            <span class='notification n-success'>Removido dos Encontrados.......!!</span>
        <?php }


        if($_REQUEST["msg"]=="cancelado"){
            ?>
            <span class='notification n-success'>Cancelado.......!!</span>
        <?php }}?>
</div>
<!--================End Welcome Area =================-->
<style>
    .vd td {
        color: #444;
    }
    .vh th{
        color: #444;font-weight: bold;
    }
</style>
<center>
    <div class="table-responsive" style="  width: 100%;
        margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px; padding-left: 20px;padding-right: 20px;">

        <?php

        $con=conecta();

        $docs = $con->query("select * from documentos where estado='0'");
        $totalDocs = mysqli_num_rows($docs);

        $sql=$con->query("SELECT * FROM documentos
WHERE estado = '0'  ORDER  BY  dataExcluido DESC");


        ?>
        <h5 align="left" style="color: #999;"><?php if($totalDocs > 1){
                echo $totalDocs." Documentos Encontrados";}
            else if($totalDocs == 0){
                echo "Nenhum Documento Encontrado";
            }
            if($totalDocs == 1){
                echo $totalDocs." Documento Encontrado";}
            ?></h5>

        <table   style="text-align: center;" id="example1"  width="100%" class="table table-bordered table-striped" >
            <thead style="color: #fff;" class="vh"> <tr>
                <th width="192" align="center">Imagem do Documento</th>
                <th  align="center"id="bt4" width="15" height="">processo Nº</th>

                <th width="192" align="center">Nome do Documento</th>

                <th width="192" align="center">Detalhe</th>
                <th width="192" align="center">Postado Por</th>
                <th width="192" align="center">Registro no Sistema</th>


                <th width="192" align="center">Remoção</th>
                <th width="192" align="center">removido Por</th>
                <th width="192" align="center"></th>


                <th width="192" align="center"><a href="visualizar_documentos.php">
                        <button class="btn btn-primary" style="font-size: 12px"> Voltar </button>
                    </a></th>




            </tr></thead>
            <?php while($dados=mysqli_fetch_array($sql)){ $ft=$dados['fotografia'];?>
                <tr class="vd">
                    <td width="192" align=""><input type="hidden" value="<?php echo ($dados['id_doc']);?>" name="id_doc">
                        <img src="../admin/midia/documentos/<?php echo $ft; ?>" alt="<?php echo $ft; ?>"
                             width = '150px' height='100px' style='border-radius:3px;'></td>
                    <td width="15" align=""><?php echo $dados['id_doc'];?></td>


                    <td width="192" align=""><?php echo $dados['nome_doc'] ?></td>
                    <td width="192" align=""><?php echo $dados['detalhe'];?></td>
                    <td width="192" align=""><?php echo $dados['postado_por'];?></td>
                    <td width="192" align=""><?php echo $dados['dataRegistro'];?></td>
                    <td width="192" align=""><?php echo $dados['dataExcluido'];?></td>
                    <td width="192" align=""><?php echo $dados['removido_por'];?></td>
                    <td width="10" align="center"> <a href="mais_documento.php?id_doc=<?php echo ($dados['id_doc']);?>&&
                         nome=<?php echo ($dados['nome_doc']);?>"
                                                      style="" class="text-white">
                            <button class="btn btn-warning" style="font-size: 12px; color: white"><span	class="glyphicon	glyphicon-eye-open"></span>
                                Visualizar </button></a></td>
                    <form method="post" action="">
                        <input type="hidden" class="form-control" id="dat" name="dt">
                        <input type="hidden" value="<?php echo ($dados['id_doc']);?>" name="id_doc">

                        <td width="92"><a  href="doc_encontrados.php?id_doc=<?php echo ($dados['id_doc']);?> ">
                                <button class="btn btn-danger" style="font-size: 12px;" type="submit" name="excluir">
                                    <span	class="glyphicon	glyphicon-remove"></span>
                                    Remover dos Encontrados </button></a></td>
                    </form>


                </tr>


            <?php }//end if ?></table>
    </div></center>

<!--================Causes Area =================-->

<!--================End Causes Area =================-->


<!--================Event Area =================-->
<!--================End Event Area =================-->


<!--================Clients Logo Area =================-->

<!--================End Clients Logo Area =================-->


<!--================ start footer Area  =================-->
<footer class="footer-area section_gap">
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

<script src="../adminlte-master/plugins/jquery/dist/jquery.min.js"></script>
<script src="../adminlte-master/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../adminlte-master/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
</script>
</body>
</html>

<?php/*
}
else{
    header("Location:../../login-usuario.php");
}*/
?>