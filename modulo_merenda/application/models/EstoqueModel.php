<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstoqueModel extends CI_Model{

	public function pesquisarEstoque($programa = "", $produto = ""){

		return $this->db->query("SELECT MP.DESC_PROGRAMA, P.DESC_PRODUTO, MUM.SIGLA_UNIDADE_MEDIDA, ME.ESTOQUE_ATUAL FROM MM_ESTOQUE ME INNER JOIN MM_PROGRAMAS MP USING(ID_PROGRAMA) INNER JOIN MM_PRODUTOS P USING(ID_PRODUTO) INNER JOIN MM_UNIDADES_MEDIDA MUM USING(ID_UNIDADE_MEDIDA) WHERE ME.ID_PROGRAMA LIKE ? AND ME.ID_PRODUTO LIKE ?", array(
			"%".$programa."%",
			"%".$produto."%"
		))->result_array();

	}

	public function relatorioEstoque(){

		return $this->db->query("SELECT ME.ESTOQUE_ATUAL, MP.PROGRAMA, P.DESC_PRODUTO, MUM.SIGLA_UNIDADE_MEDIDA FROM MM_ESTOQUE ME INNER JOIN MM_PROGRAMAS MP USING(ID_PROGRAMA) INNER JOIN MM_PRODUTOS P USING(ID_PRODUTO) INNER JOIN MM_UNIDADES_MEDIDA MUM USING(ID_UNIDADE_MEDIDA) WHERE ME.STATUS = ?", array(
			1
		))->result_array();

	}

	public function pesquisarEstoqueEscola($programa = "", $produto = "", $escola = ""){

		return $this->db->query("SELECT MP.DESC_PROGRAMA, P.DESC_PRODUTO, MUM.SIGLA_UNIDADE_MEDIDA, MEE.ESTOQUE_ATUAL FROM MM_ESTOQUE_ESCOLA MEE INNER JOIN MM_PROGRAMAS MP USING(ID_PROGRAMA) INNER JOIN MM_PRODUTOS P USING(ID_PRODUTO) INNER JOIN MM_UNIDADES_MEDIDA MUM USING(ID_UNIDADE_MEDIDA) WHERE MEE.ID_PROGRAMA LIKE ? AND MEE.ID_PRODUTO LIKE ? AND MEE.ID_ESCOLA LIKE ?", array(
			"%".$programa."%",
			"%".$produto."%",
			"%".$escola."%"
		))->result_array();

	}

	public function listarEscolas($idEscola = 1){

		return $this->db->query("SELECT ID_ESCOLA, NOME_ESCOLA FROM UNIDADE_ENSINO_00 WHERE ID_ESCOLA != ?", array(
			$idEscola
		))->result_array();

	}

}


?>