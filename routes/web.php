<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

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

Route::get('/', "HomeController@guestHome")->name("guest_homepage");

Route::get("/posts", "PostController@index")->name("posts_page");

Route::get("/posts/{slug}", "PostController@show")->name("post_page");

Auth::routes();

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'HomeController@adminHome')->name('admin_homepage');
        Route::resource("/posts", "PostController");
        Route::get("/user", "HomeController@user")->name("user_page");
        Route::post("/user/generate_token", "HomeController@generatetoken")->name("user_generate_token");
});

