<?php
require_once("vendor/autoload.php");

use Praxis\Pesquisa;
use Praxis\Pedidos;

$app->post("/pesquisa/produto", function(){

	$categoria = filter_input(INPUT_POST,'buscaCategoria', FILTER_SANITIZE_MAGIC_QUOTES);
	$tipo = filter_input(INPUT_POST,'buscaTipo', FILTER_SANITIZE_MAGIC_QUOTES);
	$nome = filter_input(INPUT_POST,'nomeProduto', FILTER_SANITIZE_MAGIC_QUOTES);

	$pesquisa = Pesquisa::pesquisarProduto($tipo, $categoria, $nome);

	echo json_encode($pesquisa);

});

$app->post("/pesquisa/fornecedor", function(){

	$fornecedor = filter_input(INPUT_POST,'nomeFornecedorPesquisa', FILTER_SANITIZE_MAGIC_QUOTES);
	$cnpj 		= filter_input(INPUT_POST,'cnpjFornecedorPesquisa', FILTER_SANITIZE_MAGIC_QUOTES);

	$pesquisa = Pesquisa::pesquisarFornecedor($fornecedor, $cnpj);

	echo json_encode($pesquisa);

});

$app->post("/pesquisa/pedido", function(){

	$fornecedor = filter_input(INPUT_POST,'fornecedorPesquisa', FILTER_SANITIZE_MAGIC_QUOTES);
	$data 		= filter_input(INPUT_POST,'dataPesquisa', FILTER_SANITIZE_MAGIC_QUOTES);
	$programa	= filter_input(INPUT_POST,'programaPesquisa', FILTER_SANITIZE_MAGIC_QUOTES);
	$status		= filter_input(INPUT_POST,'statusPedidoPesquisa', FILTER_SANITIZE_MAGIC_QUOTES);

	$pesquisa = Pesquisa::pesquisarPedido($fornecedor, $data, $programa, $status);

	echo json_encode($pesquisa);

});

$app->post("/pesquisa/codigo/pedido", function(){

	$codPedido = Pesquisa::pesquisarCodPedido();

	echo json_encode($codPedido);

});

$app->post("/pedidos/pesquisa/fornecedores", function(){

	$dado = filter_input(INPUT_POST,'dado', FILTER_SANITIZE_MAGIC_QUOTES);
	$tipo = filter_input(INPUT_POST,'type', FILTER_SANITIZE_MAGIC_QUOTES);

	switch ($tipo) {
		case 1:
			# code...
			$categorias = Pesquisa::buscarCategoriasFornecedor($dado);

			echo json_encode($categorias);

			break;
		
		case 2:
			# code...
			$produtos = Pesquisa::buscarProdutosPedido($dado);

			echo json_encode($produtos);

			break;

		case 3:
			# code...
			$unidade = Pesquisa::buscarUnidadeMedidaPedido($dado);

			echo json_encode($unidade);

			break;

		default:
			# code...
			break;
	}

	

});

$app->post("/pesquisa/produtos", function(){

	$categoria = filter_input(INPUT_POST,'idCategoria', FILTER_SANITIZE_MAGIC_QUOTES);

	$produtos = Pesquisa::pesquisarProdutos($categoria);

	echo json_encode($produtos);

});

$app->post("/pesquisa/estoque", function(){

	$programa 	= filter_input(INPUT_POST,'programa', FILTER_SANITIZE_MAGIC_QUOTES);
	$produto 	= filter_input(INPUT_POST,'produtos', FILTER_SANITIZE_MAGIC_QUOTES);

	$resultado = Pesquisa::dadosEstoque($programa, $produto);

	echo json_encode($resultado);

});

$app->post("/pesquisa/itens/itens-pedido/", function(){

	$codigoPedido = filter_input(INPUT_POST,'codigoPedido', FILTER_SANITIZE_MAGIC_QUOTES);

	$pedido = new Pedidos();

	$dados = $pedido->informacoesItensPedido($codigoPedido);

	echo json_encode($dados);

});


?>