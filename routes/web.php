<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\AccountController;

Route::get('/', function () {
    return view('welcome');
});

// Login and Register
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('admin/register', [UserController::class, 'showRegister'])->name('register');
Route::post('admin/register', [UserController::class, 'register'])->name('register.submit');


Route::get('/admin/ebook/list', [EbookController::class, 'index'])->name('admin.ebook.list');

Route::get('/admin/ebook/create', [EbookController::class, 'create'])->name('admin.create');
Route::post('/admin/ebook/store', [EbookController::class, 'store'])->name('ebook.store');

Route::get('/admin/ebook/{id}/edit', [EbookController::class, 'edit'])->name('admin.ebook.edit');
Route::put('/admin/ebook/{id}/update', [EbookController::class, 'update'])->name('admin.ebook.update');

Route::delete('/admin/ebook/{id}/destroy', [EbookController::class, 'destroy'])->name('admin.ebook.destroy');



Route::get('user/login', [AccountController::class, 'showLoginForm'])->name('account.showLogin');
Route::post('user/login', [AccountController::class, 'login'])->name('account.login');

Route::get('user/ebooks', [EbookController::class, 'userView'])->name('user.ebooks');

Route::get('user/ebooks/{id}', [EbookController::class, 'show'])->name('user.ebooks.show');