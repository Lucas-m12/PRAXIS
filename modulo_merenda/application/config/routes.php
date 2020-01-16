<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['mainListar/(:num)'] = 'home/listaRaca/$1';  // Ex: $route['nome da rota'] = 'controller/metodo';

//Rotas de login do usuário
$route['login']           				= 'home';
$route['logoff']          				= 'home/logoff';
$route['autenticar']      				= 'login/autenticarUsuario';
$route['inicio']          				= 'home/inicio';
//Rotas Estoque
$route['estoque'] 						= 'estoque/estoqueAtual';
$route['pesquisar-estoque']				= 'estoque/pesquisarEstoque';
$route['estoqueEscola']					= 'estoque/estoqueEscolaCentralView';
// Rotas Pedidos
$route['pedidos'] 						= 'pedido/viewPedidos';
$route['codigo-pedido']					= 'pedido/codigoPedido';
$route['novoPedido/(:num)']				= 'pedido/viewNovoPedido/$1';
$route['cadastrar-pedido']				= 'pedido/cadastrarInfoPedido';
$route['produtosPedido/(:num)'] 		= 'pedido/viewProdutosPedido/$1';
$route['pesquisa-produtoForn'] 			= 'pedido/pesquisarProdutoFornecedor';
$route['pesquisa-unidadeMedida']		= 'pedido/pesquisarUndiadeMedidaFornecedor';
$route['cadastrar-itensPedido']			= 'pedido/cadastrarItensPedido';
$route['pesquisa-pedido']				= 'pedido/pesquisarPedido';
$route['editar-pedido/(:num)']			= 'pedido/editarPedidoView/$1';
$route['editar-statusPedido']			= 'pedido/editarStatusPedido';
$route['excluir-itemPedido']			= 'pedido/excluirItemPedido';
$route['pedidos-pendentesEscola']		= 'pedido/listaPedidosEscolaView';
$route['lista-pedidoEscola']			= 'pedido/listarPedidosEscola';
$route['editarPedido-escola/(:num)']	= 'pedido/editarStatusPedidoEscolaView/$1';
$route['autorizar-pedidoEscola']		= 'pedido/autorizarPedidoEscola';

// Rotas Programas
$route['programas'] 					= 'programa/listarProgramas';
$route['cadastrar-programa'] 			= 'programa/cadastrarPrograma';
$route['editar-programa/(:num)'] 		= 'programa/edicaoProgramaView/$1';
$route['atualizar-programa']			= 'programa/atualizarPrograma';
// Rotas Fornecedores
$route['fornecedores'] 					= 'fornecedor/viewFornecedores';
$route['pesquisa-fornecedor']			= 'fornecedor/pesquisarFornecedor';
$route['codigo-fornecedor']				= 'fornecedor/codigoFornecedor';
$route['novoFornecedor/(:num)']			= 'fornecedor/viewNovoFornecedor/$1';
$route['cadastrar-fornecedor']			= 'fornecedor/cadastrarFornecedor';
$route['editar-fornecedor/(:num)']		= 'fornecedor/editarFornecedorView/$1';
$route['atualizar-fornecedor']			= 'fornecedor/atualizarFornecedor';
// Rotas produtos
$route['view-produtos'] 				= 'produto/viewProdutos';
$route['tipos'] 						= 'produto/viewTiposProdutos';
$route['cadastrar-tipo']				= 'produto/cadastrarTipoProduto';
$route['pesquisa-produto']				= 'produto/pesquisarProduto';
$route['cadastrar-produto']				= 'produto/cadastrarProduto';
$route['editar-produto/(:num)']			= 'produto/atualizarProdutoView/$1';
$route['atualizar-produto']				= 'produto/atualizarProduto';
$route['editar-tipo/(:num)']			= 'produto/editarTipoProdutoView/$1';
$route['atualizar-tipoProduto']			= 'produto/atualizarTipoProduto';
// Rotas categorias
$route['categorias'] 					= 'categoria/listarCategorias';
$route['cadastrar-categoria'] 			= 'categoria/cadastrarCategoria';
$route['editar-categoria/(:num)']		= 'categoria/editarCategoriaView/$1';
$route['atualizar-categoria']			= 'categoria/atualizarCategoria';
// licitacoes
$route['licitacoes']					= 'licitacao/licitacoesView';
$route['pesquisa-licitacao']			= 'licitacao/pesquisarLicitacoes';
$route['cadastrar-licitacao']			= 'licitacao/cadastrarLicitacao';
$route['itens-licitacao/(:num)']		= 'licitacao/itensLicitacaoView/$1';
$route['cadastrar-itemLicitacao']		= 'licitacao/cadastrarItensLicitacao';
$route['remover-itemLicitacao']			= 'licitacao/removerItemLicitacao';
$route['editar-licitacao/(:num)']		= 'licitacao/editarLicitacaoView/$1';
$route['atualizar-licitacao']			= 'licitacao/atualizarLicitacao';
// perCapita
$route['perCapita']						= 'perCapita/perCapitaView';
// $route['cadastro-percapita']			= 'perCapita/cadastroPerCapitaView';
$route['cadastrar-perCapita']			= 'perCapita/cadastrarPerCapita';
$route['edicao-percapitaView/(:num)']	= 'perCapita/editarPerCapitaView/$1';
$route['editarPerCapita']				= 'perCapita/editarPerCapita';
$route['valorPercapita']				= 'perCapita/valorPercapita';
// Receitas
$route['receitas']						= 'receita/receitasView';
$route['pesquisarReceita']				= 'receita/pesquisaReceita';
$route['novaReceita']					= 'receita/novaReceitaView';
$route['cadastrarReceita']				= 'receita/cadastrarReceita';
$route['editarReceita/(:num)']			= 'receita/edicaoReceitaView/$1';
$route['editarReceita']					= 'receita/editarReceita';
// Relatórios
$route['relatorio-estoque']				= 'estoque/relatorioEstoque';
$route['relatorio/(:num)/licitacao']	= 'licitacao/relatorioLicitacao/$1';
$route['relatorio/(:num)/pedido']		= 'pedido/relatorioPedido/$1';
$route['relatorioPercapitaView']		= 'perCapita/relatorioPercapitaView';
$route['relatorioPerCapita']			= 'perCapita/relatorioPerCapita';




/////////////////////////////////////ROTAS PARA UNIDADE DE ENSINO////////////////////////////////////////////////

//ROTAS PEDIDOS

$route['pedidos-escola'] 				= 'pedido/viewPedidoEscola';
$route['pesquisa-pedidoEscola']			= 'pedido/pesquisarPedidoEscola';
$route['codigo-pedidoEscola']			= 'pedido/codigoPedidoEscola';
$route['novoPedidoEscola/(:num)']		= 'pedido/novoPedidoEscolaView/$1';
$route['cadastrar-pedido-escola']		= 'pedido/cadastrarInfoPedidoEscola';
$route['produtosPedidoEscola/(:num)'] 	= 'pedido/ItensPedidoEscolaView/$1';
$route['cadastrar-itensPedidoEscola']	= 'pedido/cadastrarItensPedidoEscola';
$route['excluir-itemPedidoEscola']		= 'pedido/excluirItemPedidoEscola';
$route['editarPedidoEscola/(:num)']		= 'pedido/editarPedidoEscolaView/$1';
$route['finalizarPedidoEscola']			= 'pedido/editarStatusPedidoEscola';

// ROTAS ESTOQUE

$route['estoque-escola/(:num)']			= 'estoque/estoqueEscolaView/$1';
$route['pesquisar-estoqueEscola']		= 'estoque/pesquisarEstoqueEscola';

/////////////////////////////////////ROTAS PARA GESTOR//////////////////////////////////////////////////////////

// ROTAS PEDIDOS

$route['pedidos-gestor'] 				= 'pedido/viewPedidosGestor';
$route['edicaoPedido-gestor/(:num)']	= 'pedido/viewAutorizacaoPedido/$1';