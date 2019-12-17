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

	public function infoPerCapita($idNivelEnsino = ''){

		return $this->db->query("SELECT NE.DS_NIVEL_ENSINO, NE.ID_NIVEL_ENSINO, P.ID_PRODUTO, P.DESC_PRODUTO FROM MM_PERCAPITA MP INNER JOIN NIVEL_ENSINO NE USING(ID_NIVEL_ENSINO) INNER JOIN MM_PRODUTOS P USING(ID_PRODUTO) WHERE MP.ID_NIVEL_ENSINO = ?", array(
			$idNivelEnsino
		))->result_array();

	}

	public function editarPerCapita(){

		$this->db->query("UPDATE MM_PERCAPITA SET VALOR_PERCAPITA = ? WHERE ID_NIVEL_ENSINO = ? AND ID_PRODUTO = ?", array(
			$this->getPerCapita(),
			$this->getNivelEnsino(),
			$this->getProduto()
		));

	}

	public function buscarPerCapita($idProduto, $nivelEnsino){

		return $this->db->query("SELECT VALOR_PERCAPITA FROM MM_PERCAPITA WHERE ID_PRODUTO = ? AND ID_NIVEL_ENSINO = ?", array(
			$idProduto,
			$nivelEnsino
		))->result_array()[0];

	}

	public function listarUnidadesEnsino($idUnidadeEnsino = 1){

		return $this->db->query("SELECT ID_ESCOLA, NOME_ESCOLA FROM UNIDADE_ENSINO_00 WHERE ID_ESCOLA != ?", array(
			$idUnidadeEnsino
		))->result_array();

	}

	public function dadosPerCapitaRelatorio($nivelEnsino, $unidadeEnsino, $produto){

		return $this->db->query("SELECT COUNT(MC.ID_MATRICULA) AS QTD_ALUNOS, MP.VALOR_PERCAPITA, UE.NOME_ESCOLA, NE.DS_NIVEL_ENSINO, MUM.SIGLA_UNIDADE_MEDIDA, P.DESC_PRODUTO, P.ID_PRODUTO FROM ETAPAS_ENSINO EE INNER JOIN SUB_ETAPA SE USING(ID_ETAPA) INNER JOIN MATRICULA_COMUM MC USING(ID_SUB_ETAPA) INNER JOIN MM_PERCAPITA MP USING(ID_NIVEL_ENSINO) INNER JOIN UNIDADE_ENSINO_00 UE USING(ID_ESCOLA) INNER JOIN NIVEL_ENSINO NE USING(ID_NIVEL_ENSINO) INNER JOIN MM_PRODUTOS P USING(ID_PRODUTO) INNER JOIN MM_UNIDADES_MEDIDA MUM USING(ID_UNIDADE_MEDIDA) WHERE MC.STATUS = ? AND EE.ID_NIVEL_ENSINO = ? AND MC.ID_ESCOLA = ? AND MP.ID_PRODUTO = ?", array(
			1,
			$nivelEnsino,
			$unidadeEnsino,
			$produto
		))->result_array()[0];

	}

}


?>