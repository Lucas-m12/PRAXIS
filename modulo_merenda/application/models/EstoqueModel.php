<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstoqueModel extends CI_Model{

	public function pesquisarEstoque($programa = "", $produto = ""){

		return $this->db->query("SELECT * FROM MM_ESTOQUE ME WHERE ME.ID_PROGRAMA LIKE ? AND ME.ID_PRODUTO LIKE ?", array(
			$programa,
			$produto
		))->result_array();

	}

}


?>