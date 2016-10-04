<?php

/**
 * Set routes for the application.
 *
 * @var \Illuminate\Routing\Router $router
 * @see \Aurora\Providers\RouteServiceProvider
 */

// Homepage
$router->get('/', 'HomeController@home');

// Authentication
$router->get('auth/login', 'Auth\AuthController@getLogin');
$router->get('auth/logout', 'Auth\AuthController@getLogout');

// Users
$router->resource('users', 'UsersController', ['except' => ['create', 'store']]);
$router->get('search', ['as' => 'user.search', 'uses' => 'UsersController@search']);

// Superusers
$router->resource('superusers', 'SuperusersController', ['only' => ['index']]);

// Clients
$router->resource('clients', 'ClientController');
