<?php
require_once("vendor/autoload.php");

use Praxis\ControllerPedidos;


$app->post("/pedidos/novo", function(){

	$codigoPedido 	= filter_input(INPUT_POST,'codigoPedido', FILTER_SANITIZE_MAGIC_QUOTES);
	$fornecedor 	= filter_input(INPUT_POST,'fornecedor', FILTER_SANITIZE_MAGIC_QUOTES);
	$programa 		= filter_input(INPUT_POST,'programa', FILTER_SANITIZE_MAGIC_QUOTES);

	$pedidos = new ControllerPedidos([
		"codigoPedido"		=>$codigoPedido,
		"codigoFornecedor"	=>$fornecedor,
		"programa"			=>$programa
	], 1);

	echo json_encode($pedidos);

});

$app->post("/pedidos/item", function(){

	$codigoPedido 	= filter_input(INPUT_POST,'codigoPedido', FILTER_SANITIZE_MAGIC_QUOTES);
	$produto 		= filter_input(INPUT_POST,'produtos', FILTER_SANITIZE_MAGIC_QUOTES);
	$quantidade 	= filter_input(INPUT_POST,'quantidade', FILTER_SANITIZE_MAGIC_QUOTES);

	$itens = new ControllerPedidos([
		"codigoPedido"	=>$codigoPedido,
		"produto"		=>$produto,
		"quantidade"	=>$quantidade
	], 2);


});

$app->post("/excluir/produto-pedido", function(){

	$idProduto = filter_input(INPUT_POST,'idProduto', FILTER_SANITIZE_MAGIC_QUOTES);
	$codigoPedido = filter_input(INPUT_POST,'codigoPedido', FILTER_SANITIZE_MAGIC_QUOTES);

	$excluir = new ControllerPedidos(['idProduto'=>$idProduto, 'codigoPedido'=>$codigoPedido], 11);

});




?>