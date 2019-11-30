<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LicitacaoModel extends CI_Model{

	private $fornecedor;
	private $data;
	private $status;
	private $programa;
	private $numero;
	private $dataInicial;
	private $dataFinal;



    
    public function getFornecedor(){
        return $this->fornecedor;
    }

    public function setFornecedor($fornecedor){
        $this->fornecedor = $fornecedor;
    }

    
    public function getData(){
        return $this->data;
    }

    public function setData($data){
        $this->data = $data;
    }

    
    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = ($status == '') ? 1 : $status;
    }

    
    public function getPrograma(){
        return $this->programa;
    }

    public function setPrograma($programa){
        $this->programa = $programa;
    }

    
    public function getNumero(){
        return $this->numero;
    }

    public function setNumero($numero){
        $this->numero = $numero;
    }


    public function getDataInicial(){
        return $this->dataInicial;
    }

    public function setDataInicial($dataInicial){
        $this->dataInicial = $dataInicial;

    }

    public function getDataFinal(){
        return $this->dataFinal;
    }

    public function setDataFinal($dataFinal){
        $this->dataFinal = $dataFinal;
    }
















    public function pesquisarLicitacao(){

    	return $this->db->query("SELECT ML.*, MF.NOME_FORNECEDOR FROM MM_LICITACOES ML INNER JOIN MM_FORNECEDOR MF USING(CODIGO_FORNECEDOR) WHERE ML.CODIGO_FORNECEDOR LIKE ? AND ML.NUMERO_LICITACAO LIKE ? AND ML.STATUS LIKE ?", array(
    		"%".$this->getFornecedor()."%",
    		"%".$this->getNumero()."%",
    		"%".$this->getStatus()."%"
    	))->result_array();

    }


    public function cadastrarLicitacao(){

    	$this->db->query("INSERT INTO MM_LICITACOES(NUMERO_LICITACAO, CODIGO_FORNECEDOR, DATA_INICIO, DATA_FIM) VALUES(?, ?, ?, ?)", array(
    		$this->getNumero(),
    		$this->getFornecedor(),
    		$this->getDataInicial(),
    		$this->getDataFinal()
    	));

    	$lastId = $this->db->insert_id();

    	return $lastId;

    }

    public function dadosLicitacao($idLicitacao){

    	return $this->db->query("SELECT ML.*, MF.NOME_FORNECEDOR FROM MM_LICITACOES ML INNER JOIN MM_FORNECEDOR MF USING(CODIGO_FORNECEDOR) WHERE ML.ID_LICITACAO = ?", array(
    		$idLicitacao
    	))->result_array()[0];

    }







    
}

?>