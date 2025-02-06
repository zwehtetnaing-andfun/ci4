<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/articles','Article::index');
$routes->get('/articles/create','Article::create');
$routes->post('/articles/store','Article::store');
$routes->get('/articles/edit/(:num)','Article::edit/$1');
$routes->post('/articles/update/(:num)','Article::update/$1');
$routes->post('/articles/delete/(:num)','Article::delete/$1');