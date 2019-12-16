<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Licitacao extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model('produtoModel', 'produto');

		$this->load->model('licitacaoModel', 'licitacao');

		$this->load->model("fornecedorModel", "fornecedor");

		$this->load->library('../controllers/Relatorio.php', "relatorio");

		$this->load->model('pedidoModel', 'pedido');


	}


	public function licitacoesView(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		// $produtos = $this->produto->produtos();
		$fornecedores = $this->fornecedor->listarFornecedores();

		$data['page'] 			= 'licitacoes/licitacoes-view';
		$data['fornecedores'] 	= $fornecedores;
		// $data['produtos'] = $produtos;

		$this->load->view('template/main-view', $data);


	}

	public function pesquisarLicitacoes(){

		// $data 		= $this->input->post('dataPesquisa');
		$fornecedor = $this->input->post('fornecedorPesquisa');
		// $programa 	= $this->input->post('programaPesquisa');
		$status 	= $this->input->post('statusPesquisa');
		$numero 	= $this->input->post('numeroLicitacaoPesquisa');

		// $this->licitacao->setData($data);
		$this->licitacao->setFornecedor($fornecedor);
		// $this->licitacao->setPrograma($programa);
		$this->licitacao->setStatus($status);
		$this->licitacao->setNumero($numero);

		$result = $this->licitacao->pesquisarLicitacao();

		echo json_encode($result);


	}

	public function cadastrarLicitacao(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}


		$this->load->library('form_validation');
		
	    $this->form_validation->set_rules('fim', 'data de fim', 'required', array('required' => 'Você deve preencher a %s.'));
	    $this->form_validation->set_rules('inicio', 'Data de início', 'required', array('required' => 'Você deve preencher a %s.'));
	    $this->form_validation->set_rules('fornecedor', 'Fornecedor', 'required', array('required' => 'Você deve preencher o %s.'));
	    $this->form_validation->set_rules('numeroLicitacao', 'Número da Licitação', 'required', array('required' => 'Você deve preencher o %s.'));


        if ($this->form_validation->run() == FALSE) {
           
           echo json_encode("campos");

        }else{

           	$codigoFornecedor 	= $this->input->post("fornecedor");
           	$numeroLicitacao 	= $this->input->post("numeroLicitacao");
           	$dataFinal 			= $this->input->post("fim");
           	$dataInicial 		= $this->input->post("inicio");

           	$this->licitacao->setFornecedor($codigoFornecedor);
           	$this->licitacao->setNumero($numeroLicitacao);
           	$this->licitacao->setDataInicial($dataInicial);
           	$this->licitacao->setDataFinal($dataFinal);

           	$lastId = $this->licitacao->cadastrarLicitacao();

           	echo json_encode($lastId);

        }
           	

	}

	public function cadastrarItensLicitacao(){

		$this->load->library('form_validation');
		
	    $this->form_validation->set_rules('codigoLicitacao', 'código da licitação', 'required', array('required' => 'Você deve preencher a %s.'));
	    $this->form_validation->set_rules('produtos', 'Produtos', 'required', array('required' => 'Você deve preencher a %s.'));
	    $this->form_validation->set_rules('quantidade', 'Quantidade', 'required', array('required' => 'Você deve preencher o %s.'));


        if ($this->form_validation->run() == FALSE) {
           
           echo json_encode("campos");

        }else{

           	$codigoLicitacao 	= $this->input->post("codigoLicitacao");
           	$produto 		 	= $this->input->post("produtos");
           	$quantidade 		= $this->input->post("quantidade");

           	$this->licitacao->setIdLicitacao($codigoLicitacao);
           	$this->licitacao->setProduto($produto);
           	$this->licitacao->setQuantidade($quantidade);
           	$this->licitacao->setSaldo($quantidade);
           	
           	$this->licitacao->cadastrarItemLicitacao();

           	echo json_encode(['id'=>1]);

        }

	}

	public function itensLicitacaoView($idLicitacao){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$produtos 			= $this->produto->produtos();
		$dadosLicitacao		= $this->licitacao->dadosLicitacao($idLicitacao);

		$data['page'] 		= 'licitacoes/itensLicitacao-view';
		$data['id']			= $idLicitacao;
		$data['produtos'] 	= $produtos;
		$data['dados']		= $dadosLicitacao;

		$this->load->view('template/main-view', $data);

	}

	public function removerItemLicitacao(){

		$idProduto 		= $this->input->post("idProduto");
		$idLicitacao 	= $this->input->post("codigoLicitacao");

		$this->licitacao->setIdLicitacao($idLicitacao);
		$this->licitacao->setProduto($idProduto);

		$this->licitacao->removerProdutoLicitacao();

	}

	public function editarLicitacaoView($idLicitacao){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$produtos 			= $this->produto->produtos();
		$dadosLicitacao		= $this->licitacao->dadosLicitacao($idLicitacao);

		$data['page'] 		= 'licitacoes/editarLicitacao-view';
		$data['dados']		= $dadosLicitacao;
		

		$this->load->view('template/main-view', $data);

	}

	public function relatorioLicitacao($idLicitacao){

		$pdf = $this->relatorio;

		$dados = $this->licitacao->relatorioLicitacao($idLicitacao);
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
		$pdf->Cell(200,5, utf8_decode('PREGÃO PRESENCIAL Nº ' . $dados[0]['NUMERO_LICITACAO'] . '/' . explode(" ", $data_atual)[5]), 0, 1, 'L');
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

	}



}


?>