<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Login and Register
Route::get('admin', [UserController::class, 'showLogin'])->name('login');
Route::post('admin', [UserController::class, 'login'])->name('login.submit');

Route::get('admin/register', [UserController::class, 'showRegister'])->name('register');
Route::post('admin/register', [UserController::class, 'register'])->name('register.submit');

// CRUD dashboard after login
Route::get('admin/crud', [UserController::class, 'showCrud'])->name('crud')->middleware('auth');

// Logout
Route::post('logout', [UserController::class, 'logout'])->name('logout');
