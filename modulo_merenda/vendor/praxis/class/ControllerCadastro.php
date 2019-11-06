<?php
namespace Praxis;

use Praxis\Cadastros;
use Praxis\Fornecedor;
use Praxis\Programa;
use Praxis\Categoria;
use Praxis\Produto;

class ControllerCadastro{

	public $id;
	private $cadastros;

	public function __construct($info = array(), $tipoCadastro){		
		switch ($tipoCadastro) {
			case $tipoCadastro == 'tipo':
				# code...
				$this->cadastros = new Produto();

				$this->cadastros->setTipoProduto($info['tipoProduto']);
				$this->id = $this->cadastros->cadastrarTipoProduto();
				break;
			case $tipoCadastro == 'fornecedor':
				# code...
				$this->cadastros = new Fornecedor();

				$this->cadastros->setCodigoFornecedor($info['codFornecedor']);
				$this->cadastros->setFornecedor($info['nomeFornecedor']);
				$this->cadastros->setCNPJ($info['cnpjFornecedor']);
				$this->cadastros->setRazaoSocial($info['razaoSocial']);
				$this->cadastros->setInscricaoEstadual($info['inscricaoEstadual']);
				$this->cadastros->setCep($info['cep']);
				$this->cadastros->setEstado($info['estadoFornecedor']);
				$this->cadastros->setCidade($info['cidadeFornecedor']);
				$this->cadastros->setBairro($info['bairroFornecedor']);
				$this->cadastros->setLogradouro($info['logradouroFornecedor']);
				$this->cadastros->setComplemento($info['complementoFornecedor']);

				$this->id = $this->cadastros->cadastrarFornecedor();
				break;
			case $tipoCadastro == 'categoria':
				$this->cadastros = new Categoria();

				$this->cadastros->setCategoria($info['categoria']);

				$this->id = $this->cadastros->cadastrarCategoria();
				break;
			case $tipoCadastro == 'programa':
				# code...
				$this->cadastros = new Programa();
				$this->cadastros->setPrograma($info['programa']);

				$this->id = $this->cadastros->cadastrarPrograma();
				break;
			case $tipoCadastro == 'produto':
				# code...
				$this->cadastros = new Produto();

				$this->cadastros->setTipoProduto($info['tipo']);
				$this->cadastros->setCategoria($info['categoria']);
				$this->cadastros->setUnidadeMedida($info['unidadeMedida']);
				$this->cadastros->setProduto($info['produto']);

				$this->id = $this->cadastros->cadastrarProduto();
				break;
			default:
				# code...
				break;
		}

		$this->returnId();
	}

	public function returnId(){
		return $this->id;
	}

	public function cadastrarCategoriasItensFornecedor($categorias = array(), $codFornecedor){
		foreach ($categorias as $value) {
			# code...
			$this->cadastros->cadastrarCategoriasFornecedor($value, $codFornecedor);
		}

	}

}


?>