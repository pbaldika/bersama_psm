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


/*
|--------------------------------------------------------------------------
| Inve
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home-verified', [App\Http\Controllers\HomeController::class, 'indexVerified'])->name('home-verified')->middleware(['auth','verified']);
Route::get('/update', [App\Http\Controllers\UserController::class, 'update'])->name('update')->middleware(['auth','verified']); 
Route::get('/available-investment', [App\Http\Controllers\HomeController::class, 'investmentList'])->name('investment-list')->middleware(['auth','verified']); 
Route::get('/{project}/investment', [App\Http\Controllers\HomeController::class, 'investmentDetails'])->name('investment-details')->middleware(['auth','verified']); 
Route::get('/{project}/place-investment', [App\Http\Controllers\HomeController::class, 'placeInvestmentShow'])->name('place-start')->middleware(['auth','verified']); 
Route::post('/{project}/place-investment', [App\Http\Controllers\InvestmentController::class, 'create'])->name('place-investment')->middleware(['auth','verified']); 

 
Route::get('/investment-made', [App\Http\Controllers\InvestmentController::class, 'investmentList'])->name('investment-made')->middleware(['auth','verified']); 
Route::get('/{investment}/upload-proof', [App\Http\Controllers\InvestmentController::class, 'addPhoto'])->name('proof-add')->middleware(['auth','verified']); 
Route::put('/{investment}/store-proof', [App\Http\Controllers\InvestmentController::class, 'uploadPhoto'])->name('proof-upload')->middleware(['auth','verified']); 
Route::get('/get-proof', [App\Http\Controllers\InvestmentController::class, 'viewPhoto'])->name('proof-view')->middleware(['auth','verified']); 

Route::group(['middleware' => ['auth', 'admin', 'verified']], function() {
    // your routes

    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');

    /*
    |--------------------------------------------------------------------------
    | User Management Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/user', [App\Http\Controllers\AdminController::class, 'user'])->name('admin.user');
    Route::get('/admin/user/create', [App\Http\Controllers\AdminController::class, 'userShowCreate'])->name('admin.user.show-create');
    Route::post('/admin/user/create', [App\Http\Controllers\AdminController::class, 'userCreate'])->name('admin.user.create');
    Route::get('/admin/{user}/show', [App\Http\Controllers\AdminController::class, 'userProfile'])->name('admin.user.show');
    Route::get('/admin/{user}/update', [App\Http\Controllers\AdminController::class, 'userShowUpdate'])->name('admin.user.show-update');
    Route::put('/admin/{user}/update', [App\Http\Controllers\AdminController::class, 'userUpdate'])->name('admin.user.update');
    Route::delete('/admin/{user}/delete', [App\Http\Controllers\AdminController::class, 'userDelete'])->name('admin.user.delete');
    Route::get('/admin/{user}/verify', [App\Http\Controllers\AdminController::class, 'userShowVerify'])->name('admin.user.show-verify');
    Route::post('/admin/{user}/verify', [App\Http\Controllers\AdminController::class, 'userVerify'])->name('admin.user.verify');

    /*
    |--------------------------------------------------------------------------
    | Project Management Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/project', [App\Http\Controllers\ProjectController::class, 'project'])->name('admin.project');
    Route::get('/admin/project/create', [App\Http\Controllers\ProjectController::class, 'projectShowCreate'])->name('admin.project.show-create');
    Route::post('/admin/project/create', [App\Http\Controllers\ProjectController::class, 'projectCreate'])->name('admin.project.create');
    Route::get('/admin/{project}/show', [App\Http\Controllers\ProjectController::class, 'projectProfile'])->name('admin.project.show');
    Route::get('/admin/{project}/update', [App\Http\Controllers\ProjectController::class, 'projectShowUpdate'])->name('admin.project.show-update');
    Route::put('/admin/{project}/update', [App\Http\Controllers\ProjectController::class, 'projectUpdate'])->name('admin.project.update');
    Route::delete('/admin/{project}/delete', [App\Http\Controllers\ProjectController::class, 'projectDelete'])->name('admin.project.delete');
    Route::get('/admin/{project}/verify', [App\Http\Controllers\ProjectController::class, 'projectShowVerify'])->name('admin.project.show-verify');
    Route::post('/admin/{project}/verify', [App\Http\Controllers\ProjectController::class, 'projectVerify'])->name('admin.project.verify');
});

Route::group(['middleware' => ['auth', 'company']], function() {
    // your routes

    Route::get('/company', function () {
        return view('frontend.company.welcome');
    });
});

