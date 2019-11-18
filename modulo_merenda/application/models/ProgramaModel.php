<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProgramaModel extends CI_Model{

	private $programa;
	private $status;

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($value){
		$this->status = $value;
	}

	public function getPrograma(){

		return $this->programa;

	}

	public function setPrograma($value){

		$this->programa = mb_strtoupper($value);

	}

	public function listarProgramas($idPrograma = ''){

		$result = $this->db->query("SELECT * FROM MM_PROGRAMAS WHERE ID_PROGRAMA != ?", array(
			"?"=>$idPrograma
		));

		return $result->result_array();

	}

	public function dadosPrograma($idPrograma){

		$result = $this->db->query("SELECT * FROM MM_PROGRAMAS WHERE ID_PROGRAMA = ?", array(
			"?"=>$idPrograma
		));

		return $result->result_array()[0];

	}

	public function cadastrarPrograma(){

		$this->db->query("INSERT INTO MM_PROGRAMAS(DESC_PROGRAMA) VALUES(?)", array(
			"?"=>$this->getPrograma()
		));

	}

	public function atualizarPrograma($idPrograma){

		$this->db->query("UPDATE MM_PROGRAMAS SET DESC_PROGRAMA = ?, STATUS = ? WHERE ID_PROGRAMA = ?", array(
			$this->getPrograma(),
			$this->getStatus(),
			$idPrograma
		));

	}





}


?>