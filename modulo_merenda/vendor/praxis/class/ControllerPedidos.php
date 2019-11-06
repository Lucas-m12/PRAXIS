<?php
namespace Praxis;

use Praxis\Pedidos;

class ControllerPedidos{
	private $pedidos;
	public $id;

	public function __construct($info = array(), $type){

		$this->pedidos = new Pedidos();

		switch ($type) {
			case 1:
				$this->pedidos->setCodigoFornecedor($info['codigoFornecedor']);
				$this->pedidos->setCodigoPedido($info['codigoPedido']);
				$this->pedidos->setPrograma($info['programa']);

				$this->id = $this->pedidos->novoPedido();

				break;

			case 2:
				$this->pedidos->setCodigoPedido($info['codigoPedido']);
				$this->pedidos->setProduto($info['produto']);
				$this->pedidos->setQuantidade($info['quantidade']);

				$this->pedidos->itensPedido();

				break;



			case 11:
				# code...

				$this->pedidos->excluirProdutoPedido($info['idProduto'], $info['codigoPedido']);
				break;
			
			default:
				break;
		}

		$this->returnId();

	}

	public function returnId(){
		return $this->id;
	}

}


?>