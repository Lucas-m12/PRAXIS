<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Produto extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model("produtoModel", "produto");
		$this->load->model("categoriaModel", "categoria");
		

	}

	public function viewProdutos(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$categorias 			= $this->categoria->categorias();
		$tiposProduto 			= $this->produto->tiposProduto();
		$unidadesMedida			= $this->produto->listarUnidadesMedida();

		$data['page'] 			= 'produtos/produtos-view';
		$data['categorias']		= $categorias;
		$data['tipos']			= $tiposProduto;
		$data['unidadesMedida'] = $unidadesMedida;

		$this->load->view('template/main-view', $data);

	}

	public function viewTiposProdutos(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$result = $this->produto->tiposProduto();

		$data['page'] = 'produtos/tiposProdutos-view';
		$data['tipos'] = $result;

		$this->load->view('template/main-view', $data);

	}

	public function cadastrarTipoProduto(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$this->load->library('form_validation');
		
	    $this->form_validation->set_rules('tipoProduto', 'Tipo de produto', 'required', array('required' => 'Você deve preencher o %s.'));

        if ($this->form_validation->run() == FALSE) {
           
           echo json_encode('');

        }else{

           $tipoProduto = $this->input->post('tipoProduto');

           $this->produto->setTipoProduto($tipoProduto);
           $this->produto->cadastrarTipoProduto();

           echo json_encode(['id'=>1]);

        }

	}

	public function pesquisarProduto(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$this->load->library('form_validation');

      	$nomeProduto 		= $this->input->post('nomeProduto');
       	$categoriaProduto 	= $this->input->post('buscaCategoria');
       	$tipoProduto 		= $this->input->post('buscaTipo');

       	$result = $this->produto->pesquisarProduto($nomeProduto, $tipoProduto, $categoriaProduto);

       	echo json_encode($result);

	}

	public function cadastrarProduto(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$this->load->library('form_validation');
		
	    $this->form_validation->set_rules('tipoProduto', 'Tipo de produto', 'required', array('required' => 'Você deve preencher o %s.'));

	    $this->form_validation->set_rules('categoriaProduto', 'Categoria de produto', 'required', array('required' => 'Você deve preencher o %s.'));

	    $this->form_validation->set_rules('produto', 'Produto', 'required', array('required' => 'Você deve preencher o %s.'));

	    $this->form_validation->set_rules('unidadeMedida', 'Unidade de medida', 'required', array('required' => 'Você deve preencher o %s.'));

        if ($this->form_validation->run() == FALSE) {
           
           echo json_encode('');

        }else{

           $tipoProduto 		= $this->input->post('tipoProduto');
           $categoriaProduto 	= $this->input->post('categoriaProduto');
           $produto 			= $this->input->post('produto');
           $unidadeMedida 		= $this->input->post('unidadeMedida');

           $this->produto->setTipoProduto($tipoProduto);
           $this->produto->setCategoriaProduto($categoriaProduto);
           $this->produto->setProduto($produto);
           $this->produto->setUnidadeMedida($unidadeMedida);
           $this->produto->cadastrarProduto();

           echo json_encode(['id'=>1]);

        }		

	}

	public function atualizarProdutoView($idProduto){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$info 					= $this->produto->informacoesProduto($idProduto);
		$categorias 			= $this->categoria->categorias($info['ID_CATEGORIA']);
		$tiposProduto 			= $this->produto->tiposProduto($info['ID_TIPO']);
		$unidadesMedida			= $this->produto->listarUnidadesMedida($info['ID_UNIDADE_MEDIDA']);

		$data['page'] 			= 'produtos/edicaoProduto-view';
		$data['info']			= $info;
		$data['categorias'] 	= $categorias;
		$data['unidadesMedida'] = $unidadesMedida;
		$data['tipos']			= $tiposProduto;
		

		$this->load->view('template/main-view', $data);		

	}

	public function atualizarProduto(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$this->load->library('form_validation');
		
	    $this->form_validation->set_rules('tipoProduto', 'Tipo de produto', 'required', array('required' => 'Você deve preencher o %s.'));

	    $this->form_validation->set_rules('categoriaProduto', 'Categoria de produto', 'required', array('required' => 'Você deve preencher o %s.'));

	    $this->form_validation->set_rules('produto', 'Produto', 'required', array('required' => 'Você deve preencher o %s.'));

	    $this->form_validation->set_rules('unidadeMedida', 'Unidade de medida', 'required', array('required' => 'Você deve preencher o %s.'));

        if ($this->form_validation->run() == FALSE) {
           
           echo json_encode('');

        }else{

           $tipoProduto 		= $this->input->post('tipoProduto');
           $categoriaProduto 	= $this->input->post('categoriaProduto');
           $produto 			= $this->input->post('produto');
           $unidadeMedida 		= $this->input->post('unidadeMedida');
           $status 				= $this->input->post('status');
           $idProduto 			= $this->input->post('idProduto');

           $this->produto->setTipoProduto($tipoProduto);
           $this->produto->setCategoriaProduto($categoriaProduto);
           $this->produto->setProduto($produto);
           $this->produto->setUnidadeMedida($unidadeMedida);
           $this->produto->setStatus($status);
           $this->produto->atualizarProduto($idProduto);

           echo json_encode(['id'=>1]);

        }
	}

	public function editarTipoProdutoView($idTipo){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$result = $this->produto->dadosTipoProduto($idTipo);

		$data['page'] = 'produtos/edicaoTipoProduto-view';
		$data['dados'] = $result;

		$this->load->view('template/main-view', $data);



	}

	public function atualizarTipoProduto(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$this->load->library('form_validation');
		
	    $this->form_validation->set_rules('tipoProduto', 'Tipo de produto', 'required', array('required' => 'Você deve preencher o %s.'));

        if ($this->form_validation->run() == FALSE) {
           
           echo json_encode('');

        }else{

           $tipoProduto = $this->input->post('tipoProduto');
           $idTipo 		= $this->input->post('idTipo');
           $status 		= $this->input->post('status');

           $this->produto->setTipoProduto($tipoProduto);
           $this->produto->setStatus($status);
           $this->produto->atualizarTipoProduto($idTipo);

           echo json_encode(['id'=>1]);

        }

	}


}


?>