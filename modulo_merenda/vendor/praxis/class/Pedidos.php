<?php
namespace Praxis;

use Praxis\Sql;

class Pedidos{

	private $sql;
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



	public function __construct(){
		$this->sql = new Sql();
	}

	public static function buscarCategorias(){

		$sql = new Sql();

		return $sql->select("SELECT ID_CATEGORIA, DESC_CATEGORIA FROM MM_CATEGORIA_PRODUTO WHERE STATUS = :STATUS", array(
			":STATUS"=>1
		));

	}

	public static function carregarProdutosFornecedor($idFornecedor){
		$sql = new Sql();

		return $sql->select("SELECT MIF.ID_ITEM, MF.NOME_FORNECEDOR, MF.CNPJ_FORNECEDOR, MP.ID_PRODUTO, MP.DESC_PRODUTO, MTP.TIPO_PRODUTO, MCP.DESC_CATEGORIA, MUM.SIGLA_UNIDADE_MEDIDA FROM MM_ITENS_FORNECEDOR MIF INNER JOIN MM_FORNECEDOR MF ON MIF.ID_FORNECEDOR = MF.ID_FORNECEDOR INNER JOIN MM_PRODUTOS MP ON MIF.ID_PRODUTO = MP.ID_PRODUTO INNER JOIN MM_TIPO_PRODUTOS MTP ON MP.ID_TIPO = MTP.ID_TIPO INNER JOIN MM_CATEGORIA_PRODUTO MCP ON MP.ID_CATEGORIA = MCP.ID_CATEGORIA INNER JOIN MM_UNIDADES_MEDIDA MUM ON MP.ID_UNIDADE_MEDIDA = MUM.ID_UNIDADE_MEDIDA WHERE MIF.ID_FORNECEDOR = :ID_FORNECEDOR AND MIF.STATUS = :STATUS ORDER BY MIF.ID_ITEM", array(
			":ID_FORNECEDOR"=>$idFornecedor,
			":STATUS"		=>1
		));

	}

	//Não se usa mais
	public static function buscarFornecedor(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM MM_FORNECEDOR WHERE STATUS = :STATUS", array(
			":STATUS"=>1
		));

	}


	public static function listarPedidosPendentes(){
		$sql = new Sql();

		return $sql->select("SELECT MPF.ID_PEDIDO, MPF.QUANTIDADE_PRODUTO, MSP.DS_STATUS, MF.NOME_FORNECEDOR, MP.DESC_PRODUTO, MUM.SIGLA_UNIDADE_MEDIDA FROM MM_PEDIDOS_FORNECEDOR MPF INNER JOIN MM_STATUS_PEDIDO MSP ON MPF.STATUS = MSP.ID_STATUS INNER JOIN MM_FORNECEDOR MF USING(ID_FORNECEDOR) INNER JOIN MM_PRODUTOS MP USING(ID_PRODUTO) INNER JOIN MM_UNIDADES_MEDIDA MUM USING(ID_UNIDADE_MEDIDA) WHERE MPF.STATUS = :STATUS", array(
			":STATUS"=>2
		));

	}

	public function novoPedido(){

		return $this->sql->lastId("INSERT INTO MM_PEDIDOS_FORNECEDOR(CODIGO_PEDIDO, CODIGO_FORNECEDOR, ID_PROGRAMA) VALUES(:CODIGO_PEDIDO, :CODIGO_FORNECEDOR, :ID_PROGRAMA)", array(
			":CODIGO_FORNECEDOR"=>$this->getCodigoFornecedor(),
			":ID_PROGRAMA"		=>$this->getPrograma(),
			":CODIGO_PEDIDO"	=>$this->getCodigoPedido()
		));

	}

	public function itensPedido(){

		$this->sql->query("INSERT INTO MM_ITENS_PEDIDO_FORNECEDOR(CODIGO_PEDIDO, ID_PRODUTO, QUANTIDADE) VALUES(:CODIGO_PEDIDO, :ID_PRODUTO, :QUANTIDADE)", array(
			":CODIGO_PEDIDO"=>$this->getCodigoPedido(),
			":ID_PRODUTO"	=>$this->getProduto(),
			":QUANTIDADE"	=>$this->getQuantidade()
		));

	}

	public function excluirProdutoPedido($idProduto, $codigoPedido){

		$this->sql->query("DELETE FROM MM_ITENS_PEDIDO_FORNECEDOR WHERE ID_PRODUTO = :ID_PRODUTO AND CODIGO_PEDIDO = :CODIGO_PEDIDO", array(
			":ID_PRODUTO"	=>$idProduto,
			":CODIGO_PEDIDO"=>$codigoPedido
		));

	}

	public function informacoesPedido($codPedido){

		return $this->sql->select("SELECT MPF.*, MP.DESC_PROGRAMA, MF.NOME_FORNECEDOR, MF.CNPJ_FORNECEDOR, MST.TIPO_STATUS, MST.DESC_STATUS, MST.COR FROM MM_PEDIDOS_FORNECEDOR MPF INNER JOIN MM_PROGRAMAS MP USING(ID_PROGRAMA) INNER JOIN MM_FORNECEDOR MF USING(CODIGO_FORNECEDOR) INNER JOIN MM_STATUS_PEDIDO MST ON MPF.STATUS = MST.ID_STATUS WHERE MPF.CODIGO_PEDIDO = :CODIGO_PEDIDO", array(
			":CODIGO_PEDIDO"=>$codPedido
		))[0];

	}

	public function informacoesItensPedido($codigoPedido){

		return $this->sql->select("SELECT MIPF.ID_PRODUTO, MIPF.QUANTIDADE, MP.DESC_PRODUTO, MUM.SIGLA_UNIDADE_MEDIDA FROM MM_ITENS_PEDIDO_FORNECEDOR MIPF INNER JOIN MM_PRODUTOS MP USING(ID_PRODUTO) INNER JOIN MM_UNIDADES_MEDIDA MUM USING(ID_UNIDADE_MEDIDA) WHERE MIPF.CODIGO_PEDIDO = :CODIGO_PEDIDO", array(
			":CODIGO_PEDIDO"=>$codigoPedido
		));

	}


	public function atualizarStatusPedido($codigoPedido, $novoStatus){

		$this->sql->query("UPDATE MM_PEDIDOS_FORNECEDOR SET STATUS = :STATUS WHERE CODIGO_PEDIDO = :CODIGO_PEDIDO", array(
			":STATUS"		=>$novoStatus,
			":CODIGO_PEDIDO"=>$codigoPedido
		));

	}

	public static function produtosPedido($codigoPedido){
		$sql = new Sql();

		return $sql->select("SELECT MIPF.CODIGO_PEDIDO, MIPF.ID_PRODUTO, MIPF.QUANTIDADE, MPF.ID_PROGRAMA, MPF.CODIGO_FORNECEDOR FROM MM_ITENS_PEDIDO_FORNECEDOR MIPF INNER JOIN MM_PEDIDOS_FORNECEDOR MPF ON MIPF.CODIGO_PEDIDO = MPF.CODIGO_PEDIDO WHERE MIPF.CODIGO_PEDIDO = :CODIGO_PEDIDO", array(
			":CODIGO_PEDIDO"=>$codigoPedido
		));

	}

    
}


?>