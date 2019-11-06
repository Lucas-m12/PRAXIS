<?php
namespace Praxis;

use Praxis\Sql;

class Categoria{

	private $sql;
	private $categoria;
    private $status;


    public function getCategoria(){
        return $this->categoria;
    }

    public function setCategoria($categoria){
        $this->categoria = mb_strtoupper($categoria);
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status = ''){
        $this->status = ($status == '') ? 1 : intval($status);
    }








    public function __construct(){
    	$this->sql = new Sql();
    }


    public function cadastrarCategoria(){
		return $this->sql->lastId("INSERT INTO MM_CATEGORIA_PRODUTO(DESC_CATEGORIA) VALUES(:DESC_CATEGORIA)", array(
			":DESC_CATEGORIA"=>$this->getCategoria()
		));
	}

    public function buscarCategoria($idCategoria){

        return $this->sql->select("SELECT * FROM MM_CATEGORIA_PRODUTO WHERE ID_CATEGORIA = :ID_CATEGORIA", array(
            ":ID_CATEGORIA"=>$idCategoria
        ))[0];

    }

    public function atualizarCategoria($idCategoria){

        $this->sql->query("UPDATE MM_CATEGORIA_PRODUTO SET DESC_CATEGORIA = :DESC_CATEGORIA, STATUS = :STATUS WHERE ID_CATEGORIA = :ID_CATEGORIA", array(
            ":DESC_CATEGORIA"   =>$this->getCategoria(),
            ":STATUS"           =>$this->getStatus(),
            ":ID_CATEGORIA"     =>$idCategoria
        ));

    }

    public static function listarCategorias($categoriaAtual = '', $status = 2){
        $sql = new Sql();

        return $sql->select("SELECT * FROM MM_CATEGORIA_PRODUTO WHERE STATUS != :STATUS AND ID_CATEGORIA != :ATUAL", array(
            ":STATUS"   =>$status,
            ":ATUAL"    =>$categoriaAtual
        ));

    }

}


?>