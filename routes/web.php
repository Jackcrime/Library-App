<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/* 
|--------------------------------------------------------------------------
| Frontend Routes (WEB) - User Pages
|--------------------------------------------------------------------------
*/

Route::get("/", [UserController::class, 'main'])->name('index');
Route::get('/preview', [GuestController::class, 'preview'])->name('preview.index');

// Authentication
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Forgot & Reset Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Guest Pages
Route::get('/guest/about', [GuestController::class, 'about'])->name('about');
Route::get('/guest/contact', [GuestController::class, 'contact'])->name('contact');
Route::get('/books', [GuestController::class, 'books'])->name('book');
Route::post('/books/{book}/reviews', [GuestController::class, 'storeReview']);
Route::get('/guest/challenge', [GuestController::class, 'challenge'])->name('challenge');
Route::get('/guest/privacy', [GuestController::class, 'privacy'])->name('privacy');
Route::get('/guest/support', action: [GuestController::class, 'support'])->name('support');
Route::middleware(['auth'])->group(function () {
    Route::get('/guest/profile', [GuestController::class, 'edit'])->name('profile');
    Route::put('/guest/profile', [GuestController::class, 'update'])->name('profile.update');
    Route::delete('/guest/profile/delete-photo', [GuestController::class, 'deletePhoto'])->name('profile.deletePhoto');
});




// Contact Form
Route::post('/contact/send', [ContactController::class, 'sendMail'])->name('contact.send');

// Middleware untuk halaman dashboard berdasarkan role user
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])
        ->middleware('role:admin')
        ->name('admin.dashboard');

    Route::get('/guest', [GuestController::class, 'index'])
        ->middleware('role:member')
        ->name('guest.dashboard');
});

/* 
|--------------------------------------------------------------------------
| Backend Routes (API/ADMIN) - Admin Panel & CRUD
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    
    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/users/{id}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');

    // Kategori Buku
    Route::get('/kategoris', [KategoriController::class, 'index'])->name('kategoris.index');
    Route::get('/kategoris/create', [KategoriController::class, 'create'])->name('kategoris.create');
    Route::post('/kategoris', [KategoriController::class, 'store'])->name('kategoris.store');
    Route::get('/kategoris/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategoris.edit');
    Route::put('/kategoris/{kategori}', [KategoriController::class, 'update'])->name('kategoris.update');
    Route::delete('/kategoris/{kategori}', [KategoriController::class, 'destroy'])->name('kategoris.destroy');
    Route::post('/kategoris/{id}/restore', [KategoriController::class, 'restore'])->name('kategoris.restore');
    Route::delete('/kategoris/{id}/force-delete', [KategoriController::class, 'forceDelete'])->name('kategoris.forceDelete');

    // Buku Management
    Route::get('/bukus', [BukuController::class, 'index'])->name('bukus.index');
    Route::get('/bukus/create', [BukuController::class, 'create'])->name('bukus.create');
    Route::post('/bukus', [BukuController::class, 'store'])->name('bukus.store');
    Route::get('/bukus/{buku}/edit', [BukuController::class, 'edit'])->name('bukus.edit');
    Route::put('/bukus/{buku}', [BukuController::class, 'update'])->name('bukus.update');
    Route::delete('/bukus/{buku}', [BukuController::class, 'destroy'])->name('bukus.destroy');
    Route::post('/bukus/{id}/restore', [BukuController::class, 'restore'])->name('bukus.restore');
    Route::delete('/bukus/{id}/force-delete', [BukuController::class, 'forceDelete'])->name('bukus.forceDelete');

    // Peminjaman Buku
    Route::get('/pinjams', [PinjamController::class, 'index'])->name('pinjams.index');
    Route::get('/pinjams/create', [PinjamController::class, 'create'])->name('pinjams.create');
    Route::post('/pinjams', [PinjamController::class, 'store'])->name('pinjams.store');
    Route::get('/pinjams/{pinjam}/edit', [PinjamController::class, 'edit'])->name('pinjams.edit');
    Route::put('/pinjams/{pinjam}', [PinjamController::class, 'update'])->name('pinjams.update');
    Route::delete('/pinjams/{pinjam}', [PinjamController::class, 'destroy'])->name('pinjams.destroy');
    Route::post('/pinjams/{id}/restore', [PinjamController::class, 'restore'])->name('pinjams.restore');
    Route::delete('/pinjams/{id}/force-delete', [PinjamController::class, 'forceDelete'])->name('pinjams.forceDelete');

    // Pengembalian Buku
    Route::get('/pengembalians', [PengembalianController::class, 'index'])->name('pengembalians.index');
    Route::post('/pengembalians/{id}/peringatan/{level}', [PengembalianController::class, 'peringatan'])->name('pengembalians.peringatan');
    Route::post('/pengembalians/{id}/lunas', [PengembalianController::class, 'lunas'])->name('pengembalians.lunas');
});

/* 
|--------------------------------------------------------------------------
| API Route for Session Checking
|--------------------------------------------------------------------------
*/
Route::get('/check-session', function (Request $request) {
    return response()->json(['logged_in' => Auth::check()]);
});