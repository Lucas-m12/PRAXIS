<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receita extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model("receitaModel", "receita");
		$this->load->model("perCapitaModel", "perCapita");
		$this->load->model("produtoModel", "produto");

	}


	public function receitasView(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$data['page'] = 'receitas/receitas-view';

		$this->load->view('template/main-view', $data);

	}

	public function pesquisaReceita(){

		$idReceita 		= $this->input->post("idReceita");
		$nomeReceita 	= $this->input->post("nomeReceita");
		$nivelEnsino 	= $this->input->post("nivelEnsino");


		$this->receita->setIdReceita($idReceita);
		$this->receita->setNomeReceita($nomeReceita);
		$this->receita->setNivelEnsino($nivelEnsino);

		$receitas = $this->receita->pesquisarReceita();

		echo json_encode($receitas);

	}

	public function novaReceitaView(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$produtos 				= $this->produto->produtos();
		$niveisEnsino 			= $this->perCapita->listarNiveisEnsino();

		$data['page'] 			= 'receitas/novaReceita-view';
		$data['produtos']		= $produtos;
		$data['niveisEnsino']	= $niveisEnsino;

		$this->load->view('template/main-view', $data);

	}

	public function cadastrarReceita(){

		$receita 		= $this->input->post("receita");
		$nivelEnsino 	= $this->input->post("nivelEnsino");
		$produtos 		= $this->input->post("produtosReceita");
		$perCapita 		= $this->input->post("perCapita");

		$this->receita->setNomeReceita($receita);
		$this->receita->setNivelEnsino($nivelEnsino);
		$this->receita->setPerCapita($perCapita);

		$idReceita = $this->receita->cadastrarReceita();

		foreach ($produtos as $value) {
			$this->receita->cadastrarProdutosReceita($idReceita, $value);
		}

		redirect(base_url("receitas"));

	}

	public function edicaoReceitaView($idReceita){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$dados					= $this->receita->dadosReceita($idReceita);
		$produtos 				= $this->produto->produtos();
		$niveisEnsino 			= $this->perCapita->listarNiveisEnsino($dados[0]['ID_NIVEL_ENSINO']);

		$data['page'] 			= 'receitas/edicaoReceita-view';
		$data['dados']			= $dados;
		$data['produtos']		= $produtos;
		$data['niveisEnsino']	= $niveisEnsino;

		$this->load->view('template/main-view', $data);

	}

	public function editarReceita(){

		$idReceita 			= $this->input->post("idReceita");
		$nivelEnsino 		= $this->input->post("nivelEnsino");
		$receita 			= $this->input->post("receita");
		$perCapita 			= $this->input->post("perCapita");
		$produtosReceita 	= $this->input->post("produtosReceita");

		$this->receita->setIdReceita($idReceita);
		$this->receita->setNivelEnsino($nivelEnsino);
		$this->receita->setNomeReceita($receita);
		$this->receita->setPerCapita($perCapita);

		$this->receita->editarReceita();
		$this->receita->excluirProdutosReceita($idReceita);
		foreach ($produtosReceita as $value) {
			$this->receita->cadastrarProdutosReceita($idReceita, $value);
					
		}

		redirect(base_url("receitas"));

	}

}


?>