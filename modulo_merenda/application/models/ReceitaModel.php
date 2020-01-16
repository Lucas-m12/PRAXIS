<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReceitaModel extends CI_Model{

	private $idReceita;
	private $nomeReceita;
	private $nivelEnsino;
	private $perCapita;


	public function getPerCapita() {
	    return $this->perCapita;
	}
	 
	public function setPerCapita($perCapita) {
	    $this->perCapita = $perCapita;
	}

	public function getIdReceita() {
	    return $this->idReceita;
	}
	 
	public function setIdReceita($idReceita) {
	    $this->idReceita = $idReceita;
	}
	public function getNomeReceita() {
	    return $this->nomeReceita;
	}
	 
	public function setNomeReceita($nomeReceita) {
	    $this->nomeReceita = mb_strtoupper($nomeReceita);
	}
	public function getNivelEnsino() {
	    return $this->nivelEnsino;
	}
	 
	public function setNivelEnsino($nivelEnsino) {
	    $this->nivelEnsino = $nivelEnsino;
	}




	public function listarReceitas($idReceita = ""){

		return $this->db->query("SELECT ID_RECEITA, NOME_RECEITA FROM MM_RECEITAS WHERE ID_RECEITA != ?", array(
			$idReceita
		))->result_array();

	}


	public function pesquisarReceita(){

		return $this->db->query("SELECT MR.*, NE.DS_NIVEL_ENSINO FROM MM_RECEITAS MR INNER JOIN NIVEL_ENSINO NE USING(ID_NIVEL_ENSINO) WHERE MR.ID_RECEITA LIKE ? AND MR.NOME_RECEITA LIKE ? AND MR.ID_NIVEL_ENSINO LIKE ?", array(
			"%".$this->getIdReceita()."%",
			"%".$this->getNomeReceita()."%",
			"%".$this->getNivelEnsino()."%"
		))->result_array();

	}

	public function cadastrarReceita(){

		$this->db->query("INSERT INTO MM_RECEITAS(NOME_RECEITA, ID_NIVEL_ENSINO, PERCAPITA) VALUES (?, ?, ?)", array(
			$this->getNomeReceita(),
			$this->getNivelEnsino(),
			$this->getPerCapita()
		));

		$lastId = $this->db->insert_id();

		return $lastId;

	}

	public function editarReceita(){

		$this->db->query("UPDATE MM_RECEITAS SET NOME_RECEITA = ?, ID_NIVEL_ENSINO = ?, PERCAPITA = ? WHERE ID_RECEITA = ?", array(
			$this->getNomeReceita(),
			$this->getNivelEnsino(),
			$this->getPerCapita(),
			$this->getIdReceita()
		));

	}

	public function cadastrarProdutosReceita($idReceita, $produto){

		$this->db->query("INSERT INTO MM_PRODUTOS_RECEITA(ID_RECEITA, ID_PRODUTO) VALUES(?, ?)", array(
			$idReceita,
			$produto
		));

	}

	public function excluirProdutosReceita($idReceita){

		$this->db->query("DELETE FROM MM_PRODUTOS_RECEITA WHERE ID_RECEITA = ?", array($idReceita));

	}

	public function dadosReceita($idReceita){

		return $this->db->query("SELECT MR.*, NE.DS_NIVEL_ENSINO, MPR.ID_PRODUTO, MP.DESC_PRODUTO FROM MM_RECEITAS MR INNER JOIN MM_PRODUTOS_RECEITA MPR USING(ID_RECEITA) INNER JOIN NIVEL_ENSINO NE USING(ID_NIVEL_ENSINO) INNER JOIN MM_PRODUTOS MP USING(ID_PRODUTO) WHERE MR.ID_RECEITA = ?", array(
			$idReceita
		))->result_array();

	}





}


?>