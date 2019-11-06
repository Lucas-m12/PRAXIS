<?php
namespace Praxis;

use Praxis\Sql;
use Praxis\Cadastros;

class Produto{

	private $sql;
	private $tipoProduto;
	private $categoria;
	private $unidadeMedida;
	private $produto;
    private $status;

    
    public function getTipoProduto(){
        return $this->tipoProduto;
    }

    public function setTipoProduto($tipoProduto){
        $this->tipoProduto = mb_strtoupper($tipoProduto);
    }

    
    public function getCategoria(){
        return $this->categoria;
    }


    public function setCategoria($categoria){
        $this->categoria = $categoria;
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

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status = ''){
        $this->status = ($status == "") ? 1 : $status;
    }



    public function __construct(){
    	$this->sql = new Sql();
    }


    public function cadastrarProduto(){
		return $this->sql->lastId("INSERT INTO MM_PRODUTOS(ID_TIPO, ID_CATEGORIA, DESC_PRODUTO, ID_UNIDADE_MEDIDA) VALUES(:ID_TIPO, :ID_CATEGORIA, :DESC_PRODUTO, :ID_UNIDADE_MEDIDA)", array(
			":ID_TIPO"			=>$this->getTipoProduto(),
			":ID_CATEGORIA"		=>$this->getCategoria(),
			":DESC_PRODUTO"		=>$this->getProduto(),
			":ID_UNIDADE_MEDIDA"=>$this->getUnidadeMedida()
		));
	}

    public function atualizarProduto($idProduto){

        $this->sql->query("UPDATE MM_PRODUTOS SET ID_TIPO = :ID_TIPO, ID_CATEGORIA = :ID_CATEGORIA, DESC_PRODUTO = :DESC_PRODUTO, ID_UNIDADE_MEDIDA = :ID_UNIDADE_MEDIDA, STATUS = :STATUS WHERE ID_PRODUTO = :ID_PRODUTO", array(
            ":ID_TIPO"          =>$this->getTipoProduto(),
            ":ID_CATEGORIA"     =>$this->getCategoria(),
            ":DESC_PRODUTO"     =>$this->getProduto(),
            ":ID_UNIDADE_MEDIDA"=>$this->getUnidadeMedida(),
            ":STATUS"           =>$this->getStatus(),
            ":ID_PRODUTO"       =>$idProduto
        ));

    }


	public function cadastrarTipoProduto(){
		return $this->sql->lastId("INSERT INTO MM_TIPO_PRODUTOS(TIPO_PRODUTO) VALUES (:TIPO_PRODUTO)", array(
			":TIPO_PRODUTO"=>$this->getTipoProduto()
		));
	}

    public function buscarTipoProduto($idTipo){

        return $this->sql->select("SELECT * FROM MM_TIPO_PRODUTOS WHERE ID_TIPO = :ID_TIPO", array(
            ":ID_TIPO"=>$idTipo
        ))[0];

    }

    public function atualizarTipoProduto($idTipo){

        $this->sql->query("UPDATE MM_TIPO_PRODUTOS SET TIPO_PRODUTO = :TIPO_PRODUTO, STATUS = :STATUS WHERE ID_TIPO = :ID_TIPO", array(
            ":TIPO_PRODUTO" =>$this->getTipoProduto(),
            ":STATUS"       =>$this->getStatus(),
            ":ID_TIPO"      =>$idTipo
        ));

    }

    public function buscarProduto($idProduto){

        return $this->sql->select("SELECT MP.ID_PRODUTO, MP.DESC_PRODUTO, MP.STATUS, MCP.ID_CATEGORIA, MCP.DESC_CATEGORIA, MTP.ID_TIPO, MTP.TIPO_PRODUTO, MUM.ID_UNIDADE_MEDIDA, MUM.DESC_UNIDADE_MEDIDA FROM MM_PRODUTOS MP INNER JOIN MM_CATEGORIA_PRODUTO MCP USING(ID_CATEGORIA) INNER JOIN MM_UNIDADES_MEDIDA MUM USING(ID_UNIDADE_MEDIDA) INNER JOIN MM_TIPO_PRODUTOS MTP USING(ID_TIPO) WHERE MP.ID_PRODUTO = :ID_PRODUTO", array(
            ":ID_PRODUTO"=>$idProduto
        ))[0];

    }

    public static function listarTiposProdutos($tipoAtual = ''){
        $sql = new Sql();

        return $sql->select("SELECT * FROM MM_TIPO_PRODUTOS WHERE STATUS = :STATUS AND ID_TIPO != :ATUAL", array(
            ":STATUS"   =>1,
            ":ATUAL"    =>$tipoAtual
        ));

    }

    public static function listarUnidadesMedida($unidadeAtual = ''){
        $sql = new Sql();

        return $sql->select("SELECT * FROM MM_UNIDADES_MEDIDA WHERE STATUS = :STATUS AND ID_UNIDADE_MEDIDA != :ATUAL", array(
            ":STATUS"   =>1,
            ":ATUAL"    =>$unidadeAtual
        ));

    }



}


?>