<?php
// Config::set('auth.defaults.guard', 'comp_user');
Route::get('/{name_page?}', 'DashboardController@index')->name('comp_user.dashboard')->where('name_page', 'dashboard');

// Companies Users
Route::resource('c_users', 'CompUserController')->except(['show', 'create', 'store']);
Route::post('c_users/show/{id}', 'CompUserController@show')->name('c_user.show');

// Account Types
Route::resource('account_types', 'AccountTypeController')->except(['show']);

// Sub accounts
Route::resource('sub_accounts', 'AccountNameController')->except(['show']);

// Transitions
Route::resource('transitions', 'TransitionController');
Route::post('get_account_types', 'TransitionController@get_account_types')->name('get_account_types');

// Transition Details
Route::resource('transition_details', 'TransitionDetailsController')->except(['show']);
