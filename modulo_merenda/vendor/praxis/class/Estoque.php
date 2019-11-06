<?php
namespace Praxis;

use Praxis\Sql;

class Estoque{

	private $sql;
	private $programa;
	private $fornecedor;
	private $produto;
	private $quantidade;


	public function getPrograma(){
        return $this->programa;
    }

    
    public function setPrograma($programa){
        $this->programa = $programa;
    }

    
    public function getFornecedor(){
        return $this->fornecedor;
    }

    
    public function setFornecedor($fornecedor){
        $this->fornecedor = $fornecedor;
    }

    
    public function getProduto(){
        return $this->produto;
    }

    
    public function setProduto($produto){
        $this->produto = $produto;
    }

    
    public function getQuantidade(){
        return $this->quantidade;
    }

    
    public function setQuantidade($quantidade){
        $this->quantidade = $quantidade;
    }



	public function __construct(){
		$this->sql = new Sql();
	}


	private function entradaProdutosEstoque(){

		$this->sql->lastId("INSERT INTO MM_ENTRADA_PRODUTOS(ID_PROGRAMA, ID_PRODUTO, QUANTIDADE, CODIGO_FORNECEDOR) VALUES(:ID_PROGRAMA, :ID_PRODUTO, :QUANTIDADE, :CODIGO_FORNECEDOR)", array(
			":ID_PROGRAMA"		=>$this->getPrograma(),
			":ID_PRODUTO"		=>$this->getProduto(),
			":QUANTIDADE"		=>$this->getQuantidade(),
			":CODIGO_FORNECEDOR"=>$this->getFornecedor()
		));

	}

	private function atualizarEstoque(){
		$this->sql->query("CALL atualizarEstoque(:ID_PROGRAMA, :ID_PRODUTO, :QUANTIDADE, :DATA)", array(
			":ID_PROGRAMA"	=>$this->getPrograma(),
			":ID_PRODUTO"	=>$this->getProduto(),
			":QUANTIDADE"	=>$this->getQuantidade(),
			":DATA"			=>date("Y/m/d")
		));
	}


	public function estoque(){
		$this->entradaProdutosEstoque();
		$this->atualizarEstoque();

	}


    
    
}


?>