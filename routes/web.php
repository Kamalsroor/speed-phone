<?php

// change language form this link -- method (get)
// Route::get('lang/{lang}', 'LangController@lang')->name('lang');
/**********************************************************************************/

/********** Admin Login **************************************************************************************
*************************************************************************************************************/
// Auth::routes();
Route::namespace('Auth')->group(function () {
    Route::get('admin/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('admin/login', 'LoginController@login');
    Route::post('admin/logout', 'LoginController@logout_manually')->name('admin.logout');
});

/********** Company User Login *******************************************************************************
*************************************************************************************************************/
Route::group(['namespace' => 'CompUserAuth', 'prefix' => 'company'], function () {

    Route::get('login', 'LoginController@showLoginForm')->name('comp_user.login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('comp_user.logout');
    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('comp_user.password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('comp_user.password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('comp_user.password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('comp_user.password.update');

});

/*************************************************************************************************
 * Show Company From Companies users 
**************************************************************************************************/
