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
//      PRINCIPAL PAGES
Route::get('/home', 'HomeController@index');
Route::get('/combustible', 'ExpensesController@gas');
Route::get('/estacion', 'ExpensesController@station');
Route::get('/libro_novedades', 'NewsController@index');
Route::get('/inventario_recaudaciones', 'CollectionController@index');

//      SAVE DATA
Route::post('/combustible/gas', ['as'   => 'save.gas',
                                 'uses' => 'ExpensesController@saveGas']);
Route::post('/combustible/station', ['as'   => 'save.station',
                                     'uses' => 'ExpensesController@saveStation']);
Route::post('/novedades/save', ['as'   => 'save.news',
                                'uses' => 'NewsController@saveNew']);

Route::get('/unidades/{unidad}', ['as'   => 'unidad',
                                  'uses' => 'UnityController@index']);

