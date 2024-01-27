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
    <title>Relatório de Desaparecidos</title>
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
<body style="background: #ccc;">

<?php

$con=conecta();

$desaparecidos = $con->query("select * from desaparecidos where estado='1'");
$totalDesaparecidos = mysqli_num_rows($desaparecidos);

$sql=$con->query("SELECT id_desaparecido,nome_completo,idade,caracteristicas_especiais,descricao,nome_pai,nome_mae,data_desaparecimento,foto,
telefone1,telefone2,dataRegistro,postado_por,bairro,genero,provincia FROM
`desaparecidos`,bairro,genero,provincia WHERE estado = '1' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia ORDER  BY  id_desaparecido DESC ");


?>
<p>
    <input type="button" style="float: right" value="Criar PDF" id="btnImprimir" class="btn btn-primary  " onclick="CriaPDF()" />
   <a href="view_desaparecidos.php"> <input type="button" style="float: right" value="Voltar" id="btnImprimir"
                                            class="btn btn-default "  /></a>
</p>
<div id="tabela">
    <center><img style="width: auto;height: auto"
         src="../../../midia/logotipo/<?php echo $dados['logo'];?>" alt="ANGOSEARCH"></center>
    <center><h3>Pessoas Desaparecidas</h3></center>
    <div class="table-responsive" style="  width: 100%;
color:#005cbf; background-color: transparent;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 20px; padding-left: 20px;padding-right: 20px;">


        <table  style="text-align: center;background: #fff; width: 100%"  width="100%" class="table table-bordered table-hover" >
            <thead style="font-size: 15px"> <tr class="bg-primary">
                <th width="96" align="center">Fotografia</th>
                <th  align="center"id="bt4"width="40" height="">Processo Nº</th>
                <th width="96" align="center">Nome</th>
                <th width="22" align="center">Idade</th>
                <th width="96" align="center">Fisiológia</th>
                <th width="96" align="center">Descrição</th>
                <th width="96" align="center">Filiaçao</th>
                <th width="96" align="center">Telefone</th>
                <th width="96" align="center">Data de Desaparecimento</th>
                <th width="96" align="center">Registro no Sistema</th>
                <th width="196" align="center">Postado Por</th>






            </tr></thead>
            <?php while($dados=mysqli_fetch_array($sql)){ $ft=$dados['foto'];?>
                <tr class="vd">
                    <td width="92" align=""><input type="hidden" value="<?php echo ($dados['id_desaparecido']);?>" name="id_desaparecido">
                        <img src="../admin/midia/foto_desaparecido/<?php echo $ft; ?>" alt="<?php echo $ft; ?>"
                             width = '100px' height='100px' style='border-radius:100%;'></td>
                    <td width="92" align=""id="bt4"><?php echo $dados['id_desaparecido'];?></td>
                    <td width="92" align=""><?php echo $dados['nome_completo'];?></td>
                    <td width="22" align=""><?php echo $dados['idade'];?></td>
                    <td width="62" align=""><?php echo $dados['caracteristicas_especiais'];?></td>
                    <td width="62" align=""><?php echo $dados['descricao'];?></td>
                    <td width="92" align=""id="bt4"><?php echo $dados['nome_pai']." e de ".$dados['nome_mae'];?></td>
                    <td width="92" align=""id="bt4"><?php echo $dados['telefone1'];?></td>
                    <td width="92" align=""id="bt4"><?php echo $dados['data_desaparecimento'];?></td>
                    <td width="92" align=""><?php echo $dados['dataRegistro'];?></td>
                    <td width="192" align=""><?php echo $dados['postado_por'];?></td>



                </tr>


            <?php }//end if ?></table>
    </div></div>

<?php echo "<center id='dt_user'>Por : ".$_SESSION['nome_admin'] .", aos  ".date('d-m-Y   H:i:s'). "</center>"; ?>
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
        win.document.write('<title>Pessoas Desaparecidos</title>');   // <title> CABEÇALHO DO PDF.
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