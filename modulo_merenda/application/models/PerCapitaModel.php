<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PerCapitaModel extends CI_Model{

	private $produto;
	private $perCapita;
	private $nivelEnsino;

	public function getProduto() {
	    return $this->produto;
	}
	 
	public function setProduto($produto) {
	    $this->produto = $produto;
	}
	public function getPerCapita() {
	    return $this->perCapita;
	}
	 
	public function setPerCapita($perCapita) {
	    $this->perCapita = $perCapita;
	}
	public function getNivelEnsino() {
	    return $this->nivelEnsino;
	}
	 
	public function setNivelEnsino($nivelEnsino) {
	    $this->nivelEnsino = $nivelEnsino;
	}



	public function listarNiveisEnsino($idNivelEnsino = ''){

		return $this->db->query("SELECT ID_NIVEL_ENSINO, DS_NIVEL_ENSINO FROM NIVEL_ENSINO WHERE STATUS = ? AND ID_NIVEL_ENSINO != ?", array(
			1,
			$idNivelEnsino
		))->result_array();

	}

	public function cadastrarPerCapita(){

		$this->db->query("INSERT INTO MM_PERCAPITA(ID_NIVEL_ENSINO, ID_PRODUTO, VALOR_PERCAPITA) VALUES(?, ?, ?)", array(
			$this->getNivelEnsino(),
			$this->getProduto(),
			$this->getPerCapita()
		));

	}

}


?>