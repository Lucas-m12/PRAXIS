<?php
defined('BASEPATH') OR exit('No direct script access allowed');



use controllers\Relatorio;

class Estoque extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->model('programaModel', 'programa');
		$this->load->model('categoriaModel', 'categoria');
		$this->load->model('estoqueModel', 'estoque');
		$this->load->library('../controllers/Relatorio.php', "relatorio");


	}


	public function estoqueAtual(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$programa 	= $this->programa->listarProgramas();
		$categoria 	= $this->categoria->categorias();

		$data['page'] 		= 'estoque/estoque-view';
		$data['programas'] 	= $programa;
		$data['categorias']	= $categoria;

		$this->load->view('template/main-view', $data);

	}

	public function pesquisarEstoque(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$this->load->library('form_validation');

      	$produto 		= $this->input->post('produtos');
       	$programa 		= $this->input->post('programa');

       	$estoque = $this->estoque->pesquisarEstoque($programa, $produto);

       	echo json_encode($estoque);

	}

	public function relatorioEstoque(){

		
		$pdf = $this->relatorio;

		$estoque = $this->estoque->relatorioEstoque();

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
		$pdf->Cell(200,5, utf8_decode('ESTOQUE'), 0, 1,'C');
		$pdf->Ln(10);
		$pdf->SetFont('Times','B', 10);
		$pdf->Cell(63, 5, utf8_decode("PROGRAMA"), 1, 0, 'C');
		$pdf->Cell(64, 5, utf8_decode("PRODUTO"), 1, 0, 'C');
		$pdf->Cell(64, 5, utf8_decode("QUANTIDADE ATUAL"), 1, 0, 'C');

		$pdf->Ln();
		$pdf->SetFont('Times', '', 10);

		foreach ($estoque as $value) {
			$pdf->Cell(63, 5, utf8_decode($value['DESC_PROGRAMA']), 1, 0, 'C');
			$pdf->Cell(64, 5, utf8_decode($value['DESC_PRODUTO']), 1, 0, 'C');
			$pdf->Cell(64, 5, utf8_decode($value['ESTOQUE_ATUAL'] . " " . $value['SIGLA_UNIDADE_MEDIDA']), 1, 0, 'C');
			$pdf->Ln();
		}







		$pdf->Output("Matriculados_escola.pdf", "I");


	}

}


?>