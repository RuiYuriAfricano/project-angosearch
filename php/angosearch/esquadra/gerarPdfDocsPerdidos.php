<?php

session_start();
if($_SESSION['esquadra']) {
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
    <title>Relatório de Documentos Perdidos</title>
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
<body>

<?php

$con=conecta();

$docs = $con->query("select * from documentos where estado='1'");
$totalDocs = mysqli_num_rows($docs);

$sql=$con->query("SELECT id_doc,nome_doc, fotografia, detalhe,codigo_doc,postado_por,dataRegistro FROM documentos
WHERE estado = '1'ORDER  BY id_doc ASC ");


?>
<p>
    <input type="button" style="float: right" value="Criar PDF" id="btnImprimir" class="btn btn-primary  " onclick="CriaPDF()" />
    <a href="view_doc.php"> <input type="button" style="float: right" value="Voltar" id="btnImprimir"
                                             class="btn btn-default "  /></a>
</p>
<div id="tabela">
    <center><img style="width: auto;height: auto"
                 src="../../../midia/logotipo/<?php echo $dados['logo'];?>" alt="ANGOSEARCH"></center>

    <div class="table-responsive" style="  width: 100%;
color:#005cbf; background-color: #fff;
margin-bottom: 30px; padding-bottom: 10px; padding-top: 10px; margin-top: 30px; padding-left: 20px;padding-right: 20px;">

        <h5 align="left" style="color: #999;"><?php if($totalDocs > 1){
                echo $totalDocs." Documentos Perdidos";}
            else if($totalDocs == 0){
                echo "Nenhum Documento Perdido";
            }
            if($totalDocs == 1){
                echo $totalDocs." Documento Perdido";}
            ?></h5> <br>

        <table   style="text-align: center;"  width="100%" class="table table-bordered table-hover" >
            <thead style="color: #fff;"> <tr class="bg-primary">
                <th width="192" align="center">Documento</th>
                <th  align="center"id="bt4" width="15" height="">processo Nº</th>

                <th width="192" align="center">Nome do Documento</th>

                <th width="192" align="center">Detalhe</th>
                <th width="192" align="center">Código</th>
                <th width="192" align="center">Postado Por</th>
                <th width="192" align="center">Registro no Sistema</th>




            </tr></thead>
            <?php while($dados=mysqli_fetch_array($sql)){ $ft=$dados['fotografia'];?>
                <tr class="vd">
                    <td width="192" align=""><input type="hidden" value="<?php echo ($dados['id_doc']);?>" name="id_doc">
                        <img src="../admin/midia/documentos/<?php echo $ft; ?>" alt="<?php echo $ft; ?>"
                             width = '150px' height='100px' style='border-radius:3px;'></td>
                    <td width="15" align=""><?php echo $dados['id_doc'];?></td>


                    <td width="192" align=""><?php echo $dados['nome_doc'] ?></td>
                    <td width="192" align=""><?php echo $dados['detalhe'];?></td>
                    <td width="192" align=""><?php echo $dados['codigo_doc'];?></td>
                    <td width="192" align=""><?php echo $dados['postado_por'];?></td>
                    <td width="192" align=""><?php echo $dados['dataRegistro'];?></td>

                </tr>


            <?php }//end if ?></table>
    </div></div>

<?php echo "<center id='dt_user'>Por : ".$_SESSION['esquadra'] .", aos  ".date('d-m-Y H:i:s'). "</center>"; ?>


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
        win.document.write('<title>Documentos Perdidos</title>');   // <title> CABEÇALHO DO PDF.
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