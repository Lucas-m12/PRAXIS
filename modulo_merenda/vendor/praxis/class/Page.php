<?php 

namespace Praxis;

use Rain\Tpl;
use Praxis\Pedidos;
use Praxis\Usuario;


class Page {

	private $tpl;
	private $options = [];
	private $defaults = [
		"header"=>true,
		"footer"=>true,
		"data"=>[]
	];
	private $usuario;

	public function __construct($assign = array(), $opts = array(), $dadosUsuario = false, $nivelAcesso, $nomeUnidade, $inepUnidade, $tpl_dir = "/praxis/modulo_merenda/public/views"){
		
		$this->options = array_merge($this->defaults, $opts);

		$config = array(
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$tpl_dir,
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/praxis/modulo_merenda/public/views-cache",
			"debug"         => false
	    );

		Tpl::configure( $config );

		$this->tpl = new Tpl;

		$this->usuario = new Usuario();

		$this->setData([
			"dados"			=>$this->usuario->consultarUsuario($dadosUsuario),
			"cidade"		=>"praxis",//$_SERVER['DOCUMENT_ROOT'],
			"inepUnidade"	=>$inepUnidade,
			"nivelAcesso"	=>$nivelAcesso,
			"unidade"		=>$nomeUnidade
		]);

		$this->setData($this->options["data"]);

		if ($this->options["header"] === true) $this->tpl->draw("header");

	}

	private function setData($data = array()){

		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}

	}

	public function setTpl($name, $data = array(), $returnHTML = false){

		$this->setData($data);

		return $this->tpl->draw($name, $returnHTML);

	}

	public function __destruct(){

		$this->setData([
			"cidade"=>"praxis"
		]);

		if ($this->options["footer"] === true) $this->tpl->draw("footer");

	}

}

 ?>