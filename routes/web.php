<?php

use Illuminate\Support\Facades\Route;

/**
 * Here is where you can register web routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * contains the "web" middleware group. Now create something great!
 *
 * @var \Illuminate\Routing\Router $router
 * @see \Aurora\Providers\RouteServiceProvider
 */

// Homepage
Route::get('/', 'HomeController@home')->name('login');

// Authentication
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Users
Route::resource('users', 'UsersController', ['except' => ['create', 'edit', 'store']]);
Route::get('users/{id}/edit', ['as' => 'users.edit', 'uses' => 'UsersController@edit']);
Route::get('search', ['as' => 'user.search', 'uses' => 'UsersController@search']);
Route::get('users/{user}/merge', ['as' => 'users.merge.create', 'uses' => 'MergeController@create']);
Route::post('users/{user}/merge', ['as' => 'users.merge.store', 'uses' => 'MergeController@store']);
Route::post('users/{user}/resets', ['as' => 'users.resets.create', 'uses' => 'UsersController@sendPasswordReset']);

// Superusers
Route::resource('superusers', 'SuperusersController', ['only' => ['index']]);

// Clients
Route::resource('clients', 'ClientController');

// Redirects
Route::resource('redirects', 'RedirectsController');
