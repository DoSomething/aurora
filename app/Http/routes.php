<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect()->route('users.index');
});

// Authentication
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Users
Route::resource('users', 'UsersController', ['except' => ['create', 'store']]);

// Aurora Users
Route::resource('aurora-users', 'AuroraUsersController', ['only' => ['index']]);

// Delete Northstar User
Route::delete('northstar-user-delete/{user}', ['as' => 'northstar.delete', 'uses' => 'UsersController@deleteNorthstarUser']);

// Display edit form with merged users
Route::get('merge', ['as' => 'users.merge', 'uses' => 'UsersController@mergedForm']);

// Delete other users that were not selected
Route::post('merge', ['as' => 'users.merge-and-delete', 'uses' => 'UsersController@deleteUnmergedUsers']);

// Create admins.
Route::post('role/{user}', ['as' => 'role.create', 'uses' => 'UsersController@roleCreate']);


// Key
Route::resource('keys', 'KeyController');

// Mobile Commons Message Backlog
Route::get('/users/{user}/mobile-commons-messages', 'UsersController@mobileCommonsMessages');

// Zendesk Requested Tickets Backlog
Route::get('/users/{user}/zendesk-tickets', 'UsersController@zendeskTickets');

// Search
Route::get('search', ['as' => 'users.search', 'uses' => 'UsersController@search', 'before' => 'auth']);

// Advanced Search
Route::get('/advanced-search', 'UsersController@advancedSearch');

// Unauthorized Page
Route::get('/unauthorized', 'SessionsController@unauthorized');

// Unsubscribe to MailChimp
Route::delete('user/{id}/mailchimp', ['as' => 'users.unsubscribe-mailchimp', 'uses' => 'UsersController@unsubscribeFromMailChimp']);
