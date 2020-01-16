<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PedidoModel extends CI_Model{

	private $codigoFornecedor;
	private $programa;
	private $produto;
	private $codigoPedido;
	private $categoria;
	private $quantidade;
	private $escola;
	private $status;

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = ($status == "") ? 1 : $status;
	}

	public function getEscola(){
		return $this->escola;
	}

	public function setEscola($escola){
		$this->escola = $escola;
	}

	public function getQuantidade(){
		return $this->quantidade;
	}

	public function setQuantidade($quantidade){
		$this->quantidade = $quantidade;
	}

	public function getCategoria(){
		return $this->categoria;
	}

	public function setCategoria($categoria){
		$this->categoria = $categoria;
	}

	public function getCodigoPedido(){
		return $this->codigoPedido;
	}

	public function setCodigoPedido($codigoPedido){
		$this->codigoPedido = $codigoPedido;
	}

	public function getCodigoFornecedor(){
        return $this->codigoFornecedor;
    }

    
    public function setCodigoFornecedor($codigoFornecedor){
        $this->codigoFornecedor = $codigoFornecedor;
    }

    public function getPrograma(){
        return $this->programa;
    }

    
    public function setPrograma($programa){
        $this->programa = $programa;
    }

    public function getProduto(){
        return $this->produto;
    }

    
    public function setProduto($produto){
        $this->produto = $produto;
    }



    // 

    public function novoPedido(){

		$this->db->query("INSERT INTO MM_PEDIDOS_FORNECEDOR(CODIGO_PEDIDO, CODIGO_FORNECEDOR, ID_PROGRAMA) VALUES(?, ?, ?)", array(
			$this->getCodigoPedido(),
			$this->getCodigoFornecedor(),
			$this->getPrograma()
		));

	}

	public function novoPedidoEscola(){

		$this->db->query("INSERT INTO MM_PEDIDOS_CENTRAL(ID_ESCOLA, CODIGO_PEDIDO, CODIGO_FORNECEDOR, ID_PROGRAMA) VALUES(?, ?, ?, ?)", array(
			$this->getEscola(),
			$this->getCodigoPedido(),
			$this->getCodigoFornecedor(),
			$this->getPrograma()
		));

	}


	public function informacoesCompletaPedido($codigoPedido){

		return $this->db->query("SELECT MPF.*, MP.DESC_PROGRAMA, MF.NOME_FORNECEDOR, MF.CNPJ_FORNECEDOR, MST.TIPO_STATUS, MST.DESC_STATUS, MST.COR FROM MM_PEDIDOS_FORNECEDOR MPF INNER JOIN MM_PROGRAMAS MP USING(ID_PROGRAMA) INNER JOIN MM_FORNECEDOR MF USING(CODIGO_FORNECEDOR) INNER JOIN MM_STATUS_PEDIDO MST ON MPF.STATUS = MST.ID_STATUS WHERE MPF.CODIGO_PEDIDO = ?", array(
			$codigoPedido
		))->result_array()[0];

	}

	public function informacoesCompletaItensPedido($codigoPedido){

		return $this->db->query("SELECT MIPF.ID_PRODUTO, MIPF.QUANTIDADE, MP.DESC_PRODUTO, MUM.SIGLA_UNIDADE_MEDIDA FROM MM_ITENS_PEDIDO_FORNECEDOR MIPF INNER JOIN MM_PRODUTOS MP USING(ID_PRODUTO) INNER JOIN MM_UNIDADES_MEDIDA MUM USING(ID_UNIDADE_MEDIDA) WHERE MIPF.CODIGO_PEDIDO = ?", array(
			$codigoPedido
		))->result_array();

	}

	public function atualizarStatusPedido($codigoPedido, $novoStatus){

		$this->db->query("UPDATE MM_PEDIDOS_FORNECEDOR SET STATUS = ? WHERE CODIGO_PEDIDO = ?", array(
			$novoStatus,
			$codigoPedido
		));

	}

	public function atualizarStatusPedidoEscola($codigoPedido, $novoStatus){

		$this->db->query("UPDATE MM_PEDIDOS_CENTRAL SET STATUS = ? WHERE CODIGO_PEDIDO = ?", array(
			$novoStatus,
			$codigoPedido
		));

	}

	public function excluirProdutoPedido($idProduto, $codigoPedido){

		$this->db->query("DELETE FROM MM_ITENS_PEDIDO_FORNECEDOR WHERE ID_PRODUTO = ? AND CODIGO_PEDIDO = ?", array(
			$idProduto,
			$codigoPedido
		));

	}

	public function excluirProdutoPedidoEscola($idProduto, $codigoPedido){

		$this->db->query("DELETE FROM MM_ITENS_PEDIDO_CENTRAL WHERE ID_PRODUTO = ? AND CODIGO_PEDIDO = ?", array(
			$idProduto,
			$codigoPedido
		));

	}

	public function listarStatusPedido($statusAtual = ''){
		if ($statusAtual == 1) {
			return $this->db->query("SELECT ID_STATUS, TIPO_STATUS, DESC_STATUS, COR FROM MM_STATUS_PEDIDO WHERE STATUS = ? AND ID_STATUS = ?", array(
				1,
				4
			))->result_array();
		} elseif ($statusAtual == 2) {
			return $this->db->query("SELECT ID_STATUS, TIPO_STATUS, DESC_STATUS, COR FROM MM_STATUS_PEDIDO WHERE STATUS = ? AND ID_STATUS = ? OR ID_STATUS = ?", array(
				1,
				4,
				3
			))->result_array();
		} elseif ($statusAtual == '') {
			return $this->db->query("SELECT ID_STATUS, TIPO_STATUS, DESC_STATUS, COR FROM MM_STATUS_PEDIDO WHERE STATUS = ?", array(
				1
			))->result_array();
		}
		

	}


	public function gerarCodigoPedido(){

		return $this->db->query("CALL MM_CODIGOS_PEDIDOS()")->result_array()[0];

	}

	public function gerarCodigoPedidoEscola(){

		return $this->db->query("CALL MM_CODIGOS_PEDIDOS_ESCOLA()")->result_array()[0];

	}

	public function dadosPedido($codigoPedido){

		return $this->db->query("SELECT MPF.*, MP.DESC_PROGRAMA, MF.NOME_FORNECEDOR, MF.CNPJ_FORNECEDOR, MST.TIPO_STATUS, MST.DESC_STATUS, MST.COR FROM MM_PEDIDOS_FORNECEDOR MPF INNER JOIN MM_PROGRAMAS MP USING(ID_PROGRAMA) INNER JOIN MM_FORNECEDOR MF USING(CODIGO_FORNECEDOR) INNER JOIN MM_STATUS_PEDIDO MST ON MPF.STATUS = MST.ID_STATUS WHERE MPF.CODIGO_PEDIDO = ?", array(

			$codigoPedido

		))->result_array()[0];

	}

	public function dadosPedidoEscola($codigoPedido){

		return $this->db->query("SELECT MPC.*, MP.DESC_PROGRAMA, UE.ID_ESCOLA, UE.INEP_ESCOLA, UE.NOME_ESCOLA, MST.TIPO_STATUS, MST.DESC_STATUS, MST.COR FROM MM_PEDIDOS_CENTRAL MPC INNER JOIN MM_PROGRAMAS MP USING(ID_PROGRAMA) INNER JOIN UNIDADE_ENSINO_00 UE ON MPC.CODIGO_FORNECEDOR = UE.ID_ESCOLA INNER JOIN MM_STATUS_PEDIDO MST ON MPC.STATUS = MST.ID_STATUS WHERE MPC.CODIGO_PEDIDO = ?", array(

			$codigoPedido

		))->result_array()[0];

	}

	public function cadastrarItensPedido(){

		$idItem = $this->db->query("CALL itensPedido(?, ?, ?)", array(
			$this->getCodigoPedido(),
			$this->getProduto(),
			$this->getQuantidade()
		))->result_array()[0];

		// $result = $this->db->query("SELECT MIL.ID_ITEM FROM MM_PEDIDOS_FORNECEDOR MPF INNER JOIN MM_LICITACOES ML USING(CODIGO_FORNECEDOR) INNER JOIN MM_ITENS_LICITACAO MIL USING(ID_LICITACAO) WHERE MPF.CODIGO_PEDIDO = ? AND MIL.ID_PRODUTO = ? AND ML.STATUS = ?", array(
  //           $this->getCodigoPedido(),
  //           $this->getProduto(),
  //           1
  //       ))->result_array()[0];

  //       if (count($result) > 0) {
        
  //           $this->db->query("UPDATE MM_ITENS_LICITACAO SET SALDO = SALDO - ? WHERE ID_ITEM = ?", array(
  //               $this->getQuantidade(),
  //               $result['ID_ITEM']
  //           ));

  //       }

        return $idItem;

	}

	public function cadastrarItensPedidoEscola(){

		$this->db->query("INSERT INTO MM_ITENS_PEDIDO_CENTRAL(CODIGO_PEDIDO, ID_PRODUTO, QUANTIDADE) VALUES(?, ?, ?)", array(
			$this->getCodigoPedido(),
			$this->getProduto(),
			$this->getQuantidade()
		));

	}

	public function pesquisarPedido($fornecedor = "", $data = "", $programa = "", $status = ""){

		return $this->db->query("SELECT MPF.CODIGO_FORNECEDOR, DATE_FORMAT(MPF.DATA_PEDIDO, '%d %m %Y') AS DATA_PEDIDO, MPF.ID_PEDIDO, MPF.CODIGO_PEDIDO, MSP.ID_STATUS, MSP.TIPO_STATUS, MSP.DESC_STATUS, MSP.COR, MF.NOME_FORNECEDOR FROM MM_PEDIDOS_FORNECEDOR MPF INNER JOIN MM_FORNECEDOR MF USING(CODIGO_FORNECEDOR) INNER JOIN MM_STATUS_PEDIDO MSP ON MPF.STATUS = MSP.ID_STATUS WHERE MPF.CODIGO_FORNECEDOR LIKE ? AND MPF.DATA_PEDIDO LIKE ? AND MPF.ID_PROGRAMA LIKE ? AND MPF.STATUS LIKE ?", array(
			"%".$fornecedor."%",
			"%".$data."%",
			"%".$programa."%",
			"%".$status."%"
		))->result_array();

	}

	public function pesquisarPedidoEscola($fornecedor = "", $data = "", $programa = "", $status = ""){

		return $this->db->query("SELECT MPC.CODIGO_FORNECEDOR, DATE_FORMAT(MPC.DATA_PEDIDO, '%d %m %Y') AS DATA_PEDIDO, MPC.ID_PEDIDO, MPC.CODIGO_PEDIDO, MSP.ID_STATUS, MSP.TIPO_STATUS, MSP.DESC_STATUS, MSP.COR, UE.NOME_ESCOLA FROM MM_PEDIDOS_CENTRAL MPC INNER JOIN UNIDADE_ENSINO_00 UE ON MPC.CODIGO_FORNECEDOR = UE.ID_ESCOLA INNER JOIN MM_STATUS_PEDIDO MSP ON MPC.STATUS = MSP.ID_STATUS WHERE MPC.CODIGO_FORNECEDOR LIKE ? AND MPC.DATA_PEDIDO LIKE ? AND MPC.ID_PROGRAMA LIKE ? AND MPC.STATUS LIKE ?", array(
			"%".$fornecedor."%",
			"%".$data."%",
			"%".$programa."%",
			"%".$status."%"
		))->result_array();

	}

	public function buscarItensPedido($codigoPedido){

		return $this->db->query("SELECT MIPF.ID_PRODUTO, MIPF.QUANTIDADE, MPF.ID_PROGRAMA, MPF.CODIGO_FORNECEDOR FROM MM_ITENS_PEDIDO_FORNECEDOR MIPF INNER JOIN MM_PEDIDOS_FORNECEDOR MPF USING(CODIGO_PEDIDO) WHERE MIPF.CODIGO_PEDIDO = ?", array(
			$codigoPedido
		))->result_array();

	}

	public function buscarItensPedidoEscola($codigoPedido){

		return $this->db->query("SELECT MIPC.ID_PRODUTO, MIPC.QUANTIDADE, MPC.ID_PROGRAMA, MPC.CODIGO_FORNECEDOR, MPC.ID_ESCOLA FROM MM_ITENS_PEDIDO_CENTRAL MIPC INNER JOIN MM_PEDIDOS_CENTRAL MPC USING(CODIGO_PEDIDO) WHERE MIPC.CODIGO_PEDIDO = ?", array(
			$codigoPedido
		))->result_array();

	}

	private function entradaProdutosEstoque(){

		$this->db->query("INSERT INTO MM_ENTRADA_PRODUTOS(ID_PROGRAMA, ID_PRODUTO, QUANTIDADE, CODIGO_FORNECEDOR) VALUES(?, ?, ?, ?)", array(
			$this->getPrograma(),
			$this->getProduto(),
			$this->getQuantidade(),
			$this->getCodigoFornecedor()
		));

	}

	private function atualizarEstoque(){
		$this->db->query("CALL atualizarEstoque(?, ?, ?, ?)", array(
			$this->getPrograma(),
			$this->getProduto(),
			$this->getQuantidade(),
			date("Y/m/d")
		));
	}


	public function estoque(){
		$this->entradaProdutosEstoque();
		$this->atualizarEstoque();

	}

	public function dadosPedidosGestor(){

		return $this->db->query("SELECT DATE_FORMAT(MPF.DATA_PEDIDO, '%d %m %Y') AS DATA_PEDIDO, MPF.CODIGO_PEDIDO, MF.NOME_FORNECEDOR, MSP.DESC_STATUS, MPF.STATUS FROM MM_PEDIDOS_FORNECEDOR MPF INNER JOIN MM_FORNECEDOR MF USING(CODIGO_FORNECEDOR) INNER JOIN MM_STATUS_PEDIDO MSP ON MPF.STATUS = MSP.ID_STATUS WHERE MPF.STATUS = ? OR MPF.STATUS = ?", array(
			1,
			2
		))->result_array();

	}

	public function dadosPedidoAutorizacao($codigoPedido){

		return $this->db->query("SELECT MPF.*, MF.NOME_FORNECEDOR, MIPF.*, MP.DESC_PRODUTO, MUM.DESC_UNIDADE_MEDIDA, MPG.DESC_PROGRAMA FROM MM_PEDIDOS_FORNECEDOR MPF INNER JOIN MM_FORNECEDOR MF USING(CODIGO_FORNECEDOR) INNER JOIN MM_ITENS_PEDIDO_FORNECEDOR MIPF USING(CODIGO_PEDIDO) INNER JOIN MM_PRODUTOS MP USING(ID_PRODUTO) INNER JOIN MM_UNIDADES_MEDIDA MUM USING(ID_UNIDADE_MEDIDA) INNER JOIN MM_PROGRAMAS MPG USING(ID_PROGRAMA) WHERE MPF.CODIGO_PEDIDO = ?", array(
			$codigoPedido
		))->result_array();

	}

	public function estoqueEscola(){

		$this->entradaProdutosEstoqueEscola();
		$this->atualizarEstoqueEscola();

	}

	private function entradaProdutosEstoqueEscola(){

		$this->db->query("INSERT INTO MM_ENTRADA_PRODUTOS_ESCOLA(ID_ESCOLA, ID_PROGRAMA, ID_PRODUTO, QUANTIDADE) VALUES(?, ?, ?, ?)", array(
			$this->getEscola(),
			$this->getPrograma(),
			$this->getProduto(),
			$this->getQuantidade()
		));

	}

	private function atualizarEstoqueEscola(){

		$this->db->query("CALL atualizarEstoqueEscola(?, ?, ?, ?, ?)", array(
			$this->getEscola(),
			$this->getPrograma(),
			$this->getProduto(),
			$this->getQuantidade(),
			date("Y/m/d")
		));

	}

	public function saidaProdutoCentral(){

		$this->db->query("INSERT INTO MM_SAIDA_PRODUTOS(ID_ESCOLA, ID_PROGRAMA, ID_PRODUTO, QUANTIDADE) VALUES(?, ?, ?, ?)", array(
			$this->getEscola(),
			$this->getPrograma(),
			$this->getProduto(),
			$this->getQuantidade()
		));

	}

	public function diminuirEstoqueCentral(){

		$this->db->query("UPDATE MM_ESTOQUE SET ESTOQUE_ATUAL = ESTOQUE_ATUAL - ? WHERE ID_PROGRAMA = ? AND ID_PRODUTO = ?", array(
			$this->getQuantidade(),
			$this->getPrograma(),
			$this->getProduto()
		));

	}


	public function listarUnidadesEnsino(){

		return $this->db->query("SELECT INEP_ESCOLA, NOME_ESCOLA, ID_ESCOLA FROM UNIDADE_ENSINO_00 WHERE ID_ESCOLA != ? AND STATUS = ?", array(
			1,
			1
		))->result_array();

	}

	public function listarPedidosEscola(){

		return $this->db->query("SELECT MPC.CODIGO_PEDIDO, DATE_FORMAT(MPC.DATA_PEDIDO, '%d %m %Y') AS DATA_PEDIDO, UE.NOME_ESCOLA, MSP.TIPO_STATUS FROM MM_PEDIDOS_CENTRAL MPC INNER JOIN UNIDADE_ENSINO_00 UE USING(ID_ESCOLA) INNER JOIN MM_STATUS_PEDIDO MSP ON MPC.STATUS = MSP.ID_STATUS WHERE MPC.ID_ESCOLA LIKE ? AND MPC.STATUS LIKE ?", array(
			"%".$this->getEscola()."%",
			"%".$this->getStatus()."%"
		))->result_array();

	}

	public function relatorioPedido(){

		return $this->db->query("SELECT MF.*, MP.PROGRAMA, MP.DESC_PROGRAMA, MPF.DATA_PEDIDO, MIPF.QUANTIDADE, P.ID_PRODUTO, P.DESC_PRODUTO, MPF.CODIGO_PEDIDO, MUM.DESC_UNIDADE_MEDIDA FROM MM_PEDIDOS_FORNECEDOR MPF INNER JOIN MM_FORNECEDOR MF USING(CODIGO_FORNECEDOR) INNER JOIN MM_PROGRAMAS MP USING(ID_PROGRAMA) INNER JOIN MM_ITENS_PEDIDO_FORNECEDOR MIPF USING(CODIGO_PEDIDO) INNER JOIN MM_PRODUTOS P USING(ID_PRODUTO) INNER JOIN MM_UNIDADES_MEDIDA MUM USING(ID_UNIDADE_MEDIDA) WHERE MPF.CODIGO_PEDIDO = ?", array(
			$this->getCodigoPedido()
		))->result_array();

	}

	public function informacoesPedidoEscola($codigoPedido){

		return $this->db->query("SELECT MPC.*, MPG.DESC_PROGRAMA, UE.NOME_ESCOLA AS NOME_FORNECEDOR, MIPC.ID_PRODUTO, MP.DESC_PRODUTO, MIPC.QUANTIDADE, MUM.DESC_UNIDADE_MEDIDA, MUM.SIGLA_UNIDADE_MEDIDA, MSP.TIPO_STATUS, MSP.DESC_STATUS, MSP.ID_STATUS FROM MM_PEDIDOS_CENTRAL MPC INNER JOIN MM_PROGRAMAS MPG USING(ID_PROGRAMA) INNER JOIN UNIDADE_ENSINO_00 UE ON MPC.CODIGO_FORNECEDOR = UE.ID_ESCOLA INNER JOIN MM_ITENS_PEDIDO_CENTRAL MIPC USING(CODIGO_PEDIDO) INNER JOIN MM_PRODUTOS MP USING(ID_PRODUTO) INNER JOIN MM_UNIDADES_MEDIDA MUM USING(ID_UNIDADE_MEDIDA) INNER JOIN MM_STATUS_PEDIDO MSP ON MPC.STATUS = MSP.ID_STATUS WHERE MPC.CODIGO_PEDIDO = ?", array(
			$codigoPedido
		))->result_array();

	}

	public function autorizarPedidoEscola(){

		$this->db->query("UPDATE MM_PEDIDOS_CENTRAL SET STATUS = ? WHERE CODIGO_PEDIDO = ?", array(
			2,
			$this->getCodigoPedido()
		));

	}





}



?>