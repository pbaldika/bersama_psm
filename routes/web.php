<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.welcome');
});

Route::get('/admin-check', function () {
    return view('frontend.admin.welcome');
});

// Auth::routes(); 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home-verified', [App\Http\Controllers\HomeController::class, 'indexVerified'])->name('home-verified')->middleware(['auth','verified']);
Route::get('/update', [App\Http\Controllers\UserController::class, 'update'])->name('update')->middleware(['auth','verified']); 


// Route::get('redirects', 'App\Http\Controllers\HomeController@index');



Route::group(['middleware' => ['auth', 'admin', 'verified']], function() {
    // your routes

    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');
    Route::get('/admin/user', [App\Http\Controllers\AdminController::class, 'user'])->name('admin.user');
    Route::get('/admin/{user}/show', [App\Http\Controllers\AdminController::class, 'userProfile'])->name('admin.user.show');
});

Route::group(['middleware' => ['auth', 'company']], function() {
    // your routes

    Route::get('/company', function () {
        return view('frontend.company.welcome');
    });
});

