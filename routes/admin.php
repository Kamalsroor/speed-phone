<?php
// dashboard
Route::get('/{name_page?}', 'DashboardController@index')->name('admin.dashboard')->where('name_page', 'dashboard');
Route::get('home', 'DashboardController@index')->name('admin.dashboard')->where('name_page', 'dashboard');

// Users
Route::resource('users', 'UserController');
Route::get('downloadExcel/{id}', 'ExcelController@userExport');

// permissions
Route::resource('permissions', 'PermissionsController');
// permissions
Route::resource('roles', 'RolesController');

// customers
Route::resource('customers', 'CustomersController');
Route::resource('customersfreight', 'CustomersfreightController');
// typeofproduct
Route::resource('typeofproduct', 'TypeOfProductController');
// typeofproduct
Route::resource('operation', 'OperationController');

// permissionex
Route::resource('permissionex', 'PermissionExFreightController');
Route::get('permissionex/action/{id}', 'PermissionExFreightController@action')->name('permissionex.action');
Route::get('permissionexing', 'PermissionExFreightController@index2')->name('permissionexing.index2');
Route::get('permissionex/action2', 'PermissionExFreightController@action2')->name('action2pre');

// permissionent
Route::resource('permissionent', 'PermissionEntFreightController');
Route::resource('prisess', 'PermissionEntFreightpricesController');
Route::get('permissionent/pricing/{id}', 'PermissionEntFreightController@pricing')->name('permissionent.pricing');
Route::get('permissionent/excel/{id}', 'PermissionEntFreightpricesController@excel')->name('permissionent.excel');
Route::get('permissionent/action/{id}', 'PermissionEntFreightController@action')->name('permissionent.action');
Route::get('permissionenting', 'PermissionEntFreightController@index2')->name('permissionexing.index2');

// Route::resource('permissionex', 'PermissionExFreightController')->except(['show']);
//Route::post('permissionex/{id}', 'PermissionExFreightController@show')->name('permissionex.show');
Route::get('Search', 'SearchsController@index');
Route::get('/Search/action', 'SearchsController@action')->name('Search.action');
Route::get('/Search/actions', 'SearchsController@action2')->name('Search.action2');
Route::get('Searchent', 'SearchentController@index');
Route::get('/Searchent/action', 'SearchentController@action')->name('Searchent.action');
Route::get('/Searchent/actions', 'SearchentController@action2')->name('Searchent.actions');
Route::get('/Searchent/showbro', 'SearchentController@showbro')->name('Searchent.showbro');
Route::get('Searches', 'SearchController@index');
Route::get('inventory/action/{id}', 'SearchController@action')->name('inventory.show');
Route::get('inventorytype/action/{id}', 'SearchController@action2')->name('inventorytype.show');

// accountcustomers.
Route::resource('accountcustomers', 'AccountCustomersController');
Route::get('accountcustomerss/index2', 'AccountCustomersController@index2')->name('accountcustomers.index2');
Route::get('accountcustomers/action/{id}', 'AccountCustomersController@action')->name('accountcustomers.action');
Route::resource('Accountstatement', 'AccountstatementController');
Route::get('Accountstatement/customer/{id}', 'AccountstatementController@createstatement')->name('Accountstatement.action.{id}');
Route::get('accountcustomers/customer/{id}', 'AccountCustomersController@createstatement')->name('Accountstatement.action.{id}');
Route::get('accountcustomers/Accountstatement/{id}/{test}', 'AccountstatementController@action')->name('accountcustomers.Accountstatement');
// mobilats
Route::resource('mobilats', 'MobilatController');
Route::resource('acc', 'ACCController');
Route::get('inventory', 'MobilatController@showInventory')->name('mobilats.inventory');
Route::get('inventoryacc', 'ACCController@showInventory')->name('ACC.inventory');
Route::get('inventorytype', 'TypeOfProductController@showInventory')->name('Type.inventory');
// mobilatsex
Route::resource('mobilatsex', 'MobilatExController');


// prometerrequests
Route::resource('prometerrequests', 'PrometerRequestController');
Route::get('prometerrequests/action/{id}', 'PrometerRequestController@action')->name('prometerrequests.action');
Route::resource('prometer', 'PrometerController');
Route::get('prometer/action/{id}', 'PrometerController@action')->name('prometer.action');
Route::resource('prometerfinsh', 'prometerfinshController');
Route::get('prometerfinsh/action/{id}', 'prometerfinshController@action2')->name('prometerfinsh.action');

// accessoriesex
Route::resource('accessoriesex', 'ACCExController');
// mobilatsent
Route::resource('mobilatsent', 'MobilatEntController');
Route::get('ent/get-row/', 'MobilatEntController@getRow')->name('ent.get-row');
// accessoriesex
Route::resource('accessoriesent', 'ACCEntController');

// Companies
Route::resource('companies', 'CompanyController')->except(['show']);
Route::post('companies/show/{id}', 'CompanyController@show')->name('companies.show');

// Companies Users
Route::resource('companies_users', 'CompUserController')->except(['show']);
Route::post('companies_users/show/{id}', 'CompUserController@show')->name('comp_user.show');
Route::get('c_users/company/{id}', 'CompUserController@showCompanyUser')->name('comp_user.company');
Route::get('c_users/pending', 'CompUserController@showPending')->name('comp_user.pending');
Route::get('c_users/deleted', 'CompUserController@showDeleted')->name('comp_user.deleted');
Route::delete('c_users/force_delete/{id}', 'CompUserController@force_delete')->name('comp_user.force_delete');
Route::delete('c_users/restore/{id}', 'CompUserController@restore')->name('comp_user.restore');
Route::post('c_users/approve/{id}', 'CompUserController@approve')->name('comp_user.approve');
