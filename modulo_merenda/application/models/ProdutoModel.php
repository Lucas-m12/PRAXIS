<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProdutoModel extends CI_Model{

	private $tipoProduto;
	private $categoriaProduto;
	private $unidadeMedida;
	private $produto;
	private $status;


	public function getStatus(){
		return $this->status;
	}

	public function setStatus($value){
		$this->status = $value;
	}

	public function getTipoProduto(){
		return $this->tipoProduto;
	}

	public function setTipoProduto($value){
		$this->tipoProduto = mb_strtoupper($value);
	}

	public function getCategoriaProduto(){
        return $this->categoriaProduto;
    }

    
    public function setCategoriaProduto($categoriaProduto){
        $this->categoriaProduto = $categoriaProduto;
    }

    
    public function getUnidadeMedida(){
        return $this->unidadeMedida;
    }

    
    public function setUnidadeMedida($unidadeMedida){
        $this->unidadeMedida = $unidadeMedida;
    }

    
    public function getProduto(){
        return $this->produto;
    }

    
    public function setProduto($produto){
        $this->produto = mb_strtoupper($produto);
    }







	public function produtos($idProduto = ''){

		return $this->db->query("SELECT MP.ID_PRODUTO, MP.DESC_PRODUTO FROM MM_PRODUTOS MP WHERE MP.ID_PRODUTO != ?", array(
			"?"=>$idProduto
		))->result_array();

	}

	public function tiposProduto($idTipo = ''){

		return $this->db->query("SELECT * FROM MM_TIPO_PRODUTOS WHERE ID_TIPO != ?", array(
			"?"=>$idTipo
		))->result_array();

	}

	public function cadastrarTipoProduto(){

		$this->db->query("INSERT INTO MM_TIPO_PRODUTOS(TIPO_PRODUTO) VALUES(?)", array(
			"?"=>$this->getTipoProduto()
		));

	}

	public function pesquisarProduto($nome = '', $tipo = '', $categoria = ''){

		return $this->db->query("SELECT MP.ID_PRODUTO, MP.DESC_PRODUTO, MP.STATUS, MTP.TIPO_PRODUTO, MCP.DESC_CATEGORIA, MUM.SIGLA_UNIDADE_MEDIDA FROM MM_PRODUTOS MP INNER JOIN MM_TIPO_PRODUTOS MTP ON MP.ID_TIPO = MTP.ID_TIPO INNER JOIN MM_CATEGORIA_PRODUTO MCP ON MP.ID_CATEGORIA = MCP.ID_CATEGORIA INNER JOIN MM_UNIDADES_MEDIDA MUM ON MP.ID_UNIDADE_MEDIDA = MUM.ID_UNIDADE_MEDIDA WHERE MP.ID_TIPO LIKE ? AND MP.ID_CATEGORIA LIKE ? AND MP.DESC_PRODUTO LIKE ? ORDER BY MP.ID_PRODUTO", array(
				"%".$tipo."%",
				"%".$categoria."%",
				"%".$nome."%"
			))->result_array();
	}


	public function listarUnidadesMedida($idUnidadeMedida = ''){

		return $this->db->query("SELECT ID_UNIDADE_MEDIDA, DESC_UNIDADE_MEDIDA FROM MM_UNIDADES_MEDIDA WHERE ID_UNIDADE_MEDIDA != ? AND STATUS = ?", array(
			$idUnidadeMedida,
			1
		))->result_array();

	}
	

	public function cadastrarProduto(){

		$this->db->query("INSERT INTO MM_PRODUTOS(ID_TIPO, ID_CATEGORIA, DESC_PRODUTO, ID_UNIDADE_MEDIDA) VALUES(?, ?, ?, ?)", array(
			$this->getTipoProduto(),
			$this->getCategoriaProduto(),
			$this->getProduto(),
			$this->getUnidadeMedida()
		));

		$lastId = $this->db->insert_id();

		return $lastId;

	}

	public function listarProdutosCategoria($idCategoria){

		return $this->db->query("SELECT ID_PRODUTO, DESC_PRODUTO FROM MM_PRODUTOS WHERE ID_CATEGORIA = ?", array(
			$idCategoria
		))->result_array();

	}

	public function listarUnidadeMedidaProduto($idProduto){

		return $this->db->query("SELECT MUM.ID_UNIDADE_MEDIDA, MUM.DESC_UNIDADE_MEDIDA, MUM.SIGLA_UNIDADE_MEDIDA FROM MM_PRODUTOS MP INNER JOIN MM_UNIDADES_MEDIDA MUM USING(ID_UNIDADE_MEDIDA) WHERE MP.ID_PRODUTO = ?", array(
			$idProduto
		))->result_array()[0];

	}

	public function informacoesProduto($idProduto){

		return $this->db->query("SELECT MP.ID_PRODUTO, MP.DESC_PRODUTO, MP.STATUS, MCP.ID_CATEGORIA, MCP.DESC_CATEGORIA, MTP.ID_TIPO, MTP.TIPO_PRODUTO, MUM.ID_UNIDADE_MEDIDA, MUM.DESC_UNIDADE_MEDIDA FROM MM_PRODUTOS MP INNER JOIN MM_CATEGORIA_PRODUTO MCP USING(ID_CATEGORIA) INNER JOIN MM_UNIDADES_MEDIDA MUM USING(ID_UNIDADE_MEDIDA) INNER JOIN MM_TIPO_PRODUTOS MTP USING(ID_TIPO) WHERE MP.ID_PRODUTO = ?", array(
            $idProduto
        ))->result_array()[0];

	}


	public function atualizarProduto($idProduto){

        $this->db->query("UPDATE MM_PRODUTOS SET ID_TIPO = ?, ID_CATEGORIA = ?, DESC_PRODUTO = ?, ID_UNIDADE_MEDIDA = ?, STATUS = ? WHERE ID_PRODUTO = ?", array(
            $this->getTipoProduto(),
            $this->getCategoriaProduto(),
            $this->getProduto(),
            $this->getUnidadeMedida(),
            $this->getStatus(),
            $idProduto
        ));

    }

    public function atualizarTipoProduto($idTipo){

        $this->db->query("UPDATE MM_TIPO_PRODUTOS SET TIPO_PRODUTO = ?, STATUS = ? WHERE ID_TIPO = ?", array(
            $this->getTipoProduto(),
            $this->getStatus(),
            $idTipo
        ));

    }

    public function dadosTipoProduto($idTipo){

    	return $this->db->query("SELECT * FROM MM_TIPO_PRODUTOS WHERE ID_TIPO = ?", array(
    		$idTipo
    	))->result_array()[0];

    }


    
    
}


?>