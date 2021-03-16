<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/home', function () {
        return view('home');
    });
});

//Customer routes
Route::prefix('customer')->group(function() {
    Route::get('/', 'CustomerController@index')->middleware(['role:admin'])->name('getCustomerIndex');
    Route::get('/create', 'CustomerController@create')->middleware(['role:admin'])->name('getCustomerCreate');
    Route::post('/create', 'CustomerController@store')->middleware(['role:admin'])->name('postCustomerCreate');
    Route::get('/{id}/edit', 'CustomerController@edit')->middleware(['role:admin'])->name('getCustomerEdit');
    Route::post('/{id}/edit', 'CustomerController@update')->middleware(['role:admin'])->name('postCustomerEdit');
    Route::get('/{id}/delete', 'CustomerController@remove')->middleware(['role:admin'])->name('getCustomerDelete');
    Route::post('/{id}/delete', 'CustomerController@archive')->middleware(['role:admin'])->name('postCustomerDelete');
});

//Event routes
Route::prefix('inspector')->group(function() {
    Route::get('/', 'InspectorController@index')->middleware(['role:admin'])->name('getInspectorIndex');
    Route::get('/create', 'InspectorController@create')->middleware(['role:admin'])->name('getInspectorCreate');
    Route::post('/create', 'InspectorController@store')->middleware(['role:admin'])->name('postInspectorCreate');
    Route::get('/{id}/edit', 'InspectorController@edit')->middleware(['role:admin'])->name('getInspectorEdit');
    Route::post('/{id}/edit', 'InspectorController@update')->middleware(['role:admin'])->name('postInspectorEdit');
    Route::get('/{id}/delete', 'InspectorController@delete')->middleware(['role:admin'])->name('getInspectorDelete');
    Route::post('/{id}/delete', 'InspectorController@destroy')->middleware(['role:admin'])->name('postInspectorDelete');
});
