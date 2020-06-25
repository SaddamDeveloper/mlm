<?php

use Illuminate\Support\Facades\Route;

require __DIR__.'/frontend.php';

/***
 * Admin Login Control
 */
Route::get('/admin/login', 'Admin\AdminLoginController@showAdminLoginForm')->name('admin.login');
Route::post('/admin/login', 'Admin\AdminLoginController@adminLogin');
Route::post('/admin/logout', 'Admin\AdminLoginController@logout')->name('admin.logout');

/***
 * Member Login Control
 */
Route::get('/member/login', 'Member\MemberLoginController@showMemberLoginForm')->name('member.login');
Route::post('/member/login', 'Member\MemberLoginController@memberLogin');
Route::post('/member/logout', 'Member\MemberLoginController@logout')->name('member.logout');

/***
 * Admin Dashboard Routes
 */
Route::group(['middleware'=>'auth:admin','prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::get('/dashboard', 'AdminDashboardController@index')->name('admin.dashboard');
});


/***
 * Member Dashboard Routes
 */
Route::group(['middleware'=>'auth:member','prefix'=>'member','namespace'=>'Member'],function(){
    Route::get('/dashboard', 'MemberDashboardController@index')->name('member.dashboard');
    Route::get('/add/new', 'MemberDashboardController@addNewMemberForm')->name('member.add_new_member_form');
    Route::post('/add', 'MemberDashboardController@addNewMember')->name('member.add_new_member');
    Route::get('/search/sponsorID', 'MemberDashboardController@searchSponsorID')->name('member.search_sponsor_id');
});
