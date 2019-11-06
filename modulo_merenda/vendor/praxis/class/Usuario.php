<?php
namespace Praxis;

use Praxis\Sql;

class Usuario{

	public function consultarUsuario($idUsuario){
		
		$sql = new Sql();
		
		return $sql->select("SELECT UA.ID_USUARIO, P.NOME_PROFISSIONAL FROM USUARIO_ADMINISTRATIVO UA INNER JOIN PROFISSIONAL_30 P USING(ID_PROFISSIONAL) WHERE UA.ID_USUARIO = :ID_USUARIO", array(
			":ID_USUARIO"=>$idUsuario
		));

	}

}


?>