<?php

$con= conecta();

$sql =$con ->query("select * from definicoes where id_definicoes='1' ") or die(mysql_error());

$linhas = mysqli_num_rows($sql);
$dados = mysqli_fetch_assoc($sql);

/* rodape base de dados*/
$sq =$con ->query("select * from rodape where id_rodape='1' ") or die(mysql_error());

$linha = mysqli_num_rows($sq);
$dado = mysqli_fetch_assoc($sq);
$nome_utilizador=$_SESSION['utilizador'];
$select_utilizador=$con->query("select foto,nome_completo,dataRegistro from utilizador WHERE  nome_completo='$nome_utilizador'");

$pega=mysqli_fetch_array($select_utilizador);
?>
<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="index.php" class="navbar-brand"><b><img style="width: 140px;height: 49px;margin-top: -13px"
                                                                 src="../../../midia/logotipo/<?php echo $dados['logo'];?>" alt="ANGOSEARCH"></b></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Inicio <span class="sr-only">(current)</span></a></li>
                    <li><a href="index.php">Chat</a></li>
                    <li><a href="registrar_desaparecido.php">Fazer Comunicado</a></li>
                    <li><a href="comunicados.php">Comunicados</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pessoas <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="pessoas_desap.php">Desaparecidas</a></li>
                            <li><a href="pessoas_encont.php">Encontradas</a></li>

                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Documentos <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="docs_perdidos.php">Perdidos</a></li>
                            <li><a href="docs_encont.php">Encontrados</a></li>

                        </ul>
                    </li>
                    <li><a href="galeria.php">Galeria</a></li>
                </ul>
                <form class="navbar-form navbar-left" role="search" action="apresenta_pesquisa.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="valor_pesquisa" id="navbar-search-input" placeholder="Pesquisar">
                    </div>
                </form>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Você tem 4 mensagens</li>

                                <li class="footer"><a href="#">Ver Todas Mensagens</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Você tem 10 notificações</li>

                                <li class="footer"><a href="#">Ver Todas</a></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="../admin/midia/img/<?php echo $pega['foto']; ?>" class="user-image" alt="User Image"/>
                                <span class="hidden-xs"><?php echo $_SESSION['utilizador']; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="../admin/midia/img/<?php echo $pega['foto']; ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $_SESSION['utilizador']; ?> - Utilizador
                                        <small>desde <?php echo date('d-m-Y', strtotime($pega['dataRegistro'])); ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#"></a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <!--  <a href="#">Encon-<br>trados</a>-->
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#"></a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="perfil.php" class="btn btn-default btn-flat"><i class="fa fa-edit"></i> Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="../../logout.php" class="btn btn-default btn-flat"><i class="fa fa-power-off"></i> Terminar Sessão</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->

    </nav>
</header><style>
    .n-success {
        background-color: #a3e6bd;
        color: #555;
        border-color: #68d59b;
        background-image: url(../admin/midia/img/notification-tick.gif);
    }
    .notification {
        display: block;
        padding: 20px 20px 20px 45px;
        border: 0px solid;
        border-top-color: currentcolor;
        border-right-color: currentcolor;
        border-bottom-color: currentcolor;
        border-left-color: currentcolor;
        margin-bottom: 20px;
        background-repeat: no-repeat;
        background-position: 20px 20px;
        font-size: 15px;
        font-weight: bold;
        margin-left: 15px;
        margin-right: 15px;
    }
    .n-error {
        background-color: #ffc6ca;
        border-color: #efb9c3;
        color: #555;
        background-image: url(../admin/midia/img/notification-slash.gif);
    }
</style>