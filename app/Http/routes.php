<?php

/**
 * Set routes for the application.
 *
 * @var \Illuminate\Routing\Router $router
 * @see \Northstar\Providers\RouteServiceProvider
 */

$router->get('/', function () {
    return redirect()->route('users.index');
});

// Authentication
$router->get('auth/login', 'Auth\AuthController@getLogin');
$router->post('auth/login', 'Auth\AuthController@postLogin');
$router->get('auth/logout', 'Auth\AuthController@getLogout');

// Users
$router->resource('users', 'UsersController', ['except' => ['create', 'store']]);
$router->get('search', ['as' => 'user.search', 'uses' => 'UsersController@search']);

// Aurora Users
$router->resource('aurora-users', 'AuroraUsersController', ['only' => ['index', 'edit', 'update']]);

// Key
$router->resource('keys', 'KeyController');
