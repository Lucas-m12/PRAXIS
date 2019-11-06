<?php
namespace Praxis;

use Praxis\Status;

class ControllerStatus{

	public function __construct($tipoCadastro, $id, $status){
		$statusClass = new Status();

		switch ($tipoCadastro) {
			case 'categoria':
				# code...
				$statusClass->alterarStatusCategoria($status, $id);
				break;
			case 'tipo':
				# code...
				$statusClass->alterarStatusTipo($status, $id);
				break;
			case 'programa':
				# code...
				$statusClass->alterarStatusPrograma($status, $id);
				break;
		}

	}

}


?>