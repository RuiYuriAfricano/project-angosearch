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

$id=$_GET['id_desaparecido'];
?>
<html>
<head>
    <title>Relatório de Desaparecidos</title>
    <link href="../admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />


</head>
<body>

<?php

$con=conecta();

$desaparecidos = $con->query("select * from desaparecidos where estado='1'");
$totalDesaparecidos = mysqli_num_rows($desaparecidos);

$sql=$con->query("SELECT id_desaparecido,nome_completo,idade,nome_pai,nome_mae,data_desaparecimento,foto,
telefone1,telefone2,dataRegistro,postado_por,bairro,genero,provincia FROM
`desaparecidos`,bairro,genero,provincia WHERE estado = '1' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia ORDER  BY  id_desaparecido DESC ");


?><p>
    <input type="button" style="float: right" value="Criar PDF" id="btnImprimir" class="btn btn-primary  " onclick="CriaPDF()" />
    <a href="view_desaparecidos.php"> <input type="button" style="float: right" value="Voltar" id="btnImprimir"
                                             class="btn btn-default "  /></a>
</p>
<div id="tabela">
    <center><img style="width: auto;height: auto"
                 src="../../../midia/logotipo/<?php echo $dados['logo'];?>" alt="ANGOSEARCH"></center>

    <div class="row" id="resumo" style="background: #fff;">
        <br>
        <center>
            <?php
            if($_GET["id_desaparecido"]!=""){



                $desaparecidos=$con->query("SELECT id_desaparecido,nome_completo,idade,nome_pai,nome_mae,data_desaparecimento,foto,
telefone1,telefone2,dataRegistro,postado_por,descricao,caracteristicas_especiais,bairro,genero,provincia FROM
desaparecidos,bairro,genero,provincia WHERE estado = '1' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia and id_desaparecido='$id' ORDER  BY  id_desaparecido DESC LIMIT 1 ");




                while ($dados = mysqli_fetch_assoc($desaparecidos)) {


                    echo "";
                    echo "<table class='table table-bordered table-striped'  style='border: 0;width: 70%'>".
                        "<thead>"."<tr>
                <th>Desaparecido(a)</th>
                <th>Detalhes</th>
            </tr>
            </thead><tbody>
            <tr>
        <td ><img width = 'auto' height='100px' style='border-radius:100%;'
                 src='../admin/midia/foto_desaparecido/".
                        $dados['foto']."' alt='".$dados['nome_completo']."'/></td></tr>

                <tr>
                <td class='td' >Nº do Processo</td><td class='td' style='text-align:center;'>".
                        $dados['id_desaparecido']."</td></tr><tr>
                <td class='td' >Nome Completo</td><td class='td' style='text-align:center;'>".
                        $dados['nome_completo']."</td></tr><tr>
                <td class='td'>Idade</td><td class='td' style='text-align:center;'>".
                        $dados['idade']."</td></tr><tr>
                <td class='td'>Naturalidade</td><td class='td' style='text-align:center;'>".
                        $dados['provincia']."</td></tr><tr>
                <td class='td'>Pai</td><td class='td' style='text-align:center;'>".
                        $dados['nome_pai']."</td></tr><tr>
                <td class='td'>Mãe</td><td class='td' style='text-align:center;'>".
                        $dados['nome_mae']."</td></tr><tr>
                <td class='td'>Bairro</td><td class='td' style='text-align:center;'>".
                        $dados['bairro']."</td></tr><tr>
                <td class='td'>Telefone</td><td class='td' style='text-align:center;'>".
                        $dados['telefone1']." / ".$dados['telefone2']."</td></tr>
                <tr>
                 <td class='td'>Descrição</td><td class='td' style='text-align:center;'>".
                        $dados['descricao']."</td>
</tr><tr>
                 <td class='td'>Caracteristicas Físicas</td><td class='td' style='text-align:center;'>".
                        $dados['caracteristicas_especiais']."
</td></tr>
                <tr>
                <td class='td'>Desaparecimento</td><td class='td' style='text-align:center;'>".
                        $dados['data_desaparecimento']."</td></tr><br><tr>
                <td class='td'>Registro no Sistema</td><td class='td' style='text-align:center;'>".
                        $dados['dataRegistro']."</td></tr><tr>
                <td class='td'>Registrado Por</td><td class='td' style='text-align:center;'>".
                        $dados['postado_por']."</td></tr></tbody></table><br><br>
                 ";

                }





            } else{

                echo"<script language='javascript'>alert('Digite o Id do Desaparecido!')</script>";
                echo '<script type="text/javascript">window.location ="index.php"</script>';
            }




            ?></center></div></div>

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
        win.document.write('<title>Desaparecido</title>');   // <title> CABEÇALHO DO PDF.
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