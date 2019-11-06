<?php
require_once("../../vendor/autoload.php");

use Praxis\Pedidos;


$tipo = filter_input(INPUT_POST,'tipo', FILTER_SANITIZE_MAGIC_QUOTES);
$id = filter_input(INPUT_POST,'id', FILTER_SANITIZE_MAGIC_QUOTES);
$comboBox = new Pedidos();

switch ($tipo) {
	case $tipo == "categoria":
		# code...
		echo json_encode($comboBox->carregarProdutos($id));
		break;
	
	case $tipo == "produto":
		# code...
	echo json_encode($comboBox->carregarInformacoesProduto($id));
		break;
	default:
		# code...
		break;
}

?>