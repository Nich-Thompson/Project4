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
    Route::get('/{id}/archive', 'CustomerController@remove')->middleware(['role:admin'])->name('getCustomerArchive');
    Route::post('/{id}/archive', 'CustomerController@archive')->middleware(['role:admin'])->name('postCustomerArchive');
});
