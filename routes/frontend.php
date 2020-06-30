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
Route::get('/', function () {
    return view('web.index');
})->name('web.index');

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
