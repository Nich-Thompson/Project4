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
Route::prefix('customer')->group(function () {
    Route::get('/', 'CustomerController@index')->middleware(['role:admin|inspecteur'])->name('getCustomerIndex');
    Route::get('/create', 'CustomerController@create')->middleware(['role:admin'])->name('getCustomerCreate');
    Route::post('/create', 'CustomerController@store')->middleware(['role:admin'])->name('postCustomerCreate');
    Route::get('/{id}/edit', 'CustomerController@edit')->middleware(['role:admin|inspecteur'])->name('getCustomerEdit');
    Route::post('/{id}/edit', 'CustomerController@update')->middleware(['role:admin'])->name('postCustomerEdit');
    Route::get('/{id}/archive', 'CustomerController@remove')->middleware(['role:admin'])->name('getCustomerArchive');
    Route::post('/{id}/archive', 'CustomerController@archive')->middleware(['role:admin'])->name('postCustomerArchive');

    Route::get('/archives', 'CustomerController@archives')->middleware(['role:admin'])->name('getCustomerArchives');
    Route::post('{id}/restore', 'CustomerController@restore')->middleware(['role:admin'])->name('postRestoreCustomer');
    Route::get('/delete', 'CustomerController@delete')->middleware(['role:admin'])->name('getDeleteArchive');
    Route::post('/archives', 'CustomerController@deletes')->middleware(['role:admin'])->name('postDeleteArchive');
    Route::prefix('/{id}/location')->group(function() {
        Route::get('/create', 'LocationController@create')->middleware(['role:admin|inspecteur'])->name('getLocationCreate');
        Route::post('/create', 'LocationController@store')->middleware(['role:admin|inspecteur'])->name('postLocationCreate');
        Route::get('/{location_id}/edit', 'LocationController@edit')->middleware(['role:admin|inspecteur'])->name('getLocationEdit');
        Route::post('/{location_id}/edit', 'LocationController@update')->middleware(['role:admin|inspecteur'])->name('postLocationEdit');
        Route::get('/{location_id}/archive', 'LocationController@remove')->middleware(['role:admin'])->name('getLocationArchive');
        Route::post('/{location_id}/archive', 'LocationController@archive')->middleware(['role:admin'])->name('postLocationArchive');
        Route::get('/archives', 'LocationController@archives')->middleware(['role:admin'])->name('getLocationArchives');
        Route::post('/{location_id}/restore', 'LocationController@restore')->middleware(['role:admin'])->name('restoreLocation');
        Route::get('/delete', 'LocationController@delete')->middleware(['role:admin'])->name('getDeleteArchiveLocation');
        Route::post('/archives', 'LocationController@deletes')->middleware(['role:admin'])->name('postDeleteArchiveLocation');
    });
});

//Inspector routes
Route::prefix('inspector')->group(function () {
    Route::get('/', 'InspectorController@index')->middleware(['role:admin'])->name('getInspectorIndex');
    Route::get('/create', 'InspectorController@create')->middleware(['role:admin'])->name('getInspectorCreate');
    Route::post('/create', 'InspectorController@store')->middleware(['role:admin'])->name('postInspectorCreate');
    Route::get('/{id}/edit', 'InspectorController@edit')->middleware(['role:admin'])->name('getInspectorEdit');
    Route::post('/{id}/edit', 'InspectorController@update')->middleware(['role:admin'])->name('postInspectorEdit');
    Route::get('/{id}/archive', 'InspectorController@remove')->middleware(['role:admin'])->name('getInspectorArchive');
    Route::post('/{id}/archive', 'InspectorController@archive')->middleware(['role:admin'])->name('postInspectorArchive');
    Route::get('/archives', 'InspectorController@archives')->middleware(['role:admin'])->name('getInspectorArchives');

});

//Inspection routes
Route::prefix('inspection')->group(function () {
    Route::get('/{id}', 'InspectionController@index')->middleware(['role:admin|inspecteur'])->name('getInspectionIndex');
    Route::get('/inspect/{id}/{type}', 'InspectionController@inspect')->middleware(['role:admin|inspecteur'])->name('getInspection');
    Route::get('/{customer_id}/{location_id}/create', 'InspectionController@create')->middleware(['role:admin|inspecteur'])->name('getInspectionCreate');
    Route::post('/create', 'InspectionController@store')->middleware(['role:admin|inspecteur'])->name('postInspectionCreate');
    Route::get('/{id}/edit', 'InspectionController@edit')->middleware(['role:admin|inspecteur'])->name('getInspectionEdit');
    Route::post('/{id}/edit', 'InspectionController@update')->middleware(['role:admin|inspecteur'])->name('postInspectionEdit');
    Route::post('/save/{id}', 'InspectionController@save')->middleware(['role:admin|inspecteur'])->name('saveInspectionJson');
});

//Inspection type routes
Route::prefix('inspectiontype')->group(function () {
    Route::get('/', 'InspectionTypeController@index')->middleware(['role:admin'])->name('getInspectionTypeIndex');
    Route::get('/create', 'InspectionTypeController@create')->middleware(['role:admin'])->name('getInspectionTypeCreate');
    Route::post('/create', 'InspectionTypeController@store')->middleware(['role:admin'])->name('postInspectionTypeCreate');
    Route::get('/{id}/edit', 'InspectionTypeController@edit')->middleware(['role:admin'])->name('getInspectionTypeEdit');
    Route::post('/{id}/edit', 'InspectionTypeController@update')->middleware(['role:admin'])->name('postInspectionTypeEdit');
    Route::post('/{id}/editInspector', 'InspectionController@updateInspector')->middleware(['role:admin|inspecteur'])->name('postInspectionEditInspector');
    Route::get('/{id}/archive', 'InspectionTypeController@delete')->middleware(['role:admin'])->name('getInspectionTypeDelete');
    Route::post('/{id}/archive', 'InspectionTypeController@destroy')->middleware(['role:admin'])->name('postInspectionTypeDelete');
});

//List routes
Route::prefix('list')->group(function() {
    Route::get('/create', 'ListController@create')->middleware(['role:admin'])->name('getListCreate');
    Route::post('/create', 'ListController@store')->middleware(['role:admin'])->name('postListCreate');
    Route::get('/{id}/edit', 'ListController@edit')->middleware(['role:admin'])->name('getListEdit');
    Route::post('/{id}/edit', 'ListController@update')->middleware(['role:admin'])->name('postListEdit');
    Route::get('/{id}/create-value', 'ListController@createValue')->middleware(['role:admin'])->name('getListValueCreate');
    Route::post('/{id}/create-value', 'ListController@storeValue')->middleware(['role:admin'])->name('postListValueCreate');
    Route::get('/{list_id}/{id}/edit-value', 'ListController@editValue')->middleware(['role:admin'])->name('getListValueEdit');
    Route::post('/{list_id}/{id}/edit-value', 'ListController@updateValue')->middleware(['role:admin'])->name('postListValueEdit');
});

//Template routes
Route::prefix('template')->group(function () {
    Route::get('/', 'TemplateController@index')->middleware(['role:admin'])->name('getTemplateIndex');
    Route::get('/create', 'TemplateController@create')->middleware(['role:admin'])->name('getTemplateCreate');
    Route::post('/create', 'TemplateController@store')->middleware(['role:admin'])->name('postTemplateCreate');
    Route::get('/{id}/edit', 'TemplateController@edit')->middleware(['role:admin'])->name('getTemplateEdit');
    Route::post('/{id}/edit', 'TemplateController@update')->middleware(['role:admin'])->name('postTemplateEdit');
});
