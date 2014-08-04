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

Route::group(
    array(
        'before' => 'auth.basic',
        'prefix' => 'v1/admin',
        'namespace' => 'Dasigr\Core\Controllers'
    ), function()
    {
        Route::resource('user', 'UserController');
        Route::resource('role', 'RoleController');
    }
);

Route::get('/', function()
{
	return View::make('home');
});
