
<?php

//PDF SCRIPT By EDSON - INTEGRATOR
define('FPDF_FONTPATH','fpdf/font/');
require_once('fpdf/fpdf.php');
//Arquivo que se conecta com o banco de dados
require_once("include/conexao.php");
class PDF extends FPDF
{ 
//Cabeçalho da página
    function Header()
    {
//Logo
        $this->Image('../../../midia/logotipo/search.png',15,1,60);
//Arial bold 15
        $this->SetFont('Arial','B',15);
        //Move para a direita
        $this->Cell(80);
//Título
        $this->Cell(60,10,'Relatorio AngoSearch',0,0,'C');
//Quebra de linha
        $this->Ln(20);

    }

//Rodapé da página
    function Footer()
    {
        //Posição de 1.5 cm da borda inferior
        $this->SetY(-15);
//Arial italic 8
        $this->SetFont('Arial','I',8);
        //Número da página
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
//name
        $this->SetTextColor(0,0,255);
        $this->SetFont('','U');
        $this->SetY(-5);
        $this->SetX(90);
        $this->Write(5,'www.angosearch.co.ao','http://localhost/Projecto%20Final%20-%20Loide%20Laura/php/index.php');
    }
}

//Criando um novo arquivo de PDF
//na classe, você pode definir a visualização (“L” em minúsculo) indica Paisagem,
//o default é Retrato, as medidas usadas na página e o formato
//da página: A3, A4 e etc
$pdf=new PDF('l','mm','A3');
$pdf->AliasNbPages( );
//Abre o arquivo


//Desabilita a quebra automática de páginas
$pdf->SetAutoPageBreak(false);
//Adiciona a primeira página
$pdf->AddPage();
//coloca o valor do eixo y na posição por página
$y_axis = 33;
//coloca a altura da linha
$row_height = 10;
//Imprime os títulos para a página atual
//coloca a cor de fundo
$pdf->SetFillColor(222,222,221);
//coloca o cor da fonte
$pdf->SetTextColor(0,0,0,0.6);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($y_axis);
$pdf->SetX(25);
$pdf->Cell(392,$row_height,'Desaparecidos Registrados',1,2,'C',0);
//adiciona a altura da linha seguinte
$y_axis = $y_axis + $row_height;
$pdf->SetY($y_axis);
$pdf->SetX(25);
$pdf->Cell(18,$row_height,'Processo',1,0,'L',1);
$pdf->Cell(60,$row_height,'Nome Completo',1,0,'C',1);
$pdf->Cell(30,$row_height,'Nascimento',1,0,'C',1);
$pdf->Cell(25,$row_height,'Genero',1,0,'C',1);
$pdf->Cell(40,$row_height,'Pai',1,0,'C',1);
$pdf->Cell(35,$row_height,utf8_decode('Mãe'),1,0,'C',1);
$pdf->Cell(30,$row_height,utf8_decode('Natural de:'),1,0,'C',1);
$pdf->Cell(30,$row_height,utf8_decode('Morada'),1,0,'C',1);
$pdf->Cell(40,$row_height,'Desaparecido desde',1,0,'C',1);
$pdf->Cell(22,$row_height,utf8_decode('Registro'),1,0,'C',1);
$pdf->Cell(40,$row_height,utf8_decode('Registrado Por'),1,0,'C',1);
$pdf->MultiCell(22,$row_height,'Contacto',1,0,'C',1);

$y_axis = $y_axis + $row_height;
try{
    $con=conecta();
    //seleciona os livros para serem mostrados no seu arquivo PDF
    $result=$con->query("SELECT id_desaparecido,nome_completo,nascimento,nome_pai,nome_mae,data_desaparecimento,foto,
telefone1,telefone2,dataRegistro,postado_por,bairro,genero,provincia FROM
`desaparecidos`,bairro,genero,provincia WHERE estado = '1' and fk_bairro=id_bairro and fk_genero=id_genero
 and fk_provincia=id_provincia ORDER  BY  dataRegistro DESC ");
    if($result===FALSE)
        throw new Exception('Problemas: '.$con->errno.' --- '.$con->error.'<br />');
    //Inicializa o contador
    $i = 0;
    //Coloca o máximo de linhas por página
    $max = 15;
    if( $result->num_rows==0 )
        throw new Exception('Não existem dados cadastrados no momento');
    while($row = $result->fetch_array( ))
    {
        //Se a linha atual é da próxima página, é criada uma nova página e é
        //impressa os títulos novamente
        if ($i == $max)
        {
            $pdf->AddPage( );
            $y_axis = 30;      //Imprime os títulos das colunas para a página atual
            $pdf->SetY($y_axis);   $pdf->SetX(25);   $pdf->SetFillColor(232,232,232);
            $pdf->SetTextColor(0,0,160);   $pdf->Cell(20,$row_height,'Id',1,0,'C',1);
            $pdf->Cell(60,$row_height,'Nome Completo',1,0,'C',1);
            $pdf->Cell(30,$row_height,'Nascimento',1,0,'C',1);        //Vai para a próxima linha
            $y_axis = $y_axis + $row_height;        //Pega a variável $i e coloca o valor 0 (primeira linha)
            $i = 0;  }
        //coloca o efeito zebra nas linhas
        if($i%2)
            $pdf->SetFillColor(222,222,222);
        else
            $pdf->SetFillColor(255,255,255);
        $id = $row['id_desaparecido'];
        $nome = $row['nome_completo'];
        $nasc = $row['nascimento'];

        //$pdf->Image('midia/foto_desaparecido/adilson.jpg',15,1,60);
        //coloca a cor da fonte
        $pdf->SetTextColor(0,0,0);
        $pdf->SetY($y_axis);
        $pdf->SetX(25);
        //adiciona os valores do banco nas células
       // $pdf->Cell(60,$row_height,$foto,1,0,'L',1);
        $pdf->Cell(18,$row_height,$id,1,0,'L',1);
        $pdf->Cell(60,$row_height,utf8_decode($nome),1,0,'L',1);
        $pdf->Cell(30,$row_height,$nasc,1,0,'L',1);
        $pdf->Cell(25,$row_height,$row['genero'],1,0,'L',1);
        $pdf->Cell(40,$row_height,utf8_decode($row['nome_pai']),1,0,'L',1);
        $pdf->Cell(35,$row_height,utf8_decode($row['nome_mae']),1,0,'L',1);
        $pdf->Cell(30,$row_height,utf8_decode($row['provincia']),1,0,'L',1);
        $pdf->Cell(30,$row_height,utf8_decode($row['bairro']),1,0,'L',1);
        $pdf->Cell(40,$row_height,$row['data_desaparecimento'],1,0,'R',1);
        $pdf->Cell(22,$row_height,$row['dataRegistro'],1,0,'R',1);
        $pdf->Cell(40,$row_height,utf8_decode($row['postado_por']),1,0,'R',1);
        $pdf->MultiCell(22,$row_height,$row['telefone1']." ".$row['telefone2'],1,0,'L',1);


//vai para a próxima linha
        $y_axis = $y_axis + $row_height;
        $i ++;
    }
    //Cria o arquivo
    //abaixo você tem a possibilidade de enviar para o browser para salvar como
//$pdf->Output('arquivo.pdf','D');
    //o exemplo abaixo é para ser exibido diretamente no browser
    $pdf->Output();//abre o plug-in padrão do PDF para visualizar o arquivo de saída
    Header('Pragma: public'); //Deve ser colocado para exibição no Internet Explorer
    $result->close();
}
catch(Exception $e){
    //caso haja uma exceção a mensagem é capturada e atribuida a $msg
    echo $e->getMessage( );
}
$con->close();