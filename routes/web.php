<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\FundingController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvoiceController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProjectController;
use App\Http\Controllers\Admin\AdminInvestmentController;
use App\Http\Controllers\Admin\AdminFundingController;
use App\Http\Controllers\Admin\AdminCompanyController;

Route::get('/', [LandingController::class, 'landing'])->name('landing');
Route::get('/available-investment', [LandingController::class, 'investmentList'])->name('investment-list');
Route::get('/{project}/investment', [LandingController::class, 'investmentDetails'])->name('investment-details');

Route::middleware(['auth', 'verified'])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | User Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/update', [UserController::class, 'update'])->name('update');
    Route::get('/upload-verification', [UserController::class, 'addVerification'])->name('verification-add');
    Route::put('/store-verification', [InvestorController::class, 'storeVerification'])->name('verification-upload');
    Route::get('/{project}/place-investment', [HomeController::class, 'placeInvestmentShow'])->name('place-start');
    Route::post('/{project}/place-investment', [InvestmentController::class, 'create'])->name('place-investment');
    Route::get('/investment-made', [InvestmentController::class, 'investmentList'])->name('investment-made');
    Route::get('/{investment}/upload-proof', [InvestmentController::class, 'addPhoto'])->name('proof-add');
    Route::put('/{investment}/store-proof', [InvestmentController::class, 'uploadPhoto'])->name('proof-upload');
    Route::get('/get-proof', [InvestmentController::class, 'viewPhoto'])->name('proof-view');
    Route::get('/{investment}/user-invoice', [InvestmentController::class, 'invoice'])->name('invoice');
    Route::get('/{investment}/generate-invoice', [InvestmentController::class, 'generate'])->name('generate-invoice');
    Route::get('/{investment}/print-invoice', [InvestmentController::class, 'print'])->name('print-invoice');


    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');

        Route::prefix('admin')->group(function () {
            /*
            |--------------------------------------------------------------------------
            | User Management Routes
            |--------------------------------------------------------------------------
            */
            Route::get('/user', [AdminUserController::class, 'index'])->name('admin.user');
            Route::get('/user-search', [AdminUserController::class, 'search'])->name('admin.user.search');
            Route::get('/user/create', [AdminUserController::class, 'showCreate'])->name('admin.user.show-create');
            Route::post('/user/create', [AdminUserController::class, 'create'])->name('admin.user.create');
            Route::get('/{user}/show', [AdminUserController::class, 'profile'])->name('admin.user.show');
            // Route::get('/{user}/update', [AdminUserController::class, 'showUpdate'])->name('admin.user.show-update');
            Route::put('/{user}/update', [AdminUserController::class, 'update'])->name('admin.user.update');
            Route::delete('/{user}/delete', [AdminUserController::class, 'selete'])->name('admin.user.delete');
            Route::get('/{user}/verify', [AdminUserController::class, 'verify'])->name('admin.user.show-verify');
            Route::get('/{user}/comp-verify', [AdminCompanyController::class, 'showVerify'])->name('admin.user.show-verify-comp');
            Route::put('/{user}/verify', [AdminCompanyController::class, 'verify'])->name('admin.user.verify');

            /*
            |--------------------------------------------------------------------------
            | Project Management Routes
            |--------------------------------------------------------------------------
            */
            Route::get('/project', [AdminProjectController::class, 'index'])->name('admin.project');
            Route::get('/project-search', [AdminProjectController::class, 'search'])->name('admin.project.search');
            Route::get('/project/create', [AdminProjectController::class, 'showCreate'])->name('admin.project.show-create');
            Route::post('/project/create', [AdminProjectController::class, 'create'])->name('admin.project.create');
            Route::get('/project/{project}/details', [AdminProjectController::class, 'details'])->name('admin.project.details');
            // Route::get('/project/{project}/update', [AdminProjectController::class, 'showUpdate'])->name('admin.project.show-update');
            Route::put('/project/{project}/update', [AdminProjectController::class, 'update'])->name('admin.project.update');
            Route::delete('/project/{project}/delete', [AdminProjectController::class, 'delete'])->name('admin.project.delete');
            Route::put('/project/{project}/complete', [AdminProjectController::class, 'complete'])->name('admin.project.complete');
            // Route::get('/{project}/verify', [AdminProjectController::class, 'projectShowVerify'])->name('admin.project.show-verify');
            // Route::put('/{project}/verify', [ProjectController::class, 'projectVerify'])->name('admin.project.verify');

            /*
            |--------------------------------------------------------------------------
            | Investment Management Routes
            |--------------------------------------------------------------------------
            */
            Route::get('/{investment}/investment', [AdminInvestmentController::class, 'userInvestment'])->name('admin.user.investment');
            Route::put('/{investment}/investment-verify', [AdminInvestmentController::class, 'verify'])->name('admin.investment.verify');

            /*
            |--------------------------------------------------------------------------
            | Funding Management Routes
            |--------------------------------------------------------------------------
            */
            Route::get('/funding', [AdminFundingController::class, 'listFunding'])->name('admin.funding');
            Route::get('/funding-search', [AdminFundingController::class, 'search'])->name('admin.funding.search');
            Route::get('/funding-create', [AdminFundingController::class, 'create'])->name('admin.funding.create');
            // Route::get('/funding-show', [AdminFundingController::class, 'show'])->name('admin.funding.show');
            Route::get('/{funding}/funding-details', [AdminFundingController::class, 'details'])->name('admin.funding.details');
            Route::put('/{funding}/funding-verify', [AdminFundingController::class, 'verify'])->name('admin.funding.verify');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Company Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['company'])->group(function () {
        Route::get('/company', function () {
            return view('frontend.company.welcome');
        });

        Route::get('/funding', [FundingController::class, 'create'])->name('funding');
        Route::post('/funding', [FundingController::class, 'createFunding'])->name('create-funding');
        Route::get('/upload-verification-comp', [CompanyController::class, 'showVerification'])->name('verification-add-comp');
        Route::put('/store-verification-comp', [CompanyController::class, 'storeVerification'])->name('verification-upload-comp');
    });
});