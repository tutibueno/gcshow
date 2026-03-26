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
$routes->get('/loja', 'Loja::index');
$routes->get('/loja/produto/(:segment)', 'Loja::detalhes/$1');
$routes->get('/loja/carrinho', 'Loja::carrinho');
$routes->post('/loja/carrinho/adicionar', 'Loja::adicionarCarrinho');
$routes->post('/loja/carrinho/remover', 'Loja::removerCarrinho');
$routes->post('/loja/carrinho/frete', 'Loja::calcularFrete');
$routes->get('/loja/checkout', 'Loja::checkout');
$routes->post('/loja/finalizar-pedido', 'Loja::finalizarPedido');
$routes->match(['GET', 'POST'], '/loja/meus-pedidos', 'Loja::meusPedidos');

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
});

//Eventos
