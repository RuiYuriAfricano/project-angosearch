<link rel="stylesheet" href="../../../css/fonts.css">
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
$select_utilizador=$con->query("select foto,nome_completo from utilizador WHERE  nome_completo='$nome_utilizador'");

$pega=mysqli_fetch_array($select_utilizador);
?>
<!-- Header Navbar: style can be found in header.less -->
<header class="main-header">
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
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
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            <li><!-- start message -->
                                <a href="#">
                                    <div class="pull-left">
                                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                                    </div>
                                    <h4>
                                        Support Team
                                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                    </h4>
                                    <p>Why not buy a new awesome theme?</p>
                                </a>
                            </li><!-- end message -->
                            <li>
                                <a href="#">
                                    <div class="pull-left">
                                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="user image"/>
                                    </div>
                                    <h4>
                                        AdminLTE Design Team
                                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                    </h4>
                                    <p>Why not buy a new awesome theme?</p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="pull-left">
                                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="user image"/>
                                    </div>
                                    <h4>
                                        Developers
                                        <small><i class="fa fa-clock-o"></i> Today</small>
                                    </h4>
                                    <p>Why not buy a new awesome theme?</p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="pull-left">
                                        <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="user image"/>
                                    </div>
                                    <h4>
                                        Sales Department
                                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                    </h4>
                                    <p>Why not buy a new awesome theme?</p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="pull-left">
                                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="user image"/>
                                    </div>
                                    <h4>
                                        Reviewers
                                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                                    </h4>
                                    <p>Why not buy a new awesome theme?</p>
                                </a>
                            </li>
                        </ul>
                    </li>
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
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            <li>
                                <a href="#">
                                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-users text-red"></i> 5 new members joined
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-user text-red"></i> You changed your username
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="footer"><a href="#">Ver Todas</a></li>
                </ul>
            </li>
            <!-- Tasks: style can be found in dropdown.less -->

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="../admin/midia/img/igor.jpg" class="user-image" alt="User Image"/>
                    <span class="hidden-xs"><?php echo $_SESSION['utilizador']; ?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="../admin/midia/img/igor.jpg" class="img-circle" alt="User Image" />
                        <p>
                            <?php echo $_SESSION['utilizador']; ?> - Administrador
                            <small>Membro desde Nov. 2012</small>
                        </p>
                    </li>
                    <!-- Menu Body -->
                    <li class="user-body">
                        <div class="col-xs-4 text-center">
                            <a href="#">Usuários</a>
                        </div>
                        <div class="col-xs-4 text-center">
                            <!--  <a href="#">Encon-<br>trados</a>-->
                        </div>
                        <div class="col-xs-4 text-center">
                            <a href="#">Esquadras</a>
                        </div>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="#" class="btn btn-default btn-flat"><i class="fa fa-edit"></i> Perfil</a>
                        </div>
                        <div class="pull-right">
                            <a href="../../logout.php" class="btn btn-default btn-flat"><i class="fa fa-power-off"></i> Terminar Sessão</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav></header><div class="main_menu">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand logo_h" href="index.php"><img src="../../../midia/logotipo/<?php echo $dados['logo'];?>" alt="ANGOSEARCH"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                <ul class="nav navbar-nav menu_nav ml-auto">
                    <li class="nav-item" ><a class="nav-link" id="ativo1" href="index.php">Página Inicial</a></li>

                    <li class="nav-item" ><a class="nav-link" id="ativo2" href="sobre.php">Registro <br></a></li>
                    <li class="nav-item dropdown" ><a class="nav-link dropdown-toggle" data-toggle="dropdown"
                                                       role="button" aria-haspopup="true" aria-expanded="false"
                                                       href="#" id="ativo3    dropdown04">Desaparecidos</a>

                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="todosDesaparecidos.php" id="pessoas">Pessoas</a>
                            <a class="dropdown-item" href="todosDocDesaparecidos.php">Documentações</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown" ><a class="nav-link dropdown-toggle" data-toggle="dropdown"
                                                             role="button" aria-haspopup="true" aria-expanded="false"
                                                             href="#" id="ativo4    dropdown04"><span class="fa fa-angle-bottom pull-top"></span>Encontrados</a>

                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="pessoas_encontradas.php" id="pessoas">Pessoas</a>
                            <a class="dropdown-item" href="todosDocEncontrados.php">Documentações</a>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" id="ativo5" href="galeria.php">Galeria</a></li>

                    <li class="nav-item"><a class="nav-link" id="ativo6" href="contacto.php">Contacte-Nos</a></li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item"><a href="#" class="search" data-toggle="modal" data-target="#modalAppointment"><i class="lnr lnr-magnifier"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>
</div></header>


<style>


    header .navbar .dropdown-menu .dropdown-item:hover {
        background: #005fcb;
        color: #fff;
    }

    header .navbar .dropdown-menu .dropdown-item.active {
        background: #005fcb;
        color: #fff;
    }

    header .navbar .dropdown-menu a {
        padding-top: 7px;
        padding-bottom: 7px;
    }
    header .navbar .dropdown.show > a {
        color: #fff;
    }

    header .navbar .dropdown-menu {
        font-size: 14px;
        border-radius: 0px;
        border: none;
        -webkit-box-shadow: 0 2px 30px 0px rgba(0, 0, 0, 0.2);
        box-shadow: 0 2px 30px 0px rgba(0, 0, 0, 0.2);
        min-width: 13em;
        margin-top: -10px;
    }

    header .navbar .dropdown-menu:before {
        bottom: 100%;
        left: 10%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-bottom-color: #fff;
        border-width: 10px;
    }

    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
        z-index: 2;
        color: #fff;
        cursor: default;
        background-color: #337ab7;
        border-color: #337ab7;
    }
    .pagination>li>a {
        background: #fafafa;
        color: #666;
    }
    .pagination>li>a, .pagination>li>span {
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #337ab7;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
    }
    .pagination>li:first-child>a, .pagination>li:first-child>span {
        margin-left: 0;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }
    .pagination>.disabled>a, .pagination>.disabled>a:focus, .pagination>.disabled>a:hover, .pagination>.disabled>span, .pagination>.disabled>span:focus, .pagination>.disabled>span:hover {
        color: #777;
        cursor: not-allowed;
        background-color: #fff;
        border-color: #ddd;
    }
    .pagination>li>a {
        background: #fafafa;
        color: #666;
    }
    .pagination>li>a, .pagination>li>span {
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #337ab7;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
    }
    a {
        color: #3c8dbc;
    }
    a {
        color: #337ab7;
        text-decoration: none;
    }
    iv.dataTables_wrapper div.dataTables_filter input {
        margin-left: 0.5em;
        display: inline-block;
        width: auto;
    }
    @media (min-width: 768px)
        .form-inline .form-control {
            display: inline-block;
            width: auto;
            vertical-align: middle;
        }
        .form-control:not(select) {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
        input[type=search] {
            -webkit-appearance: none;
        }
        input[type=search] {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        input[type=search] {
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
            -webkit-appearance: textfield;
        }
        .form-control {
            border-radius: 0 !important;
            box-shadow: none;
            border-color: #d2d6de;
        }
        .input-sm {
            height: 30px;
            padding: 5px 10px;
            font-size: 12px;
            line-height: 1.5;
            border-radius: 3px;
        }


</style>


