<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programa extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model('programaModel', 'programa');

	}

	public function listarProgramas(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$result = $this->programa->listarProgramas();

		$data['page'] = 'programas/programas-view';
		$data['programas'] = $result;

		$this->load->view('template/main-view', $data);

	}

	public function edicaoPrograma($idPrograma = false){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$result = $this->programa->dadosPrograma($idPrograma);

		$data['page'] = 'programas/edicaoPrograma';
		$data['dados'] = $result;

		

	}

	public function cadastrarPrograma(){

		if($this->session->userdata('logado')){}else {redirect('login');}


		$this->load->library('form_validation');
		
	    $this->form_validation->set_rules('programa', 'Programa', 'required', array('required' => 'Você deve preencher o %s.'));

        if ($this->form_validation->run() == FALSE) {
           
           $erros = array('mensagens' => validation_errors());
           $this->load->view('programas-view', $erros);

        }else{

           $nomePrograma = $this->input->post('programa');

           $this->programa->setPrograma($nomePrograma);
           $this->programa->cadastrarPrograma();

           echo json_encode(['id'=>1]);

           // redirect("programas");

        }


	}

	public function edicaoProgramaView($idPrograma){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$result = $this->programa->dadosPrograma($idPrograma);

		$data['page'] = 'programas/editarPrograma-view';
		$data['dados'] = $result;

		$this->load->view('template/main-view', $data);		

	}

	public function atualizarPrograma(){

		$this->load->library('form_validation');
		
	    $this->form_validation->set_rules('programa', 'Programa', 'required', array('required' => 'Você deve preencher o %s.'));

        if ($this->form_validation->run() == FALSE) {
           echo json_encode([""]);

        }else{

           $nomePrograma 	= $this->input->post('programa');
           $statusPrograma 	= $this->input->post('statusPrograma');
           $idPrograma 		= $this->input->post('idPrograma');

           $this->programa->setPrograma($nomePrograma);
           $this->programa->setStatus($statusPrograma);
           $this->programa->atualizarPrograma($idPrograma);

           echo json_encode(['id'=>1]);

           // redirect("programas");

        }		

	}

}


?>