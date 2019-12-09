<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PerCapita extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model("produtoModel", "produto");
		$this->load->model("perCapitaModel", "perCapita");


	}

	public function perCapitaView(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$niveisEnsino			= $this->perCapita->listarNiveisEnsino();
		$produtos				= $this->produto->produtos();

		$data['page']			= "perCapita/perCapita-view";
		$data['niveisEnsino']	= $niveisEnsino;
		$data['produtos']		= $produtos;

		$this->load->view('template/main-view', $data);

	}

	public function cadastrarPerCapita(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$this->load->library('form_validation');
		
	    $this->form_validation->set_rules('nivelEnsino', 'Nivel de Ensino', 'required', array('required' => 'Você deve preencher o %s.'));

	    $this->form_validation->set_rules('produto', 'Produto', 'required', array('required' => 'Você deve preencher o %s.'));

	    $this->form_validation->set_rules('percapita', 'perCapita', 'required', array('required' => 'Você deve preencher o %s.'));

        if ($this->form_validation->run() == FALSE) {
           
           echo json_encode('');

        }else{

           $nivelEnsino = $this->input->post('nivelEnsino');
           $produto 	= $this->input->post('produto');
           $percapita 	= $this->input->post('percapita');

           $this->perCapita->setNivelEnsino($nivelEnsino);
           $this->perCapita->setProduto($produto);
           $this->perCapita->setPerCapita($percapita);

           $this->perCapita->cadastrarPerCapita();

           echo json_encode(['id'=>1]);


        }

	}

}

?>