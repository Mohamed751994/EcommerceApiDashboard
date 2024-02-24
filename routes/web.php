<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WebsiteControllers\HomePageController;
use App\Http\Controllers\WebsiteControllers\CMSController;

//Auth::routes();

//Route::get("lang/{lang}", function ($lang) {
//    app()->setLocale($lang);
//    session()->put('locale', $lang);
//    return redirect()->back();
//});

/*All Normal Languages Routes List*/

Route::get('/', function(){
    return redirect()->route('admin.login_page');
});


