<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Licitacao extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model('produtoModel', 'produto');

		$this->load->model('licitacaoModel', 'licitacao');

		$this->load->model("fornecedorModel", "fornecedor");



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



}


?>