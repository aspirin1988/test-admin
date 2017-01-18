<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

    Route::group(['middleware' => ['auth']], function () {
        Route::get( '/home', 'HomeController@index' );
        Route::get( '/admin', 'AdminController@index' );

        /*News*/
        Route::get( '/admin/news/', 'NewsController@index' );
        Route::get( '/admin/news/page/', 'NewsController@page' );
        Route::get( '/admin/news/page/{id}', 'NewsController@page' );
        Route::get( '/admin/news/edit/{id}', 'NewsController@edit' );
        Route::get( '/admin/news/get/{id}', 'NewsController@get' );
    });
