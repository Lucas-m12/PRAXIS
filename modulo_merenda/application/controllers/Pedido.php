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
        	$escola 		= 1;


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

		$pdf = $this->relatorio;

		$this->pedido->setCodigoPedido($codigoPedido);

		$dados = $this->pedido->relatorioPedido();

		$idUnidade = 1;

		define('FPDF_FONTPATH','font/');
		$pdf->AliasNbPages();
		$pdf->AddPage();

		//Timbre
		$row  = $pdf->Timbre($idUnidade);
		$ds_empresa    = $row['DS_EMPRESA'];
		$ds_cnpj       = $row['CNPJ'];
		$ds_secretaria = $row['SECRETARIA_EDUCACAO'];
		$ds_estado     = $row['NOME_UF'];
		$ds_escola     = $row['NOME_ESCOLA'];
		$ds_inep       = $row['INEP_ESCOLA'];
		$estado_esc    = $row['ESTADO'];
		$uf_esc        = $row['UF'];
		$cidade_esc    = $row['NOME_MUNICIPIO'];

		$pdf->SetFont('Times','',10);
		#PADRONIZANDO O CABEÇALHO DOS RELATÓRIOS#
		$pdf->Image(base_url('assets/img/praxis.png'), 10, 10, 18);
		// Arial bold 15
		$pdf->Image(base_url('assets/img/praxis.png'), 98, 2, 18);
		$pdf->Ln(10);
		$pdf->Cell (198,6, utf8_decode($ds_estado),0,0, 'C');
		$pdf->Ln(4);
		$pdf->Cell (198,6, utf8_decode($ds_empresa),0,0, 'C');
		$pdf->Ln(4);
		$pdf->Cell (198,6, utf8_decode($ds_secretaria),0,0, 'C');
		$pdf->Ln(4);
		$pdf->Cell (190,6, utf8_decode('------------------------------------------------------------------------------------------------------------------------------------------------------------------'),0,0, 'C');
		$pdf->Ln(6);

		setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );             
		$data_atual   = strftime( ' %d de %B de %Y', strtotime(date( 'Y-m-d' ))); // DATA ATUAL       
		$local = $cidade_esc.' - '.$uf_esc.', '.$data_atual.'.';

		#NOME DO RELATÓRIO#
		$pdf->SetFont('Times','B', 14);
		$pdf->Cell(200,5, utf8_decode('INFORMAÇÕES DO PEDIDO'), 0, 1,'C');
		$pdf->Ln(20);
		$pdf->SetFont('Times','', 10);
		$pdf->Cell(35,5, utf8_decode('Código do Pedido: ' . $dados[0]['CODIGO_PEDIDO']), 1, 0, 'L');
		$pdf->Cell(45,5, utf8_decode('Data do Pedido: ' . date("d/m/Y", strtotime(explode(" ", $dados[0]['DATA_PEDIDO'])[0]))), 1, 0, 'L');
		$pdf->Cell(110,5, utf8_decode('Fornecedor: ' . mb_convert_case($dados[0]['NOME_FORNECEDOR'], MB_CASE_TITLE, 'UTF-8')), 1, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(110,5, utf8_decode('Razão Social: ' . mb_convert_case($dados[0]['RAZAO_SOCIAL'], MB_CASE_TITLE, 'UTF-8')), 1, 0, 'L');
		$pdf->Cell(80,5, utf8_decode('CNPJ: ' . $dados[0]['CNPJ_FORNECEDOR']), 1, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(90,5, utf8_decode('CPF: ' . $this->formatCnpjCpf($dados[0]['CPF_FORNECEDOR'])), 1, 0, 'L');
		$pdf->Cell(100	,5, utf8_decode('DAP: ' . $this->formatCnpjCpf($dados[0]['DAP_FORNECEDOR'])), 1, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(100,5, utf8_decode('Inscrição Estadual: ' . $dados[0]['INSCRICAO_ESTADUAL']), 1, 0, 'L');
		$pdf->Cell(90,5, utf8_decode('Email: ' . $dados[0]['EMAIL_FORNECEDOR']), 1, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(35,5, utf8_decode('CEP: ' . $dados[0]['CEP_FORNECEDOR']), 1, 0, 'L');
		$pdf->Cell(20,5, utf8_decode('UF: ' . $dados[0]['ESTADO_FORNECEDOR']), 1, 0, 'L');
		$pdf->Cell(135,5, utf8_decode('Cidade: ' . mb_convert_case($dados[0]['CIDADE_FORNECEDOR'], MB_CASE_TITLE, 'UTF-8')), 1, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(90,5, utf8_decode('Bairro: ' . mb_convert_case($dados[0]['BAIRRO_FORNECEDOR'], MB_CASE_TITLE, 'UTF-8')), 1, 0, 'L');
		$pdf->Cell(100,5, utf8_decode('Endereço: ' . mb_convert_case($dados[0]['LOGRADOURO_FORNECEDOR'], MB_CASE_TITLE, 'UTF-8')), 1, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(190,5, utf8_decode('Complemento: ' . mb_convert_case($dados[0]['COMPLEMENTO'], MB_CASE_TITLE, 'UTF-8')), 1, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(190,5, utf8_decode('Programa de Destino: ' . mb_convert_case($dados[0]['DESC_PROGRAMA'], MB_CASE_TITLE, 'UTF-8') . " - " . $dados[0]['PROGRAMA']), 1, 0, 'L');
		$pdf->Ln(20);
		$pdf->SetFont('Times','B', 14);
		$pdf->Cell(200,5, utf8_decode('ITENS DO PEDIDO'), 0, 1,'C');
		$pdf->SetFont('Times','B', 10);
		$pdf->Ln(10);

		$pdf->Cell(50,5, utf8_decode("CÓDIGO DO PRODUTO"), 1, 0, 'L');
		$pdf->Cell(70,5, utf8_decode("PRODUTO"), 1, 0, 'L');
		$pdf->Cell(70,5, utf8_decode("QUANTIDADE"), 1, 0, 'L');
		$pdf->Ln();
		$pdf->SetFont('Times','', 10);

		foreach ($dados as $value) {
			$pdf->Cell(50,5, utf8_decode($dados[0]['ID_PRODUTO']), 1, 0, 'L');
			$pdf->Cell(70,5, utf8_decode(mb_convert_case($value['DESC_PRODUTO'], MB_CASE_TITLE, 'UTF-8')), 1, 0, 'L');
			$pdf->Cell(70,5, utf8_decode($value['QUANTIDADE'] . " " . $value['SIGLA_UNIDADE_MEDIDA']), 1, 0, 'L');
			$pdf->Ln();
		}







		
		$pdf->Output("pedido.pdf", "I");

	}



}


?>