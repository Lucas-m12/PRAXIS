<?php
require_once("vendor/autoload.php");

use Praxis\Estoque;
use Praxis\ControllerEstoque;
use Praxis\Pedidos;


$app->post("/estoque/entrada", function(){

	$produtos = Pedidos::produtosPedido($_POST['codigoPedido']);

	$controller = new ControllerEstoque($produtos, 1);

	echo json_encode($controller);

});


?>