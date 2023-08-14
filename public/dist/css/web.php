<?php

use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade as PDF;



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



Route::get('/', function () {
    return view('welcome');
});

Route::get('/info', function () {
    return view('info');
});

Route::get('/superadmin/account', 'Superadmin\AccountController@index')->middleware('superadmin');
Route::get('/superadmin/account/create', 'Superadmin\AccountController@create')->middleware('superadmin');
Route::post('/superadmin/account/submit', 'Superadmin\AccountController@store')->middleware('superadmin');
Route::post('/superadmin/account/users/submit', 'Superadmin\AccountController@submitAccountuser')->middleware('superadmin');
Route::get('/superadmin/account/back', 'Superadmin\AccountController@back')->middleware('superadmin');
Route::get('/superadmin/account/edit/{id}', 'Superadmin\AccountController@edit')->name('account.edit')->middleware('superadmin');
Route::post('/superadmin/account/edit/submit', 'Superadmin\AccountController@updateAccountOnly')->middleware('superadmin');
Route::get('/superadmin/account/users/edit/{id}', 'Superadmin\AccountController@getAccountuser')->middleware('superadmin');
Route::post('/superadmin/account/users/update', 'Superadmin\AccountController@updateAccountuser')->middleware('superadmin');
Route::get('/superadmin/account/delete/{id}', 'Superadmin\AccountController@delete')->middleware('superadmin');
Route::get('/superadmin/account/users/delete/{id}', 'Superadmin\AccountController@deleteAccountuser')->middleware('superadmin');
Route::get('/superadmin/account/checkemail','Superadmin\AccountController@varifyemail')->middleware('superadmin');
Route::get('/superadmin/account/checkusername','Superadmin\AccountController@varifyusername')->middleware('superadmin');

Route::get('/superadmin/setup', function () {
    return view('common.setup');
})->middleware('superadmin');


Route::get('/superadmin/roles/back', 'Superadmin\RoleController@back')->name('roles.back')->middleware('superadmin');
Route::get('/superadmin/roles', 'Superadmin\RoleController@index')->name('roles.index')->middleware('superadmin');
Route::get('/superadmin/roles/edit/{id}', 'Superadmin\RoleController@edit')->name('roles.edit')->middleware('superadmin');
Route::get('/superadmin/roles/create', 'Superadmin\RoleController@create')->middleware('superadmin');
Route::post('/superadmin/roles/edit/submit', 'Superadmin\RoleController@store')->middleware('superadmin');
Route::post('/superadmin/roles/submit', 'Superadmin\RoleController@store')->middleware('superadmin');
Route::get('/superadmin/roles/delete/{id}', 'Superadmin\RoleController@delete')->middleware('superadmin');

Route::get('/superadmin/country/back', 'Superadmin\CountryController@back')->name('country.back')->middleware('superadmin');
Route::get('/superadmin/country','Superadmin\CountryController@index')->name('country.index')->middleware('superadmin');
Route::get('/superadmin/country/add','Superadmin\CountryController@create')->name('country.add')->middleware('superadmin');
Route::post('/superadmin/country/submit','Superadmin\CountryController@store')->name('country.store')->middleware('superadmin');
Route::get('/superadmin/country/edit/{id}','Superadmin\CountryController@edit')->name('country.edit')->middleware('superadmin');
Route::post('/superadmin/country/update','Superadmin\CountryController@store')->name('country.update')->middleware('superadmin');
Route::get('/superadmin/country/delete/{id}','Superadmin\CountryController@delete')->name('country.delete')->middleware('superadmin');

Route::get('/superadmin/states/back', 'Superadmin\StateController@back')->name('states.back')->middleware('superadmin');
Route::get('/superadmin/states','Superadmin\StateController@index')->name('states.index')->middleware('superadmin');
Route::get('/superadmin/states/add','Superadmin\StateController@create')->name('states.add')->middleware('superadmin');
Route::post('/superadmin/states/submit','Superadmin\StateController@store')->name('states.store')->middleware('superadmin');
Route::get('/superadmin/states/edit/{id}','Superadmin\StateController@edit')->name('states.edit')->middleware('superadmin');
Route::post('/superadmin/states/update','Superadmin\StateController@store')->name('states.update')->middleware('superadmin');
Route::get('/superadmin/states/delete/{id}','Superadmin\StateController@delete')->name('states.delete')->middleware('superadmin');


Route::get('/superadmin/order-status/back', 'Superadmin\OrderStatusController@back')->name('order-status.back')->middleware('superadmin');
Route::get('/superadmin/order-status','Superadmin\OrderStatusController@index')->name('order-status.index')->middleware('superadmin');
Route::get('/superadmin/order-status/add','Superadmin\OrderStatusController@create')->name('order-status.add')->middleware('superadmin');
Route::post('/superadmin/order-status/submit','Superadmin\OrderStatusController@store')->name('order-status.store')->middleware('superadmin');
Route::get('/superadmin/order-status/edit/{id}','Superadmin\OrderStatusController@edit')->name('order-status.edit')->middleware('superadmin');
Route::post('/superadmin/order-status/update','Superadmin\OrderStatusController@store')->name('order-status.update')->middleware('superadmin');
Route::get('/superadmin/order-status/delete/{id}','Superadmin\OrderStatusController@delete')->name('order-status.delete')->middleware('superadmin');


Route::get('/superadmin/users/back', 'Superadmin\UserController@back')->middleware('superadmin');
Route::get('/superadmin/users', 'Superadmin\UserController@index')->name('users.index')->middleware('superadmin');
Route::get('/superadmin/users/create', 'Superadmin\UserController@create')->middleware('superadmin');
Route::get('/superadmin/users/edit/{id}', 'Superadmin\UserController@edit')->name('users.edit')->middleware('superadmin');
Route::post('/superadmin/users/edit/submit', 'Superadmin\UserController@store')->middleware('superadmin');
Route::post('/superadmin/users/submit', 'Superadmin\UserController@store')->middleware('superadmin');
Route::get('/superadmin/users/delete/{id}', 'Superadmin\UserController@delete')->middleware('superadmin');



Auth::routes(['register' => false]);

Route::get('/superadmin', 'HomeController@index')->name('dashboard.index')->middleware('superadmin');
Route::get('/accountadmin', 'HomeController@index')->name('dashboard.index')->middleware('admin');
Route::get('/locationmanager', 'HomeController@index')->name('dashboard.index')->middleware('locationadmin');
Route::get('/customer', 'HomeController@index')->name('dashboard.index')->middleware('customer');

Route::get('/accountadmin/users/back', 'Accountadmin\UserController@back')->middleware('admin');
Route::get('/accountadmin/users', 'Accountadmin\UserController@index')->name('adminusers.index')->middleware('admin');
Route::get('/accountadmin/users/edit/{id}', 'Accountadmin\UserController@edit')->name('accountadmin.users.edit')->middleware('admin');
Route::get('/accountadmin/users/create','Accountadmin\UserController@create')->name('accountadmin.users.create')->middleware('admin');
Route::post('/accountadmin/users/submit','Accountadmin\UserController@store')->name('accountadmin.users.store')->middleware('admin');
Route::post('/accountadmin/users/edit/submit','Accountadmin\UserController@update')->name('accountadmin.users.update')->middleware('admin');
Route::get('/accountadmin/users/delete/{id}','Accountadmin\UserController@delete')->name('accountadmin.users.delete')->middleware('admin');

Route::get('/accountadmin/locations/back', 'Accountadmin\LocationController@back')->middleware('admin');
Route::get('/accountadmin/locations','Accountadmin\LocationController@index')->name('accountadmin.locations.index')->middleware('admin');
Route::get('/accountadmin/locations/add','Accountadmin\LocationController@create')->name('accountadmin.locations.add')->middleware('admin');
Route::post('/accountadmin/locations/submit','Accountadmin\LocationController@store')->name('accountadmin.locations.store')->middleware('admin');
Route::get('/accountadmin/locations/edit/{id}','Accountadmin\LocationController@edit')->name('accountadmin.locations.edit')->middleware('admin');
Route::post('/accountadmin/locations/update','Accountadmin\LocationController@store')->name('accountadmin.locations.update')->middleware('admin');
Route::get('/accountadmin/locations/delete/{id}','Accountadmin\LocationController@delete')->name('accountadmin.locations.delete')->middleware('admin');

Route::get('/accountadmin/products-categories/back', 'Accountadmin\ProductCategoryController@back')->middleware('admin');
Route::get('/accountadmin/products-categories','Accountadmin\ProductCategoryController@index')->name('accountadmin.products-categories.index')->middleware('admin');
Route::get('/accountadmin/products-categories/add','Accountadmin\ProductCategoryController@create')->name('accountadmin.products-categories.add')->middleware('admin');
Route::post('/accountadmin/products-categories/submit','Accountadmin\ProductCategoryController@store')->name('accountadmin.products-categories.store')->middleware('admin');
Route::get('/accountadmin/products-categories/edit/{id}','Accountadmin\ProductCategoryController@edit')->name('accountadmin.products-categories.edit')->middleware('admin');
Route::post('/accountadmin/products-categories/update','Accountadmin\ProductCategoryController@store')->name('accountadmin.products-categories.update')->middleware('admin');
Route::get('/accountadmin/products-categories/delete/{id}','Accountadmin\ProductCategoryController@delete')->name('accountadmin.products-categories.delete')->middleware('admin');

Route::get('/accountadmin/vendors/back', 'Accountadmin\VendorController@back')->middleware('admin');
Route::get('/accountadmin/vendors','Accountadmin\VendorController@index')->name('accountadmin.vendors.index')->middleware('admin');
Route::get('/accountadmin/vendors/add','Accountadmin\VendorController@create')->name('accountadmin.vendors.add')->middleware('admin');
Route::post('/accountadmin/vendors/submit','Accountadmin\VendorController@store')->name('accountadmin.vendors.store')->middleware('admin');
Route::get('/accountadmin/vendors/edit/{id}','Accountadmin\VendorController@edit')->name('accountadmin.vendors.edit')->middleware('admin');
Route::post('/accountadmin/vendors/update','Accountadmin\VendorController@update')->name('accountadmin.vendors.update')->middleware('admin');
Route::get('/accountadmin/vendors/delete/{id}','Accountadmin\VendorController@delete')->name('accountadmin.vendors.delete')->middleware('admin');

Route::post('/accountadmin/vendors/comments/store','Accountadmin\VendorController@commentStore')->name('accountadmin.comments.vendors.store')->middleware('admin');
Route::get('/accountadmin/vendors/comments/edit/{id}','Accountadmin\VendorController@commentEdit')->name('accountadmin.comments.vendors.edit')->middleware('admin');
Route::get('/accountadmin/vendors/comments/delete/{id}','Accountadmin\VendorController@commentDelete')->name('accountadmin.comments.vendors.delete')->middleware('admin');

Route::get('/accountadmin/vendors/contacts/add/{id}','Accountadmin\VendorContactController@index')->name('accountadmin.vendors.contacts.add')->middleware('admin');
Route::post('/accountadmin/vendors/contacts/submit','Accountadmin\VendorContactController@store')->name('accountadmin.vendors.contacts.store')->middleware('admin');
Route::get('/accountadmin/vendors/contacts/edit/{id}','Accountadmin\VendorContactController@edit')->name('accountadmin.vendors.contacts.edit')->middleware('admin');
Route::post('/accountadmin/vendors/contacts/update','Accountadmin\VendorContactController@update')->name('accountadmin.vendors.contacts.update')->middleware('admin');
Route::get('/accountadmin/vendors/contacts/delete/{id}','Accountadmin\VendorContactController@delete')->name('accountadmin.vendors.contacts.delete')->middleware('admin');

Route::get('/accountadmin/vendor-type/back', 'Accountadmin\VendortypeController@back')->middleware('admin');
Route::get('/accountadmin/vendor-type','Accountadmin\VendortypeController@index')->name('accountadmin.vendor-type.index')->middleware('admin');
Route::get('/accountadmin/vendor-type/add','Accountadmin\VendortypeController@create')->name('accountadmin.vendor-type.add')->middleware('admin');
Route::post('/accountadmin/vendor-type/submit','Accountadmin\VendortypeController@store')->name('accountadmin.vendor-type.store')->middleware('admin');
Route::get('/accountadmin/vendor-type/edit/{id}','Accountadmin\VendortypeController@edit')->name('accountadmin.vendor-type.edit')->middleware('admin');
Route::post('/accountadmin/vendor-type/update','Accountadmin\VendortypeController@store')->name('accountadmin.vendor-type.update')->middleware('admin');
Route::get('/accountadmin/vendor-type/delete/{id}','Accountadmin\VendortypeController@delete')->name('accountadmin.vendor-type.delete')->middleware('admin');

Route::get('/accountadmin/customer-type','Accountadmin\CustomertypeController@index')->name('accountadmin.customer-type.index')->middleware('admin');
Route::get('/accountadmin/customer-type/add','Accountadmin\CustomertypeController@create')->name('accountadmin.customer-type.add')->middleware('admin');
Route::post('/accountadmin/customer-type/submit','Accountadmin\CustomertypeController@store')->name('accountadmin.customer-type.store')->middleware('admin');
Route::get('/accountadmin/customer-type/edit/{id}','Accountadmin\CustomertypeController@edit')->name('accountadmin.customer-type.edit')->middleware('admin');
Route::post('/accountadmin/customer-type/update','Accountadmin\CustomertypeController@store')->name('accountadmin.customer-type.update')->middleware('admin');
Route::get('/accountadmin/customer-type/delete/{id}','Accountadmin\CustomertypeController@delete')->name('accountadmin.customer-type.delete')->middleware('admin');

Route::get('/accountadmin/customers/back','Accountadmin\CustomerController@back')->name('accountadmin.customers.back')->middleware('admin');
Route::get('/accountadmin/customers/long','Accountadmin\CustomerController@location')->name('accountadmin.customers.location')->middleware('admin');
Route::get('/accountadmin/customers','Accountadmin\CustomerController@index')->name('accountadmin.customers.index')->middleware('admin');
Route::get('/accountadmin/customers/add','Accountadmin\CustomerController@create')->name('accountadmin.customers.add')->middleware('admin');
Route::post('/accountadmin/customers/submit','Accountadmin\CustomerController@store')->name('accountadmin.customers.store')->middleware('admin');
Route::get('/accountadmin/customers/edit/{id}','Accountadmin\CustomerController@edit')->name('accountadmin.customers.edit')->middleware('admin');
Route::post('/accountadmin/customers/update','Accountadmin\CustomerController@update')->name('accountadmin.customers.update')->middleware('admin');
Route::get('/accountadmin/customers/delete/{id}','Accountadmin\CustomerController@delete')->name('accountadmin.customers.delete')->middleware('admin');

Route::post('/accountadmin/customers/comments/store','Accountadmin\CustomerController@commentStore')->name('accountadmin.comments.customers.store')->middleware('admin');
Route::get('/accountadmin/customers/comments/edit/{id}','Accountadmin\CustomerController@commentEdit')->name('accountadmin.comments.customers.edit')->middleware('admin');
Route::get('/accountadmin/customers/comments/delete/{id}','Accountadmin\CustomerController@commentDelete')->name('accountadmin.comments.customers.delete')->middleware('admin');

Route::get('/accountadmin/department/back', 'Accountadmin\DepartmentController@back')->middleware('admin');
Route::get('/accountadmin/department','Accountadmin\DepartmentController@index')->name('accountadmin.department.index')->middleware('admin');
Route::get('/accountadmin/department/add','Accountadmin\DepartmentController@create')->name('accountadmin.department.add')->middleware('admin');
Route::post('/accountadmin/department/submit','Accountadmin\DepartmentController@store')->name('accountadmin.department.store')->middleware('admin');
Route::get('/accountadmin/department/edit/{id}','Accountadmin\DepartmentController@edit')->name('accountadmin.department.edit')->middleware('admin');
Route::post('/accountadmin/department/update','Accountadmin\DepartmentController@store')->name('accountadmin.department.update')->middleware('admin');
Route::get('/accountadmin/department/delete/{id}','Accountadmin\DepartmentController@delete')->name('accountadmin.department.delete')->middleware('admin');



Route::get('/accountadmin/customers/contacts/add/{id}','Accountadmin\CustomerContactController@index')->name('accountadmin.customers.contacts.add')->middleware('admin');
Route::post('/accountadmin/customers/contacts/submit','Accountadmin\CustomerContactController@store')->name('accountadmin.customers.contacts.store')->middleware('admin');
Route::get('/accountadmin/customers/contacts/edit/{id}','Accountadmin\CustomerContactController@edit')->name('accountadmin.customers.contacts.edit')->middleware('admin');
Route::post('/accountadmin/customers/contacts/update','Accountadmin\CustomerContactController@update')->name('accountadmin.customers.contacts.update')->middleware('admin');
Route::get('/accountadmin/customers/contacts/delete/{id}','Accountadmin\CustomerContactController@delete')->name('accountadmin.customers.contacts.delete')->middleware('admin');

Route::get('/accountadmin/customer-business/add','Accountadmin\CustomerController@businessIndex')->name('accountadmin.customers.business.index')->middleware('admin');
Route::post('/accountadmin/customer-business/submit','Accountadmin\CustomerController@businessStore')->name('accountadmin.customers.contacts.store')->middleware('admin');
Route::post('/accountadmin/customer-business/update','Accountadmin\CustomerController@businessUpdate')->name('accountadmin.customers.contacts.update')->middleware('admin');


Route::get('/accountadmin/customers/export','Accountadmin\CustomerController@export')->name('accountadmin.customers.contacts.delete')->middleware('admin');


Route::get('/accountadmin/setup', function () {
    return view('common.setup');
})->middleware('admin');


//Route::post('/account/user/submit', [App\Http\Controllers\Superadmin\AccountController::class, 'store'])->middleware('superadmin');
