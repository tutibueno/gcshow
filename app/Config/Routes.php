<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Publico
$routes->get('/', 'Home::index');
$routes->get('/welcome', 'Home::welcome');
$routes->get('/homeold', 'Home::homeold');
$routes->get('/sobre', 'Institucional::index');

// EVENTOS PUBLICO
$routes->get('/eventos', 'Eventos::index');
$routes->get('/eventos/anteriores', 'Eventos::anteriores');
$routes->get('/evento/(:num)', 'Eventos::detalhes/$1');
$routes->get('/galeria', 'Galeria::index');
$routes->get('/parceiros', 'Parceiros::index');
$routes->get('/loja', 'Loja::index');
$routes->get('/loja/produto/(:segment)', 'Loja::detalhes/$1');
$routes->get('/loja/carrinho', 'Loja::carrinho');
$routes->post('/loja/carrinho/adicionar', 'Loja::adicionarCarrinho');
$routes->post('/loja/carrinho/remover', 'Loja::removerCarrinho');
$routes->post('/loja/carrinho/frete', 'Loja::calcularFrete');
$routes->get('/loja/checkout', 'Loja::checkout');
$routes->post('/loja/finalizar-pedido', 'Loja::finalizarPedido');
$routes->match(['GET', 'POST'], '/loja/meus-pedidos', 'Loja::meusPedidos');
$routes->get('/newsletter', 'Newsletter::index');
$routes->post('/newsletter/subscribe', 'Newsletter::subscribe');
$routes->get('/newsletter/unsubscribe/(:segment)', 'Newsletter::unsubscribe/$1');

// LOGIN
$routes->get('/admin', 'Admin\Login::index');
$routes->post('/admin/login/autenticar', 'Admin\Login::autenticar');
$routes->get('/admin/sair', 'Admin\Login::sair');

// ADMIN (PROTEGIDO)
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    

    // Dashboard
    $routes->get('dashboard', 'Admin\Dashboard::index');

    // EVENTOS
    $routes->get('eventos', 'Admin\Eventos::index');
    $routes->get('eventos/criar', 'Admin\Eventos::criar');
    $routes->post('eventos/salvar', 'Admin\Eventos::salvar');
    $routes->get('eventos/editar/(:num)', 'Admin\Eventos::editar/$1');
    $routes->post('eventos/atualizar/(:num)', 'Admin\Eventos::atualizar/$1');
    $routes->get('eventos/excluir/(:num)', 'Admin\Eventos::excluir/$1');

    //Galeria
    $routes->get('galeria', 'Admin\Galeria::index');
    $routes->post('galeria/salvar', 'Admin\Galeria::salvar');
    $routes->get('galeria/excluir/(:num)', 'Admin\Galeria::excluir/$1');

    // Institucional
    $routes->get('institucional', 'Admin\Institucional::index');
    $routes->post('institucional/salvar', 'Admin\Institucional::salvar');

    // Loja
    $routes->get('categorias', 'Admin\Categorias::index');
    $routes->post('categorias/salvar', 'Admin\Categorias::salvar');
    $routes->post('categorias/atualizar/(:num)', 'Admin\Categorias::atualizar/$1');
    $routes->get('categorias/excluir/(:num)', 'Admin\Categorias::excluir/$1');

    $routes->get('produtos', 'Admin\Produtos::index');
    $routes->get('produtos/criar', 'Admin\Produtos::criar');
    $routes->post('produtos/salvar', 'Admin\Produtos::salvar');
    $routes->get('produtos/editar/(:num)', 'Admin\Produtos::editar/$1');
    $routes->post('produtos/atualizar/(:num)', 'Admin\Produtos::atualizar/$1');
    $routes->get('produtos/excluir/(:num)', 'Admin\Produtos::excluir/$1');

    $routes->get('pedidos', 'Admin\Pedidos::index');
    $routes->get('pedidos/(:num)', 'Admin\Pedidos::detalhes/$1');
    $routes->post('pedidos/atualizar-status/(:num)', 'Admin\Pedidos::atualizarStatus/$1');

    $routes->get('relatorios/vendas', 'Admin\Relatorios::vendas');

    $routes->get('newsletter', 'Admin\Newsletter::index');
    $routes->get('newsletter/export', 'Admin\Newsletter::exportCsv');
    $routes->post('newsletter/status/(:num)', 'Admin\Newsletter::updateStatus/$1');
    $routes->get('newsletter/delete/(:num)', 'Admin\Newsletter::delete/$1');

    // Parceiros
    $routes->get('parceiros', 'Admin\Parceiros::index');
    $routes->get('parceiros/criar', 'Admin\Parceiros::criar');
    $routes->post('parceiros/salvar', 'Admin\Parceiros::salvar', ['filter' => 'csrf']);
    $routes->get('parceiros/editar/(:num)', 'Admin\Parceiros::editar/$1');
    $routes->post('parceiros/atualizar/(:num)', 'Admin\Parceiros::atualizar/$1', ['filter' => 'csrf']);
    $routes->post('parceiros/toggle/(:num)', 'Admin\Parceiros::toggle/$1', ['filter' => 'csrf']);
    $routes->post('parceiros/excluir/(:num)', 'Admin\Parceiros::excluir/$1', ['filter' => 'csrf']);
});

//Eventos
