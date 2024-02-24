<?php

use App\Http\Controllers\APIControllers\AuthController;
use App\Http\Controllers\APIControllers\CategoryController;
use App\Http\Controllers\APIControllers\CMSController;
use App\Http\Controllers\APIControllers\OrderController;
use App\Http\Controllers\APIControllers\ProductController;
use App\Http\Controllers\APIControllers\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::middleware(['trust', 'language'])->group(function () {


    //****************WEBSITE PUBLIC*******************************

    Route::middleware(['guest.or.auth'])->group(function () {
        Route::get('/languages', [CMSController::class, 'languages'])->name('website.languages');
        Route::get('/categories', [CategoryController::class, 'categories'])->name('website.categories');
        Route::get('/products', [ProductController::class, 'products'])->name('website.products');
        Route::get('/product/{id}', [ProductController::class, 'product'])->name('website.product');
        Route::get('/related-products/{id}', [ProductController::class, 'related_products'])->name('website.related_products');
        Route::get('/search-products', [ProductController::class, 'realtime_search'])->name('website.realtime_search');
        Route::get('/settings', [CMSController::class, 'settings'])->name('website.settings');
        Route::post('/store-contact', [CMSController::class, 'contacts'])->name('website.contacts');
        Route::get('/gender-list', [CMSController::class, 'gender_list'])->name('website.gender_list');
    });
    //****************END WEBSITE PUBLIC*******************************






    //**************** User AUTH *******************************
    Route::prefix('auth')->group(function () {
        //****************Not AUTH*******************************
            Route::post('/register', [AuthController::class, 'register'])->name('user.register');
            Route::post('/login', [AuthController::class, 'login'])->name('user.login');
            Route::post('/forget-password', [AuthController::class, 'forget_password'])->name('user.forget_password');
            Route::post('/reset-password', [AuthController::class, 'reset_password'])->name('user.reset_password');
            Route::get('/verification-email/{id}', [AuthController::class, 'verification_email'])->name('user.verification_email');

        //****************END Not AUTH*******************************

        //**************** AUTH *******************************
            Route::middleware(['auth:sanctum'])->group(function () {
                Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');
                Route::post('/deactivation', [AuthController::class, 'deactivation'])->name('user.deactivation');
                Route::get('/get-user', [AuthController::class, 'get_user'])->name('user.get_user');

                //Edit profile
                Route::post('/update-profile', [AuthController::class, 'profile'])->name('user.profile');
                Route::post('/change-password', [AuthController::class, 'changePassword'])->name('user.changePassword');
                Route::get('/get-user-address', [AuthController::class, 'get_user_address'])->name('user.get_user_address');
                Route::post('/add-or-update-address', [AuthController::class, 'add_or_update_address'])->name('user.add_or_update_address');

                //Orders
                Route::post('/checkout', [OrderController::class, 'checkout'])->name('user.checkout');
                Route::get('/orders', [OrderController::class, 'orders'])->name('user.orders');
                Route::get('/order/{id}', [OrderController::class, 'order'])->name('user.order');
                Route::post('/cancel-order/{id}', [OrderController::class, 'cancel_order'])->name('user.cancel_order');

                //Wishlists
                Route::post('/add-or-delete-wishlist', [WishlistController::class, 'add_or_delete_wishlist'])->name('user.add_or_delete_wishlist');
                Route::get('/wishlists', [WishlistController::class, 'wishlists'])->name('user.wishlists');

            });
        //****************END  AUTH*******************************

    });




});


