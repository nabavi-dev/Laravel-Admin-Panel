<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'AuthController@index')->name('login');
Route::get('/signup', 'AuthController@signup_page')->name('signup_page');
Route::post('/login', 'AuthController@authenticate');
Route::post('/signup', 'SignupController@signup');

Route::middleware(['auth'])->group(function () {
    Route::get('logout', 'LogoutController@index');
    Route::get('/dashboard', 'DashboardController@index');
    Route::resource('/category', 'CategoryController')->except(['show']);
    Route::resource('/subcategory', 'SubCategoryController')->except(['show']);
    Route::resource('/product', 'ProductController')->except(['show']);
    Route::get('/live-search-product', 'LiveSearchController@index');
    Route::get('/live_search/action', 'LiveSearchController@action')->name('live_search.action');
    Route::get('/filter-product', 'FilterController@index');
    Route::get('/filter/action', 'FilterController@action')->name('filter.action');
});
