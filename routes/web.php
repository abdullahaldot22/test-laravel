<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\orderController;
use App\Http\Controllers\CouponController;
use App\HTTP\Controllers\productcontroller;
use App\HTTP\Controllers\CategoryController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\orderAdminController;
use App\HTTP\Controllers\subcategorycontroller;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\customerProfileController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\SslCommerzPaymentController;

Auth::routes();



// Frontend User Customer -----------------------------
// Frontend User Customer -----------------------------
// clearnet  -------------- frontend
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/welcome', [FrontendController::class, 'welcome'])->name('welcome');


// root frontend
Route::get('/', [FrontendController::class, 'home'])->name('customer.home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/product/details/{slug}', [FrontendController::class, 'product_details'])->name('product.details');
Route::get('/login/user', [customerController::class, 'login_page'])->name('user.login.page');
Route::get('/user/cart/', [customerController::class, 'cart_page'])->name('cart.page')->middleware('customerlogin');
Route::get('/user/checkout/', [customerController::class, 'checkout_page'])->name('checkout.page')->middleware('customerlogin');
Route::get('/user/profile/', [customerController::class, 'customer_profile_page'])->name('customer.profile')->middleware('customerlogin');
Route::get('/user/my_order/', [customerController::class, 'customer_order_page'])->name('customer.myorder')->middleware('customerlogin');
Route::get('/success', [customerController::class, 'customer_order_success'])->name('success')->middleware('customerlogin');
Route::get('/error', [customerController::class, 'error_page'])->name('error')->middleware('customerlogin');

// ------------------ frontend process
Route::post('/getSize', [FrontendController::class, 'getSize']);
Route::post('/getavQuantity', [FrontendController::class, 'getavQuantity']);
Route::post('/getState', [checkoutController::class, 'getState']);
Route::post('/getCity', [checkoutController::class, 'getCity']);

// log in
Route::post('/store/register/customer', [CustomerRegisterController::class, 'user_register'])->name('customer.register.store');
Route::post('/store/login/customer', [CustomerLoginController::class, 'user_login'])->name('customer.login');
Route::get('/store/logout/customer', [CustomerLoginController::class, 'user_logout'])->name('customer.logout');

// cart----------------
Route::post('/store/cart', [CartController::class, 'store_cart'])->name('store.cart');
Route::get('/store/remove/cart/{cart_id}', [CartController::class, 'cart_remove'])->name('cart.remove')->middleware('customerlogin');
Route::post('/store/update/cart', [CartController::class, 'cart_update'])->name('cart.product.update');

// wish -----------------------------
Route::post('/store/wishlist', [WishListController::class, 'store_wish'])->name('store.wishlist');
Route::get('/store/remove/wishitm/{cart_id}', [WishListController::class, 'wishitm_remove'])->name('wishitm.remove');

// checkout ------------------------------
Route::post('/order/store', [checkoutController::class, 'order_store'])->name('order.store')->middleware('customerlogin');

// customer_profile_update --------------------------
Route::post('/user/profile/update', [customerProfileController::class, 'customer_profile_update'])->name('customer.profile.update');



// mail check ----------------------------------------------

Route::get('/invoice', [FrontendController::class, 'invoice_check'])->name('invoice.check');


// stripe ---------------------------------------------------
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe')->name('stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});
// stripe ---------------------------------------------------



// user [ ADMIN ] ===============================================================================================================================
// user [ ADMIN ] =====================

Route::get('/users', [usercontroller::class, 'users'])->name('users')->middleware('auth');
Route::get('/users/delete/{user_id}', [usercontroller::class, 'user_delete'])->name('user.delete')->middleware('auth');

// profile ===========
Route::get('/profile', [usercontroller::class, 'profile'])->name('profile')->middleware('auth');
Route::get('/profile/update/edit', [usercontroller::class, 'profile_update_edit'])->name('profile.update.edit')->middleware('auth');
Route::post('/profile_image/update', [usercontroller::class, 'image_update'])->name('image.update');
Route::post('/profile/update', [usercontroller::class, 'profile_update'])->name('profile.update');
Route::post('/password/update', [usercontroller::class, 'password_update'])->name('password.update');

// category
Route::get('/category', [CategoryController::class, 'category'])->name('category')->middleware('auth');
Route::post('/category/add', [CategoryController::class, 'category_add'])->name('category.add');
Route::get('/category/delete/{cat_id}', [CategoryController::class, 'cat_sdel'])->name('cat.s.del');
Route::get('/category/restore/{cat_id}', [CategoryController::class, 'cat_rstr'])->name('cat.restore');
Route::get('/category/force/delete/{cat_id}', [CategoryController::class, 'cat_fdel'])->name('cat.f.del');
Route::get('/category/edit/{cat_id}', [CategoryController::class, 'cat_edit'])->name('cat.edit');
Route::post('/category/update', [CategoryController::class, 'cat_update'])->name('cat.update');

// subcategory
Route::get('/subcategory', [subcategorycontroller::class, 'subcat'])->name('subcategory')->middleware('auth');
Route::post('/subcategory/add', [subcategorycontroller::class, 'scat_add'])->name('scat.add');
Route::get('/subcategory/restore/{scat_id}', [subcategorycontroller::class, 'scat_rstr'])->name('scat.restr');
Route::get('/subcategory/soft_delete/{scat_id}', [subcategorycontroller::class, 'scat_sdel'])->name('scat.sdel');
Route::get('/subcategory/force_delete/{scat_id}', [subcategorycontroller::class, 'scat_fdel'])->name('scat.fdel');
Route::get('/subcategory/edit/{scat_id}', [subcategorycontroller::class, 'scat_edit'])->name('scat.edit');
Route::post('/subcategory/update/', [subcategorycontroller::class, 'scat_update'])->name('scat.update');

// product
Route::get('/product', [productcontroller::class, 'product'])->name('product')->middleware('auth');
Route::get('/product/coupon', [CouponController::class, 'product_coupon'])->name('event.coupon')->middleware('auth');
Route::post('/product/coupon/add', [CouponController::class, 'coupon_add'])->name('coupon.add')->middleware('auth');
Route::post('/getscat', [productcontroller::class, 'getscat']);
Route::post('/product/store', [productcontroller::class, 'product_store'])->name('product.store')->middleware('auth');
Route::get('/product/list', [productcontroller::class, 'product_list'])->name('product.list')->middleware('auth');
Route::get('/product/s/inventory/{pro_id}', [productcontroller::class, 'product_inventory'])->name('product.inventory');
Route::post('/product/s/inventory/add', [productcontroller::class, 'inventory_add'])->name('inventory.add');
Route::get('/product/variation', [productcontroller::class, 'product_variation'])->name('product.variation')->middleware('auth');
Route::post('/product/variation/color/store', [productcontroller::class, 'color_store'])->name('color.store');
Route::post('/product/variation/size/store', [productcontroller::class, 'size_store'])->name('size.store');
Route::get('/product/delete/{pro_id}', [productcontroller::class, 'product_delete'])->name('product.delete');

// order --------------------------------------------------------
Route::get('/customer/order_control', [orderAdminController::class, 'order_controller_page'])->name('customer.order');
Route::post('/customer/order/status/update/', [orderAdminController::class, 'order_status_update'])->name('order.status.update');


// SSLCOMMERZ Start
// Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
// Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::get('/pay', [SslCommerzPaymentController::class, 'index']);
Route::get('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax'])->name('pay.card')->middleware('customerlogin');

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

