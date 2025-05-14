<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 💡 Route Auth (Login, Logout, Register Pegawai)
Route::middleware(['web'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1')->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Hanya pegawai yang bisa register (bukan guest)
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    Route::redirect('/', '/login');
});


// 🔐 ADMIN ROUTES
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    
    // Admin kelola data pegawai
    Route::get('/pegawai', [PegawaiController::class, 'indexPegawai'])->name('admin.pegawai.index');
    Route::get('/pegawai/create', [PegawaiController::class, 'createPegawai'])->name('admin.pegawai.create');
    Route::post('/pegawai/store', [PegawaiController::class, 'storePegawai'])->name('admin.pegawai.store');
    Route::get('/pegawai/{id}/edit', [PegawaiController::class, 'editPegawai'])->name('admin.pegawai.edit');
    Route::put('/pegawai/{id}', [PegawaiController::class, 'updatePegawai'])->name('admin.pegawai.update');
    Route::get('/pegawai/{id}/show', [PegawaiController::class, 'showPegawai'])->name('admin.pegawai.show');
    Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroyPegawai'])->name('admin.pegawai.destroy');

    // Kelola Cuti semua pegawai
    Route::get('/cuti', [CutiController::class, 'index'])->name('admin.cuti.index');
    Route::patch('/cuti/{id}/status', [CutiController::class, 'updateStatus'])->name('admin.cuti.status');
    Route::get('/cuti/laporan', [CutiController::class, 'laporanCuti'])->name('admin.cuti.laporan');


    // Kelola Admin
    Route::get('/list', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/{admin}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/{admin}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/{admin}', [AdminController::class, 'destroy'])->name('admin.destroy');
});


// 👨‍💼 PEGAWAI ROUTES
Route::middleware(['auth', 'isPegawai'])->prefix('pegawai')->group(function () {
    Route::get('/dashboard', [PegawaiController::class, 'dashboard'])->name('pegawai.dashboard');

    // Cuti Pegawai (ajukan dan lihat status)
    Route::get('/cuti', [CutiController::class, 'indexPegawai'])->name('pegawai.cuti.index');
    Route::get('/cuti/create', [CutiController::class, 'create'])->name('pegawai.cuti.create');
    Route::post('/cuti/store', [CutiController::class, 'store'])->name('pegawai.cuti.store');

    // Profil Pegawai (opsional)
    Route::get('/profile', [PegawaiController::class, 'profile'])->name('pegawai.profile');
    Route::put('/profile/update', [PegawaiController::class, 'updateProfile'])->name('pegawai.profile.update');
});
