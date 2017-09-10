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

Auth::routes();
// API CALLS
Route::get('/api/all_notes/{student_id}', 'DeveloperController@all_notes');
Route::get('/api/specific_note/{student_id}/{matter_id}', 'DeveloperController@specific_note');
Route::get('/api/notes_matter/{student_id}/{matter_id}', 'DeveloperController@only_notes');

//      PRINCIPAL PAGES
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/combustible', 'ExpensesController@gas');
Route::get('/estacion', 'ExpensesController@station');
Route::get('/libro_novedades', 'NewsController@index');
Route::get('/inventario_recaudaciones', 'CollectionController@index');

//  CHANGE PASSWORD
Route::get('/cambio/contrasena', ['as'   => 'save.password.view', 'uses' => 'HomeController@changePassword']);
Route::post('/nueva/contrasena', ['as'   => 'save.password', 'uses' => 'HomeController@newPassword']);
// GENERAL CONTROL ROUTES
Route::get('/general', 'Reports\GeneralController@index');
Route::get('/gastos/combustible', 'Reports\GeneralSpendGasController@index');
Route::get('/gastos/estacion', 'Reports\GeneralSpendStationController@index');
Route::get('/control/recaudaciones', 'Reports\GeneralCollectionController@index');
Route::get('/control/novedades', 'Reports\GeneralNewsController@index');
Route::get('/reporte/semanal', 'Reports\WeeklyController@index');

//      SAVE DATA
Route::post('/combustible/gas', ['as'   => 'save.gas', 'uses' => 'ExpensesController@saveGas']);
Route::post('/combustible/station', ['as'   => 'save.station', 'uses' => 'ExpensesController@saveStation']);
Route::post('/novedades/save', ['as'   => 'save.news', 'uses' => 'NewsController@saveNew']);
Route::post('/recaudaciones/save', ['as'   => 'save.collections', 'uses' => 'CollectionController@saveCollection']);
Route::get('/unidades/{unidad}', ['as'   => 'unidad', 'uses' => 'UnityController@index']);
Route::post('/saveunidades/', ['as'   => 'unidad.save', 'uses' => 'UnityController@save']);
Route::post('/save/weekly', ['as'   => 'save.weekly.data', 'uses' => 'Reports\WeeklyController@save']);


//PDF ROUTES
Route::get('/pdf/general', 'Reports\GeneralController@pdf');
Route::get('/pdf/general/spend/gas', 'Reports\GeneralSpendGasController@pdf');
Route::get('/pdf/general/spend/station', 'Reports\GeneralSpendStationController@pdf');
//AJAX FOR DATATABLES
Route::get('weekly/ajax', ['uses' => 'Reports\WeeklyController@ajax', 'as' => 'weekly.data.ajax']);
Route::get('users/ajax', ['uses' => 'HomeController@users_ajax', 'as' => 'users.data.ajax']);
//ROUTES FOR FIND DATA
Route::get('/unity/data/find/{id}', 'UnityController@find');
//ROUTES FOR TEST
Route::get('/testing', 'DeveloperController@testing');
//FOR DEVELOPER
Route::get('/programador', 'DeveloperController@developer');
