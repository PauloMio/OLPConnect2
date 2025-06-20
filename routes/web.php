<?php

use App\Http\Controllers\ProgramUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\EbookCategoryController;
use App\Http\Controllers\EbookLocationController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\GuestLogController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\DepartmentController;
use App\Models\ProgramUser;

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

    Route::get('/admin/useraccounts', [AccountController::class, 'index'])->name('admin.useraccounts.index');
    Route::post('/admin/useraccounts', [AccountController::class, 'store'])->name('admin.useraccounts.store');
    Route::put('/admin/useraccounts/{id}', [AccountController::class, 'update'])->name('admin.useraccounts.update');
    Route::delete('/admin/useraccounts/{id}', [AccountController::class, 'destroy'])->name('admin.useraccounts.delete');
    
    // ✅ Ebook Categories Routes
    Route::get('/admin/ebook-categories', [EbookCategoryController::class, 'index'])->name('admin.ebook_categories.index');
    Route::get('/admin/ebook-categories/create', [EbookCategoryController::class, 'create'])->name('admin.ebook_categories.create');
    Route::post('/admin/ebook-categories/store', [EbookCategoryController::class, 'store'])->name('admin.ebook_categories.store');
    Route::delete('/admin/ebook-categories/{id}', [EbookCategoryController::class, 'destroy'])->name('admin.ebook_categories.destroy');

    // ✅ Ebook Locations Routes
    Route::get('/admin/ebook-locations', [EbookLocationController::class, 'index'])->name('admin.ebook_locations.index');
    Route::get('/admin/ebook-locations/create', [EbookLocationController::class, 'create'])->name('admin.ebook_locations.create');
    Route::post('/admin/ebook-locations/store', [EbookLocationController::class, 'store'])->name('admin.ebook_locations.store');
    Route::delete('/admin/ebook-locations/{id}', [EbookLocationController::class, 'destroy'])->name('admin.ebook_locations.destroy');

    // Program User Routes
    Route::get('/admin/program-user', action: [ProgramUserController::class, 'index'])->name('admin.program_user.index');
    Route::get('/admin/program-user/create', [ProgramUserController::class, 'create'])->name('admin.program_user.create');
    Route::post('/admin/program-user/store', [ProgramUserController::class, 'store'])->name('admin.program_user.store');
    Route::delete('/admin/program-user/{id}', [ProgramUserController::class, 'destroy'])->name('admin.program_user.destroy');   

    // Announcement Routes
    Route::get('/admin/announcement',[AnnouncementController::class, 'index'])->name('announcements.index');
    Route::post('/admin/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::delete('/admin/announcements/{id}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');

    // ✅ Research CRUD Routes
    Route::get('/admin/research', [ResearchController::class, 'index'])->name('admin.research.index');
    Route::post('/admin/research', [ResearchController::class, 'store'])->name('admin.research.store');
    Route::put('/admin/research/{research}', [ResearchController::class, 'update'])->name('admin.research.update');
    Route::delete('/admin/research/{research}', [ResearchController::class, 'destroy'])->name('admin.research.destroy');

    // Department Routes
    Route::get('/admin/department', [DepartmentController::class, 'index'])->name('admin.department.index');
    Route::get('/admin/department/create', [DepartmentController::class, 'create'])->name('admin.department.create');
    Route::post('/admin/department/store', [DepartmentController::class, 'store'])->name('admin.department.store');
    Route::delete('admin/department/{id}', [DepartmentController::class, 'destroy'])->name('admin.department.destroy');
});


// User Routes
Route::middleware(['account.guest'])->group(function () {
    Route::get('user/signup', [AccountController::class, 'showSignupForm'])->name('account.showSignup');
    Route::post('user/signup', [AccountController::class, 'signup'])->name('account.signup');

    Route::get('user/login', [AccountController::class, 'showLoginForm'])->name('account.showLogin');
    Route::post('user/login', [AccountController::class, 'login'])->name('account.login');

    Route::get('/', [AnnouncementController::class, 'home'])->name('user.home');
});



Route::post('user/logout', [AccountController::class, 'logout'])->name('account.logout');

Route::middleware(['account.auth'])->group(function () {
    Route::get('user/ebooks', [EbookController::class, 'userView'])->name('user.ebooks');
    Route::get('user/ebooks/{id}', [EbookController::class, 'show'])->name('user.ebooks.show');
});

Route::middleware(['account.auth'])->group(function () {
    Route::post('user/ebooks/{id}/favorite', [EbookController::class, 'toggleFavorite'])->name('user.ebooks.favorite');
    Route::get('user/favorites', [EbookController::class, 'viewFavorites'])->name('user.favorites');
    Route::get('user/research', [ResearchController::class, 'userView'])->name('user.research');
});



Route::get('/guest/login', [GuestLogController::class, 'showForm'])->name('guest.login');
Route::post('/guest/login', [GuestLogController::class, 'store'])->name('guest.login.submit');
Route::get('/guest/ebooks', [GuestLogController::class, 'viewEbooks'])->name('guest.ebooks');
Route::get('/guest/ebooks/{id}', [GuestLogController::class, 'showEbook'])->name('guest.ebooks.show');
Route::get('/guest/research', [ResearchController::class, 'guestView'])->name('guest.research');



