<?php
require_once("vendor/autoload.php");

use Praxis\Page;
use Praxis\Cadastros;
use Praxis\Pesquisa;
use Praxis\ControllerCadastro;
use Praxis\ControllerStatus;
use Praxis\Fornecedor;
use Praxis\Categoria;
use Praxis\Programa;



$app->get("/cadastro/fornecedores", function(){

	session_start();

	$page = new Page(array(), array(), $_SESSION['id_usuario'], $_SESSION['id_nivel_acesso'], $_SESSION['nome_unidade'], $_SESSION['inep_unidade']);

	$info = Categoria::listarCategorias();

	$page->setTpl("fornecedores", array(
		"categorias"=>$info
	));

});

$app->get("/cadastro/categorias", function(){

	session_start();

	$page = new Page(array(), array(), $_SESSION['id_usuario'], $_SESSION['id_nivel_acesso'], $_SESSION['nome_unidade'], $_SESSION['inep_unidade']);

	$result = Categoria::listarCategorias('', 3);

	$page->setTpl("categorias", array(
		"categorias"=>$result
	));

});

$app->get("/cadastro/programas", function(){

	session_start();

	$page = new Page(array(), array(), $_SESSION['id_usuario'], $_SESSION['id_nivel_acesso'], $_SESSION['nome_unidade'], $_SESSION['inep_unidade']);

	$result = Programa::listarProgramas(3);

	$page->setTpl("programas", array(
		"programas"=>$result
	));

});

$app->get("/cadastro/tipos", function(){

	session_start();

	$page = new Page(array(), array(), $_SESSION['id_usuario'], $_SESSION['id_nivel_acesso'], $_SESSION['nome_unidade'], $_SESSION['inep_unidade']);

	$result = Pesquisa::listarTipos();

	$page->setTpl("tipos", array(
		"tipos"=>$result
	));

});

$app->get("/cadastro/produtos", function(){

	session_start();

	$page = new Page(array(), array(), $_SESSION['id_usuario'], $_SESSION['id_nivel_acesso'], $_SESSION['nome_unidade'], $_SESSION['inep_unidade']);

	$categoria = Cadastros::buscarCategoriaProduto();

	$tipo = Cadastros::buscarTiposProdutos();

	$unidade = Cadastros::buscarUnidadeMedida();

	$page->setTpl("produtos", array(
		"categoria"	=>$categoria,
		"tipo"		=>$tipo,
		"unidade"	=>$unidade
	));

});

$app->get("/cadastro/pedido/:codigo", function($codigo){

	session_start();

	$page = new Page(array(), array(), $_SESSION['id_usuario'], $_SESSION['id_nivel_acesso'], $_SESSION['nome_unidade'], $_SESSION['inep_unidade']);

	$fornecedores = Pesquisa::listarFornecedores();
	$programas 	= Pesquisa::listarProgramas();

	$page->setTpl("novoPedido", array(
		"fornecedores"=>$fornecedores,
		"programas"	=>$programas,
		"codPedido"	=>$codigo
	));

});


$app->get("/cadastro/pedido/produto/:codigoPedido", function($codigoPedido){

	session_start();

	$page = new Page(array(), array(), $_SESSION['id_usuario'], $_SESSION['id_nivel_acesso'], $_SESSION['nome_unidade'], $_SESSION['inep_unidade']);

	$dados = Pesquisa::dadosPedido($codigoPedido);
	$categorias = Pesquisa::buscarCategoriasFornecedor($dados['CODIGO_FORNECEDOR']);

	$page->setTpl("novoPedidoProduto", array(
		"codPedido"	=>$codigoPedido,
		"dados"		=>$dados,
		"categorias"=>$categorias
	));

});

$app->get("/fornecedor/:codigoFornecedor/novo", function($codigoFornecedor){

	session_start();

	$page = new Page(array(), array(), $_SESSION['id_usuario'], $_SESSION['id_nivel_acesso'], $_SESSION['nome_unidade'], $_SESSION['inep_unidade']);

	$categorias = Categoria::listarCategorias();

	$page->setTpl("novoFornecedor", array(
		"codigoFornecedor"	=>$codigoFornecedor,
		"categorias"		=>$categorias
	));

});

$app->post("/cadastrar/fornecedor", function(){

	$idFornecedor = filter_input(INPUT_POST,'codFornecedor', FILTER_SANITIZE_MAGIC_QUOTES);
	$nomeFornecedor = filter_input(INPUT_POST,'nomeFornecedor', FILTER_SANITIZE_MAGIC_QUOTES);
	$cnpjFornecedor = filter_input(INPUT_POST,'cnpjFornecedor', FILTER_SANITIZE_MAGIC_QUOTES);
	$razaoSocial = filter_input(INPUT_POST,'razaoSocial', FILTER_SANITIZE_MAGIC_QUOTES);
	$inscricaoEstadual = filter_input(INPUT_POST,'inscricaoEstadual', FILTER_SANITIZE_MAGIC_QUOTES);
	$cep = filter_input(INPUT_POST,'cep', FILTER_SANITIZE_MAGIC_QUOTES);
	$estado = filter_input(INPUT_POST,'estadoFornecedor', FILTER_SANITIZE_MAGIC_QUOTES);
	$cidade = filter_input(INPUT_POST,'cidadeFornecedor', FILTER_SANITIZE_MAGIC_QUOTES);
	$bairro = filter_input(INPUT_POST,'bairroFornecedor', FILTER_SANITIZE_MAGIC_QUOTES);
	$logradouro = filter_input(INPUT_POST,'logradouroFornecedor', FILTER_SANITIZE_MAGIC_QUOTES);
	$complemento = filter_input(INPUT_POST,'complementoFornecedor', FILTER_SANITIZE_MAGIC_QUOTES);
	$categoria  = $_POST['categoriasOfertadas'];

	$controller = new ControllerCadastro([
		"codFornecedor"			=>$idFornecedor,
		"nomeFornecedor"		=>$nomeFornecedor,
		"cnpjFornecedor"		=>$cnpjFornecedor,
		"razaoSocial"			=>$razaoSocial,
		"inscricaoEstadual"		=>$inscricaoEstadual,
		"cep"					=>$cep,
		"estadoFornecedor"		=>$estado,
		"cidadeFornecedor"		=>$cidade,
		"bairroFornecedor"		=>$bairro,
		"logradouroFornecedor"	=>$logradouro,
		"complementoFornecedor"	=>$complemento
	], "fornecedor");

	$controller->cadastrarCategoriasItensFornecedor($categoria, $idFornecedor);

	// echo "<script>alert('Fornecedor cadastrado com sucesso'); window.location.href='/praxis/modulo_merenda/cadastro/fornecedores'</script>";
	
});

$app->post("/cadastrar/tipos", function(){

	$tipoProduto = filter_input(INPUT_POST,'tipoProduto', FILTER_SANITIZE_MAGIC_QUOTES);

	$cont = new ControllerCadastro(['tipoProduto'=>$tipoProduto], "tipo");

	echo json_encode($cont);

});

$app->post("/cadastrar/categoria", function(){

	$categoria = filter_input(INPUT_POST,'categoriaProduto', FILTER_SANITIZE_MAGIC_QUOTES);

	$cont = new ControllerCadastro(['categoria'=>$categoria], "categoria");

	echo json_encode($cont);

});

$app->post("/cadastrar/programa", function(){

	$programa = filter_input(INPUT_POST,'programa', FILTER_SANITIZE_MAGIC_QUOTES);

	$cont = new ControllerCadastro(['programa'=>$programa], "programa");

	echo json_encode($cont);

});

$app->post("/cadastrar/produto", function(){

	$categoria 		= filter_input(INPUT_POST,'categoriaProduto', FILTER_SANITIZE_MAGIC_QUOTES);
	$tipo 			= filter_input(INPUT_POST,'tipoProduto', FILTER_SANITIZE_MAGIC_QUOTES);
	$unidadeMedida 	= filter_input(INPUT_POST,'unidadeMedida', FILTER_SANITIZE_MAGIC_QUOTES);
	$produto 		= filter_input(INPUT_POST,'produto', FILTER_SANITIZE_MAGIC_QUOTES);

	$cont = new ControllerCadastro([
		'categoria'		=>$categoria, 
		'tipo'			=>$tipo, 
		'unidadeMedida'	=>$unidadeMedida, 
		'produto'		=>$produto
		], "produto");

	

});

$app->post("/cadastro/itens-fornecedor", function(){

	$produto 	= filter_input(INPUT_POST,'idProduto', FILTER_SANITIZE_MAGIC_QUOTES);
	$fornecedor = filter_input(INPUT_POST,'idFornecedor', FILTER_SANITIZE_MAGIC_QUOTES);

	$cont = new ControllerCadastro(['fornecedor'=>$fornecedor, 'produto'=>$produto], 'itens');
	
	$array = (array)$cont;
	
	$result = Pesquisa::pesquisarItemFornecedor($array['id']);
	
	echo json_encode($result);
	
});

$app->post("/status", function(){
	$id 	= filter_input(INPUT_POST,'id', FILTER_SANITIZE_MAGIC_QUOTES);
	$status = filter_input(INPUT_POST,'novoStatus', FILTER_SANITIZE_MAGIC_QUOTES);
	$tipo 	= filter_input(INPUT_POST,'tipoCadastro', FILTER_SANITIZE_MAGIC_QUOTES);

	$cont = new ControllerStatus($tipo, $id, $status);

	print_r($cont);
});

$app->post("/codFornecedores", function(){
	$cadastro = new Cadastros();

	$cod = $cadastro->gerarCodFornecedor();

	echo json_encode($cod);

});


?>