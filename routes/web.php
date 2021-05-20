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

Auth::routes();

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'HomeController@adminHome')->name('admin_homepage');
});

Route::prefix("posts")
    ->group(function() {
        Route::get("/", "PostController@index")->name("posts_page");
        Route::get("/{slug}", "PostController@show")->name("post_page");
    });
