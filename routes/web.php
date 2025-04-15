<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EbookController;

Route::get('/', function () {
    return view('welcome');
});

// Login and Register
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('admin/register', [UserController::class, 'showRegister'])->name('register');
Route::post('admin/register', [UserController::class, 'register'])->name('register.submit');

// CRUD dashboard after login
Route::get('/admin/edit', [UserController::class, 'showCrud'])->name('admin.~edit')->middleware('auth');


Route::get('/ebook/create', [EbookController::class, 'create'])->name('admin.create');
Route::post('/ebook/store', [EbookController::class, 'store'])->name('ebook.store');

Route::get('/ebooks/{id}/edit', [EbookController::class, 'edit'])->name('ebook.edit');
Route::put('/ebooks/{id}', [EbookController::class, 'update'])->name('ebook.update');

