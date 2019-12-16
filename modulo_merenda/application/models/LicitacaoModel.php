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

    // public function diminuirSaldo($codigoPedido, $idProduto){

    //     $result = $this->db->query("SELECT MIL.ID_ITEM FROM MM_PEDIDOS_FORNECEDOR MPF INNER JOIN MM_LICITACOES ML USING(CODIGO_FORNECEDOR) INNER JOIN MM_ITENS_LICITACAO MIL USING(ID_LICITACAO) WHERE MPF.CODIGO_PEDIDO = ? AND MIL.ID_PRODUTO = ? AND ML.STATUS = ?", array(
    //         $codigoPedido,
    //         $idProduto,
    //         1
    //     ))->result_array()[0];

    //     // if (count($result) > 0) {
        
    //     //     $this->db->query("UPDATE MM_ITENS_LICITACAO SET SALDO = ? WHERE ID_ITEM = ?", array(
    //     //         $this->getSaldo(),
    //     //         $result['ID_ITEM']
    //     //     ));

    //     // }

    // }

    public function alterarSaldo($codigoPedido, $idProduto, $quantidade){

        $dados = $this->db->query("SELECT ML.ID_LICITACAO FROM MM_PEDIDOS_FORNECEDOR MPF INNER JOIN MM_LICITACOES ML USING(CODIGO_FORNECEDOR) WHERE MPF.CODIGO_PEDIDO = ? AND ML.STATUS = ?", array(
            $codigoPedido,
            1
        ))->result_array()[0];

        $this->db->query("UPDATE MM_ITENS_LICITACAO SET SALDO = SALDO + ? WHERE ID_LICITACAO = ? AND ID_PRODUTO = ?", array(
            $quantidade,
            $dados['ID_LICITACAO'],
            $idProduto
        ));

    }

    public function relatorioLicitacao($idLicitacao){

        return $this->db->query("SELECT MF.CODIGO_FORNECEDOR, MF.NOME_FORNECEDOR, MF.CNPJ_FORNECEDOR, MF.CPF_FORNECEDOR, MF.DAP_FORNECEDOR, ML.NUMERO_LICITACAO, MP.DESC_PRODUTO, MP.ID_PRODUTO, MUM.DESC_UNIDADE_MEDIDA, MIL.QUANTIDADE, MIL.SALDO, ML.DATA_INICIO, ML.DATA_FIM FROM MM_LICITACOES ML INNER JOIN MM_FORNECEDOR MF USING(CODIGO_FORNECEDOR) INNER JOIN MM_ITENS_LICITACAO MIL USING(ID_LICITACAO) INNER JOIN MM_PRODUTOS MP USING(ID_PRODUTO) INNER JOIN MM_UNIDADES_MEDIDA MUM USING(ID_UNIDADE_MEDIDA) WHERE ML.ID_LICITACAO = ? ORDER BY MP.ID_PRODUTO", array(
            $idLicitacao
        ))->result_array();

    }







    
}

?>