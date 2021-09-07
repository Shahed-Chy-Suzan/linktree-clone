<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//linktree.com/dashboard
Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function() {

    //linktree.com/dashboard/links
    Route::get('/links', 'LinkController@index');
    Route::get('/links/new', 'LinkController@create');
    Route::post('/links/new', 'LinkController@store');
    Route::get('/links/{link}', 'LinkController@edit');
    Route::post('/links/{link}', 'LinkController@update');
    Route::delete('/links/{link}', 'LinkController@destroy');

    Route::get('/settings', 'UserController@edit');
    Route::post('/settings', 'UserController@update');

});

//linktree.com/visit/
Route::post('/visit/{link}', 'VisitController@store');
//linktree.com/username
Route::get('{user}', 'UserController@show');

Route::get('/home', 'HomeController@index')->name('home');
