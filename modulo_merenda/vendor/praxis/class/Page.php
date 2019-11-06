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

		$this->tpl->assign("dados", $this->usuario->consultarUsuario($dadosUsuario));

		$this->tpl->assign("unidade", $nomeUnidade);

		$this->tpl->assign("nivelAcesso", $nivelAcesso);

		$this->tpl->assign("inepUnidade", $inepUnidade);

		$this->setData($this->options["data"]);

		if ($this->options["header"] === true) $this->tpl->draw("header");

	}

	private function setData($data = array())
	{
		$p = [];

		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}

	}

	public function setTpl($name, $data = array(), $returnHTML = false)
	{

		$this->setData($data);
		// $this->tpl->assign($data);


		return $this->tpl->draw($name, $returnHTML);

	}

	public function __destruct(){

		if ($this->options["footer"] === true) $this->tpl->draw("footer");

	}

}

 ?>