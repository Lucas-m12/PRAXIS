<?php

$idUnidade = 1;

define('FPDF_FONTPATH','font/');
$pdf->AliasNbPages();
$pdf->AddPage();

//Timbre
$row  = $pdf->Timbre($idUnidade);
$ds_empresa    = $row['DS_EMPRESA'];
$ds_cnpj       = $row['CNPJ'];
$ds_secretaria = $row['SECRETARIA_EDUCACAO'];
$ds_estado     = $row['NOME_UF'];
$ds_escola     = $row['NOME_ESCOLA'];
$ds_inep       = $row['INEP_ESCOLA'];
$estado_esc    = $row['ESTADO'];
$uf_esc        = $row['UF'];
$cidade_esc    = $row['NOME_MUNICIPIO'];

$pdf->SetFont('Times','',10);
#PADRONIZANDO O CABEÇALHO DOS RELATÓRIOS#
$pdf->Image(base_url('assets/img/praxis.png'), 10, 10, 18);
// Arial bold 15
$pdf->Image(base_url('assets/img/praxis.png'), 98, 2, 18);
$pdf->Ln(10);
$pdf->Cell (198,6, utf8_decode($ds_estado),0,0, 'C');
$pdf->Ln(4);
$pdf->Cell (198,6, utf8_decode($ds_empresa),0,0, 'C');
$pdf->Ln(4);
$pdf->Cell (198,6, utf8_decode($ds_secretaria),0,0, 'C');
$pdf->Ln(4);
$pdf->Cell (190,6, utf8_decode('------------------------------------------------------------------------------------------------------------------------------------------------------------------'),0,0, 'C');
$pdf->Ln(6);

setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );             
$data_atual   = strftime( ' %d de %B de %Y', strtotime(date( 'Y-m-d' ))); // DATA ATUAL       
$local = $cidade_esc.' - '.$uf_esc.', '.$data_atual.'.';

#NOME DO RELATÓRIO#
$pdf->SetFont('Times','B', 14);
$pdf->Cell(200,5, utf8_decode('DADOS PERCAPITA'), 0, 1,'C');
$pdf->Ln(10);
$pdf->SetFont('Times','', 10);
$pdf->Cell(190, 5, utf8_decode("Unidade de Ensino: " . $dados['NOME_ESCOLA']), 1, 0, 'L');
$pdf->Ln();
$pdf->Cell(190, 5, utf8_decode("Nível de Ensino: " . $dados['DS_NIVEL_ENSINO']), 1, 0, 'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B', 10);

$pdf->Cell(65, 5, utf8_decode("Produto"), 1, 0, 'C');
$pdf->Cell(40, 5, utf8_decode("PerCapita Individual"), 1, 0, 'C');
$pdf->Cell(40, 5, utf8_decode("Quantidade de Alunos"), 1, 0, 'C');
$pdf->Cell(45, 5, utf8_decode("Quantidade de Compra"), 1, 0, 'Cell');
$pdf->Ln();
$pdf->SetFont('Times','', 10);
$pdf->Cell(65, 5, utf8_decode($dados['ID_PRODUTO'] . " - " . $dados['DESC_PRODUTO']), 1, 0, 'C');
$pdf->Cell(40, 5, utf8_decode($dados['VALOR_PERCAPITA']), 1, 0, 'L');
$pdf->Cell(40, 5, utf8_decode($dados['QTD_ALUNOS']), 1, 0, 'L');
$pdf->Cell(45, 5, utf8_decode((floatval($dados['VALOR_PERCAPITA']) * floatval($dados['QTD_ALUNOS'])) . " " . $dados['SIGLA_UNIDADE_MEDIDA']), 1, 0, 'L');


$pdf->Ln();
$pdf->SetFont('Times', '', 10);








$pdf->Output("PerCapita.pdf", "I");

?>