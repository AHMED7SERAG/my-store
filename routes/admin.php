<?php

use Illuminate\Support\Facades\Route;
define('PAGINATION_COUNT',15);
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
Route::group(['namespace' => 'Admin','middleware' => 'guest:admin'], function() {
    Route::get('login','LoginController@getLogin')->name('get.admin.login');
    Route::post('login','LoginController@login' )->name('admin.login');
    Route::post('logout','LoginController@logout' )->name('admin.logout');
});


Route::group(['namespace' => 'Admin','middleware' => 'auth:admin'], function () {
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
      
    // languages Route
    Route::group(['prefix' => 'languages'], function () {
        Route::get('/','LanguageController@index')->name('admin.languages');
        Route::get('create','LanguageController@create')->name('admin.language.create');
        Route::post('store','LanguageController@store')->name('admin.language.store');
        Route::get('edit/{id}','LanguageController@edit')->name('admin.language.edit');
        Route::post('update/{id}','LanguageController@update')->name('admin.language.update');
        Route::get('delete/{id}','LanguageController@destroy')->name('admin.language.delete');
 
    });
    // end languages Route

    // main_categories Route
    Route::group(['prefix' => 'main_categories'], function () {
        Route::get('/','MainCategoriesController@index')->name('admin.maincategories');
        Route::get('create','MainCategoriesController@create')->name('admin.maincategories.create');
        Route::post('store','MainCategoriesController@store')->name('admin.maincategories.store');
        Route::get('edit/{id}','MainCategoriesController@edit')->name('admin.maincategories.edit');
        Route::post('update/{id}','MainCategoriesController@update')->name('admin.maincategories.update');
        Route::get('delete/{id}','MainCategoriesController@destroy')->name('admin.maincategories.delete');
 
    });
    // end main_categories Route

    // Vendors Route
    Route::group(['prefix' => 'vendors'], function () {
        Route::get('/','VendorsController@index')->name('admin.vendors');
        Route::get('create','VendorsController@create')->name('admin.vendors.create');
        Route::post('store','VendorsController@store')->name('admin.vendors.store');
        Route::get('edit/{id}','VendorsController@edit')->name('admin.vendors.edit');
        Route::post('update/{id}','VendorsController@update')->name('admin.vendors.update');
        Route::get('delete/{id}','VendorsController@destroy')->name('admin.vendors.delete');
 
    });
    // end Vendors Route


});




