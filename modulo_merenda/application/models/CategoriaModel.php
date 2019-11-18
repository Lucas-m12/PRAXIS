<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriaModel extends CI_Model{

	private $categoria;
	private $status;


	public function getStatus(){
		return $this->status;
	}

	public function setStatus($value){
		$this->status = $value;
	}

	public function getCategoria(){
		return $this->categoria;
	}

	public function setCategoria($value){
		$this->categoria = mb_strtoupper($value);
	}



	public function categorias($idCategoria = ''){

		return $this->db->query("SELECT * FROM MM_CATEGORIA_PRODUTO WHERE ID_CATEGORIA != ?", array(
			"?"=>$idCategoria
		))->result_array();

	}



	public function cadastrarCategoria(){

		$this->db->query("INSERT INTO MM_CATEGORIA_PRODUTO(DESC_CATEGORIA) VALUES(?)", array(
			"?"=>$this->getCategoria()
		));

	}

	public function dadosCategoria($idCategoria){

		return $this->db->query("SELECT * FROM MM_CATEGORIA_PRODUTO WHERE ID_CATEGORIA = ?", array(
			$idCategoria
		))->result_array()[0];

	}

	public function atualizarCategoria($idCategoria){

		$this->db->query("UPDATE MM_CATEGORIA_PRODUTO SET DESC_CATEGORIA = ?, STATUS = ? WHERE ID_CATEGORIA = ?", array(
			$this->getCategoria(),
			$this->getStatus(),
			$idCategoria
		));

	}


}


?>