<?php

session_start();
if($_SESSION['nome_admin']) {
?><?php
include '../admin/include/conexao.php';
$con= conecta();
?>
<?php
$sql =$con ->query("select * from definicoes where id_definicoes='1' ") or die(mysql_error());

$linhas = mysqli_num_rows($sql);
$dados = mysqli_fetch_assoc($sql);
$id=$_GET['id_esquadra'];
?>
<html>
<head>
    <title>Relatório sobre a Esquadra</title>
    <link href="../admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />


</head>
<body style="background: #ccc">

<p>
    <input type="button" style="float: right" value="Criar PDF" id="btnImprimir" class="btn btn-primary  " onclick="CriaPDF()" />
    <a href="view_esquadra.php"> <input type="button" style="float: right" value="Voltar" id="btnImprimir"
                                           class="btn btn-default "  /></a>
</p>
<div id="tabela">
    <center><img style="width: auto;height: auto"
                 src="../../../midia/logotipo/<?php echo $dados['logo'];?>" alt="ANGOSEARCH"></center
    <center>
        <?php
        if($_GET["id_esquadra"]!=""){



            $sql=$con->query("select id_esquadra, esquadra, numero, dataRegistro,func_esquadra,estado,func_foto,registrado_por, tipoEsquadra,
bairro
 from esquadra,tipoesquadra,bairro where id_esquadra='$id' and
 fk_tipoEsquadra=id_tipoEsquadra
 and fk_bairro=id_bairro ORDER  by id_esquadra desc ");




            while ($dados = mysqli_fetch_assoc($sql)) {

                if($dados['estado']==1){
                    $est="<span class='text-primary'>Activa</span>";
                }
                elseif($dados['estado']==0){
                    $est="<span class='text-danger'>Excluída</span>";
                }

                echo "<br>";
                echo "<center><table  class='table table-bordered table-striped'   style='border: 0;width: 70%;background: #fff'>".
                    "<thead>"."<tr>
                <th>Funcionário(a)</th>
                <th>Detalhes</th>
            </tr>
            </thead><tbody>
            <tr>
        <td ><img width = 'auto' height='200' style='border-radius:100%;'
                 src='../admin/midia/img/".
                    $dados['func_foto']."' alt='".$dados['esquadra']."'/></td></tr>

                <tr>
                <td class='td' >Nº do Processo</td><td class='td' style='text-align:center;'>".
                    $dados['id_esquadra']."</td></tr><tr>
                <td class='td' >Funcionário(a) Esquadra</td><td class='td' style='text-align:center;'>".
                    $dados['func_esquadra']."</td></tr><tr>
                <td class='td'>Número</td><td class='td' style='text-align:center;'>".
                    $dados['numero']."</td></tr><tr>
                <td class='td'>Tipo</td><td class='td' style='text-align:center;'>".
                    $dados['tipoEsquadra']."</td></tr><tr>
                <td class='td'>Bairro</td><td class='td' style='text-align:center;'>".
                    $dados['bairro']."</td></tr><tr>
                <td class='td'>Data de Registro</td><td class='td' style='text-align:center;'>".
                    $dados['dataRegistro']."</td></tr><tr>
                <td class='td'>Registrado Por</td><td class='td' style='text-align:center;'>".
                    $dados['registrado_por']."</td></tr><tr><td class='td'>Estado :</td><td class='td' style='text-align:center;'>
                        ".$est."</td></tr>
                </tbody></table><br><br>
                 </center>";

            }





        } else{

            echo"<script language='javascript'>alert('Digite o Id da esquadra!')</script>";
            echo '<script type="text/javascript">window.location ="index.php"</script>';
        }




        ?></center></div></div>


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
        win.document.write('<title>Esquadra</title>');   // <title> CABEÇALHO DO PDF.
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