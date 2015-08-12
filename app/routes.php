<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
  return View::make('hello');
});

# Authentication
Route::get('login', ['as' => 'login', 'uses' => 'SessionsController@create']);
Route::get('logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);
Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);

# Users
Route::resource('users', 'UsersController');

# Delete Northstar User
Route::delete('northstar-user-delete/{user}', ['as' => 'northstar.delete', 'uses' => 'UsersController@deleteNorthstarUser']);


# Display edit form with merged users
Route::get('merge', ['as' => 'users.merge', 'uses' => 'UsersController@mergedForm']);

# Delete other users that were not selected
Route::post('merge', ['as' => 'users.merge-and-delete', 'uses' => 'UsersController@deleteUnmergedUsers']);

# Create admins.
Route::post('admin/{user}', ['as' => 'admin.create', 'uses' => 'UsersController@adminCreate']);

Route::get('/admins', 'UsersController@adminIndex');

# Key
Route::resource('keys', 'KeyController');

# Mobile Commons Message Backlog
Route::get('/users/{user}/mobile-commons-messages', 'UsersController@mobileCommonsMessages');

# Zendesk Requested Tickets Backlog
Route::get('/users/{user}/zendesk-tickets', 'UsersController@zendeskTickets');

# Search
Route::post('search', ['as' => 'users.search', 'uses' => 'UsersController@search', 'before' =>'auth']);

# Advanced Search
Route::post('/advanced-search', 'UsersController@advancedSearch');
