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
$pdf->Cell(200,5, utf8_decode('INFORMAÇÕES DO PEDIDO'), 0, 1,'C');
$pdf->Ln();
$pdf->SetFont('Times','', 10);
$pdf->Cell(35,5, utf8_decode('Código do Pedido: ' . $dados[0]['CODIGO_PEDIDO']), 1, 0, 'L');
$pdf->Cell(45,5, utf8_decode('Data do Pedido: ' . date("d/m/Y", strtotime(explode(" ", $dados[0]['DATA_PEDIDO'])[0]))), 1, 0, 'L');
$pdf->Cell(110,5, utf8_decode('Fornecedor: ' . mb_convert_case($dados[0]['NOME_FORNECEDOR'], MB_CASE_TITLE, 'UTF-8')), 1, 0, 'L');
$pdf->Ln();
$pdf->Cell(110,5, utf8_decode('Razão Social: ' . mb_convert_case($dados[0]['RAZAO_SOCIAL'], MB_CASE_TITLE, 'UTF-8')), 1, 0, 'L');
$pdf->Cell(80,5, utf8_decode('CNPJ: ' . $cnpj), 1, 0, 'L');
$pdf->Ln();
$pdf->Cell(90,5, utf8_decode('CPF: ' . $cpf), 1, 0, 'L');
$pdf->Cell(100	,5, utf8_decode('DAP: ' . $dados[0]['DAP_FORNECEDOR']), 1, 0, 'L');
$pdf->Ln();
$pdf->Cell(100,5, utf8_decode('Inscrição Estadual: ' . $dados[0]['INSCRICAO_ESTADUAL']), 1, 0, 'L');
$pdf->Cell(90,5, utf8_decode('Email: ' . $dados[0]['EMAIL_FORNECEDOR']), 1, 0, 'L');
$pdf->Ln();
$pdf->Cell(35,5, utf8_decode('CEP: ' . $dados[0]['CEP_FORNECEDOR']), 1, 0, 'L');
$pdf->Cell(20,5, utf8_decode('UF: ' . $dados[0]['ESTADO_FORNECEDOR']), 1, 0, 'L');
$pdf->Cell(135,5, utf8_decode('Cidade: ' . mb_convert_case($dados[0]['CIDADE_FORNECEDOR'], MB_CASE_TITLE, 'UTF-8')), 1, 0, 'L');
$pdf->Ln();
$pdf->Cell(90,5, utf8_decode('Bairro: ' . mb_convert_case($dados[0]['BAIRRO_FORNECEDOR'], MB_CASE_TITLE, 'UTF-8')), 1, 0, 'L');
$pdf->Cell(100,5, utf8_decode('Endereço: ' . mb_convert_case($dados[0]['LOGRADOURO_FORNECEDOR'], MB_CASE_TITLE, 'UTF-8')), 1, 0, 'L');
$pdf->Ln();
$pdf->Cell(190,5, utf8_decode('Complemento: ' . mb_convert_case($dados[0]['COMPLEMENTO'], MB_CASE_TITLE, 'UTF-8')), 1, 0, 'L');
$pdf->Ln();
$pdf->Cell(190,5, utf8_decode('Programa de Destino: ' . mb_convert_case($dados[0]['DESC_PROGRAMA'], MB_CASE_TITLE, 'UTF-8') . " - " . $dados[0]['PROGRAMA']), 1, 0, 'L');
$pdf->Ln(20);
$pdf->SetFont('Times','B', 14);
$pdf->Cell(200,5, utf8_decode('ITENS DO PEDIDO'), 0, 1,'C');
$pdf->SetFont('Times','B', 10);
$pdf->Ln();

$pdf->Cell(50,5, utf8_decode("Código do Produto"), 1, 0, 'C');
$pdf->Cell(60,5, utf8_decode("Produto"), 1, 0, 'C');
$pdf->Cell(30,5, utf8_decode("Quantidade"), 1, 0, 'C');
$pdf->Cell(50,5, utf8_decode("Unidade"), 1, 0, 'C');

$pdf->Ln();
$pdf->SetFont('Times','', 10);

foreach ($dados as $value) {
	$pdf->Cell(50,5, utf8_decode($dados[0]['ID_PRODUTO']), 1, 0, 'C');
	$pdf->Cell(60,5, utf8_decode(mb_convert_case($value['DESC_PRODUTO'], MB_CASE_TITLE, 'UTF-8')), 1, 0, 'L');
	$pdf->Cell(30,5, utf8_decode($value['QUANTIDADE']), 1, 0, 'C');
	$pdf->Cell(50,5, utf8_decode($value['DESC_UNIDADE_MEDIDA']), 1, 0, 'C');
	$pdf->Ln();
}
$pdf->Ln(20);
$pdf->Cell(200,5, utf8_decode($this->session->userdata('momeProfissional')), 0, 0, 'C');
$pdf->Ln(0);
$pdf->Cell(200,5, utf8_decode("______________________________________________________"), 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(200,5, utf8_decode("Responsável"), 0, 0, 'C');







$pdf->Output("pedido.pdf", "I");


?>