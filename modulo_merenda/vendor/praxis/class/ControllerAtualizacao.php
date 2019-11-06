<?php
namespace Praxis;

use Praxis\Sql;

class ControllerAtualizacao{

	private $class;

	public function __construct($info = array(), $tipoAtualizacao){

		switch ($tipoAtualizacao) {
			case 'categoria':
				# code...
				$status = (empty($info['status'])) ? '' : $info['status'];
				$this->class = new Categoria();
				$this->class->setCategoria($info['categoria']);
				$this->class->setStatus($status);
				$this->class->atualizarCategoria($info['idCategoria']);

				break;

			case 'programa':
				# code...

				$status = (empty($info['status'])) ? '' : $info['status'];

				$this->class = new Programa();
				$this->class->setPrograma($info['programa']);
				$this->class->setStatus($info['status']);
				$this->class->atualizarPrograma($info['idPrograma']);

				break;

			case 'tipo':
				# code...

				$status = (empty($info['status'])) ? '' : $info['status'];

				$this->class = new Produto();
				$this->class->setTipoProduto($info['tipoProduto']);
				$this->class->setStatus($status);
				$this->class->atualizarTipoProduto($info['idTipo']);

				break;

			case 'fornecedor':
				# code...

				$this->class = new Fornecedor();

				$this->class->setFornecedor($info['nomeFornecedor']);
				$this->class->setCNPJ($info['cnpjFornecedor']);
				$this->class->setRazaoSocial($info['razaoSocial']);
				$this->class->setInscricaoEstadual($info['inscricaoEstadual']);
				$this->class->setCep($info['cep']);
				$this->class->setEstado($info['estadoFornecedor']);
				$this->class->setCidade($info['cidadeFornecedor']);
				$this->class->setBairro($info['bairroFornecedor']);
				$this->class->setLogradouro($info['logradouroFornecedor']);
				$this->class->setComplemento($info['complementoFornecedor']);

				$this->class->atualizarFornecedor($info['codFornecedor']);

				break;

			case 'produto':
				# code...

				$this->class = new Produto();

				$this->class->setTipoProduto($info['tipoProduto']);
				$this->class->setCategoria($info['categoria']);
				$this->class->setProduto($info['produto']);
				$this->class->setUnidadeMedida($info['unidadeMedida']);
				$this->class->setStatus($info['status']);

				$this->class->atualizarProduto($info['idProduto']);

				break;

			case 'statusPedido':

				$this->class = new Pedidos();
				$this->class->atualizarStatusPedido($info['codigoPedido'], $info['statusPedido']);
			
			default:
				# code...
				break;
		}

	}


	public function atualizarCategoriasItensFornecedor($categoria = array(), $idFornecedor){
		$this->class->excluirCategoriasItens($idFornecedor);

		foreach ($categoria as $value) {
			# code...
			$this->class->cadastrarCategoriasFornecedor($value, $idFornecedor);
		}
	}

}


?>