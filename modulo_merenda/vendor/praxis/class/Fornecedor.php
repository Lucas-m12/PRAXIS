<?php
namespace Praxis;

use Praxis\Sql;

class Fornecedor{

	private $sql;
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






	public function __construct(){
		$this->sql = new Sql();
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
		return $this->sql->lastId("INSERT INTO MM_FORNECEDOR(CODIGO_FORNECEDOR, NOME_FORNECEDOR, CNPJ_FORNECEDOR, RAZAO_SOCIAL, INSCRICAO_ESTADUAL, CEP_FORNECEDOR, ESTADO_FORNECEDOR, CIDADE_FORNECEDOR, BAIRRO_FORNECEDOR, LOGRADOURO_FORNECEDOR, COMPLEMENTO) VALUES (:CODIGO_FORNECEDOR, :NOME_FORNECEDOR, :CNPJ_FORNECEDOR, :RAZAO_SOCIAL, :INSCRICAO_ESTADUAL, :CEP_FORNECEDOR, :ESTADO_FORNECEDOR, :CIDADE_FORNECEDOR, :BAIRRO, :LOGRADOURO_FORNECEDOR, :COMPLEMENTO)", array(
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

    public function atualizarFornecedor($codFornecedor){
        $this->sql->query("UPDATE MM_FORNECEDOR SET NOME_FORNECEDOR = :NOME_FORNECEDOR, CNPJ_FORNECEDOR = :CNPJ_FORNECEDOR, RAZAO_SOCIAL = :RAZAO_SOCIAL, INSCRICAO_ESTADUAL = :INSCRICAO_ESTADUAL, CEP_FORNECEDOR = :CEP_FORNECEDOR, ESTADO_FORNECEDOR = :ESTADO_FORNECEDOR, CIDADE_FORNECEDOR = :CIDADE_FORNECEDOR, BAIRRO_FORNECEDOR = :BAIRRO, LOGRADOURO_FORNECEDOR = :LOGRADOURO_FORNECEDOR, COMPLEMENTO = :COMPLEMENTO WHERE CODIGO_FORNECEDOR = :CODIGO_FORNECEDOR", array(
            ":CODIGO_FORNECEDOR"    =>$codFornecedor,
            ":NOME_FORNECEDOR"      =>$this->getFornecedor(),
            ":CNPJ_FORNECEDOR"      =>$this->getCNPJ(),
            ":RAZAO_SOCIAL"         =>$this->getRazaoSocial(), 
            ":INSCRICAO_ESTADUAL"   =>$this->getInscricaoEstadual(), 
            ":CEP_FORNECEDOR"       =>$this->getCep(), 
            ":ESTADO_FORNECEDOR"    =>$this->getEstado(), 
            ":CIDADE_FORNECEDOR"    =>$this->getCidade(), 
            ":BAIRRO"               =>$this->getBairro(), 
            ":LOGRADOURO_FORNECEDOR"=>$this->getLogradouro(), 
            ":COMPLEMENTO"          =>$this->getComplemento()
        ));
    }

	public function gerarCodFornecedor(){
		return $this->sql->select("CALL MM_CODIGOS_FORNECEDOR()")[0];
	}

	public function cadastrarCategoriasFornecedor($idCategoria, $codFornecedor){
		$this->sql->query("INSERT INTO MM_CATEGORIA_ITENS_FORNECEDOR(COD_FORNECEDOR, ID_CATEGORIA) VALUES(:COD_FORNECEDOR, :ID_CATEGORIA)", array(
			":COD_FORNECEDOR"	=>$codFornecedor,
			":ID_CATEGORIA"		=>$idCategoria
		));
	}

    public function excluirCategoriasItens($codFornecedor){
        $this->sql->query("DELETE FROM MM_CATEGORIA_ITENS_FORNECEDOR WHERE COD_FORNECEDOR = :COD_FORNECEDOR", array(
            ":COD_FORNECEDOR"=>$codFornecedor
        ));
    }


    public function buscarFornecedor($codFornecedor){

        return $this->sql->select("SELECT * FROM MM_FORNECEDOR MF WHERE MF.CODIGO_FORNECEDOR = :COD_FORNECEDOR", array(
            ":COD_FORNECEDOR"=>$codFornecedor
        ))[0];

    }

    public function buscarCategoriasOfertadasFornecedor($codFornecedor){

        return $this->sql->select("SELECT MCIF.*, MCP.DESC_CATEGORIA FROM MM_CATEGORIA_ITENS_FORNECEDOR MCIF INNER JOIN MM_CATEGORIA_PRODUTO MCP USING(ID_CATEGORIA) WHERE MCIF.COD_FORNECEDOR = :COD_FORNECEDOR", array(
            ":COD_FORNECEDOR"=>$codFornecedor
        ));

    }


}

?>