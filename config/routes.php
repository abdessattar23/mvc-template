<?php

$router = new \App\Core\Router();

$router->get('/', 'HomeController@index');

$router->get('/login', 'AuthController@login');
$router->post('/handllogin', 'AuthController@handllogin');

$router->get('/register', 'AuthController@register');
$router->post('/handlregister', 'AuthController@handlregister');

$router->get('/logout', 'AuthController@logout');

$router->get('/dashboard', 'DashboardController@index');

$router->get('/admin/dashboard', 'DashboardController@index');
$router->get('/admin/users', 'AdminController@users');
$router->get('/admin/permissions', 'AdminController@permissions');
$router->post('/admin/permissions', 'AdminController@permissions');

return $router;