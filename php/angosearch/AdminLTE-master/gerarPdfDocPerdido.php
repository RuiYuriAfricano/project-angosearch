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

$id=$_GET['id_doc'];
?>
<html>
<head>
    <title>Relatório sobre Documento</title>
    <link href="../admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />


</head>
<body style="background: #ccc">

<p>
    <input type="button" style="float: right" value="Criar PDF" id="btnImprimir" class="btn btn-primary  " onclick="CriaPDF()" />
    <a href="view_docPerdidos.php"> <input type="button" style="float: right" value="Voltar" id="btnImprimir"
                                             class="btn btn-default "  /></a>
</p>
<div id="tabela">
    <center><img style="width: auto;height: auto"
                 src="../../../midia/logotipo/<?php echo $dados['logo'];?>" alt="ANGOSEARCH"></center>

    <div class="row" id="resumo">
        <br>
        <center>
            <?php
            if($_GET["id_doc"]!=""){

                $id=$_GET["id_doc"];

                $doc=$con->query("SELECT * FROM documentos WHERE  id_doc='$id'");


                $linhas = mysqli_num_rows($sql);

                if ($linhas > 0) {


                    while ($dados = mysqli_fetch_assoc($doc)) {
                        if($dados['estado']==1){
                            $est="<span class='text-primary'>Perdido</span>";
                        }else if($dados['estado']==0){
                            $est="<span class='text-success'>Encontrado desde, ". date('d-m-Y',strtotime($dados['dataEncontrado']))."</span>";
                        }
                        elseif($dados['estado']==2){
                            $est="<span class='text-danger'>Excluído</span>";
                        }

                        echo "<br><h3 align='center'>".$dados['nome_doc']."</b></h3>";
                        echo "<table class='table table-bordered table-striped'  style='width: 70%;background: #fff;'>".
                            "<thead>"."<tr>
                <th>Documento</th>
                <th>Detalhes</th>
            </tr>
            </thead><tbody>
            <tr>
                <td>Imagem</td><td><img width = '250' height='150' style='border-radius:26px;float:right;'
                 src='../admin/midia/documentos/".
                            $dados['fotografia']."' alt='".$dados['fotografia']."'/></td></tr><tr>
                <td>Designação</td><td>".
                            $dados['nome_doc']."</td></tr>

                <tr>
                <td>Descrição</td><td>".
                            $dados['detalhe']."</td></tr><tr>
                <td>Código</td><td>".
                            $dados['codigo_doc']."</td></tr><tr>
                <td>Data de Registro</td><td>".
                            $dados['dataRegistro']."</td></tr><tr>
                <td>Registrado Por</td><td>".
                            $dados['postado_por']."</td></tr>

                            <tfoot><tr><td>Estado :</td><td>".$est."</td></tr></tfoot></tbody></table><br><br>
                 ";

                    }



                }else{

                    echo"<script language='javascript'>alert('documento não encontrado.!')</script>";
                    echo '<script type="text/javascript">window.location ="index.php"</script>';

                }

            } else{

                echo"<script language='javascript'>alert('Digite o Id do Documento!')</script>";
                echo '<script type="text/javascript">window.location ="index.php"</script>';
            }




            ?>
        </center></div></div>


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
        win.document.write('<title>Documento Perdido</title>');   // <title> CABEÇALHO DO PDF.
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