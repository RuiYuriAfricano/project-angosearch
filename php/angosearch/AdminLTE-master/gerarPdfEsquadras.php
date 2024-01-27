<?php

session_start();
if($_SESSION['nome_admin']) {
?>
<?php
include '../admin/include/conexao.php';
$con= conecta();
?>
<?php
$sql =$con ->query("select * from definicoes where id_definicoes='1' ") or die(mysql_error());

$linhas = mysqli_num_rows($sql);
$dados = mysqli_fetch_assoc($sql);
?>
<html>
<head>
    <title>Relatório</title>
    <link href="../admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <style>
        table
        {
            width: 300px;
            font: 20px Calibri;
        }
        table, th, td
        {
            border: solid 1px #DDD;
            border-collapse: collapse;
            padding: 2px 3px;
            text-align: center;
        }
    </style>

</head>
<body style="background: #ccc">

<?php

$con=conecta();

$docs = $con->query("select * from esquadra where estado='1'");
$totalDocs = mysqli_num_rows($docs);

$sql=$con->query("select id_esquadra, esquadra, numero, dataRegistro,func_esquadra,func_foto,registrado_por, tipoEsquadra, bairro
 from esquadra,tipoesquadra,bairro where estado='1'and
 fk_tipoEsquadra=id_tipoEsquadra
 and fk_bairro=id_bairro ORDER  by id_esquadra desc ");

?>
<p>
    <input type="button" style="float: right" value="Criar PDF" id="btnImprimir" class="btn btn-primary  " onclick="CriaPDF()" />
   <a href="view_esquadra.php"> <input type="button" style="float: right" value="Voltar" id="btnImprimir"
                                            class="btn btn-default "  /></a>
</p>
<div id="tabela">
    <center><img style="width: auto;height: auto"
         src="../../../midia/logotipo/<?php echo $dados['logo'];?>" alt="ANGOSEARCH"></center>
    <center><h3>Esquadras Registradas</h3></center>
    <div class="table-responsive" style="  width: 100%;
color:#005cbf;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px; padding-left: 20px;padding-right: 20px;">



        <table  style="text-align: center;background-color: #fff;"  width="100%" class="table table-bordered table-hover">
            <thead style="color: #fff;"> <tr class="bg-primary">
                <th width="96" align="center">Foto do Funcionário</th>
                <th width="96" align="center">Funcionário</th>
                <th width="96" align="center">Esquadra</th>
                <th width="96" align="center">Número</th>
                <th width="96" align="center">Tipo</th>
                <th width="96" align="center">Bairro</th>
                <th width="196" align="center">Registrado Por</th>
                <th width="96" align="center">Registro no Sistema</th>


            </tr></thead>
            <?php while($dados=mysqli_fetch_array($sql)){ $ft = $dados['func_foto']?>
                <tr class="vd">
                    <td width="92" align="">
                        <img src="../admin/midia/img/<?php echo $ft; ?>" alt="<?php echo $ft; ?>"
                             width = '90px' height='90px' style='border-radius:100%;'></td>
                    <td width="202" align=""><?php echo $dados['func_esquadra'];?></td>
                    <td width="202" align=""><?php echo $dados['esquadra'];?></td>
                    <td width="202" align=""><?php echo $dados['numero'];?></td>
                    <td width="60" align=""id="bt4"><?php echo $dados['tipoEsquadra'];?></td>
                    <td width="202" align=""><?php echo $dados['bairro'];?></td>
                    <td width="196" align=""><?php echo $dados['registrado_por'];?></td>
                    <td width="202" align=""><?php echo $dados['dataRegistro'];?></td>


                </tr>


            <?php }//end if ?></table>
    </div></div>

<?php echo "<center id='dt_user'>Por : ".$_SESSION['nome_admin'] .", aos  ".date('d-m-Y H:i:s'). "</center>"; ?>


</body>
<script>
    function CriaPDF() {
        var minhaTabela = document.getElementById('tabela').innerHTML;
        var dta = document.getElementById('dt_user').innerHTML;

        var style = "<style>";
        style = style + "table {width: 100%;font: 20px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

        // CRIA UM OBJETO WINDOW
        var win = window.open('', '', 'height=700,width=700');

        win.document.write('<html><head>');
        win.document.write('<title>Esquadras Registradas</title>');   // <title> CABEÇALHO DO PDF.
        win.document.write(style);                       // INCLUI UM ESTILO NA TAB HEAD
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(minhaTabela);                   // O CONTEUDO DA TABELA DENTRO DA TAG BODY
        win.document.write('</body><center><footer>'+dta+'</footer></center></html>');

        win.document.close(); 	                            // FECHA A JANELA

        win.print();                                        // IMPRIME O CONTEUDO
    }
</script>
</html>

<?php }else{
    header("Location:../../login-usuario.php");
} ?>