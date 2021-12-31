<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Registration;
use App\Http\Controllers\DashboardCotroller;
use App\Http\Controllers\LoginCotroller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GigController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ChatController;

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
Route::get('/test', [HomeController::class, 'test'])->name('test');

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/registration', [Registration::class, 'registration'])->name('registration');
Route::post('/registration-process', [Registration::class, 'registration_process'])->name('registration_process');
Route::get('/account/verify/{token}', [Registration::class, 'verifyAccount'])->name('user.verify');
Route::get('/registration/verify-email', [Registration::class, 'verify_email'])->name('verify_email');
Route::get('/login', [LoginCotroller::class, 'login'])->name('login');
Route::get('/dashboard', [DashboardCotroller::class, 'dashboard'])->name('dashboard')->middleware(['auth', 'is_verify_email']);;
Route::post('/login-process', [LoginCotroller::class, 'login_process'])->name('login_process');
Route::get('/logout', [DashboardCotroller::class, 'logout'])->name('logout');
Route::get('/profile', [DashboardCotroller::class, 'profile'])->name('profile');
Route::post('/save-profile', [DashboardCotroller::class, 'save_profile'])->name('save_profile');

// gig
Route::get('/create/gig', [GigController::class, 'create_gig'])->name('create_gig');
Route::get('/sub-cat/{id}', [GigController::class, 'sub_cat'])->name('sub_cat');
Route::post('/gig/process', [GigController::class, 'process_gig'])->name('process_gig');
Route::get('/gig/active/{id}', [GigController::class, 'gig_active'])->name('gig_active');
Route::get('/gig/inactive/{id}', [GigController::class, 'gig_inactive'])->name('gig_inactive');
Route::get('/single/gig/view/{id}', [GigController::class, 'single_gig_view'])->name('single_gig_view');
Route::get('/edit/gig/view/{id}', [GigController::class, 'edit_gig'])->name('edit_gig');
Route::get('/category/gig/{id}', [GigController::class, 'category_gig'])->name('category_gig');
Route::get('/subcategory/gig/{id}', [GigController::class, 'subcategory_gig'])->name('subcategory_gig');
Route::get('/delivery-time', [GigController::class, 'delivery_time'])->name('delivery_time');
Route::get('/min-max-search', [GigController::class, 'min_max_search'])->name('min_max_search');
Route::get('/local-seller', [GigController::class, 'local_seller'])->name('local_seller');

// cart
Route::get('cart', [GigController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [GigController::class, 'addToCart'])->name('add.to.cart');
Route::patch('itemUpdate', [GigController::class, 'itemUpdate'])->name('itemUpdate.cart');
Route::delete('removeItem', [GigController::class, 'removeItem'])->name('removeItem.cart');

// checkout
Route::get('/checkout/{id}', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/checkout-change', [CheckoutController::class, 'checkout_change'])->name('checkout_change');


/* ======
 admin panel
====== */
// login
Route::get('/admin/login', [AdminHomeController::class, 'adminLogin'])->name('adminLogin');
Route::post('/login/admin', [AdminHomeController::class, 'admin_login'])->name('admin_login');
Route::get('/admin/dashboard', [AdminController::class, 'admin_dashboard'])->name('admin_dashboard');
Route::get('/admin/logout', [AdminController::class, 'admin_logout'])->name('admin_logout');

// Category
Route::get('/admin/category/list', [AdminController::class, 'adminCategoryList'])->name('adminCategoryList');
Route::get('/admin/category/{id}',[AdminController::class, 'adminEditCategory'])->name('adminEditCategory');
Route::get('/admin/add/category',[AdminController::class, 'adminAddCategory'])->name('adminAddCategory');
Route::post('/admin/category',[AdminController::class, 'adminCategory'])->name('adminCategory');
Route::get('/admin/category/delete/{id}',[AdminController::class, 'adminDeleteCategory'])->name('adminDeleteCategory');

// sub category
Route::get('/admin/subcategory/list', [AdminController::class, 'adminsubCategoryList'])->name('adminSubCategoryList');
Route::post('/admin/subcategory', [AdminController::class, 'adminsubcategory'])->name('adminsubcategory');
Route::get('/admin/add/subcategory', [AdminController::class, 'adminAddsubCategory'])->name('adminAddsubCategory');
Route::get('/admin/subcategory/{id}', [AdminController::class, 'edit_sub_category'])->name('edit_sub_category');
Route::get('/admin/delete/subcategory/{id}', [AdminController::class, 'delete_subcategory'])->name('delete_subcategory');

Route::post('/place-order', [GigController::class, 'confirmPlaceOrder'])->name('confirmPlaceOrder');
Route::get('/my-order', [DashboardCotroller::class, 'my_order'])->name('my_order');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact-process', [ContactController::class, 'contact_process'])->name('contact_process');

Route::post('/review-rating', [ReviewController::class, 'review_rating'])->name('review_rating');

// user log as client
Route::get('/user-login', [AdminController::class, 'user_login'])->name('user_login');
Route::post('/user-login-process', [AdminController::class, 'user_login_process'])->name('user_login_process');

//gig report
Route::post('/gig-report', [GigController::class, 'gig_report'])->name('gig_report');
Route::get('/report-list', [AdminController::class, 'report_list'])->name('report_list');
Route::get('/report-view/{id}', [AdminController::class, 'report_view'])->name('report_view');

// chat request
Route::post('/chat-request', [ChatController::class, 'chat_request'])->name('chat_request');
Route::get('/message/{id?}', [ChatController::class, 'message'])->name('message');




Route::get('/test', [ReviewController::class, 'test'])->name('test');
