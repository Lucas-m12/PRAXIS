<?php
require_once("vendor/autoload.php");

use Slim\Slim;

session_start();

$app = new Slim();


require_once('routes/web.php');
require_once('routes/cadastro.php');
require_once('routes/pesquisa.php');
require_once('routes/edicao.php');
require_once('routes/pedidos.php');
require_once('routes/estoque.php');

$app->run();
?>