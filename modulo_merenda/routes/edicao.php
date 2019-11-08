<?php
require_once("vendor/autoload.php");

use Praxis\Page;
use Praxis\Fornecedor;
use Praxis\Categoria;
use Praxis\ControllerAtualizacao;
use Praxis\Programa;
use Praxis\Produto;
use Praxis\Pedidos;
use Praxis\Pesquisa;


$app->post("/editar/categoria/:id", function($id){

	$categoriaProduto = filter_input(INPUT_POST,'categoriaProduto', FILTER_SANITIZE_MAGIC_QUOTES);
	$status = (!isset($_POST['statusCategoria'])) ? "" : filter_input(INPUT_POST,'statusCategoria', FILTER_SANITIZE_MAGIC_QUOTES);

	$categoria = new ControllerAtualizacao([
		"categoria"		=>$categoriaProduto,
		"status"		=>$status,
		"idCategoria"	=>$id
	], "categoria");

	echo "<script>window.location.href='/praxis/modulo_merenda/cadastro/categorias'</script>";
	
});

$app->get("/edicao/categoria/:idCategoria", function($idCategoria){
	
	

	$page = new Page(array(), array(), $_SESSION['id_usuario'], $_SESSION['id_nivel_acesso'], $_SESSION['nome_unidade'], $_SESSION['inep_unidade']);

	$categoria = new Categoria();

	$dados = $categoria->buscarCategoria($idCategoria);

	$page->setTpl("editarCategoria", array(
		"dado"=>$dados
	));

});

$app->get("/edicao/programa/:idPrograma", function($idPrograma){

	

	$page = new Page(array(), array(), $_SESSION['id_usuario'], $_SESSION['id_nivel_acesso'], $_SESSION['nome_unidade'], $_SESSION['inep_unidade']);

	$dados = Programa::buscarPrograma($idPrograma);

	$page->setTpl("editarPrograma", array(
		"info"=>$dados
	));

});

$app->post("/editar/programa/:id", function($id){



	$nomePrograma = filter_input(INPUT_POST,'programa', FILTER_SANITIZE_MAGIC_QUOTES);
	$status = (!isset($_POST['statusPrograma'])) ? "" : filter_input(INPUT_POST,'statusPrograma', FILTER_SANITIZE_MAGIC_QUOTES);

	$programa = new ControllerAtualizacao([
		"programa"	=>$nomePrograma,
		"status"	=>$status,
		"idPrograma"=>$id
	], "programa");

	echo "<script>window.location.href='/praxis/modulo_merenda/cadastro/programas'</script>";
});

$app->get("/edicao/tipos/:idTipo", function($idTipo){

	

	$page = new Page(array(), array(), $_SESSION['id_usuario'], $_SESSION['id_nivel_acesso'], $_SESSION['nome_unidade'], $_SESSION['inep_unidade']);

	$tipo = new Produto();

	$info = $tipo->buscarTipoProduto($idTipo);

	$page->setTpl("editarTipos", array(
		"info"=>$info
	));

});

$app->post("/editar/tipo/:id", function($id){

	$tipoProduto = filter_input(INPUT_POST,'tipoProduto', FILTER_SANITIZE_MAGIC_QUOTES);
	$status = (!isset($_POST['status'])) ? "" : filter_input(INPUT_POST,'status', FILTER_SANITIZE_MAGIC_QUOTES);

	$produto = new ControllerAtualizacao([
		"tipoProduto"	=>$tipoProduto,
		"status"		=>$status,
		"idTipo"		=>$id
	], "tipo");

	echo "<script>window.location.href='/praxis/modulo_merenda/cadastro/tipos'</script>";

});

$app->get("/edicao/fornecedor/:codFornecedor", function($codFornecedor){

	

	$page = new Page(array(), array(), $_SESSION['id_usuario'], $_SESSION['id_nivel_acesso'], $_SESSION['nome_unidade'], $_SESSION['inep_unidade']);

	$fornecedor = new Fornecedor();

	$info 	= $fornecedor->buscarFornecedor($codFornecedor);
	$info2 	= $fornecedor->buscarCategoriasOfertadasFornecedor($codFornecedor);
	$info3	= Categoria::listarCategorias();

	$page->setTpl("editarFornecedor", array(
		"dados"		=>$info,
		"ofertas"	=>$info2,
		"categorias"=>$info3	
	));

});

$app->post("/editar/fornecedor/:codFornecedor", function($codFornecedor){

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

	$fornecedor = new ControllerAtualizacao([
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

	$fornecedor->atualizarCategoriasItensFornecedor($categoria, $idFornecedor);
	
	echo "<script>window.location.href='/praxis/modulo_merenda/cadastro/fornecedores'</script>";

});

$app->get("/edicao/produto/:idProduto", function($idProduto){

	

	$page = new Page(array(), array(), $_SESSION['id_usuario'], $_SESSION['id_nivel_acesso'], $_SESSION['nome_unidade'], $_SESSION['inep_unidade']);

	$produto = new Produto();

	$info = $produto->buscarProduto($idProduto);

	$categoria = Categoria::listarCategorias($info['ID_CATEGORIA']);
	$tipo = Produto::listarTiposProdutos($info['ID_TIPO']);
	$unidade = Produto::listarUnidadesMedida($info['ID_UNIDADE_MEDIDA']);

	$page->setTpl("editarProduto", array(
		"info"		=>$info,
		"categoria"	=>$categoria,
		"tipo"		=>$tipo,
		"unidade"	=>$unidade
	));

});

$app->post("/cadastrar/produto/:idProduto", function($idProduto){

	$categoria 		= filter_input(INPUT_POST,'categoriaProduto', FILTER_SANITIZE_MAGIC_QUOTES);
	$tipoProduto 	= filter_input(INPUT_POST,'tipoProduto', FILTER_SANITIZE_MAGIC_QUOTES);
	$unidadeMedida 	= filter_input(INPUT_POST,'unidadeMedida', FILTER_SANITIZE_MAGIC_QUOTES);
	$produto 		= filter_input(INPUT_POST,'produto', FILTER_SANITIZE_MAGIC_QUOTES);
	$status = (!isset($_POST['status'])) ? "" : filter_input(INPUT_POST,'status', FILTER_SANITIZE_MAGIC_QUOTES);

	$produto = new ControllerAtualizacao([
		"categoria"		=>$categoria,
		"tipoProduto"	=>$tipoProduto,
		"unidadeMedida"	=>$unidadeMedida,
		"produto"		=>$produto,
		"status"		=>$status,
		"idProduto"		=>$idProduto
	], "produto");

	echo "<script>ndow.location.href='/praxis/modulo_merenda/cadastro/produtos'</script>";

});

$app->get("/edicao/pedido/:codPedido", function($codPedido){

	

	$page = new Page(array(), array(), $_SESSION['id_usuario'], $_SESSION['id_nivel_acesso'], $_SESSION['nome_unidade'], $_SESSION['inep_unidade']);

	$pedido = new Pedidos();

	$info 		= $pedido->informacoesPedido($codPedido);
	$info2 		= $pedido->informacoesItensPedido($codPedido);
	$categorias = Pesquisa::buscarCategoriasFornecedor($info['CODIGO_FORNECEDOR']);
	$status 	= Pesquisa::pesquisarStatusPedido($info['STATUS']);

	$page->setTpl("editarPedido", array(
		"informacoes"	=>$info,
		"itens"			=>$info2,
		"categorias"	=>$categorias,
		"status"		=>$status
	));

});


$app->post("/editar/situacaoPedido", function(){

	$codigoPedido = filter_input(INPUT_POST,'codigoPedido', FILTER_SANITIZE_MAGIC_QUOTES);
	$statusPedido = filter_input(INPUT_POST,'statusPedido', FILTER_SANITIZE_MAGIC_QUOTES);

	$pedidos = new ControllerAtualizacao([
		"codigoPedido"=>$codigoPedido,
		"statusPedido"=>$statusPedido
	], "statusPedido");

});




?>