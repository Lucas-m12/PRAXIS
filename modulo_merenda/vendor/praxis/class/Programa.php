<?php
namespace Praxis;

use Praxis\Sql;

class Programa{
	private $sql;
	private $programa;
	private $status;

    public function getPrograma(){
        return $this->programa;
    }

    public function setPrograma($programa){
        $this->programa = mb_strtoupper($programa);
    }

    public function getStatus(){
    	return $this->status;
    }

    public function setStatus($status){
    	$this->status = ($status == '') ? 1 : intval($status);
    }




	public function cadastrarPrograma(){
		$sql = new Sql();

		return $sql->lastId("INSERT INTO MM_PROGRAMAS(DESC_PROGRAMA) VALUES(:DESC_PROGRAMA)", array(
			":DESC_PROGRAMA"=>$this->getPrograma()
		));

	}

	public static function buscarPrograma($idPrograma){
		$sql = new Sql();

		return $sql->select("SELECT * FROM MM_PROGRAMAS WHERE ID_PROGRAMA = :ID_PROGRAMA", array(
			":ID_PROGRAMA"=>$idPrograma
		))[0];

	}

	public function atualizarPrograma($idPrograma){
		$sql = new Sql();

		$sql->query("UPDATE MM_PROGRAMAS SET DESC_PROGRAMA = :DESC_PROGRAMA, STATUS = :STATUS WHERE ID_PROGRAMA = :ID_PROGRAMA", array(
			":DESC_PROGRAMA"=>$this->getPrograma(),
			":STATUS"		=>$this->getStatus(),
			":ID_PROGRAMA"	=>$idPrograma
		));

	}

	public static function listarProgramas($status = 2){
		$sql = new Sql();

		return $sql->select("SELECT * FROM MM_PROGRAMAS WHERE STATUS != :STATUS", array(
			":STATUS"=>$status
		));

	}

}


?>