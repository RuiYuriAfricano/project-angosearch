<?php

session_start();
if($_SESSION['nome_admin']) {
    ?>

    <?php
    include '../admin/include/conexao.php';
    $con= conecta();

    $sql =$con ->query("select * from definicoes where id_definicoes='1' ") or die(mysql_error());

    $linhas = mysqli_num_rows($sql);
    $dados = mysqli_fetch_assoc($sql);

    /* rodape base de dados*/
    $sq =$con ->query("select * from rodape where id_rodape='1' ") or die(mysql_error());

    $linha = mysqli_num_rows($sq);
    $dado = mysqli_fetch_assoc($sq);


    $id_pagina=$_GET['id_pagina'];
    if(isset($_POST['editar'])) {
        $titulo = $_POST['titulo'];
        $conteudo = $_POST['conteudo'];
        $tag_meta = $_POST['tag_meta'];
        $descricao_meta = $_POST['descricao_meta'];
        $texto=$_POST['texto'];
        $texto_add=$_POST['texto_add'];

        if ($conteudo == "" and $titulo == "" and $texto=="" and $texto_add=="") {
            header('Location:pagina.php?msg=erro');
        } else {



            $atualiza = $con->query("update  pagina  set titulo='$titulo' , conteudo='$conteudo',  texto_inicial='$texto',
 texto_adicional='$texto_add', tag_meta='$tag_meta' , descricao_meta='$descricao_meta' where  id_pagina='$id_pagina'")
            or die(mysql_error()."erro ao atualizar");


            header('Location:pagina.php?msg=add');

        }
    }
    ?>
    <?php
    $id_pagina=$_GET['id_pagina'];

    $con=conecta();

    $sql=$con->query("select * from pagina where id_pagina='$id_pagina' and estado='1'");
    $d=mysqli_fetch_assoc($sql);
    $pega_titulo= $d['titulo'];

    if($id_pagina!='1' && $id_pagina >='4'){
        echo '<style>
                    .apresentaTP, .apresentaTA{
                            display: none;
                    }
                    .tn:before{
                            content: "Conteúdo :";
                    }
                    .ta{
                            display: none;
                    }

                </style>';
    }
    if($id_pagina=='2'){
        echo '<style>
                    .apresentaTP{
                            display: none;
                    }
                    .tn:before{
                            content: "Conteúdo :";
                    }
                    .ta{
                            display: none;
                    }

                </style>';
    }

    if($id_pagina=='3'){

        echo '<style>
                    .apresentaTP, .apresentaTA{
                            display: none;
                    }
                    .tn:before{
                            content: "Galeria :";
                    }
                    .ta{
                            display: none;
                    }

                </style>';

    }

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Editar <?php echo $pega_titulo; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <script type="text/javascript" src="../admin/js/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="../admin/js/ckfinder/ckfinder.js"></script>
        <?php include "include/links.php"; ?>
    </head>
    <body class="skin-blue" onload="setInterval('apresentaData()',1000);">
    <div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <?php include "include/cabecalhoTopo.php"; ?>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <?php include "include/cabecalho.php"; ?>
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Administrador
                <small>Painel de Controlo</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Principal</a></li>
                <li class="active">AngoSearch</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->

            <div class="row" id="resumo">
                <br>



                <!-- left column -->

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Editar : <?php echo $pega_titulo; ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <center>
                        <div class="col-lg-9    table-responsive" style=" width: 100%;
background:#fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px;">

                            <?php


                            $sql1=$con->query("select * from pagina where id_pagina='$id_pagina' and estado='1'");


                            ?>
                            <form class="row contact_form" action="" method="post" id="contactForm" novalidate="novalidate" onsubmit="ap();">
                                <table border="0" cellspacing="10px" cellpadding="2px"style="width: 100%;">

                                    <?php while($dados=mysqli_fetch_array($sql1)){ ?>
                                        <tr>
                                            <td  align="right" style="width: auto;">Nome da Pagina : </td>
                                            <td  align="left">
                                                <input type="hidden" value="<?php echo $dados['id_pagina'];?>" name="pid" id="pid">
                                                <input type="text" name="title" id="title" value="<?php echo $dados['titulo'];?>"
                                                       class="form-control" readonly="readonly"/></td>
                                        </tr>

                                        <tr>
                                            <td  align="right" style="width: auto;">Titulo : </td>
                                            <td  align="left">

                                                <input type="text" name="titulo" id="page_title"
                                                       value="<?php echo $dados['titulo'];?>"  class="form-control"/></td>
                                        </tr>

                                        <tr>
                                            <td  align="right">Meta Keywords: </td>
                                            <td  align="left">
                                                <input type="text" name="tag_meta" id="met_tags"
                                                       value="<?php echo $dados['tag_meta'];?>"  class="form-control" /></td>
                                        </tr>


                                        <tr>
                                            <td  align="right">Meta Description : </td>
                                            <td  align="left">
                                                <input type="text" name="descricao_meta" id="meta_description"
                                                       value="<?php echo $dados['descricao_meta'];?>"  class="form-control" /></td>
                                        </tr>

                                        <tr class="apresentaTP">
                                            <td  align="right" style="vertical-align:top;">Texto Principal: </td>

                                            <td align="left" style="width: 100%;"><textarea name="texto" rows="3"    id="tPrincipal"
                                                                                            class="form-control" >
                                                    <?php echo $dados['texto_inicial'];?></textarea>
                                                <script type="text/javascript">
                                                    var editor = CKEDITOR.replace( 'tPrincipal', {
                                                        filebrowserBrowseUrl : 'js/ckfinder/ckfinder.html',
                                                        filebrowserImageBrowseUrl : 'js/ckfinder/ckfinder.html?type=Images',
                                                        filebrowserFlashBrowseUrl : 'js/ckfinder/ckfinder.html?type=Flash',
                                                        filebrowserUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                                        filebrowserImageUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                                        filebrowserFlashUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                                                    });
                                                    CKFinder.setupCKEditor( editor,'js/' );
                                                </script>
                                            </td>
                                        </tr>
                                        <br><br> <tr>
                                            <td  align="right" style="vertical-align:top;" class="tn" ><span class="ta" >Bem-Vindo:</span> </td>

                                            <td align="left" style="width: 100%;"><textarea name="conteudo" rows="3"    id="description"
                                                                                            class="form-control">
                                                    <?php echo utf8_encode($dados['conteudo']);?></textarea>
                                                <script type="text/javascript">
                                                    var editor = CKEDITOR.replace( 'description', {
                                                        filebrowserBrowseUrl : 'js/ckfinder/ckfinder.html',
                                                        filebrowserImageBrowseUrl : 'js/ckfinder/ckfinder.html?type=Images',
                                                        filebrowserFlashBrowseUrl : 'js/ckfinder/ckfinder.html?type=Flash',
                                                        filebrowserUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                                        filebrowserImageUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                                        filebrowserFlashUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                                                    });
                                                    CKFinder.setupCKEditor( editor,'js/' );
                                                </script>
                                            </td>
                                        </tr>
                                        <tr class="apresentaTA">
                                            <td  align="right" style="vertical-align:top;">Texto Adicional: </td>

                                            <td align="left" style="width: 100%;"><textarea name="texto_add" rows="3"    id="texto_add"
                                                                                            class="form-control">
                                                    <?php echo $dados['texto_adicional'];?></textarea>
                                                <script type="text/javascript">
                                                    var editor = CKEDITOR.replace( 'texto_add', {
                                                        filebrowserBrowseUrl : 'js/ckfinder/ckfinder.html',
                                                        filebrowserImageBrowseUrl : 'js/ckfinder/ckfinder.html?type=Images',
                                                        filebrowserFlashBrowseUrl : 'js/ckfinder/ckfinder.html?type=Flash',
                                                        filebrowserUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                                        filebrowserImageUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                                        filebrowserFlashUploadUrl : 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                                                    });
                                                    CKFinder.setupCKEditor( editor,'js/' );
                                                </script>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td align="left"><br>
                                                <button class="btn btn-primary" style="" type="submit" name="editar">
                                                    <span	class="glyphicon	glyphicon-edit"> </span> Efectuar Alterações
                                                </button>

                                                <input type="button" class="btn btn-danger" style="" value="Cancelar"
                                                       onclick="javascript:window.location='editar_pagina.php';" >
                                            </td> </tr>


                                    <?php }//end if ?></table></form>
                        </div></center>
                </div>
        </section></div><!-- /.content -->
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <?php include "include/rodape.php"; ?>
        </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Morris.js charts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>

    <script src="../admin/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../admin/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    </body>
    </html>

<?php }else{
    header("Location:../../login-usuario.php");
}?>