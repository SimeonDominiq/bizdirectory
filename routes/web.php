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

Route::get('/', 'HomeController@index');

Route::get('/login', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@index'
]);

Route::get('/logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout'
]);

Route::get('/businesses/{id}/view', [
    'as' => 'business.view',
    'uses' => 'BusinessController@view'
]); 

Route::post('login', 'Auth\LoginController@login');

Route::group(['middleware' => 'auth'], function () {

    /**
     * Dashboard
     */
    Route::get('/dashboard', [
        'as' => 'dashboard',
        'uses' => 'DashboardController@index'
    ]);

    /**
     * Businesses
     */
    Route::get('/businesses', [
        'as' => 'business.list',
        'uses' => 'BusinessController@index'
    ]); 
    
    Route::get('/businesses/new', [
        'as' => 'business.new',
        'uses' => 'BusinessController@newBusiness'
    ]);

    Route::get('/businesses/{id}/edit', [
        'as' => 'business.edit',
        'uses' => 'BusinessController@editBusiness'
    ]);
    
    Route::get('/businesses/{id}/delete', [
        'as' => 'business.delete',
        'uses' => 'BusinessController@deleteBusiness'
    ]);    

    Route::get('/businesses/categories', [
        'as' => 'business.category',
        'uses' => 'BusinessCategoryController@index'
    ]);

    Route::get('/businesses/categories/{id}/delete', [
        'as' => 'business.category.delete',
        'uses' => 'BusinessCategoryController@deleteCategory'
    ]);    
    
    Route::get('/businesses/{id}/deactivate', [
        'as' => 'business.deactivate',
        'uses' => 'BusinessController@deactivate'
    ]);
    
    Route::get('/businesses/{id}/activate', [
        'as' => 'business.activate',
        'uses' => 'BusinessController@activate'
    ]);    
    
    Route::post('/businesses/add', [
        'as' => 'business.add',
        'uses' => 'BusinessController@addBusiness'
    ]);

    Route::post('/businesses/{id}/update', [
        'as' => 'business.update',
        'uses' => 'BusinessController@updateBusiness'
    ]);     
    
    Route::post('/businesses/categories', [
        'as' => 'category.add',
        'uses' => 'BusinessCategoryController@addCategory'
    ]);    

});
