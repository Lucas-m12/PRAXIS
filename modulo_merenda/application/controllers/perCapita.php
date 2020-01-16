<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PerCapita extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model("produtoModel", "produto");
		$this->load->model("perCapitaModel", "perCapita");
		$this->load->model("receitaModel", "receita");


	}

	public function perCapitaView(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$niveisEnsino			= $this->perCapita->listarNiveisEnsino();

		$data['page']			= "perCapita/perCapita";
		$data['niveisEnsino']	= $niveisEnsino;

		$this->load->view('template/main-view', $data);

	}

	public function cadastroPerCapitaView(){

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

	public function editarPerCapitaView($nivelEnsino){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$dadosPerCapita			= $this->perCapita->infoPerCapita($nivelEnsino);

		$data['page']			= "perCapita/edicaoPerCapita-view";
		$data['perCapita']		= $dadosPerCapita;
		$this->load->view('template/main-view', $data);

	}

	public function valorPercapita(){

		$idProduto 	= $this->input->post("idProduto");
		$nivelEnsino= $this->input->post("nivelEnsino");

		$result 	= $this->perCapita->buscarPerCapita($idProduto, $nivelEnsino);

		echo json_encode($result);

	}

	public function editarPerCapita(){

		$nivelEnsino 	= $this->input->post("nivelEnsino");
		$produto 	 	= $this->input->post("produto");
		$valorPerCapita	= $this->input->post("percapita");

		$this->perCapita->setPerCapita($valorPerCapita);
		$this->perCapita->setNivelEnsino($nivelEnsino);
		$this->perCapita->setProduto($produto);
		
		$this->perCapita->editarPerCapita();

	}

	public function relatorioPercapitaView(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$escolas 			= $this->perCapita->listarUnidadesEnsino();
		$receitas 			= $this->receita->listarReceitas();

		$data['page']		= "relatorios/perCapita/relatorioPercapita-view";
		$data['escolas']	= $escolas;
		$data['receitas']	= $receitas;

		$this->load->view('template/main-view', $data);

	}

	public function relatorioPerCapita(){

		$this->load->library('../controllers/Relatorio.php', "relatorio");

		$receita 		= $this->input->post("receita");
		$unidadeEnsino  = $this->input->post("unidadeEnsino");

		$data['pdf']	= $this->relatorio;

		$data['dados']	= $this->perCapita->dadosPerCapitaRelatorio($unidadeEnsino, $receita);
		
		echo json_encode($this->perCapita->dadosPerCapitaRelatorio($unidadeEnsino, $receita));
		// $this->load->view('relatorios/perCapita/relatorioPercapita', $data);

	}

}

?>