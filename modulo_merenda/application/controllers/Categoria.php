<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model('categoriaModel', 'categoria');

	}

	public function listarCategorias(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$result = $this->categoria->categorias();

		$data['page'] = 'categorias/categorias-view';
		$data['categorias'] = $result;

		$this->load->view('template/main-view', $data);

	}

	public function cadastrarCategoria(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$this->load->library('form_validation');
		
	    $this->form_validation->set_rules('categoriaProduto', 'Categoria', 'required', array('required' => 'Você deve preencher a %s.'));

        if ($this->form_validation->run() == FALSE) {
           
           echo json_encode('');

        }else{

           $categoriaProduto = $this->input->post('categoriaProduto');

           $this->categoria->setCategoria($categoriaProduto);
           $this->categoria->cadastrarCategoria();

           echo json_encode(['id'=>1]);


        }

	}

	public function editarCategoriaView($idCategoria){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$result = $this->categoria->dadosCategoria($idCategoria);

		$data['page'] = 'categorias/editarCategoria-view';
		$data['dados'] = $result;

		$this->load->view('template/main-view', $data);


	}

	public function atualizarCategoria(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$this->load->library('form_validation');
		
	    $this->form_validation->set_rules('categoriaProduto', 'Categoria', 'required', array('required' => 'Você deve preencher a %s.'));

        if ($this->form_validation->run() == FALSE) {
           
           echo json_encode('');

        }else{

           $categoriaProduto 	= $this->input->post('categoriaProduto');
           $idCategoria 		= $this->input->post('idCategoria');
           $status 				= $this->input->post('statusCategoria');

           $this->categoria->setCategoria($categoriaProduto);
           $this->categoria->setStatus($status);
           $this->categoria->atualizarCategoria($idCategoria);

           echo json_encode(['id'=>1]);


        }

	}

}


?>