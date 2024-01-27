
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
        <div class="float-left">
            <ul class="list header_social">
                <li><a href="www.facebook.com"><i class="fa fa-facebook"></i></a></li>
                <li><a href="www.twitter.com"><i class="fa fa-twitter"></i></a></li>
                <li><a href="www.instagram.com"><i class="fa fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
        </div>
        <div class="float-right">

            <select class="lan_pack" id="pages-select">
                <option value="0">Idioma</option>
                <option value="1">Português</option>
                <option value="2" >English</option>
                <option value="3">Español</option>
                <option value="4">Français</option>
            </select>
            <a class="ac_btn" href="login-usuario.php">Minha Conta</a>
            <a class="dn_btn" href="add_conta.php">Criar Conta</a>
        </div>
    </div>
</div>
<div class="main_menu">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand logo_h" href="index.php"><img src="../midia/logotipo/<?php echo $dados['logo'];?>" alt="ANGOSEARCH"></a>
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

                    <li class="nav-item" ><a class="nav-link" id="ativo2" href="sobre.php">Sobre</a></li>
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
</div>


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


