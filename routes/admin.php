<?php

use App\Http\Controllers\AdminControllers\AuthController;
use App\Http\Controllers\AdminControllers\MenuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControllers\DashboardController;


Route::get('/login', [AuthController::class, 'login_page'])->name('admin.login_page');
Route::post('/login', [AuthController::class, 'login'])->name('admin.login');

Route::get("switch-language/{lang}", function ($lang) {
    app()->setLocale($lang);
    session()->put('locale', $lang);
    return redirect()->back();
})->name('switch-language');
/*All Admin Routes List*/
Route::middleware(['auth','switch-language'])->namespace('App\Http\Controllers\AdminControllers')->group(function () {

    Route::get("/migrate", function () {
        \Illuminate\Support\Facades\Artisan::call('migrate');
        //  \Illuminate\Support\Facades\Artisan::call('db:seed');
        return 'Migrated Successfully';
    });
    //Default
    Route::post('/logout_admin', [DashboardController::class, 'logout'])->name('logout_admin');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/quickChange', [DashboardController::class, 'quickChange'])->name('admin.quickChange');
    Route::post('/deleteSelectedItems', [DashboardController::class, 'deleteSelectedItems'])->name('admin.deleteSelectedItems');
    Route::get('/user-profile', [DashboardController::class, 'userProfile'])->name('admin.userProfile');
    Route::put('/updateUserProfile', [DashboardController::class, 'updateUserProfile'])->name('admin.updateUserProfile');
    Route::resource('menus', 'MenuController');


    //Routes
Route::resource('contacts', 'ContactController');
Route::resource('settings', 'SettingController');
    Route::resource('orders', 'OrderController');
    Route::resource('products', 'ProductController');
    Route::resource('categories', 'CategoryController');
    Route::resource('languages', 'LanguageController');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('customers', 'CustomerController');

});




