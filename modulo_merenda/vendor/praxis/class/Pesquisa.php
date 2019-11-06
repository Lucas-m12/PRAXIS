<?php
namespace Praxis;

use Praxis\Sql;

class Pesquisa{

	public static function pesquisarProduto($tipo = "", $categoria = "", $nome = ""){
		$sql = new Sql();

		return $sql->select("SELECT MP.ID_PRODUTO, MP.DESC_PRODUTO, MP.STATUS, MTP.TIPO_PRODUTO, MCP.DESC_CATEGORIA, MUM.SIGLA_UNIDADE_MEDIDA FROM MM_PRODUTOS MP INNER JOIN MM_TIPO_PRODUTOS MTP ON MP.ID_TIPO = MTP.ID_TIPO INNER JOIN MM_CATEGORIA_PRODUTO MCP ON MP.ID_CATEGORIA = MCP.ID_CATEGORIA INNER JOIN MM_UNIDADES_MEDIDA MUM ON MP.ID_UNIDADE_MEDIDA = MUM.ID_UNIDADE_MEDIDA WHERE MP.ID_TIPO LIKE :ID_TIPO AND MP.ID_CATEGORIA LIKE :ID_CATEGORIA AND MP.DESC_PRODUTO LIKE :DESC_PRODUTO", array(
			":ID_TIPO"=>"%".$tipo."%",
			":ID_CATEGORIA"=>"%".$categoria."%",
			":DESC_PRODUTO"=>"%".$nome."%"
		));
	}

	public static function pesquisarFornecedor($nome = "", $cnpj = ""){
		$sql = new Sql();

		return $sql->select("SELECT * FROM MM_FORNECEDOR MF WHERE NOME_FORNECEDOR LIKE :NOME_FORNECEDOR AND CNPJ_FORNECEDOR LIKE :CNPJ_FORNECEDOR", array(
			":NOME_FORNECEDOR"=>"%".$nome."%",
			":CNPJ_FORNECEDOR"=>"%".$cnpj."%"
		));
	}

	public static function pesquisarItemFornecedor($idItem){
		$sql = new Sql();

		return $sql->select("SELECT MP.ID_PRODUTO, MP.DESC_PRODUTO, MCP.DESC_CATEGORIA FROM MM_ITENS_FORNECEDOR MIF INNER JOIN MM_PRODUTOS MP ON MIF.ID_PRODUTO = MP.ID_PRODUTO INNER JOIN MM_CATEGORIA_PRODUTO MCP ON MP.ID_CATEGORIA = MCP.ID_CATEGORIA WHERE MIF.ID_ITEM = :ID_ITEM", array(
			":ID_ITEM"=>$idItem
		));

	}

	public static function pesquisarPedido($fornecedor, $data, $programa, $status){
		$sql = new Sql();

		return $sql->select("SELECT MPF.CODIGO_FORNECEDOR, DATE_FORMAT(MPF.DATA_PEDIDO, '%d %m %Y') AS DATA_PEDIDO, MPF.ID_PEDIDO, MPF.CODIGO_PEDIDO, MSP.ID_STATUS, MSP.TIPO_STATUS, MSP.DESC_STATUS, MSP.COR, MF.NOME_FORNECEDOR FROM MM_PEDIDOS_FORNECEDOR MPF INNER JOIN MM_FORNECEDOR MF USING(CODIGO_FORNECEDOR) INNER JOIN MM_STATUS_PEDIDO MSP ON MPF.STATUS = MSP.ID_STATUS WHERE MPF.CODIGO_FORNECEDOR LIKE :COD_FORNECEDOR AND MPF.DATA_PEDIDO LIKE :DATA_PEDIDO AND MPF.ID_PROGRAMA LIKE :ID_PROGRAMA AND MPF.STATUS LIKE :STATUS", array(
			":COD_FORNECEDOR"	=>"%".$fornecedor."%",
			":DATA_PEDIDO"		=>"%".$data."%",
			":ID_PROGRAMA"		=>"%".$programa."%",
			":STATUS"			=>"%".$status."%"
		));

	}

	public static function buscarCategoriasFornecedor($codFornecedor){
		$sql = new Sql();

		return $sql->select("SELECT MCP.ID_CATEGORIA, MCP.DESC_CATEGORIA FROM MM_CATEGORIA_ITENS_FORNECEDOR MCIF INNER JOIN MM_CATEGORIA_PRODUTO MCP USING(ID_CATEGORIA) WHERE MCIF.COD_FORNECEDOR = :COD_FORNECEDOR", array(
			":COD_FORNECEDOR"=>$codFornecedor
		));

	}

    public static function buscarFornecedorPedido($idCategoria){
	    $sql = new Sql();

	    return $sql->select("SELECT MCIF.*, MF.NOME_FORNECEDOR, MF.CNPJ_FORNECEDOR FROM MM_CATEGORIA_ITENS_FORNECEDOR MCIF INNER JOIN MM_FORNECEDOR MF ON MCIF.COD_FORNECEDOR = MF.CODIGO_FORNECEDOR WHERE MCIF.ID_CATEGORIA = :ID_CATEGORIA AND MF.STATUS = :STATUS", array(
	        ":ID_CATEGORIA"	=>$idCategoria,
	        ":STATUS"		=>1
	    ));

    }

    public static function buscarProdutosPedido($idCategoria){
    	$sql = new Sql();

    	return $sql->select("SELECT MP.ID_PRODUTO, MP.DESC_PRODUTO FROM MM_PRODUTOS MP WHERE MP.ID_CATEGORIA = :ID_CATEGORIA AND MP.STATUS = :STATUS", array(
    		":ID_CATEGORIA"	=>$idCategoria,
    		":STATUS"		=>1
    	));

    }

    public static function buscarUnidadeMedidaPedido($idProduto){
    	$sql = new Sql();

    	return $sql->select("SELECT MUM.ID_UNIDADE_MEDIDA, MUM.SIGLA_UNIDADE_MEDIDA FROM MM_PRODUTOS MP INNER JOIN MM_UNIDADES_MEDIDA MUM USING(ID_UNIDADE_MEDIDA) WHERE MP.ID_PRODUTO = :ID_PRODUTO", array(
    		":ID_PRODUTO"=>$idProduto
    	))[0];

    }

    public static function dadosPedido($codigoPedido){
    	$sql = new Sql();

    	return $sql->select("SELECT MPF.CODIGO_FORNECEDOR, MPF.ID_PROGRAMA, MF.NOME_FORNECEDOR, MP.DESC_PROGRAMA FROM MM_PEDIDOS_FORNECEDOR MPF INNER JOIN MM_FORNECEDOR MF USING(CODIGO_FORNECEDOR) INNER JOIN MM_PROGRAMAS MP USING(ID_PROGRAMA) WHERE MPF.CODIGO_PEDIDO = :CODIGO_PEDIDO", array(
    		":CODIGO_PEDIDO"=>$codigoPedido
    	))[0];

    }

    public static function dadosEstoque($programa = "", $produto = ""){
    	$sql = new Sql();

    	return $sql->select("SELECT MP.DESC_PROGRAMA, MPS.DESC_PRODUTO, ME.ESTOQUE_ATUAL, MUM.SIGLA_UNIDADE_MEDIDA FROM MM_ESTOQUE ME INNER JOIN MM_PROGRAMAS MP USING(ID_PROGRAMA) INNER JOIN MM_PRODUTOS MPS USING(ID_PRODUTO) INNER JOIN MM_UNIDADES_MEDIDA MUM USING(ID_UNIDADE_MEDIDA) WHERE ME.ID_PROGRAMA LIKE :ID_PROGRAMA AND ME.ID_PRODUTO LIKE :ID_PRODUTO", array(
    		":ID_PROGRAMA"	=>"%".$programa."%",
    		":ID_PRODUTO"	=>"%".$produto."%"
    	));

    }

    public static function pesquisarCodPedido(){
    	$sql = new Sql();

		return $sql->select("CALL MM_CODIGOS_PEDIDOS()")[0];

	}

	public static function pesquisarStatusPedido($statusAtual = ""){
		$sql = new Sql();

		return $sql->select("SELECT ID_STATUS, TIPO_STATUS, DESC_STATUS FROM MM_STATUS_PEDIDO WHERE ID_STATUS != :STATUS", array(
			":STATUS"=>$statusAtual
		));

	}


	// Não se usa mais
	public static function listarCategoriasFornecedor($codigo){
		$sql = new Sql();

		return $sql->select("SELECT * FROM MM_CATEGORIA_PRODUTO");

	}

	public static function statusPedidos(){
		$sql = new Sql();

		return $sql->select("SELECT * FROM MM_STATUS_PEDIDO WHERE STATUS = :STATUS", array(
			":STATUS"=>1
		));

	}

	public static function listarTipos(){
		$sql = new Sql();

		return $sql->select("SELECT * FROM MM_TIPO_PRODUTOS");
	}

	// Não se usa mais
	public static function listarProgramas(){
		$sql = new Sql();

		return $sql->select("SELECT * FROM MM_PROGRAMAS WHERE STATUS = :STATUS", array(
			":STATUS"=>1
		));
	}

	/*public static function listarCategorias(){
		$sql = new Sql();

		return $sql->select("SELECT * FROM MM_CATEGORIA_PRODUTO WHERE STATUS = :STATUS", array(
			":STATUS"=>1
		));
	}*/

	public static function listarFornecedores(){
		$sql = new Sql();

		return $sql->select("SELECT CODIGO_FORNECEDOR, NOME_FORNECEDOR, CNPJ_FORNECEDOR FROM MM_FORNECEDOR WHERE STATUS = :STATUS", array(
			":STATUS"=>1
		));
	}

	public static function pesquisarProdutos($categoria){
		$sql = new Sql();

		return $sql->select("SELECT ID_PRODUTO, DESC_PRODUTO FROM MM_PRODUTOS WHERE STATUS = :STATUS AND ID_CATEGORIA = :CATEGORIA", array(
			":STATUS"	=>1,
			":CATEGORIA"=>$categoria
		));

	}

}


?>