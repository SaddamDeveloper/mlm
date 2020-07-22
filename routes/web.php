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

     /***
     * Epin GENERATE Control
     */
    Route::get('/epin', 'AdminDashboardController@memEpinList')->name('admin.mem_epin');
    Route::get('/add/epin', 'AdminDashboardController@memAddEpinForm')->name('admin.mem_add_epin_form');
    Route::post('/add/new/epin', 'AdminDashboardController@memAddGenerateEpin')->name('admin.mem_add_generate_epin');
    Route::get('/ajax/get/fund/','AdminDashboardController@ajaxGetFundList')->name('admin.ajax.get_funds_list');

        /***
     * Epin Allot Control
     */
    Route::get('/allot/epin', 'AdminDashboardController@memAllotEpinForm')->name('admin.mem_allot_epin_form');
    Route::get('/search/memberID', 'AdminDashboardController@searchMemberID')->name('member.search_member_id');
    Route::post('/add/new/allot/epin', 'AdminDashboardController@memAllotEpin')->name('admin.mem_allot_epin');
    Route::get('/epin/requests/list', 'AdminDashboardController@epinRequestsLists')->name('admin.ajax.epin_requests_lists');
    Route::get('/epin/requests/status/{sId}/{status}', 'AdminDashboardController@epinRequestStatus')->name('admin.epin_req_status');

    // Admin Commission
    Route::get('/admin/commission', 'AdminDashboardController@adminCommission')->name('admin.mem_commission');
    Route::post('/add/commission', 'AdminDashboardController@storeCommission')->name('admin.store_commission');

    // TDS
    Route::get('/admin/tds', 'AdminDashboardController@adminTds')->name('admin.mem_tds');
    Route::post('/add/tds', 'AdminDashboardController@storeTds')->name('admin.store_tds');

    // Member List
    Route::get('/list/members', 'AdminDashboardController@memberList')->name('admin.mem_member_list');
    Route::get('/list/all/members', 'AdminDashboardController@ajaxGetMemberList')->name('admin.ajax.get_member_list');
    Route::get('/status/member/{id}/{status}', 'AdminDashboardController@memberStatus')->name('admin.member_status');
    Route::get('/view/member/{id}', 'AdminDashboardController@memberView')->name('admin.member_view');
    Route::get('/edit/member/{id}', 'AdminDashboardController@memberEdit')->name('admin.member_edit');
    Route::post('/edit/member/', 'AdminDashboardController@memberUpdate')->name('admin.update_member');
    Route::get('/downline/member/{id}', 'AdminDashboardController@memberDownline')->name('admin.member_downline');
    Route::get('/member/tree/{rank?}/{user_id?}', 'AdminDashboardController@memberTree')->name('admin.member.tree');
    Route::get('/downline/member/list/{id}', 'AdminDashboardController@memberDownlineList')->name('admin.ajax.downline_list');


    // Commision
    Route::get('/commission/members', 'AdminDashboardController@memberCommissionHistory')->name('admin.mem_commission_history');
    Route::get('/commission/history', 'AdminDashboardController@memberCommissionHistoryList')->name('admin.ajax.commission_list');
    Route::get('/wallet/', 'AdminDashboardController@memberWallet')->name('admin.mem_wallet');
    Route::get('/wallet/list', 'AdminDashboardController@memberWalletList')->name('admin.ajax.wallet_list');
    Route::get('/wallet/history/{id}', 'AdminDashboardController@memberWalletHistory')->name('admin.wallet_history');
    Route::get('/wallet/ajax/history/{id}', 'AdminDashboardController@memberAjaxWalletHistory')->name('admin.ajax.wallet_history');
});


/***
 * Member Dashboard Routes
 */
Route::group(['middleware'=>'auth:member','prefix'=>'member','namespace'=>'Member'],function(){
    Route::get('/dashboard', 'MemberDashboardController@index')->name('member.dashboard');
    Route::get('/add/new', 'MemberDashboardController@addNewMemberForm')->name('member.add_new_member_form');
    Route::post('/add', 'MemberDashboardController@addNewMember')->name('member.add_new_member');
    Route::get('/search/sponsorID', 'MemberDashboardController@searchSponsorID')->name('member.search_sponsor_id');
    Route::get('/check/loginID', 'MemberDashboardController@loginIDCheck')->name('member.login_id_check');

    // Thank You Page
    Route::get('/thank/you/{token}', 'MemberDashboardController@thankYou')->name('member.thank_you');

    // Downline list
    Route::get('/my/downline/', 'MemberDashboardController@memberDownlineListForm')->name('member.mem_downline_list_form');
    Route::get('/my/downline/list', 'MemberDashboardController@memberGetDownlineList')->name('member.ajax.my_downline_list');
    Route::get('/my/tree/{rank?}/{user_id?}', 'MemberDashboardController@memberTree')->name('member.tree');
    // Commission Lists
    Route::get('/my/commission', 'MemberDashboardController@memberCommissionListForm')->name('member.mem_commission_list_form');
    Route::get('/ajax/get/commission','MemberDashboardController@ajaxGetCommissionList')->name('member.ajax.my_commission_list');
    // Wallet LIst
    Route::get('/my/wallet/', 'MemberDashboardController@memberWalletListForm')->name('member.mem_wallet_list_form');
    Route::get('/ajax/get/wallet/history','MemberDashboardController@ajaxGetWalletHistory')->name('member.ajax.my_wallet_history');
    Route::get('/my/epin/', 'MemberDashboardController@memberEpinListForm')->name('member.mem_epin_list_form');
    Route::get('/my/epin/list', 'MemberDashboardController@memberGetEpinList')->name('member.ajax.my_epin_list');
    
    // Rewardz

    Route::get('/my/rewards', 'MemberDashboardController@memberGetRewardListForm')->name('member.my_rewards_list_form');
    Route::get('/my/rewards/list', 'MemberDashboardController@memberGetRewardList')->name('member.ajax.my_rewards_list');
    Route::get('/my/rewards/list/history', 'MemberDashboardController@memberGetRewardListHistory')->name('member.mem_rewards_history');

    // Commission
    Route::get('/my/commission', 'MemberDashboardController@memberCommissionListForm')->name('member.mem_commission_list_form');

    Route::get('/my/test/from', 'MemberDashboardController@memberTestForm')->name('member.test.form');
    Route::post('/my/test/add', 'MemberDashboardController@memberTest')->name('member.test.add');

});
