<?php

$con= conecta();

$sql =$con ->query("select * from definicoes where id_definicoes='1' ") or die(mysql_error());

$linhas = mysqli_num_rows($sql);
$dados = mysqli_fetch_assoc($sql);

/* rodape base de dados*/
$sq =$con ->query("select * from rodape where id_rodape='1' ") or die(mysql_error());

$linha = mysqli_num_rows($sq);
$dado = mysqli_fetch_assoc($sq);
?>

<div class="top_menu row m0">
    <div class="container">

        <div class="float-right">

            <a href="#" class="msg" data-toggle="dropdown">
                <i class="fa fa-envelope-o"></i>
                <span class="label label-success">4</span>
            </a>
            <a href="#" class="ntf" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning">10</span>
            </a>
            <a href="#" class="task" data-toggle="dropdown">
                <i class="fa fa-flag-o"></i>
                <span class="label label-danger">9</span>
            </a>

                <a href="#" class="" data-toggle="dropdown">
                    <img src="midia/img/igor.jpg" class="user-image"  alt="User Image" style="width: 40px;height: 40px;
                        border-radius: 40%;">
                    <span class="hidden-xs" style="margin-right: 10px"><?php echo $_SESSION['nome_admin']; ?></span>
                </a>

            <a class="dn_btn" href="../../logout.php"><span	class="glyphicon	glyphicon-log-out" ></span> Terminar Sessão</a>
        </div>
    </div>
</div>
<div class="main_menu">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand logo_h" href="principal_admin.php"><img src="../../../midia/logotipo/<?php echo $dados['logo'];?>" alt="ANGOSEARCH">
            </a>
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
                    <li class="nav-item active"><a class="nav-link" href="principal_admin.php">
                            Inicio</a></li>

                    <li class="nav-item submenu dropdown"><a class="nav-link dropdown-toggle" data-toggle="dropdown"
                                                             role="button" aria-haspopup="true" aria-expanded="false" href="#">Desaparecidos</a>

                        <ul class="dropdown-menu">
                            <li class="nav-item" id="has-sub">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false" href="#">Pessoas</a>
                                <ul class="dropdown-menu" style="background-color: #fff;">
                                    <li class="nav-item" ><a href='adicionar_desaparecidos.php' class="nav-link">Adicionar</a></li>
                                    <li class="nav-item"><a href='visualizar_desaparecidos.php' class="nav-link">Visualizar</a></li>
                                </ul>

                            </li>

<style>
    .sub a:hover{
        background-color: #fff;
        color: #333;
    }
</style>


                            <li class="nav-item" id="has-sub">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown"
                                role="button" aria-haspopup="true" aria-expanded="false" href="#">Documentações</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href='registrar_documento.php' class="nav-link">Adicionar</a></li>
                                    <li class="nav-item"><a href='visualizar_documentos.php' class="nav-link">Visualizar</a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item submenu dropdown"><a class="nav-link dropdown-toggle" href="#">Utilizadores</a>

                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="">Adicionar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Visualizar</a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item submenu dropdown"><a class="nav-link dropdown-toggle" href="#">Esquadras</a>

                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="adicionar_esquadra.php">Adicionar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="visualizar_esquadra.php">Visualizar</a>
                            </li>

                        </ul>
                    </li>


                    <li class="nav-item submenu dropdown"><a class="nav-link dropdown-toggle" href="#">CMS</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="pagina.php">Página</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="rodape.php">Rodapé</a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item submenu dropdown"><a class="nav-link dropdown-toggle" href="#">Definições</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="alterar_logo.php">Alterar Logo</a>
                            </li>
                            <li class="nav-item" id="has-sub1">
                                <a class="nav-link dropdown-toggle" href="#">Login Admin</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href='#' class="nav-link">Adicionar</a></li>
                                    <li class="nav-item"><a href='#' class="nav-link">Visualizar</a></li>
                                </ul>
                            </li>


                        </ul>
                    </li>
                    <li class="nav-item submenu dropdown"><a class="nav-link dropdown-toggle" href="#">Administrativo</a>
                        <ul class="dropdown-menu">

                                    <li class="nav-item" id="has-sub1">
                                        <a class="nav-link dropdown-toggle" href="#">Login Esquadra</a>
                                        <ul class="dropdown-menu" >
                                            <li class="nav-item"><a href='adicionar_loginEsquadra.php' class="nav-link">Adicionar</a></li>
                                            <li class="nav-item"><a href='visualizar_loginEsquadra.php' class="nav-link">Visualizar</a></li>
                                        </ul>

                                    </li>




                                    <li class="nav-item" id="has-sub1">
                                        <a class="nav-link dropdown-toggle" href="#">Login Utilizador</a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item"><a href='#' class="nav-link">Adicionar</a></li>
                                            <li class="nav-item"><a href='#' class="nav-link">Visualizar</a></li>
                                        </ul>
                                    </li>

                            <li class="nav-item">
                                <a class="nav-link" href="inicio_sessao.php" class="nav-link" >Sessões Iniciadas</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="sessoes_terminadas.php" class="nav-link" >Sessões Terminadas</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item"><a href="#" class="search" data-toggle="modal" data-target="#modalAppointment"><i class="lnr lnr-magnifier"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>


<style>
    #has-sub {
        z-index: 1;
    }
    #has-sub:hover > ul {
        display: block;
    }
    #has-sub ul {
        display: none;
        position: absolute;
        width: 200px;
        top: 100%;
        left: 0;
    }
    #has-sub ul li {
        *margin-bottom: -1px;
    }
    #has-sub ul {
        display: none;
        position: absolute;
        left: 100%;
        top: 0;
    }

    #has-sub1 ul {
        display: none;
        position: absolute;
        left: 100%;
        top: 0;
    }
    #has-sub1 {
        z-index: 1;
    }
    #has-sub1:hover > ul {
        display: block;
    }
    #has-sub1 ul {
        display: none;
        position: absolute;
        width: 200px;
        top: 0;
        left: -200px;
        background: #fff;
    }
</style>