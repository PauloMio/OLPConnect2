<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\AccountController;

//Route::get('/', function () {
//    return view('welcome');
//});

// Admin Routes
Route::middleware(['admin.guest'])->group(function () {
    Route::get('/login', [UserController::class, 'showLogin'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.submit');

});

Route::get('admin/register', [UserController::class, 'showRegister'])->name('register');
Route::post('admin/register', [UserController::class, 'register'])->name('register.submit');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth:web'])->group(function () {
    Route::get('/admin/ebook/list', [EbookController::class, 'index'])->name('admin.ebook.list');

    Route::get('/admin/ebook/create', [EbookController::class, 'create'])->name('admin.create');
    Route::post('/admin/ebook/store', [EbookController::class, 'store'])->name('ebook.store');

    Route::get('/admin/ebook/{id}/edit', [EbookController::class, 'edit'])->name('admin.ebook.edit');
    Route::put('/admin/ebook/{id}/update', [EbookController::class, 'update'])->name('admin.ebook.update');

    Route::delete('/admin/ebook/{id}/destroy', [EbookController::class, 'destroy'])->name('admin.ebook.destroy');

    Route::get('/admin/accounts', [UserController::class, 'indexAdmins'])->name('admin.accounts');
    Route::get('/admin/accounts/{id}/edit', [UserController::class, 'editAdmin'])->name('admin.accounts.edit');
    Route::put('/admin/accounts/{id}', [UserController::class, 'updateAdmin'])->name('admin.accounts.update');
    Route::delete('/admin/accounts/{id}', [UserController::class, 'deleteAdmin'])->name('admin.accounts.delete');

    Route::get('/admin/dashboard', [EbookController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/ebook-overview/pdf', [EbookController::class, 'downloadPdf'])->name('admin.ebook-overview.pdf');
});


// User Routes
Route::middleware(['account.guest'])->group(function () {
    Route::get('user/signup', [AccountController::class, 'showSignupForm'])->name('account.showSignup');
    Route::post('user/signup', [AccountController::class, 'signup'])->name('account.signup');

    Route::get('user/login', [AccountController::class, 'showLoginForm'])->name('account.showLogin');
    Route::post('user/login', [AccountController::class, 'login'])->name('account.login');

    Route::get('/', function () {
        return view('user.home');
    })->name('user.home');
});



Route::post('user/logout', [AccountController::class, 'logout'])->name('account.logout');

Route::middleware(['account.auth'])->group(function () {
    Route::get('user/ebooks', [EbookController::class, 'userView'])->name('user.ebooks');
    Route::get('user/ebooks/{id}', [EbookController::class, 'show'])->name('user.ebooks.show');
});

