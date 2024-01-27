
<?php
$sql =$con ->query("select * from rodape where id_rodape='1' ") or die(mysql_error());

$linhas = mysqli_num_rows($sql);
$dados = mysqli_fetch_assoc($sql);
?>
<div class="pull-right hidden-xs">
    <b>Versão</b> 1.0
</div>
<strong>Copyright <script>document.write(new Date().getFullYear());</script> <a href="http://localhost/Projecto%20Final%20-%20Loide%20Laura/php/index.php">Angosearch</a>.</strong> Todos Direitos Reservados.