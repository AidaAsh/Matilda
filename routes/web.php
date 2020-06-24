<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Worker;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
Route::auth();
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/workers', 'WorkerController@index')->name('workers');
// Route::get('/workersForAccountant', 'WorkerController@indexForAccountant')->name('workers');


// Route::post('/workers/add', 'WorkerController@store');
// Route::post('/workers/addForAccountant', 'WorkerController@storeForAccountant');


// Route::get('/workers/add', 'WorkerController@create');
// Route::get('/workers/addForAccountant', 'WorkerController@createForAccountant');


// Route::get('/workers/edit/{worker}', 'WorkerController@edit');
// Route::get('/workers/editForAccountant/{worker}', 'WorkerController@editForAccountant');


// Route::patch('/workers/update/{worker}', 'WorkerController@update');
// Route::patch('/workers/updateForAccoutant/{worker}', 'WorkerController@updateForAccoutant');

// Route::any('/search', 'WorkerController@search')->name('workers');
// Route::any('/searchForAccountant', 'WorkerController@searchForAccountant')->name('workers');

// Route::delete('/workers/delete/{worker}', 'WorkerController@destroy');




Route::get('/home', 'HomeController@index')->name('home');
Route::get('/visits', 'WorkerController@indexVisits')->name('visits');
Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
{
Route::match(['get', 'post'], '/adminOnlyPage/',  'WorkerController@admin');
Route::any('/search', 'WorkerController@search')->name('workers');
Route::match(['get', 'post'], '/workers', 'WorkerController@index')->name('workers');
Route::match(['post'], '/workers/add', 'WorkerController@store');
Route::match(['get'], '/workers/add', 'WorkerController@create');
Route::match(['get', 'post'], '/workers/edit/{worker}', 'WorkerController@edit');
Route::delete('/workers/delete/{worker}', 'WorkerController@destroy');
Route::match(['get', 'post', 'patch'], '/workers/update/{worker}', 'WorkerController@update');
});


Route::group(['middleware' => 'App\Http\Middleware\AccountantMiddleware'], function()
{
Route::match(['get', 'post'], '/accountantOnlyPage/', 'WorkerController@accountant');
Route::any('/searchForAccountant', 'WorkerController@searchForAccountant')->name('workers');
Route::match(['get', 'post'], '/workersForAccountant', 'WorkerController@indexForAccountant')->name('workers');
Route::match(['post'], '/workers/addForAccountant', 'WorkerController@storeForAccountant');
Route::match(['get'], '/workers/addForAccountant', 'WorkerController@createForAccountant');
Route::delete('/workers/deleteForAccountant/{worker}', 'WorkerController@destroyForAccountant');
Route::match(['get', 'post'], '/workers/editForAccountant/{worker}', 'WorkerController@editForAccountant');
Route::match(['get', 'post', 'patch'], '/workers/updateForAccoutant/{worker}', 'WorkerController@updateForAccoutant');

Route::match(['get'], '/workers/viewReportsForAccountant', 'WorkerController@indexReportsForAccountant')->name('reports');

});

Route::get('importExportView', 'VisitController@importExportView');
Route::post('import', 'VisitController@import')->name('import');
Route::get('export', 'VisitController@export')->name('export');
