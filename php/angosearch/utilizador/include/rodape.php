<?php

$con= conecta();

$sql =$con ->query("select * from rodape where id_rodape='1' ") or die(mysql_error());

$linhas = mysqli_num_rows($sql);
$dados = mysqli_fetch_assoc($sql);
?>


<footer class="main-footer">
    <div class="container-fluid">
        <div class="pull-right hidden-xs">
            <b>Versão</b> 1.0
        </div>
        <strong>Copyright &copy;<script>document.write(new Date().getFullYear());</script>.</strong> Todos Direitos Reservados | Angosearch.
    </div><!-- /.container -->
    <div class="ml-lg-auto cr_links pull-left hidden-xs">
        <ul class="cr_list">
            <a href="#">Termos de utiliza&ccedil;&atilde;o</a>
            <a href="#">Politica e Privacidade</a>
        </ul>
    </div>
</footer>