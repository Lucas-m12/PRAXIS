<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model("programaModel", "programa");

		$this->load->model("fornecedorModel", "fornecedor");

		$this->load->model("pedidoModel", "pedido");

		$this->load->model("produtoModel", "produto");

		$this->load->model("categoriaModel", "categoria");

		$this->load->model("licitacaoModel", "licitacao");

		$this->load->library('../controllers/Relatorio.php', "relatorio");

		



	}

	public function email($codigoFornecedor){
		$this->load->library('email');
		$dados = $this->fornecedor->dadosFornecedor($codigoFornecedor);

		$this->email->from($emailDestinatario, $destinatario);
		$this->email->to($emailRemetente);
		$this->email->subject('Send Email Codeigniter');
		$this->email->message('The email send using codeigniter library');

	}

	public function viewPedidos(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$programas 				= $this->programa->listarProgramas();

		$fornecedores 			= $this->fornecedor->listarFornecedores();

		$status 				= $this->pedido->listarStatusPedido();

		$data['page']			= "pedidos/pedidos-view";

		$data['programas'] 		= $programas;

		$data['fornecedores'] 	= $fornecedores;

		$data['status'] 		= $status;

		$this->load->view('template/main-view', $data);


	}

	public function viewPedidoEscola(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$programas 				= $this->programa->listarProgramas();

		$fornecedores 			= $this->fornecedor->listarFornecedorEscola();

		$status 				= $this->pedido->listarStatusPedido();

		$data['page']			= "pedidos/pedidosEscola-view";

		$data['programas'] 		= $programas;

		$data['fornecedores'] 	= $fornecedores;

		$data['status'] 		= $status;

		$this->load->view('template/main-view', $data);

	}

	public function listaPedidosEscolaView(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$status 		= $this->pedido->listarStatusPedido();
		$escolas		= $this->pedido->listarUnidadesEnsino();

		$data['page']	= "pedidos/listaPedidosEscola-view";
		$data['status']	= $status;
		$data['escolas']= $escolas;

		$this->load->view('template/main-view', $data);

	}

	public function listarPedidosEscola(){

		$this->load->library('form_validation');

		$escola = $this->input->post("escolaPesquisa");
		$status = $this->input->post("statusPedidoPesquisa");

		$this->pedido->setEscola($escola);
		$this->pedido->setStatus($status);
		$dados = $this->pedido->listarPedidosEscola();

		echo json_encode($dados);

	}

	public function codigoPedido(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$codigo = $this->pedido->gerarCodigoPedido();

		echo json_encode($codigo);

	}

	public function codigoPedidoEscola(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$codigo = $this->pedido->gerarCodigoPedidoEscola();

		echo json_encode($codigo);

	}

	public function viewNovoPedido($codigoPedido){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$fornecedores 			= $this->fornecedor->listarFornecedoresLicitados();
		$programas 				= $this->programa->listarProgramas();

		$data['page'] 			= "pedidos/novoPedido-view";
		$data['codigo'] 		= $codigoPedido;
		$data['fornecedores'] 	= $fornecedores;
		$data['programas']		= $programas;

		$this->load->view('template/main-view', $data);

	}

	public function cadastrarInfoPedido(){
		
		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

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


	public function cadastrarInfoPedidoEscola(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

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
        	$escola 		= $this->session->userdata('ID_UNIDADE');


        	$this->pedido->setCodigoPedido($codigoPedido);
        	$this->pedido->setCodigoFornecedor($fornecedor);
        	$this->pedido->setPrograma($programa);
        	$this->pedido->setEscola($escola);

        	$this->pedido->novoPedidoEscola();

        	echo json_encode(["id"=>1]);

	    }

	}

	


	public function viewProdutosPedido($codigoPedido){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$dadosPedido	 	= $this->pedido->dadosPedido($codigoPedido);
		$produtos			= $this->fornecedor->produtosLicitados($dadosPedido['CODIGO_FORNECEDOR']);

		$data['page'] 		= "pedidos/novoPedidoProduto-view";
		$data['codigo'] 	= $codigoPedido;
		$data['pedido']		= $dadosPedido;
		$data['produtos']	= $produtos;

		// echo json_encode($produtos);
		$this->load->view('template/main-view', $data);

	}

	public function pesquisarProdutoFornecedor(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$this->load->library('form_validation');

		$idCategoria = $this->input->post("idCategoria");

		$produtos = $this->produto->listarProdutosCategoria($idCategoria);

		echo json_encode($produtos);

	}

	public function pesquisarUndiadeMedidaFornecedor(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$this->load->library('form_validation');

		$info = $this->input->post("idProduto");

		$idProduto = explode("/", $info);

		$idProduto = $idProduto[0];

		$unidadeMedida = $this->produto->listarUnidadeMedidaProduto($idProduto);


		echo json_encode($unidadeMedida);

	}

	public function cadastrarItensPedido(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

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


	public function cadastrarItensPedidoEscola(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

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
        	// $escola 		= 1;

        	$this->pedido->setCodigoPedido($codigoPedido);
        	$this->pedido->setProduto($produto);
        	$this->pedido->setQuantidade($quantidade);
        	// $this->pedido->setEscola($escola);

        	$this->pedido->cadastrarItensPedidoEscola();

        	echo json_encode(['id'=>1]);

	    }

	}

	public function pesquisarPedido(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$this->load->library('form_validation');

		$fornecedor = $this->input->post("fornecedorPesquisa");
		$data 		= $this->input->post("dataPesquisa");
		$programa 	= $this->input->post("programaPesquisa");
		$situacao 	= $this->input->post("statusPedidoPesquisa");

		$results = $this->pedido->pesquisarPedido($fornecedor, $data, $programa, $situacao);

		echo json_encode($results);


	}

	public function pesquisarPedidoEscola(){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$this->load->library('form_validation');

		$fornecedor = $this->input->post("fornecedorPesquisa");
		$data 		= $this->input->post("dataPesquisa");
		$programa 	= $this->input->post("programaPesquisa");
		$situacao 	= $this->input->post("statusPedidoPesquisa");

		$results = $this->pedido->pesquisarPedidoEscola($fornecedor, $data, $programa, $situacao);

		echo json_encode($results);


	}


	public function editarPedidoView($codigoPedido){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$dadosPedido 		= $this->pedido->informacoesCompletaPedido($codigoPedido);
		$status 			= $this->pedido->listarStatusPedido($dadosPedido['STATUS']);
		$itens 				= $this->pedido->informacoesCompletaItensPedido($codigoPedido);
		$produtos 			= $this->fornecedor->produtosLicitados($dadosPedido['CODIGO_FORNECEDOR']);

		$data['page'] 		= "pedidos/edicaoPedido-view";
		$data['codigo'] 	= $codigoPedido;
		$data['info']		= $dadosPedido;
		$data['status']		= $status;
		$data['itens']		= $itens;
		$data['produtos']	= $produtos;
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

	public function editarStatusPedidoEscola(){

		$this->load->library('form_validation');

		$status 		= $this->input->post("statusPedido");
		$codigoPedido 	= $this->input->post("codigoPedido");

		$this->pedido->atualizarStatusPedidoEscola($codigoPedido, $status);

		if ($status == 3) {
			$itens = $this->pedido->buscarItensPedidoEscola($codigoPedido);
			foreach ($itens as $value) {
				
				$this->pedido->setPrograma($value['ID_PROGRAMA']);
				$this->pedido->setProduto($value['ID_PRODUTO']);
				$this->pedido->setQuantidade($value['QUANTIDADE']);
				$this->pedido->setCodigoFornecedor($value['CODIGO_FORNECEDOR']);
				$this->pedido->setEscola($value['ID_ESCOLA']);
				$this->pedido->estoqueEscola();

			}
		}

	}

	public function novoPedidoEscolaView($codigoPedido){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$fornecedores 			= $this->fornecedor->listarFornecedorEscola();
		$programas 				= $this->programa->listarProgramas();

		$data['page'] 			= "pedidos/novoPedidoEscola-view";
		$data['codigo'] 		= $codigoPedido;
		$data['fornecedores'] 	= $fornecedores;
		$data['programas']		= $programas;

		$this->load->view('template/main-view', $data);

	}

	public function excluirItemPedido(){

		$this->load->library('form_validation');

		$produto 		= $this->input->post("idProduto");
		$codigoPedido 	= $this->input->post("codigoPedido");
		$quantidade 	= $this->input->post("quantidade");

		$this->licitacao->alterarSaldo($codigoPedido, $produto, $quantidade);

		$this->pedido->excluirProdutoPedido($produto, $codigoPedido);

	}

	public function excluirItemPedidoEscola(){

		$this->load->library('form_validation');

		$produto 		= $this->input->post("idProduto");
		$codigoPedido 	= $this->input->post("codigoPedido");

		$this->pedido->excluirProdutoPedidoEscola($produto, $codigoPedido);

	}

	public function ItensPedidoEscolaView($codigoPedido){

		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$dadosPedido	 	= $this->pedido->dadosPedidoEscola($codigoPedido);
		$categorias			= $this->categoria->categorias();

		$data['page'] 		= "pedidos/novoPedidoProdutoEscola-view";
		$data['codigo'] 	= $codigoPedido;
		$data['pedido']		= $dadosPedido;
		$data['categorias']	= $categorias;

		$this->load->view('template/main-view', $data);

	}

	public function formatCnpjCpf($value){
	  $cnpj_cpf = preg_replace("/\D/", '', $value);
	  
	  if (strlen($cnpj_cpf) === 11) {
	    return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
	  } 
	  
	  return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
	}

	public function relatorioPedido($codigoPedido){

		

		$this->pedido->setCodigoPedido($codigoPedido);

		$dados = $this->pedido->relatorioPedido();

		$data['pdf']	= $this->relatorio;
		$data['dados']	= $dados;
		$data['cpf']	= $this->formatCnpjCpf($dados[0]['CPF_FORNECEDOR']);
		$data['cnpj']	= $this->formatCnpjCpf($dados[0]['CNPJ_FORNECEDOR']);

		$this->load->view("relatorios/pedido/pedido", $data);
		

	}



	public function viewPedidosGestor(){
		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$dadosPedidos 	= $this->pedido->dadosPedidosGestor();

		$data['page'] 	= "gestor/pedidos-view";
		$data['dados']	= $dadosPedidos;
		$this->load->view("template/main-view", $data);

	}

	public function viewAutorizacaoPedido($codigoPedido){
		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$dadosPedido 	= $this->pedido->dadosPedidoAutorizacao($codigoPedido);

		$data['page']	= 'gestor/autorizacao-view';
		$data['dados']	= $dadosPedido;

		$this->load->view("template/main-view", $data);

	}

	public function editarStatusPedidoEscolaView($codigoPedido){
		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$dadosPedido 	= $this->pedido->informacoesPedidoEscola($codigoPedido);

		$data['page']	= 'pedidos/autorizacaoPedidoEscola-view';
		$data['dados']	= $dadosPedido;

		$this->load->view("template/main-view", $data);
	}

	public function autorizarPedidoEscola(){

		$codigoPedido 	= $this->input->post("codigoPedido");
		$info 			= $this->pedido->buscarItensPedidoEscola($codigoPedido);

		$this->pedido->setCodigoPedido($codigoPedido);
		$this->pedido->autorizarPedidoEscola();

		foreach ($info as $value) {
			$this->pedido->setPrograma($value['ID_PROGRAMA']);
			$this->pedido->setEscola($value['ID_ESCOLA']);
			$this->pedido->setProduto($value['ID_PRODUTO']);
			$this->pedido->setQuantidade($value['QUANTIDADE']);
			$this->pedido->saidaProdutoCentral();
			$this->pedido->diminuirEstoqueCentral();
		}

		redirect(base_url('pedidos-pendentesEscola'));

	}

	public function editarPedidoEscolaView($codigoPedido){
		if($this->session->userdata('logado')){}else {redirect(base_url('login'));}

		$info 				= $this->pedido->informacoesPedidoEscola($codigoPedido);
		$status 			= $this->pedido->listarStatusPedido($info[0]['STATUS']);
		$produtos 			= $this->fornecedor->listarProdutosEscola();

		$data['page']		= 'pedidos/edicaoPedidoEscola-view';
		$data['info']		= $info;
		$data['status']		= $status;
		$data['produtos']	= $produtos;

		$this->load->view("template/main-view", $data);

	}





}


?>