<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FornecedorModel extends CI_Model{


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
    private $status;
    
     
    public function getCodigoFornecedor(){
        return $this->codigoFornecedor;
    }  
     
    public function setCodigoFornecedor($codigoFornecedor){
        $this->codigoFornecedor = $codigoFornecedor;
    }
    
    public function getFornecedor(){
        return $this->fornecedor;
    }
     
    public function setFornecedor($fornecedor){
        $this->fornecedor = mb_strtoupper($fornecedor);
    }
    
     
    public function getCnpj(){
        return $this->cnpj;
    }  
     
    public function setCnpj($cnpj){
        $this->cnpj = $this->limparCNPJ($cnpj);
    }
    
     
    public function getRazaoSocial(){
        return $this->razaoSocial;
    }  
     
    public function setRazaoSocial($razaoSocial){
        $this->razaoSocial = mb_strtoupper($razaoSocial);
    }
    
     
    public function getInscricaoEstadual(){
        return $this->inscricaoEstadual;
    }  
     
    public function setInscricaoEstadual($inscricaoEstadual){
        $this->inscricaoEstadual = mb_strtoupper($inscricaoEstadual);
    }
    
     
    public function getCep(){
        return $this->cep;
    }  
     
    public function setCep($cep){
        $this->cep = $cep;
    }
    
     
    public function getEstado(){
        return $this->estado;
    }  
     
    public function setEstado($estado){
        $this->estado = mb_strtoupper($estado);
    }
    
     
    public function getCidade(){
        return $this->cidade;
    }  
     
    public function setCidade($cidade){
        $this->cidade = mb_strtoupper($cidade);
    }
    
     
    public function getBairro(){
        return $this->bairro;
    }  
     
    public function setBairro($bairro){
        $this->bairro = mb_strtoupper($bairro);
    }
    
     
    public function getLogradouro(){
        return $this->logradouro;
    }  
     
    public function setLogradouro($logradouro){
        $this->logradouro = mb_strtoupper($logradouro);
    }
    
     
    public function getComplemento(){
        return $this->complemento;
    }  
     
    public function setComplemento($complemento){
        $this->complemento = mb_strtoupper($complemento);
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }


    private function limparCNPJ($cnpj){

        $cnpj = trim($cnpj);
        $cnpj = str_replace(".", "", $cnpj);
        $cnpj = str_replace(",", "", $cnpj);
        $cnpj = str_replace("-", "", $cnpj);
        $cnpj = str_replace("/", "", $cnpj);
        
        return $cnpj;

    }


    public function cadastrarFornecedor(){
		return $this->db->query("INSERT INTO MM_FORNECEDOR(CODIGO_FORNECEDOR, NOME_FORNECEDOR, CNPJ_FORNECEDOR, RAZAO_SOCIAL, INSCRICAO_ESTADUAL, CEP_FORNECEDOR, ESTADO_FORNECEDOR, CIDADE_FORNECEDOR, BAIRRO_FORNECEDOR, LOGRADOURO_FORNECEDOR, COMPLEMENTO) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array(
			$this->getCodigoFornecedor(),
			$this->getFornecedor(),
			$this->getCNPJ(),
			$this->getRazaoSocial(), 
			$this->getInscricaoEstadual(), 
			$this->getCep(), 
			$this->getEstado(), 
			$this->getCidade(), 
			$this->getBairro(), 
			$this->getLogradouro(), 
			$this->getComplemento()
		));

	}

    public function atualizarFornecedor($codigoFornecedor){
        $this->db->query("UPDATE MM_FORNECEDOR SET NOME_FORNECEDOR = ?, CNPJ_FORNECEDOR = ?, RAZAO_SOCIAL = ?, INSCRICAO_ESTADUAL = ?, CEP_FORNECEDOR = ?, ESTADO_FORNECEDOR = ?, CIDADE_FORNECEDOR = ?, BAIRRO_FORNECEDOR = ?, LOGRADOURO_FORNECEDOR = ?, COMPLEMENTO = ?, STATUS = ? WHERE CODIGO_FORNECEDOR = ?", array(
            $this->getFornecedor(),
            $this->getCNPJ(),
            $this->getRazaoSocial(), 
            $this->getInscricaoEstadual(), 
            $this->getCep(), 
            $this->getEstado(), 
            $this->getCidade(), 
            $this->getBairro(), 
            $this->getLogradouro(), 
            $this->getComplemento(),
            $this->getStatus(),
            $codigoFornecedor
        ));
    }

    public function excluirCategoriasItens($codFornecedor){
        $this->db->query("DELETE FROM MM_CATEGORIA_ITENS_FORNECEDOR WHERE COD_FORNECEDOR = ?", array(
            $codFornecedor
        ));
    }

	public function cadastrarCategoriasFornecedor($idCategoria, $codFornecedor){
		$this->db->query("INSERT INTO MM_CATEGORIA_ITENS_FORNECEDOR(COD_FORNECEDOR, ID_CATEGORIA) VALUES(?, ?)", array(
			$codFornecedor,
			$idCategoria
		));
	}



	public function listarFornecedores($codigoFornecedor = ''){

		return $this->db->query("SELECT CODIGO_FORNECEDOR, NOME_FORNECEDOR, CNPJ_FORNECEDOR FROM MM_FORNECEDOR WHERE CODIGO_FORNECEDOR != ?", array(
			"?"=>$codigoFornecedor
		))->result_array();

	}

	public function pesquisarFornecedor($nomeFornecedor = '', $cnpjFornecedor = ''){

		return $this->db->query("SELECT CODIGO_FORNECEDOR, NOME_FORNECEDOR, CNPJ_FORNECEDOR FROM MM_FORNECEDOR WHERE NOME_FORNECEDOR LIKE ? AND CNPJ_FORNECEDOR LIKE ?", array(
			"%".$nomeFornecedor."%",
			"%".$cnpjFornecedor."%"
		))->result_array();

	}

	public function gerarCodigoFornecedor(){

		return $this->db->query("CALL MM_CODIGOS_FORNECEDOR()")->result_array()[0];

	}


    public function categoriasOfertadas($codigoFornecedor){

        return $this->db->query("SELECT MCIF.ID_CATEGORIA, MCP.DESC_CATEGORIA FROM MM_CATEGORIA_ITENS_FORNECEDOR MCIF INNER JOIN MM_CATEGORIA_PRODUTO MCP USING(ID_CATEGORIA)")->result_array();

    }

    public function dadosFornecedor($codigoFornecedor){

        return $this->db->query("SELECT * FROM MM_FORNECEDOR WHERE CODIGO_FORNECEDOR = ?", array(
            $codigoFornecedor
        ))->result_array()[0];

    }

    public function listarFornecedorEscola(){

        return $this->db->query("SELECT ID_ESCOLA, NOME_ESCOLA, INEP_ESCOLA FROM UNIDADE_ENSINO_00 WHERE ID_ESCOLA = ?", array(
            1
        ))->result_array();

    }

}


?>