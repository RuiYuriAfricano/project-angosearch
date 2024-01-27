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
    $nome = $_POST['valor_pesquisa'];
    if($nome==""){
        echo "
<META HTTP-EQUIV=REFRESH CONTENT = '0; URL =http://localhost/Projecto%20Final%20-%20Loide%20Laura/php/angosearch/esquadra/principal_esquadra.php'>
<script type=\"text/javascript\">

alert(\"Escreva alguma coisa para pesquisar\");
</script>";
    }
    else{
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Resultado da Pesquisa</title>
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
                        Resultado para: " <?php echo $nome; ?> "

                    </h1>

                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="row" id="resumo" style="">

                        <?php

                        $nd = $con->query("select * from documentos where estado!='2' and nome_doc LIKE  '$nome%' or codigo_doc = '$nome'");
                        $tnd = mysqli_num_rows($nd);

                        $np = $con->query("select * from desaparecidos where estado='1' and nome_completo like '$nome%' or idade='$nome'");
                        $tnp = mysqli_num_rows($np);

                        $desaparecidos=$con->query("SELECT id_desaparecido,nome_completo,idade,nome_pai,nome_mae,data_desaparecimento,foto,
dataRegistro,descricao,caracteristicas_especiais,telefone1,telefone2,postado_por,bairro,genero,provincia,postado_por FROM
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
                </span> Nenhum resultado, para pesquisa efectuada.</h3></center>
                        <?php } ?>



                        <?php if(($linhas >0) && ($linhas1>0)){?>
                            <center>
                                <?php
                                while ($dados = mysqli_fetch_assoc($desaparecidos)) {


                                    echo "<h3 align='center'>".$dados['nome_completo']."</b></h3>";
                                    echo "<table width='80%' style='width: 70%;background: #fff;' class='table table-bordered table-striped'>".
                                        "<thead>"."<tr>
                <th>Desaparecido(a)</th>
                <th>Detalhes</th>
            </tr>
            </thead><tbody>
            <tr>
                <td><img width = 'auto' height='150' style='border-radius:100%;'
                 src='../admin/midia/foto_desaparecido/".
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
                                    echo "<table  style='width: 70%;background: #fff;'  class='table table-bordered table-striped'>".
                                        "<thead>"."<tr>
                    <th>Desaparecido</th>
                    <th>Detalhes</th>
                </tr>
                </thead><tbody>
                <tr>
                <td>Imagem</td><td><img width = '250' height='150' style='border-radius:26px;float:right;'
                 src='../admin/midia/documentos/".
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


                                    echo "<h3 align='center'><".$dados['nome_completo']."</b></h3>";
                                    echo "<table width='80%' style='width: 70%;background: #fff;'  class='table table-bordered table-striped'>".
                                        "<thead>"."<tr>
                <th>Desaparecido(a)</th>
                <th>Detalhes</th>
            </tr>
            </thead><tbody>
           <tr>
                <td><img width = 'auto' height='150' style='border-radius:100%;'
                 src='../admin/midia/foto_desaparecido/".
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
                                    echo "<table   style='width: 70%;background: #fff;'  class='table table-bordered table-striped'>".
                                        "<thead>"."<tr>
                    <th>Desaparecido</th>
                    <th>Detalhes</th>
                </tr>
                </thead><tbody>
                <tr>
                <td>Imagem</td><td><img width = '250' height='150' style='border-radius:26px;float:right;'
                 src='../admin/midia/documentos/".
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

                        <tfoot><tr><td class='td'>Estado :</td><td>".$est."</td></tr></tfoot></table><br><br>
            ";

                                }?>
                            </center>
                        <?php }//end if ?>


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
        </body>
        </html>

    <?php }}else{
    header("Location:../../login-usuario.php");
} ?>