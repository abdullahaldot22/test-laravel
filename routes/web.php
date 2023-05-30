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
<<<<<<< HEAD
=======
use App\Http\Controllers\Controller;
>>>>>>> main
use App\Http\Controllers\customerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\orderAdminController;
use App\HTTP\Controllers\subcategorycontroller;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\customerProfileController;
use App\Http\Controllers\CustomerRegisterController;
<<<<<<< HEAD
=======
use App\Http\Controllers\faqController;
>>>>>>> main
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\superAdminRoleManagementController;

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
Route::get('/user/my_wishlist/', [customerController::class, 'customer_wish_page'])->name('customer.wishlist')->middleware('customerlogin');
Route::get('/success', [customerController::class, 'customer_order_success'])->name('success.page')->middleware('customerlogin');
Route::get('/error', [customerController::class, 'error_page'])->name('error');
Route::get('/customer/reset/password', [customerController::class, 'pass_reset_page'])->name('password.reset.page');
Route::get('/customer/reset/password/form/{token}', [customerController::class, 'pass_reset_form_page'])->name('password.reset.form.page');
Route::get('/product/search', [FrontendController::class, 'product_search'])->name('product.shop_search');


// ------------------ frontend process
Route::post('/getSize', [FrontendController::class, 'getSize']);
Route::post('/getavQuantity', [FrontendController::class, 'getavQuantity']);
Route::post('/getState', [checkoutController::class, 'getState']);
Route::post('/getCity', [checkoutController::class, 'getCity']);

<<<<<<< HEAD
=======
// dummy download =============================================================================
Route::get('/dummy/download', [Controller::class, 'dummy_download'])->name('dummy.download');

>>>>>>> main
// log in
Route::post('/store/register/customer', [CustomerRegisterController::class, 'user_register'])->name('customer.register.store');
Route::post('/store/login/customer', [CustomerLoginController::class, 'user_login'])->name('customer.login');
Route::get('/store/logout/customer', [CustomerLoginController::class, 'user_logout'])->name('customer.logout');

<<<<<<< HEAD
//Github Login
Route::get('/login/github', [CustomerRegisterController::class, 'redirectToGithub'])->name('login.github');
Route::get('/login/github/callback', [CustomerRegisterController::class, 'handleGithubCallback']);

//Google Login
Route::get('/login/google', [CustomerRegisterController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [CustomerRegisterController::class, 'handleGoogleCallback']);


//Facebook Login
Route::get('/login/facebook', [CustomerRegisterController::class, 'redirectToFacebook'])->name('login.google');
Route::get('/login/facebook/callback', [CustomerRegisterController::class, 'handleFacebookCallback']);

// Change Language --------------------------------------------------------------------------------------------------------
Route::get('lang/change', [FrontendController::class, 'change_lang'])->name('changeLang');

=======
>>>>>>> main
// cart----------------
Route::post('/store/cart', [CartController::class, 'store_cart'])->name('store.cart');
Route::get('/store/remove/cart/{cart_id}', [CartController::class, 'cart_remove'])->name('cart.remove')->middleware('customerlogin');
Route::post('/store/update/cart', [CartController::class, 'cart_update'])->name('cart.product.update');

// wish -----------------------------
Route::post('/store/wishlist', [WishListController::class, 'store_wish'])->name('store.wishlist');
Route::get('/store/remove/wishitm/{wish_id}', [WishListController::class, 'wishitm_remove'])->name('wishitm.remove');

// checkout ------------------------------
Route::post('/order/store', [checkoutController::class, 'order_store'])->name('order.store')->middleware('customerlogin');

// customer_profile_update --------------------------
Route::post('/user/profile/update', [customerProfileController::class, 'customer_profile_update'])->name('customer.profile.update');

// user review -------------------------------------------------
Route::post('/user/add/review/{product_id}', [FrontendController::class, 'add_product_review'])->name('user.review');

// password Reset -------------------------------------------------
Route::post('/cpass/reset/request', [CustomerLoginController::class, 'cpass_reset_request'])->name('customer.password.reset.request');
Route::post('/password/set', [CustomerLoginController::class, 'password_set'])->name('customer.password.set');

// customer mail verification ---------------------------------------------
Route::get('/customer/verification/email/{token}', [CustomerLoginController::class, 'customer_email_verify_page'])->name('customer.email.verification');

// mail check ----------------------------------------------

<<<<<<< HEAD
// order invoice --------------------------------------------------------------------------------------------------------------
// Route::get('/invoice', [FrontendController::class, 'invoice_check'])->name('invoice.check');
Route::get('/order/invoice/download/{order_id}', [FrontendController::class, 'order_invoice_download'])->name('order.invoice.download');
=======
// Route::get('/invoice', [FrontendController::class, 'invoice_check'])->name('invoice.check');
>>>>>>> main


// stripe ---------------------------------------------------
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe')->name('stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});
// stripe ---------------------------------------------------



// user [ ADMIN ] ===============================================================================================================================
// user [ ADMIN ] =====================

Route::get('/users', [usercontroller::class, 'users'])->name('users')->middleware('auth');
Route::post('/users/add', [usercontroller::class, 'users_add'])->name('admin.add.user');
Route::get('/users/edit_page/{usr_id}', [usercontroller::class, 'users_edit_page'])->name('admin.edit.users.page');
Route::post('admin/users/edit/info', [usercontroller::class, 'admin_users_edit_info'])->name('admin.user.edit.info');
Route::post('admin/users/edit/password', [usercontroller::class, 'admin_users_edit_password'])->name('admin.user.edit.password');
Route::post('admin/users/edit/image', [usercontroller::class, 'admin_users_edit_image'])->name('admin.user.edit.image');
Route::get('/users/delete/{user_id}', [usercontroller::class, 'user_delete'])->name('admin.user.delete')->middleware('auth');
Route::get('superAdmin/manage/admin_role', [usercontroller::class, 'superadmin_role_management_page'])->name('superadmin.role.management')->middleware('auth');
Route::get('/admin/control/customers', [usercontroller::class, 'customer_control'])->name('customer.control')->middleware('auth');

// superAdmin_Role_management ================================================
Route::post('superadmin/manage/admin/permission/add', [superAdminRoleManagementController::class, 'admin_permission_add'])->name('admin.permission.add');
Route::post('superadmin/manage/admin/role/add', [superAdminRoleManagementController::class, 'admin_role_add'])->name('admin.role.add');
Route::get('superadmin/manage/role/action/{role_id}', [superAdminRoleManagementController::class, 'superadmin_role_action'])->name('superadmin.role.action');
Route::post('superadmin/manage/role/permission/update', [superAdminRoleManagementController::class, 'superadmin_role_permission_update'])->name('admin.role.permission.update');
Route::post('superadmin/manage/role/assign_to_admin', [superAdminRoleManagementController::class, 'superadmin_role_assign'])->name('superadmin.role.assign');
Route::get('superadmin/manage/admin/role/edit/page/{admin_id}', [superAdminRoleManagementController::class, 'superadmin_admin_role_edit_page'])->name('superadmin.admin.role.edit');
Route::post('superadmin/manage/admin/role/edit', [superAdminRoleManagementController::class, 'superadmin_admin_role_action_edit'])->name('admin.role.action.edit');



// profile ===========
Route::get('/admin/profile', [usercontroller::class, 'admin_profile'])->name('admin.profile')->middleware('auth');
Route::get('/profile/update/edit', [usercontroller::class, 'profile_update_edit'])->name('profile.update.edit')->middleware('auth');
Route::post('/profile_image/update', [usercontroller::class, 'image_update'])->name('image.update');
Route::post('/profile/update', [usercontroller::class, 'profile_update'])->name('profile.update');
Route::post('/password/update', [usercontroller::class, 'password_update'])->name('password.update');
Route::get('/admin/control/customer/details/{cus_id}', [usercontroller::class, 'admin_customer_control_details'])->name('admin.customer.control.details');

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
Route::get('/product/coupon/edit/{coupon_id}', [CouponController::class, 'coupon_edit_page'])->name('coupon.edit.page')->middleware('auth');
Route::post('/product/coupon/edit/', [CouponController::class, 'coupon_edit'])->name('coupon.edit')->middleware('auth');
Route::get('/product/coupon/delete/{cpn_id}', [CouponController::class, 'coupon_delete'])->name('coupon.delete')->middleware('auth');
Route::post('/getscat', [productcontroller::class, 'getscat']);
Route::post('/product/store', [productcontroller::class, 'product_store'])->name('product.store')->middleware('auth');
Route::get('/product/list', [productcontroller::class, 'product_list'])->name('product.list')->middleware('auth');
Route::get('/product/edit/page/{pro_id}', [productcontroller::class, 'product_edit_page'])->name('product.edit.page')->middleware('auth');
Route::post('/product/edit/apply', [productcontroller::class, 'product_edit_apply'])->name('product.edit.apply')->middleware('auth');
Route::get('/product/edit/preview_&_thumbnails/{pro_id}', [productcontroller::class, 'product_edit_images_page'])->name('product.edit.images.page')->middleware('auth');
Route::post('/product/edit/thumbnails/add', [productcontroller::class, 'product_add_thumbnail'])->name('product.add.thumbnail')->middleware('auth');
Route::post('/product/edit/thumbnails/remove', [productcontroller::class, 'product_remove_thumbnail'])->name('product.remove.thumbnail')->middleware('auth');
Route::post('/product/edit/preview/update', [productcontroller::class, 'product_update_preview'])->name('product.update.preview')->middleware('auth');
Route::get('/product/s/inventory/{pro_id}', [productcontroller::class, 'product_inventory'])->name('product.inventory');
Route::post('/product/s/inventory/add', [productcontroller::class, 'inventory_add'])->name('inventory.add');
Route::get('/product/inventory/edit/{inv_id}', [productcontroller::class, 'inventory_edit_page'])->name('inventory.edit.page');
Route::post('/product/inventory/edit/apply', [productcontroller::class, 'inventory_edit'])->name('inventory.edit');
Route::get('/product/inventory/delete/{inv_id}', [productcontroller::class, 'inventory_delete'])->name('inventory.delete');
Route::get('/product/variation', [productcontroller::class, 'product_variation'])->name('product.variation')->middleware('auth');
Route::post('/product/variation/color/store', [productcontroller::class, 'color_store'])->name('color.store');
Route::post('/product/variation/size/store', [productcontroller::class, 'size_store'])->name('size.store');
Route::get('/product/delete/{pro_id}', [productcontroller::class, 'product_delete'])->name('product.delete');

// order --------------------------------------------------------
Route::get('/customer/order_control', [orderAdminController::class, 'order_controller_page'])->name('customer.order');
Route::post('/customer/order/status/update/', [orderAdminController::class, 'order_status_update'])->name('order.status.update');
Route::get('/customer/order/details/{ordr_id}', [orderAdminController::class, 'order_details'])->name('order.details');
Route::get('/customer/order/review', [orderAdminController::class, 'control_review'])->name('review.control');
Route::get('/customer/order/admin/review/remove/{cus_id}', [orderAdminController::class, 'admin_remove_review'])->name('admin.remove.review');
Route::get('/order/notification/status/update/{not_id}', [orderAdminController::class, 'order_notification_status_update'])->name('order.notification.status.update');


<<<<<<< HEAD
=======
// FAQ -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::resource('faq', faqController::class);


>>>>>>> main
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

