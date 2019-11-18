<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PedidoModel extends CI_Model{

	private $codigoFornecedor;
	private $programa;
	private $produto;
	private $codigoPedido;
	private $categoria;
	private $quantidade;

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

	public function excluirProdutoPedido($idProduto, $codigoPedido){

		$this->db->query("DELETE FROM MM_ITENS_PEDIDO_FORNECEDOR WHERE ID_PRODUTO = ? AND CODIGO_PEDIDO = ?", array(
			$idProduto,
			$codigoPedido
		));

	}



	public function listarStatusPedido($statusAtual = ''){

		return $this->db->query("SELECT ID_STATUS, TIPO_STATUS, DESC_STATUS, COR FROM MM_STATUS_PEDIDO WHERE STATUS = ? AND ID_STATUS != ?", array(
			1,
			$statusAtual
		))->result_array();

	}


	public function gerarCodigoPedido(){

		return $this->db->query("CALL MM_CODIGOS_PEDIDOS()")->result_array()[0];

	}

	public function dadosPedido($codigoPedido){

		return $this->db->query("SELECT MPF.*, MP.DESC_PROGRAMA, MF.NOME_FORNECEDOR, MF.CNPJ_FORNECEDOR, MST.TIPO_STATUS, MST.DESC_STATUS, MST.COR FROM MM_PEDIDOS_FORNECEDOR MPF INNER JOIN MM_PROGRAMAS MP USING(ID_PROGRAMA) INNER JOIN MM_FORNECEDOR MF USING(CODIGO_FORNECEDOR) INNER JOIN MM_STATUS_PEDIDO MST ON MPF.STATUS = MST.ID_STATUS WHERE MPF.CODIGO_PEDIDO = ?", array(

			$codigoPedido

		))->result_array()[0];

	}

	public function cadastrarItensPedido(){

		return $this->db->query("CALL itensPedido(?, ?, ?)", array(
			$this->getCodigoPedido(),
			$this->getProduto(),
			$this->getQuantidade()
		))->result_array()[0];

	}

	public function pesquisarPedido($fornecedor = "", $data = "", $programa = "", $status = ""){

		return $this->db->query("SELECT MPF.CODIGO_FORNECEDOR, DATE_FORMAT(MPF.DATA_PEDIDO, '%d %m %Y') AS DATA_PEDIDO, MPF.ID_PEDIDO, MPF.CODIGO_PEDIDO, MSP.ID_STATUS, MSP.TIPO_STATUS, MSP.DESC_STATUS, MSP.COR, MF.NOME_FORNECEDOR FROM MM_PEDIDOS_FORNECEDOR MPF INNER JOIN MM_FORNECEDOR MF USING(CODIGO_FORNECEDOR) INNER JOIN MM_STATUS_PEDIDO MSP ON MPF.STATUS = MSP.ID_STATUS WHERE MPF.CODIGO_FORNECEDOR LIKE ? AND MPF.DATA_PEDIDO LIKE ? AND MPF.ID_PROGRAMA LIKE ? AND MPF.STATUS LIKE ?", array(
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




}



?>