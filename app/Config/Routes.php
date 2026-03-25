<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Publico
$routes->get('/', 'Home::index');
$routes->get('/welcome', 'Home::welcome');
$routes->get('/homeold', 'Home::homeold');

// EVENTOS PUBLICO
$routes->get('/eventos', 'Eventos::index');
$routes->get('/eventos/anteriores', 'Eventos::anteriores');
$routes->get('/evento/(:num)', 'Eventos::detalhes/$1');

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
});

//Eventos

