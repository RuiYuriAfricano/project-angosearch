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









$con = conecta();
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

$esquadras = $con->query("select * from esquadra where estado='1'");
$totalEsquadra = mysqli_num_rows($esquadras);

$desaparecidos = $con->query("select * from desaparecidos where estado='1'");
$totalDesaparecidos = mysqli_num_rows($desaparecidos);

$docs = $con->query("select * from documentos where estado='1'");
$totalDocs = mysqli_num_rows($docs);
    $ut = $con->query("select * from utilizador where estado='1'");
    $totalUt = mysqli_num_rows($ut);

$total = $totalDesaparecidos + $totalDocs;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin | Angosearch</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      <?php include "include/links.php"; ?>
  </head>
  <body class="skin-blue">
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
              <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-blue" style="background: #002a80;">
                      <div class="inner">
                          <h3><?php echo $totalEsquadra; ?></h3>

                          <p><br>Esquadras Registradas</p>
                      </div>
                      <div class="icon">
                          <i class="ion  ion-android-list"> </i>
                      </div>
                      <a href="view_esquadra.php" class="small-box-footer">Mais info <i
                              class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                      <div class="inner">
                          <h3><?php echo $total; ?></h3>

                          <p>Desaparecidos: Pessoas e Documentos</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-android-search"></i>
                      </div>
                      <a href="view_desaparecidos.php" class="small-box-footer">Mais info <i
                              class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-yellow">
                      <div class="inner">
                          <h3><?php echo $totalUt; ?></h3>

                          <p><br>Utilizadores Registrados</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-person-add"></i>
                      </div>
                      <a href="view_utilizador.php" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-red">
                      <div class="inner">
                          <h3><?php echo $visualizacao; ?></h3>

                          <p><br>Visualizações</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-eye"></i>
                      </div>
                      <a href="pagina.php" class="small-box-footer">Mais info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
          <!-- Main content -->
          <section class="content">
              <div class="row">
                  <div class="col-md-6">
                      <!-- AREA CHART -->
                      <div class="box box-info">
                          <div class="box-header">
                              <h3 class="box-title">Visualizações Por Hora</h3>
                          </div>
                          <div class="box-body">
                              <canvas id="lineChart" height="250"></canvas>

                          </div><!-- /.box-body -->
                      </div>
                      <!-- /.box -->

                      <!-- DONUT CHART -->
                      <div class="box box-danger">
                          <div class="box-header">
                              <h3 class="box-title">Visulizações Por Plataforma</h3>
                          </div><center>
                          <div class="box-body">

                              <div class="chart-responsive">
                                  <canvas id="pieChart" height="250"></canvas>
                              </div>

                          </div></center><!-- /.box-body -->
                      </div>

                      <div class="box box-danger">

                          <div class="box-header">
                              <h3 class="box-title">Visulizações Por Navegador</h3>
                          </div><center>
                          <div class="box-body">
                          <div class="chart-responsive">
                              <canvas id="doughnutChart" height="250"></canvas>
                          </div>
                              </div></center>
                      </div>

                      <!-- quick email widget -->
                      <div class="box box-info">
                          <div class="box-header">
                              <i class="fa fa-envelope"></i>
                              <h3 class="box-title">Enviar Email</h3>
                              <!-- tools box -->
                              <div class="pull-right box-tools">
                                  <button class="btn btn-info btn-sm" data-widget="remove"
                                          data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                              </div><!-- /. tools -->
                          </div>
                          <div class="box-body">
                              <form action="#" method="post">
                                  <div class="form-group">
                                      <input type="email" class="form-control" name="emailto" placeholder="Email para:"/>
                                  </div>
                                  <div class="form-group">
                                      <input type="text" class="form-control" name="subject" placeholder="Assunto"/>
                                  </div>
                                  <div>
                                      <textarea class="textarea" placeholder="Mensagem" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                  </div>
                              </form>
                          </div>
                          <div class="box-footer clearfix">
                              <button class="pull-right btn btn-default" id="sendEmail">Enviar <i class="fa fa-arrow-circle-right"></i></button>
                          </div>
                      </div>


                      <!-- /.box -->

                  </div><!-- /.col (LEFT) -->
                  <div class="col-md-6">
                      <!-- BAR CHART -->
                      <div class="box box-success">
                          <div class="box-header">
                              <h3 class="box-title">Visualizações na Semana</h3>
                          </div>
                          <div class="box-body">
                              <canvas id="barChart" height="230"></canvas>
                          </div><!-- /.box-body -->
                      </div><!-- /.box -->
                      <!-- LINE CHART -->
                      <div class="box box-success">
                          <div class="box-header">
                              <h3 class="box-title">Visulizações no Mês</h3>
                          </div>
                          <div class="box-body">
                              <canvas id="barChartMensal" height="230"></canvas>
                          </div><!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                      <div class="box box-success">
                      <div class="col-md-12">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="box-header">
                                  <div class="row">
                                      <div class="col-md-8">
                                          <h3>Páginas mais visitadas</h3>
                                          </div>
                                      <div class="col-md-4">
                                          <select class="form-control  col-md-6" id="pages-select">
                                             <option value="-24 hours">Última 24 horas</option>
                                              <option value="-7 days">Últimos 7 dias</option>
                                              <option value="-15 days">Últimos 15 dias</option>
                                              <option value="-30 days">Últimos 30 dias</option>
                                          </select>
                                          </div>
                                      </div></div>
                                  <div class="box-body">
                                  <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Página</th>
                                        <th>Visualiazação</th>
                                    </tr>
                                    </thead>
                                      <tbody id="pages">

                                      </tbody>
                                  </table></div>
                                  </div></div>

                      </div></div>






                  </div><!-- /.col (RIGHT) -->
              </div><!-- /.row -->

          </section>
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">







            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
          <?php include "include/rodape.php"; ?>
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->

    <!-- Morris.js charts -->

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
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="plugins/chart.js/Chart.js" type="text/javascript"></script>

    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
    <script src="dist/js/relatorio.js" type="text/javascript"></script>
    <script src="dist/js/tabelas.init.js" type="text/javascript"></script>

  </body>
</html>

<?php }else{
    header("Location:../../login-usuario.php");
} ?>