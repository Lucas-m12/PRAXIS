<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fornecedor extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model("fornecedorModel", "fornecedor");
		$this->load->model("categoriaModel", "categoria");

	}


	public function viewFornecedores(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$data['page'] = "fornecedores/fornecedores-view";

		$this->load->view('template/main-view', $data);


	}

	public function viewNovoFornecedor($codigoFornecedor){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$categorias = $this->categoria->categorias();

		$data['page'] 		= 'fornecedores/novoFornecedor-view';
		$data['codigo']		= $codigoFornecedor;
		$data['categorias']	= $categorias;

		$this->load->view('template/main-view', $data);

	}

	public function pesquisarFornecedor(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$nomeFornecedor = $this->input->post("nomeFornecedorPesquisa");
		$cnpjFornecedor = $this->input->post("cnpjFornecedorPesquisa");

		$dados = $this->fornecedor->pesquisarFornecedor($nomeFornecedor, $cnpjFornecedor);

		echo json_encode($dados);

	}


	public function codigoFornecedor(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$codigo = $this->fornecedor->gerarCodigoFornecedor();

		echo json_encode($codigo);

	}

	public function cadastrarFornecedor(){

		
		if($this->session->userdata('logado')){}else {redirect('login');}


		$this->load->library('form_validation');
		
	    $this->form_validation->set_rules('codFornecedor', 'Codigo do Fornecedor', 'required', array('required' => 'Você deve preencher o %s.'));
	    $this->form_validation->set_rules('nomeFornecedor', 'Nome do Fornecedor', 'required', array('required' => 'Você deve preencher o %s.'));
	    $this->form_validation->set_rules('razaoSocial', 'Razão Social', 'required', array('required' => 'Você deve preencher o %s.'));
	    $this->form_validation->set_rules('cep', 'CEP', 'required', array('required' => 'Você deve preencher o %s.'));
	    $this->form_validation->set_rules('estadoFornecedor', 'Estado do Fornecedor', 'required', array('required' => 'Você deve preencher o %s.'));
	    $this->form_validation->set_rules('cidadeFornecedor', 'Cidade do Fornecedor', 'required', array('required' => 'Você deve preencher a %s.'));
	    $this->form_validation->set_rules('bairroFornecedor', 'Bairro do Fornecedor', 'required', array('required' => 'Você deve preencher o %s.'));
	    $this->form_validation->set_rules('logradouroFornecedor', 'Logradouro do Fornecedor', 'required', array('required' => 'Você deve preencher o %s.'));
	    $this->form_validation->set_rules('categoriasOfertadas[]', 'Categorias Ofertadas', 'required', array('required' => 'Você deve preencher as %s.'));


        if ($this->form_validation->run() == FALSE) {
           
           // $erros = array('mensagens' => validation_errors());
           // $this->load->view('programas-view', $erros);

        }else{

           	$codigoFornecedor 	= $this->input->post("codFornecedor");
           	$nome 				= $this->input->post("nomeFornecedor");
           	$cnpj 				= $this->input->post("cnpjFornecedor");
           	$cpf 				= $this->input->post("cpfFornecedor");
           	$dap				= $this->input->post("dapFornecedor");
           	$email				= $this->input->post("emailFornecedor");
           	$razaoSocial 		= $this->input->post("razaoSocial");
           	$inscricaoEstadual 	= $this->input->post("inscricaoEstadual");
           	$cep 				= $this->input->post("cep");
           	$estado 			= $this->input->post("estadoFornecedor");
           	$cidade 			= $this->input->post("cidadeFornecedor");
           	$bairro 			= $this->input->post("bairroFornecedor");
           	$logradouro 		= $this->input->post("logradouroFornecedor");
           	$complemento 		= $this->input->post("complemento");
           	$categoriasOfertadas= $this->input->post("categoriasOfertadas");

           	$this->fornecedor->setCodigoFornecedor($codigoFornecedor);
			$this->fornecedor->setFornecedor($nome);
			$this->fornecedor->setCNPJ($cnpj);
			$this->fornecedor->setRazaoSocial($razaoSocial);
			$this->fornecedor->setInscricaoEstadual($inscricaoEstadual);
			$this->fornecedor->setCep($cep);
			$this->fornecedor->setEstado($estado);
			$this->fornecedor->setCidade($cidade);
			$this->fornecedor->setBairro($bairro);
			$this->fornecedor->setLogradouro($logradouro);
			$this->fornecedor->setComplemento($complemento);
			$this->fornecedor->setCpf($cpf);
			$this->fornecedor->setDap($dap);
			$this->fornecedor->setEmail($email);


			$this->fornecedor->cadastrarFornecedor();

			foreach ($categoriasOfertadas as $value) {
				
				$this->fornecedor->cadastrarCategoriasFornecedor($value, $codigoFornecedor);

			}

        }

        redirect(base_url("fornecedores"));
           



	}

	public function editarFornecedorView($codigoFornecedor){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$dadosFornecedor 	= $this->fornecedor->dadosFornecedor($codigoFornecedor);
		$ofertas 			= $this->fornecedor->categoriasOfertadas($codigoFornecedor);
		$categorias 		= $this->categoria->categorias();

		$data['page'] 		= 'fornecedores/editarFornecedor-view';
		$data['codigo']		= $codigoFornecedor;
		$data['dados']		= $dadosFornecedor;
		$data['ofertas']	= $ofertas;
		$data['categorias'] = $categorias;


		$this->load->view('template/main-view', $data);

	}

	public function atualizarFornecedor(){


		if($this->session->userdata('logado')){}else {redirect('login');}


		$this->load->library('form_validation');
		
	    $this->form_validation->set_rules('codFornecedor', 'Codigo do Fornecedor', 'required', array('required' => 'Você deve preencher o %s.'));
	    $this->form_validation->set_rules('nomeFornecedor', 'Nome do Fornecedor', 'required', array('required' => 'Você deve preencher o %s.'));
	    $this->form_validation->set_rules('razaoSocial', 'Razão Social', 'required', array('required' => 'Você deve preencher o %s.'));
	    $this->form_validation->set_rules('cep', 'CEP', 'required', array('required' => 'Você deve preencher o %s.'));
	    $this->form_validation->set_rules('estadoFornecedor', 'Estado do Fornecedor', 'required', array('required' => 'Você deve preencher o %s.'));
	    $this->form_validation->set_rules('cidadeFornecedor', 'Cidade do Fornecedor', 'required', array('required' => 'Você deve preencher a %s.'));
	    $this->form_validation->set_rules('bairroFornecedor', 'Bairro do Fornecedor', 'required', array('required' => 'Você deve preencher o %s.'));
	    $this->form_validation->set_rules('logradouroFornecedor', 'Logradouro do Fornecedor', 'required', array('required' => 'Você deve preencher o %s.'));
	    $this->form_validation->set_rules('categoriasOfertadas[]', 'Categorias Ofertadas', 'required', array('required' => 'Você deve preencher as %s.'));


        if ($this->form_validation->run() == FALSE) {
           
           // $erros = array('mensagens' => validation_errors());
           // $this->load->view('programas-view', $erros);

        }else{

           	$codigoFornecedor 	= $this->input->post("codFornecedor");
           	$nome 				= $this->input->post("nomeFornecedor");
           	$cnpj 				= $this->input->post("cnpjFornecedor");
           	$cpf 				= $this->input->post("cpfFornecedor");
           	$dap				= $this->input->post("dapFornecedor");
           	$email				= $this->input->post("emailFornecedor");
           	$razaoSocial 		= $this->input->post("razaoSocial");
           	$inscricaoEstadual 	= $this->input->post("inscricaoEstadual");
           	$cep 				= $this->input->post("cep");
           	$estado 			= $this->input->post("estadoFornecedor");
           	$cidade 			= $this->input->post("cidadeFornecedor");
           	$bairro 			= $this->input->post("bairroFornecedor");
           	$logradouro 		= $this->input->post("logradouroFornecedor");
           	$complemento 		= $this->input->post("complementoFornecedor");
           	$categoriasOfertadas= $this->input->post("categoriasOfertadas");

           	$status 			= (isset($_POST['status'])) ? $this->input->post("status") : 1;

			$this->fornecedor->setFornecedor($nome);
			$this->fornecedor->setCNPJ($cnpj);
			$this->fornecedor->setRazaoSocial($razaoSocial);
			$this->fornecedor->setInscricaoEstadual($inscricaoEstadual);
			$this->fornecedor->setCep($cep);
			$this->fornecedor->setEstado($estado);
			$this->fornecedor->setCidade($cidade);
			$this->fornecedor->setBairro($bairro);
			$this->fornecedor->setLogradouro($logradouro);
			$this->fornecedor->setComplemento($complemento);
			$this->fornecedor->setStatus($status);
			$this->fornecedor->setCpf($cpf);
			$this->fornecedor->setDap($dap);
			$this->fornecedor->setEmail($email);
			$this->fornecedor->setCodigoFornecedor($codigoFornecedor);
			
			$this->fornecedor->excluirCategoriasItens();
			$this->fornecedor->atualizarFornecedor();


			foreach ($categoriasOfertadas as $value) {
				
				$this->fornecedor->cadastrarCategoriasFornecedor($value, $codigoFornecedor);

			}

        }

        redirect(base_url("fornecedores"));

	}

}


?>