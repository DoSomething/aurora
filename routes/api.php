<?php

/**
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * contains the "api" middleware group. Now create something great!
 *
 * @var \Illuminate\Routing\Router $router
 * @see \Aurora\Providers\RouteServiceProvider
 */

// Total User Count
$router->get('/total', 'Api\TotalsController@index');
