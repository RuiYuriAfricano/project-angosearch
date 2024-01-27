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

    ?>
    <?php

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

    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Páginas |  Angosearch</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
                    Páginas do Portal
                    <small>Painel de Controle</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-gears"></i> Definições</a></li>
                    <li class="active">Editar Página</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Small boxes (Stat box) -->
                <div class="row" id="resumo">
                    <div style="">
                        <?Php
                        if(isset($_REQUEST["msg"])) {
                            if($_REQUEST["msg"]=="add")
                            {

                                ?>
                                <span class='notification n-success'>Alterações Efectuada com Sucesso.......!!</span>
                            <?php }

                            if($_REQUEST["msg"]=="erro")
                            {

                                ?>
                                <span class="notification n-error">Erro: Preencha os Campos.</span>
                            <?php }}?></div>
                    <center>
                        <div class="col-lg-12    table-responsive" style="border:  width: 100%;
background:#fff;">

                            <?php

                            $con=conecta();

                            $sql=$con->query("select * from pagina where  estado='1'");

                            ?>
                            <h5 align="left" style="color: #999;"><?php echo $visualizacao; ?> Visualizações</h5>
                            <table style="text-align: center;"  width="100%" class="table table-bordered table-hover">
                                <tr class="bg-primary" style="color: ">
                                    <th style="width:4%">#</th>
                                    <th style="width:20%">Página</th>
                                    <th style="width:10%">Titulo</th>
                                    <th style="width:30%">Meta Tags</th>
                                    <th style="width:30%">Meta Description</th>
                                    <th style="width:30%">Visualização</th>
                                    <th style="width:6%">&nbsp; </th>
                                </tr>
                                <?php while($dados=mysqli_fetch_array($sql)){ ?>
                                    <tr class="vd">
                                        <td class="align-center"><?php echo $dados['id_pagina'];?></td>
                                        <td><?php echo $dados['titulo'];?></td>
                                        <td><?php echo $dados['titulo'];?></td>
                                        <td> <?php echo $dados['tag_meta'];?></td>
                                        <td> <?php echo $dados['descricao_meta'];?></td>
                                        <td> <?php echo $dados['visualizacao'];?></td>
                                        <td> <a href="editar_pagina.php?id_pagina=<?php echo ($dados['id_pagina']);?> "
                                                style="">
                                                <button class="btn btn-primary" style="font-size: 12px;"><span	class="glyphicon   glyphicon-edit"></span>
                                                    Editar </button></a></td>


                                    </tr>


                                <?php }//end if ?></table>
                        </div></center>
                 </div>
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
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
    </body>
    </html>

<?php }else{
    header("Location:../../login-usuario.php");
} ?>