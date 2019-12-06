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
    private $produto;
    private $idLicitacao;
    private $quantidade;
    private $saldo;

    public function getSaldo() {
        return $this->saldo;
    }
     
    public function setSaldo($saldo) {
        $this->saldo = $saldo;
    }
    
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

    public function getProduto(){
        return $this->produto;
    }

    public function setProduto($produto){
        $this->produto = $produto;
    }

    public function getIdLicitacao(){
        return $this->idLicitacao;
    }

    public function setIdLicitacao($idLicitacao){
        $this->idLicitacao = $idLicitacao;
    }

    public function getQuantidade(){
        return $this->quantidade;
    }

    public function setQuantidade($quantidade){
        $this->quantidade = $quantidade;
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

    public function cadastrarItemLicitacao(){

        $this->db->query("INSERT INTO MM_ITENS_LICITACAO(ID_LICITACAO, ID_PRODUTO, QUANTIDADE, SALDO) VALUES(?, ?, ?, ?)", array(
            $this->getIdLicitacao(),
            $this->getProduto(),
            $this->getQuantidade(),
            $this->getSaldo()
        ));

    }

    public function removerProdutoLicitacao(){

        $this->db->query("DELETE FROM MM_ITENS_LICITACAO WHERE ID_PRODUTO = ? AND ID_LICITACAO = ?", array(
            $this->getProduto(),
            $this->getIdLicitacao()
        ));

    }








    
}

?>