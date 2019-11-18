<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model("programaModel", "programa");

		$this->load->model("fornecedorModel", "fornecedor");

		$this->load->model("pedidoModel", "pedido");

		$this->load->model("produtoModel", "produto");


	}

	public function viewPedidos(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$programas 				= $this->programa->listarProgramas();

		$fornecedores 			= $this->fornecedor->listarFornecedores();

		$status 				= $this->pedido->listarStatusPedido();

		$data['page']			= "pedidos/pedidos-view";

		$data['programas'] 		= $programas;

		$data['fornecedores'] 	= $fornecedores;

		$data['status'] 		= $status;

		$this->load->view('template/main-view', $data);


	}

	public function codigoPedido(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$codigo = $this->pedido->gerarCodigoPedido();

		echo json_encode($codigo);

	}

	public function viewNovoPedido($codigoPedido){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$fornecedores 			= $this->fornecedor->listarFornecedores();
		$programas 				= $this->programa->listarProgramas();

		$data['page'] 			= "pedidos/novoPedido-view";
		$data['codigo'] 		= $codigoPedido;
		$data['fornecedores'] 	= $fornecedores;
		$data['programas']		= $programas;

		$this->load->view('template/main-view', $data);

	}

	public function cadastrarInfoPedido(){
		
		if($this->session->userdata('logado')){}else {redirect('login');}

		$this->load->library('form_validation');
		
	    $this->form_validation->set_rules('codigoPedido', 'Codigo do Pedido', 'required', array('required' => 'Você deve preencher o %s.'));
	    $this->form_validation->set_rules('fornecedor', 'Nome do Fornecedor', 'required', array('required' => 'Você deve preencher o %s.'));
	    $this->form_validation->set_rules('programa', 'Programa', 'required', array('required' => 'Você deve preencher o %s.'));

	    if ($this->form_validation->run() == FALSE) {
           
        	echo json_encode("");

        }else{
        	$codigoPedido 	= $this->input->post("codigoPedido");
        	$fornecedor 	= $this->input->post("fornecedor");
        	$programa 		= $this->input->post("programa");


        	$this->pedido->setCodigoPedido($codigoPedido);
        	$this->pedido->setCodigoFornecedor($fornecedor);
        	$this->pedido->setPrograma($programa);

        	$this->pedido->novoPedido();

        	echo json_encode(["id"=>1]);

	    }

	}

	


	public function viewProdutosPedido($codigoPedido){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$dadosPedido	 	= $this->pedido->dadosPedido($codigoPedido);
		$categorias			= $this->fornecedor->categoriasOfertadas($dadosPedido['CODIGO_FORNECEDOR']);

		$data['page'] 		= "pedidos/novoPedidoProduto-view";
		$data['codigo'] 	= $codigoPedido;
		$data['pedido']		= $dadosPedido;
		$data['categorias']	= $categorias;

		$this->load->view('template/main-view', $data);

	}

	public function pesquisarProdutoFornecedor(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$this->load->library('form_validation');

		$idCategoria = $this->input->post("idCategoria");

		$produtos = $this->produto->listarProdutosCategoria($idCategoria);

		echo json_encode($produtos);

	}

	public function pesquisarUndiadeMedidaFornecedor(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$this->load->library('form_validation');

		$info = $this->input->post("idProduto");

		$idProduto = explode("/", $info);

		$idProduto = $idProduto[0];

		$unidadeMedida = $this->produto->listarUnidadeMedidaProduto($idProduto);


		echo json_encode($unidadeMedida);

	}

	public function cadastrarItensPedido(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$this->load->library('form_validation');
		
	    $this->form_validation->set_rules('produtos', 'Produto', 'required', array('required' => 'Você deve preencher o %s.'));
	    $this->form_validation->set_rules('codigoPedido', 'Codigo do Pedido', 'required', array('required' => 'Você deve preencher o %s.'));
	    $this->form_validation->set_rules('quantidade', 'Quantidade', 'required', array('required' => 'Você deve preencher o %s.'));

	    if ($this->form_validation->run() == FALSE) {
           
        	echo json_encode("");

        }else{
        	$codigoPedido 	= $this->input->post("codigoPedido");
        	$produto 		= $this->input->post("produtos");
        	$quantidade 	= $this->input->post("quantidade");


        	$this->pedido->setCodigoPedido($codigoPedido);
        	$this->pedido->setProduto($produto);
        	$this->pedido->setQuantidade($quantidade);

        	$result = $this->pedido->cadastrarItensPedido();

        	echo json_encode($result);

	    }

	}

	public function pesquisarPedido(){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$this->load->library('form_validation');

		$fornecedor = $this->input->post("fornecedorPesquisa");
		$data 		= $this->input->post("dataPesquisa");
		$programa 	= $this->input->post("programaPesquisa");
		$situacao 	= $this->input->post("statusPedidoPesquisa");

		$results = $this->pedido->pesquisarPedido($fornecedor, $data, $programa, $situacao);

		echo json_encode($results);


	}


	public function editarPedidoView($codigoPedido){

		if($this->session->userdata('logado')){}else {redirect('login');}

		$dadosPedido 		= $this->pedido->informacoesCompletaPedido($codigoPedido);
		$status 			= $this->pedido->listarStatusPedido($dadosPedido['STATUS']);
		$categorias			= $this->fornecedor->categoriasOfertadas($dadosPedido['CODIGO_FORNECEDOR']);
		$itens 				= $this->pedido->informacoesCompletaItensPedido($codigoPedido);

		$data['page'] 		= "pedidos/edicaoPedido-view";
		$data['codigo'] 	= $codigoPedido;
		$data['info']		= $dadosPedido;
		$data['status']		= $status;
		$data['categorias']	= $categorias;
		$data['itens']		= $itens;
		
		$this->load->view('template/main-view', $data);


	}

	public function editarStatusPedido(){

		$this->load->library('form_validation');

		$status 		= $this->input->post("statusPedido");
		$codigoPedido 	= $this->input->post("codigoPedido");

		$this->pedido->atualizarStatusPedido($codigoPedido, $status);

		if ($status == 3) {
			$itens = $this->pedido->buscarItensPedido($codigoPedido);
			foreach ($itens as $value) {
				
				$this->pedido->setPrograma($value['ID_PROGRAMA']);
				$this->pedido->setProduto($value['ID_PRODUTO']);
				$this->pedido->setQuantidade($value['QUANTIDADE']);
				$this->pedido->setCodigoFornecedor($value['CODIGO_FORNECEDOR']);
				$this->pedido->estoque();

			}
		}


	}

	public function excluirItemPedido(){

		$this->load->library('form_validation');

		$produto 		= $this->input->post("idProduto");
		$codigoPedido 	= $this->input->post("codigoPedido");

		$this->pedido->excluirProdutoPedido($produto, $codigoPedido);

	}


}


?>