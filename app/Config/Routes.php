<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('products', 'ProductController::index');
$routes->get('products/create', 'ProductController::create');
$routes->post('products/store', 'ProductController::store');
$routes->post('products/delete/(:num)', 'ProductController::delete/$1');

$routes->post('auth/generate', 'AuthController::generateApiKey');
$routes->get('api/products', 'ProductApiController::index');
$routes->post('api/products', 'ProductApiController::create');

$routes->group('cart', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->post('add/(:num)', 'CartController::add/$1');
    $routes->get('view', 'CartController::view');
    $routes->post('remove/(:num)', 'CartController::remove/$1');
});

