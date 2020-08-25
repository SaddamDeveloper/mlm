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
    Route::get('/list/commission', 'AdminDashboardController@getCommissionList')->name('admin.ajax.commission_list');

    // TDS
    Route::get('/admin/tds', 'AdminDashboardController@adminTds')->name('admin.mem_tds');
    Route::post('/add/tds', 'AdminDashboardController@storeTds')->name('admin.store_tds');
    Route::get('/list/tds', 'AdminDashboardController@getTdsList')->name('admin.ajax.tds_list');

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
    
    // Fund Request
    Route::get('/member/fund/request', 'AdminDashboardController@memberFundRequests')->name('admin.mem_fund_requests');
    Route::get('/member/fund/request/list', 'AdminDashboardController@memberFundRequestList')->name('admin.ajax.fund_request_list');
    Route::get('/member/fund/request/status/{id}', 'AdminDashboardController@memberFundRequestStatus')->name('admin.fund_request_status');
   
    // Reward List
    Route::get('/rewards', 'AdminDashboardController@reward')->name('admin.rewards');
    Route::post('/store/rewards', 'AdminDashboardController@storeReward')->name('admin.store_reward');
    // Route::get('/member/fund/request/list', 'AdminDashboardController@memberFundRequestList')->name('admin.ajax.fund_request_list');
    // Route::get('/member/fund/request/status/{id}', 'AdminDashboardController@memberFundRequestStatus')->name('admin.fund_request_status');

    /**
     * Important Notice
     */
    Route::get('/important/notice/page', 'AdminDashboardController@importantNoticePage')->name('admin.important_notice');
    Route::post('/important/notice', 'AdminDashboardController@importantNotice')->name('admin.store_important_notice');
    Route::get('/my/notice/list', 'AdminDashboardController@getNoticeList')->name('admin.ajax.notice_list');
    Route::get('/view/notice/{id}', 'AdminDashboardController@viewNotice')->name('admin.notice_view');
    Route::get('/status/notice/{id}/{status}', 'AdminDashboardController@noticeStatus')->name('admin.notice_status');


    /**
     * Shopping Product List Control
     */

    //  Slider
    Route::get('/shopping/slider', 'ShoppingProductController@shoppingSlider')->name('admin.shopping_slider');
    Route::get('/shopping/slider/add', 'ShoppingProductController@addShoppingSlider')->name('admin.add_slider');
    Route::get('/shopping/slider/list', 'ShoppingProductController@ShoppingSliderList')->name('admin.shopping_slider_list');
    Route::post('/shopping/slider/store', 'ShoppingProductController@storeShoppingSlider')->name('admin.store_shopping_slider');
    Route::get('/shopping/slider/status/{sId}/{status}', 'ShoppingProductController@ShoppingSliderStatus')->name('admin.shopping_slider_status');
    Route::get('/shopping/slider/edit/{id}', 'ShoppingProductController@ShoppingSliderEdit')->name('admin.shopping_slider_edit');
    Route::post('/shopping/slider/update', 'ShoppingProductController@ShoppingSliderUpdate')->name('admin.update_shopping_slider');


    //Shopping Product
    Route::get('/shopping/product', 'ShoppingProductController@shoppingProduct')->name('admin.shopping_product');
    Route::get('/shopping/product/add', 'ShoppingProductController@addShoppingProduct')->name('admin.add_shopping_product');
    Route::post('/shopping/product/store', 'ShoppingProductController@storeShoppingProduct')->name('admin.store_shopping_product');
    Route::get('/shopping/product/list', 'ShoppingProductController@ShoppingProductList')->name('admin.shopping_product_list');
    Route::get('/shopping/product/status/{pId}/{status}', 'ShoppingProductController@ShoppingProductStatus')->name('admin.shopping_product_status');
    Route::get('/shopping/product/edit/{id}', 'ShoppingProductController@ShoppingProductEdit')->name('admin.shopping_product_edit');
    Route::post('/shopping/product/update', 'ShoppingProductController@ShoppingProductUpdate')->name('admin.update_shopping_product');

    //Shopping Category
    Route::get('/shopping/category', 'ShoppingProductController@shoppingCategory')->name('admin.shopping_category');
    Route::get('/shopping/category/add', 'ShoppingProductController@addShoppingCategory')->name('admin.add_shopping_category');
    Route::post('/shopping/category/store', 'ShoppingProductController@storeShoppingCategory')->name('admin.store_shopping_category');
    Route::get('/shopping/category/list', 'ShoppingProductController@ShoppingCategoryList')->name('admin.shoppingCategoryList');
    Route::get('/shopping/category/status/{pId}/{status}', 'ShoppingProductController@ShoppingCategoryStatus')->name('admin.shopping_category_status');
    Route::get('/shopping/category/edit/{id}', 'ShoppingProductController@ShoppingCategoryEdit')->name('admin.shopping_category_edit');
    Route::post('/shopping/category/update/{id}', 'ShoppingProductController@ShoppingCategoryUpdate')->name('admin.update_shopping_category');
    
    // Payment Requsets
    Route::get('/payment/request/form', 'AdminDashboardController@paymentRequestForm')->name('admin.payment_request_form');
    Route::get('/payment/request/list', 'AdminDashboardController@ajaxPaymentRequest')->name('admin.ajax.payment_request_list');
    Route::get('/payment/verify/{id}', 'AdminDashboardController@verify')->name('admin.verify');
    
    // Forented
    Route::get('/info/', 'AdminDashboardController@info')->name('admin.info');
    Route::post('/store/info/', 'AdminDashboardController@storeInfo')->name('admin.store_frontend');
    
    
});


/***
 * Member Dashboard Routes
 */

Route::get('/search/sponsorID', 'Member\MemberDashboardController@searchSponsorID')->name('member.search_sponsor_id');
Route::group(['prefix'=>'member','namespace'=>'Member'],function(){
    Route::get('/dashboard', 'MemberDashboardController@index')->name('member.dashboard');
    Route::get('/profile', 'MemberDashboardController@profile')->name('member.profile');
    Route::get('/add/new', 'MemberDashboardController@addNewMemberForm')->name('member.add_new_member_form');
    Route::post('/add', 'MemberDashboardController@addNewMember')->name('member.add_new_member');
    Route::get('/check/loginID', 'MemberDashboardController@loginIDCheck')->name('member.login_id_check');
    Route::get('/add/refresh/{id}', 'MemberDashboardController@refreshMember')->name('member.refresh');

    // Fund Request
    Route::get('/my/fund/request/form', 'MemberDashboardController@memberRequestForm')->name('member.mem_fund_request');
    Route::post('/my/fund/request', 'MemberDashboardController@memberRequest')->name('member.store_fund_requests');
    Route::get('/my/fund/request/list', 'MemberDashboardController@fundRequestList')->name('member.ajax.fund_request_list');
    Route::get('/my/fund/transfer/form', 'MemberDashboardController@memberTransferForm')->name('member.fund_transfer');
    Route::post('/my/fund/transfer', 'MemberDashboardController@memberfundTransfer')->name('member.store_fund_transfer');

    // Member Password Change
    Route::get('/change/password', 'MemberDashboardController@changePasswordPage')->name('member.change_password');
    Route::post('/changePassword','MemberDashboardController@changePassword')->name('member.changePassword');

    // Profile UPdation
    Route::get('/account/update/page', 'MemberDashboardController@accountUpdatePage')->name('member.account_update');
    Route::post('/update/member','MemberDashboardController@updateMember')->name('member.update_member');
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
    Route::get('/my/fund/hostory', 'MemberDashboardController@memberFundHistoryForm')->name('member.mem_fund_history');
    Route::get('/fund/history', 'MemberDashboardController@memberGetFundHistory')->name('member.ajax.fund_history');

    // Payment Requests
    Route::get('/payment/request', 'MemberDashboardController@memberPaymentRequestForm')->name('member.payment_request_form');
    Route::get('/ajax/get/payment/requests','MemberDashboardController@ajaxGetPaymentRequest')->name('member.ajax.payment_request');
    Route::post('/payment/requests','MemberDashboardController@paymentRequest')->name('member.payment_request');
    // Route::get('/my/epin/', 'MemberDashboardController@memberEpinListForm')->name('member.mem_epin_list_form');
    // Route::get('/my/epin/list', 'MemberDashboardController@memberGetEpinList')->name('member.ajax.my_epin_list');
    // Route::get('/my/fund/hostory', 'MemberDashboardController@memberFundHistoryForm')->name('member.mem_fund_history');
    // Route::get('/fund/history', 'MemberDashboardController@memberGetFundHistory')->name('member.ajax.fund_history');
    
    // Rewardz

    Route::get('/my/rewards', 'MemberDashboardController@memberGetRewardListForm')->name('member.my_rewards_list_form');
    Route::get('/my/rewards/list', 'MemberDashboardController@memberGetRewardList')->name('member.ajax.my_rewards_list');
    Route::get('/my/rewards/list/history', 'MemberDashboardController@memberGetRewardListHistory')->name('member.mem_rewards_history');

    // Commission
    Route::get('/my/commission', 'MemberDashboardController@memberCommissionListForm')->name('member.mem_commission_list_form');
    
    
    Route::get('/member/activate', 'MemberActivationController@memberActivatePage')->name('member.activate_page');
    Route::get('/member/fund', 'MemberActivationController@memberFund')->name('member.ajax.fund');
    Route::get('/member/add/activation', 'MemberActivationController@memberAddActivation')->name('member.add_activation');
    Route::get('/member/activate/details', 'MemberActivationController@memberActivatePageDetails')->name('member.activate_page_details');
    Route::post('/member/add/package', 'MemberActivationController@addPackage')->name('member.add_package');
    Route::get('/member/distributor/details', 'MemberActivationController@distributorDetails')->name('member.ajax.distributor_details');
    
    Route::post('/member/fund/transfer', 'MemberDashboardController@fundTransferFromWallet')->name('member.fund_transfer_from_wallet');



    Route::get('/my/test/from', 'MemberDashboardController@memberTestForm')->name('member.test.form');
    Route::post('/my/test/add', 'MemberDashboardController@memberTest')->name('member.test.add');

    // Member Notice
    Route::get('/member/notice/{id}', 'MemberDashboardController@getNotice')->name('member.notice');
});
