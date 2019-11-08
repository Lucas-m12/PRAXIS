<?php
require_once("vendor/autoload.php");

use Praxis\Page;
use Praxis\Pesquisa;
use Praxis\Categoria;

$app->get("/", function(){

	

	$_SESSION['id_usuario'] = 1;
	$_SESSION['id_unidade'] = 1;
	$_SESSION['id_nivel_acesso'] = 9;
	$_SESSION['inep_unidade'] = 12345678;
	$_SESSION['nome_unidade'] = "SECRETARIA";


	$page = new Page(array(), array(), $_SESSION['id_usuario'], $_SESSION['id_nivel_acesso'], $_SESSION['nome_unidade'], $_SESSION['inep_unidade']);

	$page->setTpl("index");
	


});



$app->get("/pedidos", function(){

	

	$page = new Page(array(), array(), $_SESSION['id_usuario'], $_SESSION['id_nivel_acesso'], $_SESSION['nome_unidade'], $_SESSION['inep_unidade']);

	$fornecedor = Pesquisa::listarFornecedores();
	$programas	= Pesquisa::listarProgramas();
	$status		= Pesquisa::statusPedidos();
	
	$page->setTpl("pedidos", array(
		"fornecedor"=>$fornecedor,
		"programas"	=>$programas,
		"status"	=>$status
	));


});


$app->get("/estoque", function(){

	

	$page = new Page(array(), array(), $_SESSION['id_usuario'], $_SESSION['id_nivel_acesso'], $_SESSION['nome_unidade'], $_SESSION['inep_unidade']);

	$programas 	= Pesquisa::listarProgramas();
	$categorias = Categoria::listarCategorias();

	$page->setTpl("estoque", array(
		"programas"	=>$programas,
		"categorias"=>$categorias
	));

});

$app->post("/pedidos/fornecedor", function(){

	$idFornecedor = filter_input(INPUT_POST,'idFornecedor', FILTER_SANITIZE_MAGIC_QUOTES);

	$pedido = Pedidos::carregarProdutosFornecedor($idFornecedor);

	echo json_encode($pedido);

});

?>