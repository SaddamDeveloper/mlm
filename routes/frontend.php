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

// =========== index ============= 
Route::get('/', 'Web\WebsiteController@index')->name('web.index');
Route::get('/about', 'Web\WebsiteController@about')->name('web.about');
Route::get('/plan', 'Web\WebsiteController@plan')->name('web.plan');
Route::get('/reward', 'Web\WebsiteController@reward')->name('web.reward');
Route::get('/product', 'Web\WebsiteController@product')->name('web.product');
Route::get('/rank/achiever', 'Web\WebsiteController@rankAchiever')->name('web.rank_achiever');
Route::get('/reward/achiever', 'Web\WebsiteController@rewardAchiever')->name('web.reward_achiever');
Route::get('/contact', 'Web\WebsiteController@contact')->name('web.contact');

// =========== join-us ============= 
Route::get('/join-us', function () {
    return view('web.join');
})->name('web.join');

// =========== login ============= 
Route::get('/login', function () {
    return view('web.login');
})->name('web.login');

// =========== product-list ============= 
Route::get('/product-list', function () {
    return view('web.product.product-list');
})->name('web.product.product-list');

// =========== product-detail ============= 
Route::get('/product-detail', function () {
    return view('web.product.product-detail');
})->name('web.product.product-detail');
