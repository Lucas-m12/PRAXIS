<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estoque extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->model('programaModel', 'programa');
		$this->load->model('categoriaModel', 'categoria');
		$this->load->model('estoqueModel', 'estoque');


	}


	public function estoqueAtual(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$programa 	= $this->programa->listarProgramas();
		$categoria 	= $this->categoria->categorias();

		$data['page'] 		= 'estoque/estoque-view';
		$data['programas'] 	= $programa;
		$data['categorias']	= $categoria;

		$this->load->view('template/main-view', $data);

	}

	public function pesquisarEstoque(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$this->load->library('form_validation');

      	$produto 		= $this->input->post('produtos');
       	$programa 		= $this->input->post('programa');

       	$estoque = $this->estoque->pesquisarEstoque($programa, $produto);

       	echo json_encode($estoque);

	}

}


?>