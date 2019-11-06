<?php
namespace Praxis;

use Praxis\Sql;



class Cadastros{

	private $codigoFornecedor;
	private $fornecedor;
	private $cnpj;
	private $razaoSocial;
	private $inscricaoEstadual;
	private $cep;
	private $estado;
	private $cidade;
	private $bairro;
	private $logradouro;
	private $complemento;
	private $tipoProduto;
	private $categoria;
	private $programa;
	private $unidadeMedida;
	private $produto;

	public function getCodigoFornecedor(){
		return $this->codigoFornecedor;
	}
	
	public function getFornecedor(){
		return $this->fornecedor;
	}

	public function getCNPJ(){
		return $this->cnpj;
	}

	public function getTipoProduto(){
		return $this->tipoProduto;
	}

	public function getCategoria(){
		return $this->categoria;
	}

	public function getPrograma(){
		return $this->programa;
	}

	public function getUnidadeMedida(){
		return $this->unidadeMedida;
	}

	public function getProduto(){
		return $this->produto;
	}

	public function getRazaoSocial(){
		return $this->razaoSocial;
	}

	public function getInscricaoEstadual(){
		return $this->inscricaoEstadual;
	}

	public function getCep(){
		return $this->cep;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function getCidade(){
		return $this->cidade;
	}

	public function getBairro(){
		return $this->bairro;
	}

	public function getLogradouro(){
		return $this->logradouro;
	}

	public function getComplemento(){
		return $this->complemento;
	}



	public function setCodigoFornecedor($value){
		$this->codigoFornecedor = mb_strtoupper($value);
	}
	
	public function setFornecedor($value){
		$this->fornecedor = mb_strtoupper($value);
	}

	public function setCNPJ($value){
		$this->cnpj = mb_strtoupper($value);
	}

	public function setTipoProduto($value){
		$this->tipoProduto = mb_strtoupper($value);
	}

	public function setCategoria($value){
		$this->categoria = mb_strtoupper($value);
	}

	public function setPrograma($value){
		$this->programa = mb_strtoupper($value);
	}

	public function setUnidadeMedida($value){
		$this->unidadeMedida = mb_strtoupper($value);
	}

	public function setProduto($value){
		$this->produto = mb_strtoupper($value);
	}

	public function setRazaoSocial($value){
		$this->razaoSocial = mb_strtoupper($value);
	}

	public function setInscricaoEstadual($value){
		$this->inscricaoEstadual = mb_strtoupper($value);
	}

	public function setCep($value){
		$this->cep = mb_strtoupper($value);
	}

	public function setEstado($value){
		$this->estado = mb_strtoupper($value);
	}

	public function setCidade($value){
		$this->cidade = mb_strtoupper($value);
	}

	public function setBairro($value){
		$this->bairro = mb_strtoupper($value);
	}

	public function setLogradouro($value){
		$this->logradouro = mb_strtoupper($value);
	}

	public function setComplemento($value){
		$this->complemento = mb_strtoupper($value);
	}




	/*public static function buscarDadosProdutos(){
		$sql = new Sql();

		return $sql->select("SELECT MP.ID_PRODUTO, MP.DESC_PRODUTO, MCP.DESC_CATEGORIA FROM MM_PRODUTOS MP INNER JOIN MM_CATEGORIA_PRODUTO MCP USING(ID_CATEGORIA) WHERE MP.STATUS = :STATUS", array(
			":STATUS"=>1
		));

	}*/

	// Não se usa mais
	public static function buscarCategoriaProduto(){
		$sql = new Sql();

		return $sql->select("SELECT MCP.ID_CATEGORIA, MCP.DESC_CATEGORIA FROM MM_CATEGORIA_PRODUTO MCP WHERE MCP.STATUS = :STATUS", array(
			":STATUS"=>1
		));

	}

	public static function buscarTiposProdutos(){
		$sql = new Sql();

		return $sql->select("SELECT ID_TIPO, TIPO_PRODUTO FROM MM_TIPO_PRODUTOS WHERE STATUS = :STATUS", array(
			":STATUS"=>1
		));

	}

	public static function buscarUnidadeMedida(){
		$sql = new Sql();

		return $sql->select("SELECT ID_UNIDADE_MEDIDA, DESC_UNIDADE_MEDIDA FROM MM_UNIDADES_MEDIDA WHERE STATUS = :STATUS", array(
			":STATUS"=>1
		));

	}

	// Não se usa mais
	public function cadastrarFornecedor(){
		$sql = new Sql();

		return $sql->lastId("INSERT INTO MM_FORNECEDOR(CODIGO_FORNECEDOR, NOME_FORNECEDOR, CNPJ_FORNECEDOR, RAZAO_SOCIAL, INSCRICAO_ESTADUAL, CEP_FORNECEDOR, ESTADO_FORNECEDOR, CIDADE_FORNECEDOR, BAIRRO, LOGRADOURO_FORNECEDOR, COMPLEMENTO) VALUES (:CODIGO_FORNECEDOR, :NOME_FORNECEDOR, :CNPJ_FORNECEDOR, :RAZAO_SOCIAL, :INSCRICAO_ESTADUAL, :CEP_FORNECEDOR, :ESTADO_FORNECEDOR, :CIDADE_FORNECEDOR, :BAIRRO, :LOGRADOURO_FORNECEDOR, :COMPLEMENTO)", array(
			":CODIGO_FORNECEDOR"	=>$this->getCodigoFornecedor(),
			":NOME_FORNECEDOR"		=>$this->getFornecedor(),
			":CNPJ_FORNECEDOR"		=>$this->getCNPJ(),
			":RAZAO_SOCIAL"			=>$this->getRazaoSocial(), 
			":INSCRICAO_ESTADUAL"	=>$this->getInscricaoEstadual(), 
			":CEP_FORNECEDOR"		=>$this->getCep(), 
			":ESTADO_FORNECEDOR"	=>$this->getEstado(), 
			":CIDADE_FORNECEDOR"	=>$this->getCidade(), 
			":BAIRRO"				=>$this->getBairro(), 
			":LOGRADOURO_FORNECEDOR"=>$this->getLogradouro(), 
			":COMPLEMENTO"			=>$this->getComplemento()
		));

	}


	// Não se usa mais
	public function cadastrarTipoProduto(){
		$sql = new Sql();

		return $sql->lastId("INSERT INTO MM_TIPO_PRODUTOS(TIPO_PRODUTO) VALUES (:TIPO_PRODUTO)", array(
			":TIPO_PRODUTO"=>$this->getTipoProduto()
		));
	}

	//Não se usa mais
	public function cadastrarCategoria(){
		$sql = new Sql();

		return $sql->lastId("INSERT INTO MM_CATEGORIA_PRODUTO(DESC_CATEGORIA) VALUES(:DESC_CATEGORIA)", array(
			":DESC_CATEGORIA"=>$this->getCategoria()
		));
	}

	// Não se usa mais
	public function cadastrarPrograma(){
		$sql = new Sql();

		return $sql->lastId("INSERT INTO MM_PROGRAMAS(DESC_PROGRAMA) VALUES(:DESC_PROGRAMA)", array(
			":DESC_PROGRAMA"=>$this->getPrograma()
		));

	}

	// Não se usa mais
	public function cadastrarProduto(){
		$sql = new Sql();

		return $sql->lastId("INSERT INTO MM_PRODUTOS(ID_TIPO, ID_CATEGORIA, DESC_PRODUTO, ID_UNIDADE_MEDIDA) VALUES(:ID_TIPO, :ID_CATEGORIA, :DESC_PRODUTO, :ID_UNIDADE_MEDIDA)", array(
			":ID_TIPO"			=>$this->getTipoProduto(),
			":ID_CATEGORIA"		=>$this->getCategoria(),
			":DESC_PRODUTO"		=>$this->getProduto(),
			":ID_UNIDADE_MEDIDA"=>$this->getUnidadeMedida()
		));
	}

	// PARA APAGAR
	// public function cadastrarItemFornecedor(){
	// 	$sql = new Sql();

	// 	return $sql->lastId("INSERT INTO MM_ITENS_FORNECEDOR(ID_FORNECEDOR, ID_PRODUTO) VALUES(:ID_FORNECEDOR, :ID_PRODUTO)", array(
	// 		":ID_FORNECEDOR"=>$this->getFornecedor(),
	// 		":ID_PRODUTO"	=>$this->getProduto()
	// 	));

	// }

	// Não se usa mais
	public function gerarCodFornecedor(){
		$sql = new Sql();

		return $sql->select("CALL MM_CODIGOS_FORNECEDOR()")[0];
	}

	// Não se usa mais
	public function cadastrarCategoriasFornecedor($idCategoria, $codFornecedor){
		$sql = new Sql();

		$sql->query("INSERT INTO MM_CATEGORIA_ITENS_FORNECEDOR(COD_FORNECEDOR, ID_CATEGORIA) VALUES(:COD_FORNECEDOR, :ID_CATEGORIA)", array(
			":COD_FORNECEDOR"	=>$codFornecedor,
			":ID_CATEGORIA"		=>$idCategoria
		));
	}

}


?>