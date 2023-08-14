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

// URL::forceScheme('https');
Route::get('/location-we-serve', 'FrontendController@locationWeServe');

Route::get('/new-home', function () {
    return view('new-home');
});
Route::get('/database', function () {
    return view('database');
});
Route::get('/accountadmin/orders', 'Accountadmin\OrderController@index')->name('accountadmin.orders.index')->middleware(['auth', 'admin']);
Route::post('/accountadmin/orders/status/update', 'Accountadmin\OrderController@orderStatusUpdate')->name('accountadmin.orders.status.update')->middleware(['auth', 'admin']);
Route::post('/accountadmin/order-status', 'Accountadmin\OrderController@orderByStatus')->name('accountadmin.orders.orderbystatus')->middleware(['auth', 'admin']);

Route::get('/accountadmin/payment-gateway/back', 'Accountadmin\AccountAdminPaymentGatewayController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/payment-gateway', 'Accountadmin\AccountAdminPaymentGatewayController@index')->name('accountadmin.payment.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/payment-gateway/add', 'Accountadmin\AccountAdminPaymentGatewayController@create')->name('accountadmin.payment.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/payment-gateway/submit', 'Accountadmin\AccountAdminPaymentGatewayController@store')->name('accountadmin.payment.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/payment-gateway/edit/{id}', 'Accountadmin\AccountAdminPaymentGatewayController@edit')->name('accountadmin.payment.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/payment-gateway/update', 'Accountadmin\AccountAdminPaymentGatewayController@store')->name('accountadmin.payment.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/payment-gateway/delete/{id}', 'Accountadmin\AccountAdminPaymentGatewayController@delete')->name('accountadmin.payment.delete')->middleware(['auth', 'admin']);

Route::get('/product-flowers', function () {
    return view('catalogue-sample');
});

Route::get('/shop', function () {
    return view('shop');
});

Route::get('/product', 'ProductController@index')->name('product.index');
Route::get('/product/{product}/price/{price}/productid/{productid}', 'ProductController@view');

Route::get('cart', 'ProductController@cart');
Route::get('checkout', 'ProductController@checkout');
Route::get('add-to-cart/{id}', 'ProductController@addToCart');
Route::patch('update-cart', 'ProductController@update');
Route::delete('remove-from-cart', 'ProductController@remove');


Route::get('/flower-bouquet', 'FlowerBouquetController@index');
Route::post('/flower-bouquet/cart/submit', 'FlowerBouquetController@cart');
Route::any('/floral-arrangement', 'FloralArrangementController@index');
Route::any('/floral-arrangement/category/{category}', 'FloralArrangementController@category');
Route::get('/flower-by-subscription', 'FlowerBySubscriptionController@index');
Route::post('/flower-by-subscription/submit', 'FlowerBySubscriptionController@view');
Route::get('/flower-by-sub/{id}', 'FlowerBySubscriptionController@detail_img');
Route::post('/other-add-to-cart', 'FlowerBySubscriptionController@addToCart');
Route::get('other-cart', 'FlowerBySubscriptionController@cart');
Route::patch('other-update-cart', 'FlowerBySubscriptionController@update');
Route::patch('other-cart-items-update', 'FlowerBySubscriptionController@updateAllCartItems');
Route::delete('other-remove-from-cart', 'FlowerBySubscriptionController@remove');
Route::get('other-checkout', 'FlowerBySubscriptionController@otherCheckOutPage');
Route::post('other-checkout', 'FlowerBySubscriptionController@other_checkout');
Route::any('other-checkouts', 'FlowerBySubscriptionController@other_checkouts');
Route::any('other-checkoutss', 'FlowerBySubscriptionController@other_checkoutss');
Route::post('other-checkout-ship-info', 'FlowerBySubscriptionController@otherCheckoutShipInfo');
Route::any('thank-you/{id}', 'FlowerBySubscriptionController@thank_you');
Route::get('/request-a-quote', 'RequestQuoteController@index');
Route::any('/apply-coupon', 'FlowerBySubscriptionController@apply_coupon');
Route::get('/remove-coupon', 'FlowerBySubscriptionController@remove_coupon');
Route::post('/getAddressId', 'FlowerBySubscriptionController@getAddressId');

// added newly
Route::any('/floral-arrangement-details/{id}', 'FloralArrangementController@detais');
Route::post('/floral-arrangement-addCard', 'FloralArrangementController@addCard');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});


//
Route::get('/guestLogin', function () {
    return view('login');
});
Route::post('/guestlogin', 'UserController@index')->name('guestlogin');
Route::get('/guestRegister', function () {
    return view('register');
});
Route::post('/guestRegister', 'UserController@guestRegister')->name('guestRegister');

//
Route::get('/assistant', 'Assistant\AssistantController@index')->name('assistant.index')->middleware(['auth', 'assistant']);

Route::get('/accountant', 'Accountant\AccountantController@index')->name('accountant.index')->middleware(['auth', 'accountant']);

Route::get('/location-manager', 'LocationManager\LocationmanagerController@index')->name('location-manager.index')->middleware(['auth', 'locationadmin']);


Route::get('/superadmin/frequency/back', 'Superadmin\FrequencyController@back')->name('frequency.back')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/frequency', 'Superadmin\FrequencyController@index')->name('frequency.index')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/frequency/edit/{id}', 'Superadmin\FrequencyController@edit')->name('frequency.edit')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/frequency/add', 'Superadmin\FrequencyController@create')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/frequency/update', 'Superadmin\FrequencyController@store')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/frequency/submit', 'Superadmin\FrequencyController@store')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/frequency/delete/{id}', 'Superadmin\FrequencyController@delete')->name('frequency.delete')->middleware(['auth', 'superadmin']);

Route::get('/superadmin/uom/back', 'Superadmin\UomController@back')->name('uom.back')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/uom', 'Superadmin\UomController@index')->name('uom.index')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/uom/edit/{id}', 'Superadmin\UomController@edit')->name('uom.edit')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/uom/add', 'Superadmin\UomController@create')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/uom/update', 'Superadmin\UomController@store')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/uom/submit', 'Superadmin\UomController@store')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/uom/delete/{id}', 'Superadmin\UomController@delete')->name('uom.delete')->middleware(['auth', 'superadmin']);


Route::get('/superadmin/account', 'Superadmin\AccountController@index')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/account/create', 'Superadmin\AccountController@create')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/account/submit', 'Superadmin\AccountController@store')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/account/users/submit', 'Superadmin\AccountController@submitAccountuser')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/account/back', 'Superadmin\AccountController@back')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/account/edit/{id}', 'Superadmin\AccountController@edit')->name('account.edit')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/account/edit/submit', 'Superadmin\AccountController@updateAccountOnly')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/account/users/edit/{id}', 'Superadmin\AccountController@getAccountuser')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/account/users/update', 'Superadmin\AccountController@updateAccountuser')->middleware(['auth', 'superadmin']);

Route::get('/superadmin/account/users/reset-password/{id}', 'Superadmin\AccountController@getReset')->name('superadmin.account.users.reset')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/account/users/reset-password/submit', 'Superadmin\AccountController@postReset')->middleware(['auth', 'superadmin']);

Route::get('/superadmin/users/reset-password/{id}', 'Superadmin\UserController@getReset')->name('account.users.reset')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/users/reset-password/submit', 'Superadmin\UserController@postReset')->name('account.users.reset.submit')->middleware(['auth', 'superadmin']);

Route::get('/superadmin/account/users/profile', 'Superadmin\UserController@profile')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/account/users/profile/update', 'Superadmin\UserController@updateProfile')->middleware(['auth', 'superadmin']);

Route::get('/superadmin/account/delete/{id}', 'Superadmin\AccountController@delete')->name('account.delete')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/account/users/delete/{id}', 'Superadmin\AccountController@deleteAccountuser')->name('account.user.delete')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/account/checkemail', 'Superadmin\AccountController@varifyemail')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/account/checkusername', 'Superadmin\AccountController@varifyusername')->middleware(['auth', 'superadmin']);

Route::get('/superadmin/setup', function () {
    return view('common.setup');
})->middleware(['auth', 'superadmin']);


Route::get('/superadmin/roles/back', 'Superadmin\RoleController@back')->name('roles.back')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/roles', 'Superadmin\RoleController@index')->name('roles.index')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/roles/edit/{id}', 'Superadmin\RoleController@edit')->name('roles.edit')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/roles/create', 'Superadmin\RoleController@create')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/roles/edit/submit', 'Superadmin\RoleController@store')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/roles/submit', 'Superadmin\RoleController@store')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/roles/delete/{id}', 'Superadmin\RoleController@delete')->name('roles.delete')->middleware(['auth', 'superadmin']);

Route::get('/superadmin/country/back', 'Superadmin\CountryController@back')->name('country.back')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/country', 'Superadmin\CountryController@index')->name('country.index')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/country/add', 'Superadmin\CountryController@create')->name('country.add')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/country/submit', 'Superadmin\CountryController@store')->name('country.store')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/country/edit/{id}', 'Superadmin\CountryController@edit')->name('country.edit')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/country/update', 'Superadmin\CountryController@store')->name('country.update')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/country/delete/{id}', 'Superadmin\CountryController@delete')->name('country.delete')->middleware(['auth', 'superadmin']);

Route::get('/superadmin/states/back', 'Superadmin\StateController@back')->name('states.back')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/states', 'Superadmin\StateController@index')->name('states.index')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/states/add', 'Superadmin\StateController@create')->name('states.add')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/states/submit', 'Superadmin\StateController@store')->name('states.store')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/states/edit/{id}', 'Superadmin\StateController@edit')->name('states.edit')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/states/update', 'Superadmin\StateController@store')->name('states.update')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/states/delete/{id}', 'Superadmin\StateController@delete')->name('states.delete')->middleware(['auth', 'superadmin']);


Route::get('/superadmin/order-status/back', 'Superadmin\OrderStatusController@back')->name('order-status.back')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/order-status', 'Superadmin\OrderStatusController@index')->name('order-status.index')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/order-status/add', 'Superadmin\OrderStatusController@create')->name('order-status.add')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/order-status/submit', 'Superadmin\OrderStatusController@store')->name('order-status.store')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/order-status/edit/{id}', 'Superadmin\OrderStatusController@edit')->name('order-status.edit')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/order-status/update', 'Superadmin\OrderStatusController@store')->name('order-status.update')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/order-status/delete/{id}', 'Superadmin\OrderStatusController@delete')->name('order-status.delete')->middleware(['auth', 'superadmin']);


Route::get('/superadmin/users/back', 'Superadmin\UserController@back')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/users', 'Superadmin\UserController@index')->name('users.index')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/users/create', 'Superadmin\UserController@create')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/users/edit/{id}', 'Superadmin\UserController@edit')->name('users.edit')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/users/edit/submit', 'Superadmin\UserController@store')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/users/submit', 'Superadmin\UserController@store')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/users/delete/{id}', 'Superadmin\UserController@delete')->name('users.delete')->middleware(['auth', 'superadmin']);

Route::get('/superadmin/event/back', 'Superadmin\EventController@back')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/event', 'Superadmin\EventController@index')->name('event.index')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/event/add', 'Superadmin\EventController@create')->name('event.add')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/event/submit', 'Superadmin\EventController@store')->name('event.store')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/event/edit/{id}', 'Superadmin\EventController@edit')->name('event.edit')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/event/update', 'Superadmin\EventController@store')->name('event.update')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/event/delete/{id}', 'Superadmin\EventController@delete')->name('event.delete')->middleware(['auth', 'superadmin']);


Route::get('/superadmin/customer-location-types', 'Superadmin\CustomerLocationTypeController@index')->name('customer.customer-location-types.index')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/customer-location-types/add', 'Superadmin\CustomerLocationTypeController@create')->name('customer.customer-location-types.add')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/customer-location-types/submit', 'Superadmin\CustomerLocationTypeController@store')->name('customer.customer-location-types.store')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/customer-location-types/edit/{id}', 'Superadmin\CustomerLocationTypeController@edit')->name('customer.customer-location-types.edit')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/customer-location-types/update', 'Superadmin\CustomerLocationTypeController@store')->name('customer.customer-location-types.update')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/customer-location-types/delete/{id}', 'Superadmin\CustomerLocationTypeController@delete')->name('customer.customer-location-types.delete')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/customer-location-types/times', 'Superadmin\CustomerLocationTypeController@times')->name('customer.customer-location-types.times')->middleware(['auth', 'superadmin']);


Route::get('/superadmin/location-types/back', 'Superadmin\LocationTypeController@back')->name('superadmin.location-types.back')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/location-types', 'Superadmin\LocationTypeController@index')->name('superadmin.location-types.index')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/location-types/add', 'Superadmin\LocationTypeController@create')->name('superadmin.location-types.add')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/location-types/submit', 'Superadmin\LocationTypeController@store')->name('superadmin.location-types.store')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/location-types/edit/{id}', 'Superadmin\LocationTypeController@edit')->name('superadmin.location-types.edit')->middleware(['auth', 'superadmin']);
Route::post('/superadmin/location-types/update', 'Superadmin\LocationTypeController@store')->name('superadmin.location-types.update')->middleware(['auth', 'superadmin']);
Route::get('/superadmin/location-types/delete/{id}', 'Superadmin\LocationTypeController@delete')->name('superadmin.location-types.delete')->middleware(['auth', 'superadmin']);


Auth::routes();

//location manager
Route::group(['namespace' => 'LocationManager', 'prefix' => 'locationmanager', 'middleware' => ['auth', 'locationadmin']], function () {
    Route::get('/vendor-order-request', 'LocationmanagerController@vendorOrderRequestList');
    Route::get('/vendor-order-request/add', 'LocationmanagerController@vendorOrderRequestCreate');
    Route::post('/vendor-order-request/submit', 'LocationmanagerController@vendorOrderRequestStore');
    Route::get('/vendor-order-request/edit/{id}', 'LocationmanagerController@vendorOrderRequestEdit');
    Route::post('/vendor-order-request/update', 'LocationmanagerController@vendorOrderRequestUpdate');
    Route::get('/vendor-order-request/view/{id}', 'LocationmanagerController@vendorOrderRequestShow');
    Route::get('/vendor-order-request/delete/{id}', 'LocationmanagerController@vendorOrderRequestDelete')->name('locationmanager.vendor-order-request.delete');
    Route::get('/', 'LocationmanagerController@index')->name('dashboard.index');
});


Route::get('/superadmin', 'HomeController@index')->name('dashboard.index')->middleware(['auth', 'superadmin']);
Route::get('/accountadmin', 'HomeController@index')->name('dashboard.index')->middleware(['auth', 'admin']);
Route::get('/customer', 'HomeController@index')->name('dashboard.index')->middleware('customer');
Route::get('/customer/profile', 'HomeController@editProfile')->name('customer.edit.profile')->middleware('customer');
Route::post('/customer/profile/update', 'HomeController@updateProfile')->name('customer.update.profile')->middleware('customer');
Route::get('/customer/reset/{id}', 'HomeController@resetCustomer')->name('customer.reset.customer')->middleware('customer');
Route::post('/customer/reset-password/submit', 'HomeController@resetUpdate')->name('customer.reset.customer.update')->middleware('customer');
Route::get('/my-orders', 'HomeController@my_order')->name('dashboard.myorders')->middleware('customer');
// Route::get('/customer/vendor-order-request', 'HomeController@vendorOrderRequestList')->name('dashboard.vendor-order-request')->middleware('customer');
// Route::get('/customer/vendor-order-request/add', 'HomeController@vendorOrderRequestCreate')->middleware('customer');
// Route::post('/customer/vendor-order-request/submit', 'HomeController@vendorOrderRequestStore')->middleware('customer');
// Route::get('/customer/vendor-order-request/edit/{id}', 'HomeController@vendorOrderRequestEdit')->middleware('customer');
// Route::post('/customer/vendor-order-request/update', 'HomeController@vendorOrderRequestUpdate')->middleware('customer');
// Route::get('/customer/vendor-order-request/view/{id}', 'HomeController@vendorOrderRequestShow')->middleware('customer');
// Route::get('/customer/vendor-order-request/delete/{id}', 'HomeController@vendorOrderRequestDelete')->name('customer.vendor-order-request.delete')->middleware('customer');
Route::get('/order-details/{id}', 'HomeController@my_order_details')->name('dashboard.myorderdetails')->middleware('customer');
Route::get('/order/cancel-order/{id}', 'HomeController@cancelOrder')->name('dashboard.cancel_order')->middleware('customer');
Route::get('/order-details/edit/{id}', 'HomeController@edit_my_order_details')->name('dashboard.myorderdetails.edit')->middleware('customer');


Route::get('/vendor', 'Vendor\VendorController@index')->name('vendor.index')->middleware(['auth', 'vendor']);
Route::get('/vendor/vendor-order-request/view/{id}', 'Vendor\VendorController@vendorOrderRequestShow')->middleware(['auth', 'vendor']);
Route::get('/vendor/vendor-order-request', 'Vendor\VendorController@vendorOrderRequestList')->middleware(['auth', 'vendor']);

Route::get('/accountadmin/flower-subscription/back', 'Accountadmin\FlowerSubscriptionController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/flower-subscription', 'Accountadmin\FlowerSubscriptionController@index')->name('admin.flower-subscription.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/flower-subscription/add', 'Accountadmin\FlowerSubscriptionController@create')->name('accountadmin.flower-subscription.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/flower-subscription/submit', 'Accountadmin\FlowerSubscriptionController@store')->name('accountadmin.flower-subscription.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/flower-subscription/edit/{id}', 'Accountadmin\FlowerSubscriptionController@edit')->name('accountadmin.flower-subscription.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/flower-subscription/update', 'Accountadmin\FlowerSubscriptionController@update')->name('accountadmin.flower-subscription.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/flower-subscription/delete/{id}', 'Accountadmin\FlowerSubscriptionController@delete')->name('accountadmin.flower-subscription.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/vendor-request-order', 'Accountadmin\VendorOrderRequestOrderController@index')->name('accountadmin.vendor-request-order.delete')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendor-request-order/view/{id}', 'Accountadmin\VendorOrderRequestOrderController@show')->name('accountadmin.vendor-request-order.view')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendor-request-order/back', 'Accountadmin\VendorOrderRequestOrderController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendor-request-order/add', 'Accountadmin\VendorOrderRequestOrderController@create')->name('accountadmin.vendor-request-order.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/vendor-request-order/submit', 'Accountadmin\VendorOrderRequestOrderController@store')->name('accountadmin.vendor-request-order.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendor-request-order/edit/{id}', 'Accountadmin\VendorOrderRequestOrderController@edit')->name('accountadmin.vendor-request-order.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/vendor-request-order/update', 'Accountadmin\VendorOrderRequestOrderController@update')->name('accountadmin.vendor-request-order.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendor-request-order/delete/{id}', 'Accountadmin\VendorOrderRequestOrderController@delete')->name('accountadmin.vendor-request-order.delete')->middleware(['auth', 'admin']);


Route::get('/accountadmin/vendor-request-order-status/back', 'Accountadmin\VendorOrderRequestStatusController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendor-request-order-status', 'Accountadmin\VendorOrderRequestStatusController@index')->name('accountadmin.vendor-request-order-status.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendor-request-order-status/add', 'Accountadmin\VendorOrderRequestStatusController@create')->name('accountadmin.vendor-request-order-status.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/vendor-request-order-status/submit', 'Accountadmin\VendorOrderRequestStatusController@store')->name('accountadmin.vendor-request-order-status.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendor-request-order-status/edit/{id}', 'Accountadmin\VendorOrderRequestStatusController@edit')->name('accountadmin.vendor-request-order-status.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/vendor-request-order-status/update', 'Accountadmin\VendorOrderRequestStatusController@store')->name('accountadmin.vendor-request-order-status.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendor-request-order-statuss/delete/{id}', 'Accountadmin\VendorOrderRequestStatusController@delete')->name('accountadmin.vendor-request-order-status.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/products/back', 'Accountadmin\ProductController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/products', 'Accountadmin\ProductController@index')->name('admin.products.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/products/image/delete/{id}', 'Accountadmin\ProductController@productImageDelete')->name('accountadmin.products.image.delete')->middleware(['auth', 'admin']);
Route::get('/accountadmin/products/add', 'Accountadmin\ProductController@create')->name('accountadmin.products.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/products/submit', 'Accountadmin\ProductController@store')->name('accountadmin.products.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/products/edit/{id}', 'Accountadmin\ProductController@edit')->name('accountadmin.products.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/products/update', 'Accountadmin\ProductController@store')->name('accountadmin.products.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/products/delete/{id}', 'Accountadmin\ProductController@delete')->name('accountadmin.products.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/acknowledgments/back', 'Accountadmin\AcknowledgmentController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/acknowledgments', 'Accountadmin\AcknowledgmentController@index')->name('admin.acknowledgments.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/acknowledgments/add', 'Accountadmin\AcknowledgmentController@create')->name('accountadmin.acknowledgments.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/acknowledgments/submit', 'Accountadmin\AcknowledgmentController@store')->name('accountadmin.acknowledgments.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/acknowledgments/edit/{id}', 'Accountadmin\AcknowledgmentController@edit')->name('accountadmin.acknowledgments.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/acknowledgments/update', 'Accountadmin\AcknowledgmentController@store')->name('accountadmin.acknowledgments.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/acknowledgments/delete/{id}', 'Accountadmin\AcknowledgmentController@delete')->name('accountadmin.acknowledgments.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/pages/back', 'Accountadmin\PageController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/pages', 'Accountadmin\PageController@index')->name('accountadmin.pages.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/pages/add', 'Accountadmin\PageController@create')->name('accountadmin.pages.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/pages/submit', 'Accountadmin\PageController@store')->name('accountadmin.pages.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/pages/edit/{id}', 'Accountadmin\PageController@edit')->name('accountadmin.pages.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/pages/update', 'Accountadmin\PageController@store')->name('accountadmin.pages.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/pages/delete/{id}', 'Accountadmin\PageController@delete')->name('accountadmin.pages.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/floral-arrangements/back', 'Accountadmin\FloralArrangementController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/floral-arrangements', 'Accountadmin\FloralArrangementController@index')->name('admin.floral-arrangements.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/floral-arrangements/add', 'Accountadmin\FloralArrangementController@create')->name('accountadmin.floral-arrangements.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/floral-arrangements/submit', 'Accountadmin\FloralArrangementController@store')->name('accountadmin.floral-arrangements.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/floral-arrangements/edit/{id}', 'Accountadmin\FloralArrangementController@edit')->name('accountadmin.floral-arrangements.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/floral-arrangements/update', 'Accountadmin\FloralArrangementController@store')->name('accountadmin.floral-arrangements.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/floral-arrangements/delete/{id}', 'Accountadmin\FloralArrangementController@delete')->name('accountadmin.floral-arrangements.delete')->middleware(['auth', 'admin']);
Route::get('/accountadmin/floral-arrangements/subcategory', 'Accountadmin\FloralArrangementController@get_by_subcategory')->name('accountadmin.floral-arrangements.get_by_subcategory')->middleware(['auth', 'admin']);
Route::get('/accountadmin/floral-arrangements/removefile', 'Accountadmin\FloralArrangementController@get_removefile')->name('accountadmin.floral-arrangements.get_removefile')->middleware(['auth', 'admin']);

Route::get('/accountadmin/floral-arrangement-type-prices/back', 'Accountadmin\FloralArrangementPriceController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/floral-arrangement-type-prices', 'Accountadmin\FloralArrangementPriceController@index')->name('admin.floral-arrangement-type-prices.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/floral-arrangement-type-prices/add', 'Accountadmin\FloralArrangementPriceController@create')->name('accountadmin.floral-arrangement-type-prices.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/floral-arrangement-type-prices/submit', 'Accountadmin\FloralArrangementPriceController@store')->name('accountadmin.floral-arrangement-type-prices.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/floral-arrangement-type-prices/edit/{id}', 'Accountadmin\FloralArrangementPriceController@edit')->name('accountadmin.floral-arrangement-type-prices.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/floral-arrangement-type-prices/update', 'Accountadmin\FloralArrangementPriceController@store')->name('accountadmin.floral-arrangement-type-prices.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/floral-arrangement-type-prices/delete/{id}', 'Accountadmin\FloralArrangementPriceController@delete')->name('accountadmin.floral-arrangement-type-prices.delete')->middleware(['auth', 'admin']);


Route::get('/accountadmin/email-account/back', 'Accountadmin\EmailAccountController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/email-account', 'Accountadmin\EmailAccountController@index')->name('admin.email-account.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/email-account/add', 'Accountadmin\EmailAccountController@create')->name('accountadmin.email-account.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/email-account/submit', 'Accountadmin\EmailAccountController@store')->name('accountadmin.email-account.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/email-account/edit/{id}', 'Accountadmin\EmailAccountController@edit')->name('accountadmin.email-account.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/email-account/update', 'Accountadmin\EmailAccountController@store')->name('accountadmin.email-account.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/email-account/delete/{id}', 'Accountadmin\EmailAccountController@delete')->name('accountadmin.email-account.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/email-template/back', 'Accountadmin\EmailTemplateController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/email-template', 'Accountadmin\EmailTemplateController@index')->name('admin.email-template.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/email-template/add', 'Accountadmin\EmailTemplateController@create')->name('accountadmin.email-template.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/email-template/submit', 'Accountadmin\EmailTemplateController@store')->name('accountadmin.email-template.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/email-template/edit/{id}', 'Accountadmin\EmailTemplateController@edit')->name('accountadmin.email-template.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/email-template/update', 'Accountadmin\EmailTemplateController@store')->name('accountadmin.email-template.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/email-template/delete/{id}', 'Accountadmin\EmailTemplateController@delete')->name('accountadmin.email-template.delete')->middleware(['auth', 'admin']);


Route::get('/accountadmin/text-account/back', 'Accountadmin\TextAccountController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/text-account', 'Accountadmin\TextAccountController@index')->name('admin.text-account.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/text-account/add', 'Accountadmin\TextAccountController@create')->name('accountadmin.text-account.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/text-account/submit', 'Accountadmin\TextAccountController@store')->name('accountadmin.text-account.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/text-account/edit/{id}', 'Accountadmin\TextAccountController@edit')->name('accountadmin.text-account.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/text-account/update', 'Accountadmin\TextAccountController@store')->name('accountadmin.text-account.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/text-account/delete/{id}', 'Accountadmin\TextAccountController@delete')->name('accountadmin.text-account.delete')->middleware(['auth', 'admin']);


Route::get('/accountadmin/text-template/back', 'Accountadmin\TextTemplateController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/text-template', 'Accountadmin\TextTemplateController@index')->name('admin.text-template.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/text-template/add', 'Accountadmin\TextTemplateController@create')->name('accountadmin.text-template.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/text-template/submit', 'Accountadmin\TextTemplateController@store')->name('accountadmin.text-template.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/text-template/edit/{id}', 'Accountadmin\TextTemplateController@edit')->name('accountadmin.text-template.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/text-template/update', 'Accountadmin\TextTemplateController@store')->name('accountadmin.text-template.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/text-template/delete/{id}', 'Accountadmin\TextTemplateController@delete')->name('accountadmin.text-template.delete')->middleware(['auth', 'admin']);


Route::get('/accountadmin/users/back', 'Accountadmin\UserController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/users', 'Accountadmin\UserController@index')->name('adminusers.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/users/edit/{id}', 'Accountadmin\UserController@edit')->name('accountadmin.users.edit')->middleware(['auth', 'admin']);
Route::get('/accountadmin/users/create', 'Accountadmin\UserController@create')->name('accountadmin.users.create')->middleware(['auth', 'admin']);
Route::post('/accountadmin/users/submit', 'Accountadmin\UserController@store')->name('accountadmin.users.store')->middleware(['auth', 'admin']);
Route::post('/accountadmin/users/edit/submit', 'Accountadmin\UserController@update')->name('accountadmin.users.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/users/delete/{id}', 'Accountadmin\UserController@delete')->name('accountadmin.users.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/users/reset-password/{id}', 'Accountadmin\UserController@getReset')->name('accountadmin.users.reset')->middleware(['auth', 'admin']);
Route::post('/accountadmin/users/reset-password/submit', 'Accountadmin\UserController@resetSubmit')->middleware(['auth', 'admin']);

Route::get('/accountadmin/account/users/profile', 'Accountadmin\UserController@profile')->middleware(['auth', 'admin']);
Route::get('/accountadmin/account/users/profile/reset/{id}', 'Accountadmin\UserController@getReset')->middleware(['auth', 'admin']);
Route::post('/accountadmin/account/users/profile/update', 'Accountadmin\UserController@updateProfile')->middleware(['auth', 'admin']);

Route::get('/accountadmin/locations/back', 'Accountadmin\LocationController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/locations', 'Accountadmin\LocationController@index')->name('accountadmin.locations.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/locations/add', 'Accountadmin\LocationController@create')->name('accountadmin.locations.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/locations/submit', 'Accountadmin\LocationController@store')->name('accountadmin.locations.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/locations/edit/{id}', 'Accountadmin\LocationController@edit')->name('accountadmin.locations.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/locations/update', 'Accountadmin\LocationController@store')->name('accountadmin.locations.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/locations/delete/{id}', 'Accountadmin\LocationController@delete')->name('accountadmin.locations.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/product-sub-category/back', 'Accountadmin\ProductSubCategoryController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/product-sub-category', 'Accountadmin\ProductSubCategoryController@index')->name('accountadmin.product-sub-category.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/product-sub-category/add', 'Accountadmin\ProductSubCategoryController@create')->name('accountadmin.product-sub-category.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/product-sub-category/submit', 'Accountadmin\ProductSubCategoryController@store')->name('accountadmin.product-sub-category.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/product-sub-category/edit/{id}', 'Accountadmin\ProductSubCategoryController@edit')->name('accountadmin.product-sub-category.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/product-sub-category/update', 'Accountadmin\ProductSubCategoryController@store')->name('accountadmin.product-sub-category.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/product-sub-category/delete/{id}', 'Accountadmin\ProductSubCategoryController@delete')->name('accountadmin.product-sub-category.delete')->middleware(['auth', 'admin']);


Route::get('/accountadmin/vase-colors/back', 'Accountadmin\VaseColorController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vase-colors', 'Accountadmin\VaseColorController@index')->name('accountadmin.vase-colors.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vase-colors/add', 'Accountadmin\VaseColorController@create')->name('accountadmin.vase-colors.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/vase-colors/submit', 'Accountadmin\VaseColorController@store')->name('accountadmin.vase-colors.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vase-colors/edit/{id}', 'Accountadmin\VaseColorController@edit')->name('accountadmin.vase-colors.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/vase-colors/update', 'Accountadmin\VaseColorController@store')->name('accountadmin.vase-colors.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vase-colors/delete/{id}', 'Accountadmin\VaseColorController@delete')->name('accountadmin.vase-colors.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/arrangement-type/back', 'Accountadmin\ArrangementTypeController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/arrangement-type', 'Accountadmin\ArrangementTypeController@index')->name('accountadmin.arrangement-type.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/arrangement-type/add', 'Accountadmin\ArrangementTypeController@create')->name('accountadmin.arrangement-type.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/arrangement-type/submit', 'Accountadmin\ArrangementTypeController@store')->name('accountadmin.arrangement-type.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/arrangement-type/edit/{id}', 'Accountadmin\ArrangementTypeController@edit')->name('accountadmin.arrangement-type.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/arrangement-type/update', 'Accountadmin\ArrangementTypeController@store')->name('accountadmin.arrangement-type.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/arrangement-type/delete/{id}', 'Accountadmin\ArrangementTypeController@delete')->name('accountadmin.arrangement-type.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/suggested-note/back', 'Accountadmin\SuggestedNoteController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/suggested-note', 'Accountadmin\SuggestedNoteController@index')->name('accountadmin.suggested-note.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/suggested-note/add', 'Accountadmin\SuggestedNoteController@create')->name('accountadmin.suggested-note.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/suggested-note/submit', 'Accountadmin\SuggestedNoteController@store')->name('accountadmin.suggested-note.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/suggested-note/edit/{id}', 'Accountadmin\SuggestedNoteController@edit')->name('accountadmin.suggested-note.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/suggested-note/update', 'Accountadmin\SuggestedNoteController@store')->name('accountadmin.suggested-note.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/suggested-note/delete/{id}', 'Accountadmin\SuggestedNoteController@delete')->name('accountadmin.suggested-note.delete')->middleware(['auth', 'admin']);


Route::get('/accountadmin/products-categories/back', 'Accountadmin\ProductCategoryController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/products-categories', 'Accountadmin\ProductCategoryController@index')->name('accountadmin.products-categories.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/products-categories/add', 'Accountadmin\ProductCategoryController@create')->name('accountadmin.products-categories.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/products-categories/submit', 'Accountadmin\ProductCategoryController@store')->name('accountadmin.products-categories.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/products-categories/edit/{id}', 'Accountadmin\ProductCategoryController@edit')->name('accountadmin.products-categories.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/products-categories/update', 'Accountadmin\ProductCategoryController@store')->name('accountadmin.products-categories.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/products-categories/delete/{id}', 'Accountadmin\ProductCategoryController@delete')->name('accountadmin.products-categories.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/vendors/back', 'Accountadmin\VendorController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendors', 'Accountadmin\VendorController@index')->name('accountadmin.vendors.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendors/add', 'Accountadmin\VendorController@create')->name('accountadmin.vendors.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/vendors/submit', 'Accountadmin\VendorController@store')->name('accountadmin.vendors.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendors/edit/{id}', 'Accountadmin\VendorController@edit')->name('accountadmin.vendors.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/vendors/update', 'Accountadmin\VendorController@update')->name('accountadmin.vendors.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendors/delete/{id}', 'Accountadmin\VendorController@delete')->name('accountadmin.vendors.delete')->middleware(['auth', 'admin']);

Route::post('/accountadmin/vendors/comments/store', 'Accountadmin\VendorController@commentStore')->name('accountadmin.comments.vendors.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendors/comments/edit/{id}', 'Accountadmin\VendorController@commentEdit')->name('accountadmin.comments.vendors.edit')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendors/comments/delete/{id}', 'Accountadmin\VendorController@commentDelete')->name('accountadmin.comments.vendors.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/vendors/contacts/add/{id}', 'Accountadmin\VendorContactController@index')->name('accountadmin.vendors.contacts.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/vendors/contacts/submit', 'Accountadmin\VendorContactController@store')->name('accountadmin.vendors.contacts.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendors/contacts/edit/{id}', 'Accountadmin\VendorContactController@edit')->name('accountadmin.vendors.contacts.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/vendors/contacts/update', 'Accountadmin\VendorContactController@update')->name('accountadmin.vendors.contacts.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendors/contacts/delete/{id}', 'Accountadmin\VendorContactController@delete')->name('accountadmin.vendors.contacts.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/vendor-type/back', 'Accountadmin\VendortypeController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendor-type', 'Accountadmin\VendortypeController@index')->name('accountadmin.vendor-type.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendor-type/add', 'Accountadmin\VendortypeController@create')->name('accountadmin.vendor-type.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/vendor-type/submit', 'Accountadmin\VendortypeController@store')->name('accountadmin.vendor-type.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendor-type/edit/{id}', 'Accountadmin\VendortypeController@edit')->name('accountadmin.vendor-type.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/vendor-type/update', 'Accountadmin\VendortypeController@store')->name('accountadmin.vendor-type.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vendor-type/delete/{id}', 'Accountadmin\VendortypeController@delete')->name('accountadmin.vendor-type.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/flowers/back', 'Accountadmin\FlowerController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/flowers', 'Accountadmin\FlowerController@index')->name('accountadmin.flowers.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/flowers/add', 'Accountadmin\FlowerController@create')->name('accountadmin.flowers.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/flowers/submit', 'Accountadmin\FlowerController@store')->name('accountadmin.flowers.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/flowers/edit/{id}', 'Accountadmin\FlowerController@edit')->name('accountadmin.flowers.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/flowers/update', 'Accountadmin\FlowerController@store')->name('accountadmin.flowers.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/flowers/delete/{id}', 'Accountadmin\FlowerController@delete')->name('accountadmin.flowers.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/location-types/calendars/{id?}', 'Accountadmin\LocationTypeController@calendar')->name('accountadmin.location-types.calendar')->middleware(['auth', 'admin']);
Route::post('/accountadmin/location-types/calendar/add', 'Accountadmin\LocationTypeController@calendar_add')->name('accountadmin.location-types.calendar_add')->middleware(['auth', 'admin']);

Route::get('/accountadmin/customer-location-types/back', 'Accountadmin\CustomerLocationTypeController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/customer-location-types', 'Accountadmin\CustomerLocationTypeController@index')->name('accountadmin.customer-location-types.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/customer-location-types/add', 'Accountadmin\CustomerLocationTypeController@create')->name('accountadmin.customer-location-types.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/customer-location-types/submit', 'Accountadmin\CustomerLocationTypeController@store')->name('accountadmin.customer-location-types.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/customer-location-types/edit/{id}', 'Accountadmin\CustomerLocationTypeController@edit')->name('accountadmin.customer-location-types.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/customer-location-types/update', 'Accountadmin\CustomerLocationTypeController@store')->name('accountadmin.customer-location-types.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/customer-location-types/delete/{id}', 'Accountadmin\CustomerLocationTypeController@delete')->name('accountadmin.customer-location-types.delete')->middleware(['auth', 'admin']);


Route::get('/accountadmin/event-type/back', 'Accountadmin\EventTypeController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/event-type', 'Accountadmin\EventTypeController@index')->name('accountadmin.event-type.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/event-type/add', 'Accountadmin\EventTypeController@create')->name('accountadmin.event-type.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/event-type/submit', 'Accountadmin\EventTypeController@store')->name('accountadmin.event-type.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/event-type/edit/{id}', 'Accountadmin\EventTypeController@edit')->name('accountadmin.event-type.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/event-type/update', 'Accountadmin\EventTypeController@store')->name('accountadmin.event-type.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/event-type/delete/{id}', 'Accountadmin\EventTypeController@delete')->name('accountadmin.event-type.delete')->middleware(['auth', 'admin']);


Route::get('/accountadmin/styles/back', 'Accountadmin\StyleController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/styles', 'Accountadmin\StyleController@index')->name('accountadmin.style.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/styles/add', 'Accountadmin\StyleController@create')->name('accountadmin.style.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/styles/submit', 'Accountadmin\StyleController@store')->name('accountadmin.style.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/styles/edit/{id}', 'Accountadmin\StyleController@edit')->name('accountadmin.style.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/styles/update', 'Accountadmin\StyleController@store')->name('accountadmin.style.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/styles/delete/{id}', 'Accountadmin\StyleController@delete')->name('accountadmin.style.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/size-arrangement/back', 'Accountadmin\SizeArrangementController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/size-arrangement', 'Accountadmin\SizeArrangementController@index')->name('accountadmin.size-arrangement.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/size-arrangement/add', 'Accountadmin\SizeArrangementController@create')->name('accountadmin.size-arrangement.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/size-arrangement/submit', 'Accountadmin\SizeArrangementController@store')->name('accountadmin.size-arrangement.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/size-arrangement/edit/{id}', 'Accountadmin\SizeArrangementController@edit')->name('accountadmin.size-arrangement.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/size-arrangement/update', 'Accountadmin\SizeArrangementController@store')->name('accountadmin.size-arrangement.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/size-arrangement/delete/{id}', 'Accountadmin\SizeArrangementController@delete')->name('accountadmin.size-arrangement.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/color-flowers/back', 'Accountadmin\ColorFlowerController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/color-flowers', 'Accountadmin\ColorFlowerController@index')->name('accountadmin.color-flowers.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/color-flowers/add', 'Accountadmin\ColorFlowerController@create')->name('accountadmin.color-flowers.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/color-flowers/submit', 'Accountadmin\ColorFlowerController@store')->name('accountadmin.color-flowers.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/color-flowers/edit/{id}', 'Accountadmin\ColorFlowerController@edit')->name('accountadmin.color-flowers.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/color-flowers/update', 'Accountadmin\ColorFlowerController@store')->name('accountadmin.color-flowers.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/color-flowers/delete/{id}', 'Accountadmin\ColorFlowerController@delete')->name('accountadmin.color-flowers.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/vase-types/back', 'Accountadmin\VasetypeController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vase-types', 'Accountadmin\VasetypeController@index')->name('accountadmin.vase-types.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vase-types/add', 'Accountadmin\VasetypeController@create')->name('accountadmin.vase-types.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/vase-types/submit', 'Accountadmin\VasetypeController@store')->name('accountadmin.vase-types.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vase-types/edit/{id}', 'Accountadmin\VasetypeController@edit')->name('accountadmin.vase-types.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/vase-types/update', 'Accountadmin\VasetypeController@store')->name('accountadmin.vase-types.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/vase-types/delete/{id}', 'Accountadmin\VasetypeController@delete')->name('accountadmin.vase-types.delete')->middleware(['auth', 'admin']);


Route::get('/accountadmin/customer-type', 'Accountadmin\CustomertypeController@index')->name('accountadmin.customer-type.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/customer-type/add', 'Accountadmin\CustomertypeController@create')->name('accountadmin.customer-type.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/customer-type/submit', 'Accountadmin\CustomertypeController@store')->name('accountadmin.customer-type.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/customer-type/edit/{id}', 'Accountadmin\CustomertypeController@edit')->name('accountadmin.customer-type.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/customer-type/update', 'Accountadmin\CustomertypeController@store')->name('accountadmin.customer-type.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/customer-type/delete/{id}', 'Accountadmin\CustomertypeController@delete')->name('accountadmin.customer-type.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/customers/back', 'Accountadmin\CustomerController@back')->name('accountadmin.customers.back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/customers/long', 'Accountadmin\CustomerController@location')->name('accountadmin.customers.location')->middleware(['auth', 'admin']);
Route::get('/accountadmin/customers', 'Accountadmin\CustomerController@index')->name('accountadmin.customers.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/customers/add', 'Accountadmin\CustomerController@create')->name('accountadmin.customers.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/customers/submit', 'Accountadmin\CustomerController@store')->name('accountadmin.customers.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/customers/edit/{id}', 'Accountadmin\CustomerController@edit')->name('accountadmin.customers.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/customers/update', 'Accountadmin\CustomerController@update')->name('accountadmin.customers.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/customers/delete/{id}', 'Accountadmin\CustomerController@delete')->name('accountadmin.customers.delete')->middleware(['auth', 'admin']);

Route::any('/accountadmin/customers/address/add/{id}', 'Accountadmin\CustomerController@address_add')->name('accountadmin.customers.address_add')->middleware(['auth', 'admin']);
Route::any('/accountadmin/customers/address/edit/{id}', 'Accountadmin\CustomerController@address_edit')->name('accountadmin.customers.address_edit')->middleware(['auth', 'admin']);
Route::any('/accountadmin/customers/address/delete/{id}', 'Accountadmin\CustomerController@address_delete')->name('accountadmin.customers.address_delete')->middleware(['auth', 'admin']);

Route::post('/accountadmin/customers/comments/store', 'Accountadmin\CustomerController@commentStore')->name('accountadmin.comments.customers.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/customers/comments/customers/{customerid}/edit/{id}', 'Accountadmin\CustomerController@commentEdit')->name('accountadmin.comments.customers.edit')->middleware(['auth', 'admin']);
Route::get('/accountadmin/customers/comments/delete/{id}', 'Accountadmin\CustomerController@commentDelete')->name('accountadmin.comments.customers.delete')->middleware(['auth', 'admin']);

Route::get('/accountadmin/department/back', 'Accountadmin\DepartmentController@back')->middleware(['auth', 'admin']);
Route::get('/accountadmin/department', 'Accountadmin\DepartmentController@index')->name('accountadmin.department.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/department/add', 'Accountadmin\DepartmentController@create')->name('accountadmin.department.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/department/submit', 'Accountadmin\DepartmentController@store')->name('accountadmin.department.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/department/edit/{id}', 'Accountadmin\DepartmentController@edit')->name('accountadmin.department.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/department/update', 'Accountadmin\DepartmentController@store')->name('accountadmin.department.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/department/delete/{id}', 'Accountadmin\DepartmentController@delete')->name('accountadmin.department.delete')->middleware(['auth', 'admin']);


Route::get('/accountadmin/customers/contacts/add/{id}', 'Accountadmin\CustomerContactController@index')->name('accountadmin.customers.contacts.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/customers/contacts/submit', 'Accountadmin\CustomerContactController@store')->name('accountadmin.customers.contacts.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/customers/contacts/edit/{id}', 'Accountadmin\CustomerContactController@edit')->name('accountadmin.customers.contacts.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/customers/contacts/update', 'Accountadmin\CustomerContactController@update')->name('accountadmin.customers.contacts.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/customers/contacts/delete/{id}', 'Accountadmin\CustomerContactController@delete')->name('accountadmin.customers.contacts.delete')->middleware(['auth', 'admin']);
Route::post('/accountadmin/orders/filter', 'Accountadmin\OrderController@filter')->name('accountadmin.payment.index.filter');
Route::get('/accountadmin/orders/{id}', 'Accountadmin\OrderController@detail')->middleware(['auth', 'admin']);
Route::get('/accountadmin/orders/cancel/{id}', 'Accountadmin\OrderController@cancelOrder')->middleware(['auth', 'admin']);

Route::get('/accountadmin/customer-business/add', 'Accountadmin\CustomerController@businessIndex')->name('accountadmin.customers.business.index')->middleware(['auth', 'admin']);
Route::post('/accountadmin/customer-business/submit', 'Accountadmin\CustomerController@businessStore')->name('accountadmin.customers.contacts.store')->middleware(['auth', 'admin']);
Route::post('/accountadmin/customer-business/update', 'Accountadmin\CustomerController@businessUpdate')->name('accountadmin.customers.contacts.update')->middleware(['auth', 'admin']);


Route::get('/accountadmin/delivery-charges', 'Accountadmin\DeliveryController@index')->name('admin.deliverycharges.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/delivery-charges/add', 'Accountadmin\DeliveryController@create')->name('accountadmin.deliverycharges.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/delivery-charges/submit', 'Accountadmin\DeliveryController@store')->name('accountadmin.deliverycharges.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/delivery-charges/edit/{id}', 'Accountadmin\DeliveryController@edit')->name('accountadmin.deliverycharges.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/delivery-charges/update', 'Accountadmin\DeliveryController@store')->name('accountadmin.deliverycharges.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/delivery-charges/delete/{id}', 'Accountadmin\DeliveryController@delete')->name('accountadmin.deliverycharges.delete')->middleware(['auth', 'admin']);


Route::get('/accountadmin/coupons', 'Accountadmin\CouponController@index')->name('admin.coupons.index')->middleware(['auth', 'admin']);
Route::get('/accountadmin/coupons/add', 'Accountadmin\CouponController@create')->name('accountadmin.coupons.add')->middleware(['auth', 'admin']);
Route::post('/accountadmin/coupons/submit', 'Accountadmin\CouponController@store')->name('accountadmin.coupons.store')->middleware(['auth', 'admin']);
Route::get('/accountadmin/coupons/edit/{id}', 'Accountadmin\CouponController@edit')->name('accountadmin.coupons.edit')->middleware(['auth', 'admin']);
Route::post('/accountadmin/coupons/update', 'Accountadmin\CouponController@store')->name('accountadmin.coupons.update')->middleware(['auth', 'admin']);
Route::get('/accountadmin/coupons/delete/{id}', 'Accountadmin\CouponController@delete')->name('accountadmin.coupons.delete')->middleware(['auth', 'admin']);


Route::get('/accountadmin/customers/export', 'Accountadmin\CustomerController@export')->name('accountadmin.customers.contacts.delete')->middleware(['auth', 'admin']);


Route::get('/accountadmin/setup', function () {
    return view('common.setup');
})->middleware(['auth', 'admin']);


Route::group([
    'namespace'  => 'Accountadmin',
    'prefix'     => 'accountadmin',
    'as'         => 'accountadmin.',
    'middleware' => ['auth', 'admin']
], function () {
    Route::resource('sale-types', 'SaleTypesController')->except('show');

    Route::get('sales/floral-arrangement', 'SalesController@floralArrangement')
        ->name('sales.floral-arrangement');
    Route::post('sales/category/products', 'SalesController@productByCategory')
        ->name('sales.product-by-category');
    Route::post('sales/floral-arrangement/add-to-cart', 'SalesController@floralArrangmentAddToCart')
        ->name('sales.floral-arrangement.add-to-cart');
    Route::post('sales/floral-arrangement/remove-from-cart', 'SalesController@removeCartItem')
        ->name('sales.floral-arrangement.remove-from-cart');
    Route::post('sales/floral-arrangement/update-cart-item', 'SalesController@updateCartItem')
        ->name('sales.floral-arrangement.update-cart-item');
    Route::get('sales/checkout', 'SalesController@checkout')->name('sales.checkout');
    Route::get('sales/floral-arrangement/category/{category}', 'SalesController@floralArrangementByCategory')->name('sales.floral-arrangement-by-category');
    Route::get('sales/floral-arrangement-details/{id}', 'SalesController@floralArrangementDetails')
        ->name('sales.floral-arrangement-details');
    Route::get('sales/select2-orders', 'SalesController@select2Orders')->name('sales.select2-orders');
    Route::get('sales/select2-customers', 'SalesController@select2Customers')->name('sales.select2-customers');
    Route::post('sales/store-from-order', 'SalesController@storeSaleFromOrder')->name('sales.store-from-order');

    Route::get('sales/product/{id}', 'SalesController@productDetails')
        ->name('sales.productDetails');

    Route::post('sales/product/add-to-cart', 'SalesController@productAddToCart')
        ->name('sales.productAddToCart');

    Route::resource('sales', 'SalesController');
});
