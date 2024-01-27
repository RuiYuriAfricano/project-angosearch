<?php

$esq=$_SESSION['esquadra'];

$con= conecta();

$sql =$con ->query("select * from definicoes where id_definicoes='1' ") or die(mysql_error());

$linhas = mysqli_num_rows($sql);
$dados = mysqli_fetch_assoc($sql);

/* rodape base de dados*/
$sq =$con ->query("select * from rodape where id_rodape='1' ") or die(mysql_error());

$linha = mysqli_num_rows($sq);
$dado = mysqli_fetch_assoc($sq);

$esquadra =$con ->query("select * from esquadra where esquadra='$esq' ") or die(mysql_error());


$valores = mysqli_fetch_assoc($esquadra);
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
                <i class="fa fa-comments"></i>
                <span class="label label-danger">9</span>
            </a>

                <a href="#" class="" data-toggle="dropdown">
                    <img src="../admin/midia/img/<?php echo $valores['func_foto'];?>"
                         class="user-image"  alt="User Image" style="width: 40px;height: 40px;
                        border-radius: 40%;">
                    <span class="hidden-xs" style="margin-right: 10px">
                        <?php echo $valores['func_esquadra'];?></span>
                </a>

            <a class="dn_btn" href="../../logout.php"><span	class="glyphicon	glyphicon-log-out" ></span> Terminar Sessão</a>
        </div>
    </div>
</div>
<div class="main_menu">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand logo_h" href="principal_esquadra.php"><img src="../../../midia/logotipo/<?php echo $dados['logo'];?>" alt="ANGOSEARCH">
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
                    <li class="nav-item"><a class="nav-link" id="ativo1" href="principal_esquadra.php">
                            <i class="fa fa-home"></i> Principal </a></li>

                    <li class="nav-item submenu dropdown"><a id="ativo2" class="nav-link dropdown-toggle" href="#">Desaparecidos</a>

                        <ul class="dropdown-menu">
                            <li class="nav-item" id="has-sub">
                                <a class="nav-link dropdown-toggle" href="#">Pessoas</a>
                                <ul class="dropdown-menu" >
                                    <li class="nav-item"><a href='adicionar_desaparecidos.php' class="nav-link">Adicionar</a></li>
                                    <li class="nav-item"><a href='visualizar_desaparecidos.php' class="nav-link">Visualizar</a></li>
                                </ul>

                            </li>




                            <li class="nav-item" id="has-sub">
                                <a class="nav-link dropdown-toggle" href="#" >Documentos</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href='registrar_documento.php' class="nav-link">Adicionar</a></li>
                                    <li class="nav-item"><a href='visualizar_documentos.php' class="nav-link">Visualizar</a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item submenu dropdown"><a id="ativo4" class="nav-link dropdown-toggle" href="#">Encontrados</a>



                                <ul class="dropdown-menu" >
                                    <li class="nav-item"><a href='historico_desaparecidos.php' class="nav-link">Pessoas</a></li>
                                    <li class="nav-item"><a href='doc_encontrados.php' class="nav-link">Documentos</a></li>
                                </ul>

                            </li>




                    <li class="nav-item submenu dropdown"><a id="ativo5" class="nav-link dropdown-toggle" href="#">Comunicados</a>
                    <li class="nav-item submenu dropdown"><a id="ativo5" class="nav-link dropdown-toggle" href="#">Definições</a>

                    </li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item"><a href="#" id="ativo6" class="search" data-toggle="modal" data-target="#modalAppointment">
                            Chat</a></li>
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


<style>.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
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


