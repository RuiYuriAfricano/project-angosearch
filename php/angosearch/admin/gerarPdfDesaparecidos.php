<?php
include('../admin/mpdf/mpdf.php');


include '../admin/include/conexao.php';
$con= conecta();

$desaparecidos = $con->query("select * from desaparecidos where estado='1'");
$totalDesaparecidos = mysqli_num_rows($desaparecidos);

$sql=$con->query("SELECT id_desaparecido,nome_completo,idade,nome_pai,nome_mae,data_desaparecimento,foto,
telefone1,telefone2,dataRegistro,postado_por,bairro,genero,provincia FROM
`desaparecidos`,bairro,genero,provincia WHERE estado = '1' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia ORDER  BY  dataRegistro DESC ");

$dados=mysqli_fetch_array($sql);
$ft=$dados['foto'];


$pagina = "<html><body>


 <h5 align='left' >".$totalDesaparecidos." Pessoas Desaparecidas</h5>

                 <tr >
                    <th width='96' align='center'>Fotografia</th>
                    <th  align='center'  width='40'>Processo Nº</th>
                    <th width='96' align='center'>Nome</th>
                    <th width='96' align='center'>Idade</th>
                    <th width='96' align='center'>Filiaçao</th>
                    <th width='96' align='center'>Telefone</th>
                    <th width='96' align='center'>Desaparecimento</th>
                    <th width='96' align='center'>Registro no Sistema</th>
                    <th width='96' align='center'>Postado Por</th>

                </tr></body></html>";

$a="<tr class='vd'>
                        <td width='92' align=''>
<img src='../admin/midia/foto_desaparecido/".$ft."'
     width = 'auto' height='100px' style='border-radius:3px;'></td>
<td width='92' >".$dados['id_desaparecido']."</td>
<td width='92' >". $dados['nome_completo']."</td>
<td width='62' > ".$dados['idade']."</td>
<td width='92' >". $dados['nome_pai']." e ".$dados['nome_mae']."</td>
<td width='92' >". $dados['telefone1']."</td>
<td width='92' >". $dados['data_desaparecimento']."</td>
<td width='92' >". $dados['dataRegistro']."</td>
<td width='92' >". $dados['postado_por']."</td>
</tr></table>";

$arquivo="desaparecidos.pdf";

$mpdf = new mPDF();
$mpdf -> WriteHTML($pagina);
$mpdf->  Output($arquivo, 'I');

?>