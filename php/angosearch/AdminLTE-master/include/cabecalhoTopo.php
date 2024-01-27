<a href="index.php" class="logo"><b><img style="width: 140px;height: 49px"
                                          src="../../../midia/logotipo/<?php echo $dados['logo'];?>" alt="ANGOSEARCH"></b></a>
<!-- Header Navbar: style can be found in header.less -->
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
            <?php
            $admin =$_SESSION['nome_admin'];
            $pega=$con->query("select foto_admin,dtRegistro from login where admin='$admin' and estado='1'");
            $pega_f=mysqli_fetch_array($pega);
            ?>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="../admin/midia/img/<?php echo $pega_f['foto_admin']; ?>" class="user-image" alt="User Image"/>
                    <span class="hidden-xs"><?php echo $_SESSION['nome_admin']; ?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="../admin/midia/img/<?php echo $pega_f['foto_admin']; ?>" class="img-circle" alt="User Image" />
                        <p>
                            <?php echo $_SESSION['nome_admin']; ?> - Administrador
                            <small>Membro desde <?php echo date('d-m-Y', strtotime($pega_f['dtRegistro'])); ?></small>
                        </p>
                    </li>
                    <!-- Menu Body -->

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
    </div>
</nav>