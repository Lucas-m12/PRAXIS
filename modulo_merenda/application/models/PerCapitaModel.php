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

	public function dadosPerCapita(){

		return $this->db->query("SELECT MP.VALOR_PERCAPITA, P.DESC_PRODUTO, NE.DS_NIVEL_ENSINO, MP.ID_PERCAPITA FROM MM_PERCAPITA MP INNER JOIN MM_PRODUTOS P USING(ID_PRODUTO) INNER JOIN NIVEL_ENSINO NE USING(ID_NIVEL_ENSINO) WHERE MP.STATUS = ?", array(
			1
		))->result_array();

	}

	public function infoPerCapita($idPerCapita = ''){

		return $this->db->query("SELECT NE.DS_NIVEL_ENSINO, P.DESC_PRODUTO, MP.VALOR_PERCAPITA, MP.ID_PERCAPITA FROM MM_PERCAPITA MP INNER JOIN MM_PRODUTOS P USING(ID_PRODUTO) INNER JOIN NIVEL_ENSINO NE USING(ID_NIVEL_ENSINO) WHERE MP.ID_PERCAPITA = ?", array(
			$idPerCapita
		))->result_array()[0];

	}

	public function editarPerCapita($idPerCapita){

		$this->db->query("UPDATE MM_PERCAPITA SET VALOR_PERCAPITA = ? WHERE ID_PERCAPITA = ?", array(
			$this->getPerCapita(),
			$idPerCapita
		));

	}

}


?>