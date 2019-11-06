<?php
namespace Praxis;

use Praxis\Sql;

class Status{

	public function alterarStatusCategoria($status, $idCategoria){
		$sql = new Sql();

		$sql->query("UPDATE MM_CATEGORIA_PRODUTO SET STATUS = :STATUS WHERE ID_CATEGORIA = :ID_CATEGORIA", array(
			":STATUS"		=>$status,
			":ID_CATEGORIA"	=>$idCategoria
		));
	}

	public function alterarStatusTipo($status, $idTipo){
		$sql = new Sql();

		$sql->query("UPDATE MM_TIPO_PRODUTOS SET STATUS = :STATUS WHERE ID_TIPO = :ID_TIPO", array(
			":ID_TIPO"	=>$idTipo,
			":STATUS"	=>$status
		));

	}

	public function alterarStatusPrograma($status, $idPrograma){
		$sql = new Sql();

		$sql->query("UPDATE MM_PROGRAMAS SET STATUS = :STATUS WHERE ID_PROGRAMA = :ID_PROGRAMA", array(
			":ID_PROGRAMA"	=>$idPrograma,
			":STATUS"		=>$status
		));
	}
}


?>