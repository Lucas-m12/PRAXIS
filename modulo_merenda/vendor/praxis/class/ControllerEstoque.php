<?php
namespace Praxis;

class ControllerEstoque{

	private $estoque;

	public function __construct($dados = array(), $tipo = ""){

		$this->estoque = new Estoque();

		switch ($tipo) {
			case 1:
				# code...
				foreach ($dados as $value) {
					# code...
					$this->estoque->setPrograma($value['ID_PROGRAMA']);
					$this->estoque->setProduto($value['ID_PRODUTO']);
					$this->estoque->setQuantidade($value['QUANTIDADE']);
					$this->estoque->setFornecedor($value['CODIGO_FORNECEDOR']);
					$this->estoque->estoque();

				}

				break;
			
			default:
				# code...
				break;
		}

	}


}


?>