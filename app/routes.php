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

$version = Config::get('app.version');

Route::group(
    array(
        'before' => 'auth.basic',
        'prefix' => $version
    ), function()
    {
        Route::resource('users', 'UserController');
        Route::resource('roles', 'RoleController');
        Route::resource('products', 'ProductController');
        Route::resource('terms', 'TermController');
        Route::resource('vocabularies', 'VocabularyController');
    }
);

Route::get('/', function()
{
	$data = array(
        'page_title' => 'Laravel Commerce | An E-Commerce website built with Laravel',
        'site_name' => 'Laravel Commerce',
        'slogan' => 'An E-Commerce website built with Laravel',
        'base_url' => 'http://laravelcommerce.local',
        'app_name' => Config::get('app.app_name')
    );

    return View::make('templates.html', $data)->nest('page', 'templates.page', $data);
});
