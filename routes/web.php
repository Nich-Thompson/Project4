<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect('/login');
})->name('index');

Route::group(['middleware' => ['role:admin|inspecteur']], function () {
    Route::get('/home', 'HomeController@index')->name('getHomeIndex');
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
    Route::get('/archives', 'CustomerController@archives')->middleware(['role:admin'])->name('getCustomerArchives');
    Route::post('{id}/restore', 'CustomerController@restore')->middleware(['role:admin'])->name('postRestoreCustomer');
    Route::get('/delete', 'CustomerController@delete')->middleware(['role:admin'])->name('getDeleteArchive');
    Route::post('/archives', 'CustomerController@deletes')->middleware(['role:admin'])->name('postDeleteArchive');
    Route::prefix('/{id}/location')->group(function() {
        Route::get('/create', 'LocationController@create')->middleware(['role:admin'])->name('getLocationCreate');
        Route::post('/create', 'LocationController@store')->middleware(['role:admin'])->name('postLocationCreate');
        Route::get('/{location_id}/edit', 'LocationController@edit')->middleware(['role:admin'])->name('getLocationEdit');
        Route::post('/{location_id}/edit', 'LocationController@update')->middleware(['role:admin'])->name('postLocationEdit');
        Route::get('/{location_id}/archive', 'LocationController@remove')->middleware(['role:admin'])->name('getLocationArchive');
        Route::post('/{location_id}/archive', 'LocationController@archive')->middleware(['role:admin'])->name('postLocationArchive');
        Route::get('/archives', 'LocationController@archives')->middleware(['role:admin'])->name('getLocationArchives');
        Route::post('/{location_id}/restore', 'LocationController@restore')->middleware(['role:admin'])->name('restoreLocation');
        Route::get('/delete', 'LocationController@delete')->middleware(['role:admin'])->name('getDeleteArchiveLocation');
        Route::post('/archives', 'LocationController@deletes')->middleware(['role:admin'])->name('postDeleteArchiveLocation');
    });
});

//Event routes
Route::prefix('inspector')->group(function() {
    Route::get('/', 'InspectorController@index')->middleware(['role:admin'])->name('getInspectorIndex');
    Route::get('/create', 'InspectorController@create')->middleware(['role:admin'])->name('getInspectorCreate');
    Route::post('/create', 'InspectorController@store')->middleware(['role:admin'])->name('postInspectorCreate');
    Route::get('/{id}/edit', 'InspectorController@edit')->middleware(['role:admin'])->name('getInspectorEdit');
    Route::post('/{id}/edit', 'InspectorController@update')->middleware(['role:admin'])->name('postInspectorEdit');
    Route::get('/{id}/archive', 'InspectorController@delete')->middleware(['role:admin'])->name('getInspectorDelete');
    Route::post('/{id}/archive', 'InspectorController@destroy')->middleware(['role:admin'])->name('postInspectorDelete');
});

//Inspection routes
Route::prefix('inspection')->group(function() {
    Route::get('/', 'InspectionController@index')->middleware(['role:admin'])->name('getInspectionIndex');
    Route::get('/create', 'InspectionController@create')->middleware(['role:admin'])->name('getInspectionCreate');
    Route::post('/create', 'InspectionController@store')->middleware(['role:admin'])->name('postInspectionCreate');
});

//Inspection type routes
Route::prefix('inspectiontype')->group(function() {
    Route::get('/', 'InspectionTypeController@index')->middleware(['role:admin'])->name('getInspectionTypeIndex');
    Route::get('/create', 'InspectionTypeController@create')->middleware(['role:admin'])->name('getInspectionTypeCreate');
    Route::post('/create', 'InspectionTypeController@store')->middleware(['role:admin'])->name('postInspectionTypeCreate');
    Route::get('/{id}/edit', 'InspectionTypeController@edit')->middleware(['role:admin'])->name('getInspectionTypeEdit');
    Route::post('/{id}/edit', 'InspectionTypeController@update')->middleware(['role:admin'])->name('postInspectionTypeEdit');
    Route::get('/{id}/archive', 'InspectionTypeController@delete')->middleware(['role:admin'])->name('getInspectionTypeDelete');
    Route::post('/{id}/archive', 'InspectionTypeController@destroy')->middleware(['role:admin'])->name('postInspectionTypeDelete');
});
