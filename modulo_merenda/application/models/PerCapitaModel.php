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

	public function dadosPerCapitaRelatorio($unidadeEnsino, $receita){

		return $this->db->query("SELECT MR.PERCAPITA AS VALOR_PERCAPITA, MP.DESC_PRODUTO, MP.ID_PRODUTO, MR.NOME_RECEITA, MUM.SIGLA_UNIDADE_MEDIDA, MC.ID_MATRICULA, UE.NOME_ESCOLA, NE.DS_NIVEL_ENSINO, COUNT(MC.ID_MATRICULA) FROM MM_RECEITAS MR INNER JOIN MM_PRODUTOS_RECEITA MPR USING(ID_RECEITA) INNER JOIN MM_PRODUTOS MP USING(ID_PRODUTO) INNER JOIN MM_UNIDADES_MEDIDA MUM USING(ID_UNIDADE_MEDIDA) INNER JOIN NIVEL_ENSINO NE ON MR.ID_NIVEL_ENSINO = NE.ID_NIVEL_ENSINO INNER JOIN ETAPAS_ENSINO EE ON NE.ID_NIVEL_ENSINO = EE.ID_NIVEL_ENSINO INNER JOIN SUB_ETAPA SE ON EE.ID_ETAPA = SE.ID_ETAPA INNER JOIN MATRICULA_COMUM MC ON SE.ID_SUB_ETAPA = MC.ID_SUB_ETAPA INNER JOIN UNIDADE_ENSINO_00 UE ON MC.ID_ESCOLA = UE.ID_ESCOLA WHERE MR.ID_RECEITA = ? AND MC.ID_ESCOLA = ? AND MC.STATUS = ?", array(
			$receita,
			$unidadeEnsino,
			1
		))->result_array();
		// return $this->db->query("SELECT MR.PERCAPITA AS VALOR_PERCAPITA, COUNT(MC.ID_MATRICULA) AS QTD_ALUNOS, UE.NOME_ESCOLA, NE.DS_NIVEL_ENSINO, MPR.ID_PRODUTO, MP.DESC_PRODUTO, MUM.SIGLA_UNIDADE_MEDIDA FROM MM_RECEITAS MR INNER JOIN MM_PRODUTOS_RECEITA MPR USING(ID_RECEITA) INNER JOIN MM_PRODUTOS MP USING(ID_PRODUTO) INNER JOIN MM_UNIDADES_MEDIDA MUM USING(ID_UNIDADE_MEDIDA) INNER JOIN NIVEL_ENSINO NE USING(ID_NIVEL_ENSINO) INNER JOIN ETAPAS_ENSINO EE USING(ID_NIVEL_ENSINO) INNER JOIN SUB_ETAPA SE USING(ID_ETAPA) INNER JOIN MATRICULA_COMUM MC USING(ID_SUB_ETAPA) INNER JOIN UNIDADE_ENSINO_00 UE USING(ID_ESCOLA) WHERE MR.ID_RECEITA = ? AND MC.ID_ESCOLA = ? AND MC.STATUS = ?", array(
		// 	$receita,
		// 	$unidadeEnsino,
		// 	1
		// ))->result_array();

	}

}


?>