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
$pdf->Cell(200,5, utf8_decode('GÊNEROS ALIMENTÍCIOS LICITADOS'), 0, 1,'C');
$pdf->Ln(10);
$pdf->SetFont('Times','B', 10);
$pdf->Cell(200,5, utf8_decode('EMPRESA: ' . $dados[0]['NOME_FORNECEDOR']), 0, 1,'L');
$pdf->Ln(1);
$pdf->SetFont('Times','', 10);
if ($dados[0]['CNPJ_FORNECEDOR'] != "") {
	$pdf->Cell(200,5, utf8_decode('CNPJ: ' . $dados[0]['CNPJ_FORNECEDOR']), 0, 1,'L');
} else if ($dados[0]['CPF_FORNECEDOR'] != ""){
	$pdf->Cell(200,5, utf8_decode('CPF: ' . $dados[0]['CPF_FORNECEDOR']), 0, 1,'L');
} else if ($dados[0]['DAP_FORNECEDOR'] != ""){
	$pdf->Cell(200,5, utf8_decode('DAP: ' . $dados[0]['DAP_FORNECEDOR']), 0, 1,'L');
}

$pdf->Ln(1);
$pdf->Cell(200,5, utf8_decode('PREGÃO PRESENCIAL Nº ' . $dados[0]['NUMERO_LICITACAO']), 0, 1, 'L');
$pdf->Ln(1);
$pdf->Cell(200,5, utf8_decode('Vigência: ' . date("d/m/Y", strtotime($dados[0]['DATA_INICIO'])) . " à " . date("d/m/Y", strtotime($dados[0]['DATA_FIM']))), 0, 1, 'L');
$pdf->Ln(10);
$pdf->SetFont('Times','B', 14);

$pdf->Cell(200,5, utf8_decode('Movimento Saldo'), 0, 1,'C');
$pdf->Ln();
$pdf->SetFont('Times','B', 9);
$pdf->Cell(10, 5, utf8_decode("Cód"), 1, 0, 'C');
$pdf->Cell(60, 5, utf8_decode("Produto"), 1, 0, 'C');
$pdf->Cell(25, 5, utf8_decode("Qtd. Licitada"), 1, 0, 'C');
$pdf->Cell(25, 5, utf8_decode("Qtd. Pedida"), 1, 0, 'C');
$pdf->Cell(25, 5, utf8_decode("Saldo Disponível"), 1, 0, 'C');
$pdf->Cell(50, 5, utf8_decode("Unidade"), 1, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Times', '', 10);

	
foreach ($dados as $value) {
	$pdf->Cell(10, 5, utf8_decode($value['ID_PRODUTO']), 1, 0, 'C');
	$pdf->Cell(60, 5, utf8_decode($value['DESC_PRODUTO']), 1, 0, 'C');
	$pdf->Cell(25, 5, utf8_decode($value['QUANTIDADE']), 1, 0, 'C');
	$pdf->Cell(25, 5, utf8_decode(floatval($value['QUANTIDADE']) - floatval($value['SALDO'])), 1, 0, 'C');
	$pdf->Cell(25, 5, utf8_decode($value['SALDO']), 1, 0, 'C');
	$pdf->Cell(50, 5, utf8_decode($value['DESC_UNIDADE_MEDIDA']), 1, 0, 'C');
	$pdf->Ln();
}


$pdf->Ln(20);
$pdf->Cell(190, 5, utf8_decode($local), 0, 0, 'R');



$pdf->Output("licitacao.pdf", "I");


?>