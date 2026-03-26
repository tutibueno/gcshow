<?php

/** @var \CodeIgniter\Router\RouteCollection $routes */

$routes->get('newsletter', '\App\Modules\Newsletter\Controllers\NewsletterController::index');
$routes->post('newsletter/subscribe', '\App\Modules\Newsletter\Controllers\NewsletterController::subscribe');
$routes->get('newsletter/unsubscribe/(:segment)', '\App\Modules\Newsletter\Controllers\NewsletterController::unsubscribe/$1');

$routes->group('admin/newsletter', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', '\App\Modules\Newsletter\Controllers\Admin\SubscribersController::index');
    $routes->get('export', '\App\Modules\Newsletter\Controllers\Admin\SubscribersController::exportCsv');
    $routes->post('status/(:num)', '\App\Modules\Newsletter\Controllers\Admin\SubscribersController::updateStatus/$1');
    $routes->get('delete/(:num)', '\App\Modules\Newsletter\Controllers\Admin\SubscribersController::delete/$1');
});
