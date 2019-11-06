<?php
namespace Praxis;

class Mascara{

	public function limpaCPF($valor){
		
		$valor = trim($valor);
		
		$valor = str_replace(".", "", $valor);
		
		$valor = str_replace(",", "", $valor);
		
		$valor = str_replace("-", "", $valor);
		
		$valor = str_replace("/", "", $valor);
		
		$valor = str_replace("(", "", $valor);
		
		$valor = str_replace(")", "", $valor);
		
		$valor = str_replace("_", "", $valor);
		
		$valor = str_replace(" ", "", $valor);

		return $valor;
	}

}

?>