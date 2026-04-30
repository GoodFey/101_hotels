<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/comments', 'Comments::index');
$routes->get('/comments/list', 'Comments::getList');
$routes->post('/comments', 'Comments::store');
$routes->delete('/comments/(:num)', 'Comments::delete/$1');
