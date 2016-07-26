<?php

/**
 * Set routes for the application.
 *
 * @var \Illuminate\Routing\Router $router
 * @see \Northstar\Providers\RouteServiceProvider
 */

// Redirect to the users index from the homepage
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

// Superusers
$router->resource('superusers', 'SuperusersController', ['only' => ['index']]);

// Key
$router->resource('clients', 'ClientController');
