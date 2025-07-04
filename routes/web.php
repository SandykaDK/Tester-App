<?php

use App\Http\Controllers\ManajemenTestingBaruController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarAplikasiController;
use App\Http\Controllers\ManajemenTestingController;
use App\Http\Controllers\DaftarModulController;
use App\Http\Controllers\DaftarMenuController;
use App\Http\Controllers\DaftarDeveloperController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ScreenFormatController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Redirect root to login if not authenticated
Route::get('/', function () {
    return redirect()->route('login');
});

// Group all routes that require authentication
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // DAFTAR APLIKASI
    Route::get('/applications', [DaftarAplikasiController::class, 'index'])
        ->name('applications.index');
    Route::get('/applications/create', [DaftarAplikasiController::class, 'create'])
        ->name('applications.create');
    Route::post('/applications', [DaftarAplikasiController::class, 'store'])
        ->name('applications.store');
    Route::get('/applications/{id}/edit', [DaftarAplikasiController::class, 'edit'])
        ->name('applications.edit');
    Route::put('/applications/{id}', [DaftarAplikasiController::class, 'update'])
        ->name('applications.update');
    Route::delete('/applications/{id}', [DaftarAplikasiController::class, 'destroy'])
        ->name('applications.destroy');

    // DAFTAR MODUL
    Route::get('/modules', [DaftarModulController::class, 'index'])
        ->name('modules.index');
    Route::get('/modules/create', [DaftarModulController::class, 'create'])
        ->name('modules.create');
    Route::post('/modules', [DaftarModulController::class, 'store'])
        ->name('modules.store');
    Route::get('/modules/{id}/edit', [DaftarModulController::class, 'edit'])
        ->name('modules.edit');
    Route::put('/modules/{id}', [DaftarModulController::class, 'update'])
        ->name('modules.update');
    Route::delete('/modules/{id}', [DaftarModulController::class, 'destroy'])
        ->name('modules.destroy');

    // DAFTAR MENU
    Route::get('/menus', [DaftarMenuController::class, 'index'])
        ->name('menus.index');
    Route::get('/menus/create', [DaftarMenuController::class, 'create'])
        ->name('menus.create');
    Route::post('/menus', [DaftarMenuController::class, 'store'])
        ->name('menus.store');
    Route::get('/menus/{id}/edit', [DaftarMenuController::class, 'edit'])
        ->name('menus.edit');
    Route::put('/menus/{id}', [DaftarMenuController::class, 'update'])
        ->name('menus.update');
    Route::delete('/menus/{id}', [DaftarMenuController::class, 'destroy'])
        ->name('menus.destroy');
    Route::get('/api/modules/{applicationId}', [DaftarMenuController::class, 'getModules']);

    // DAFTAR DEVELOPER
    Route::get('/developers', [DaftarDeveloperController::class, 'index'])
        ->name('developers.index');
    Route::get('/developers/create', [DaftarDeveloperController::class, 'create'])
        ->name('developers.create');
    Route::post('/developers', [DaftarDeveloperController::class, 'store'])
        ->name('developers.store');
    Route::get('/developers/{id}/edit', [DaftarDeveloperController::class, 'edit'])
        ->name('developers.edit');
    Route::put('/developers/{id}', [DaftarDeveloperController::class, 'update'])
        ->name('developers.update');
    Route::delete('/developers/{id}', [DaftarDeveloperController::class, 'destroy'])
        ->name('developers.destroy');

    // TEST CASES BARU
    Route::get('/test-cases-new', [ManajemenTestingBaruController::class, 'index'])
        ->name('test-cases-new.index');
    Route::get('/test-cases-new/create', [ManajemenTestingBaruController::class, 'create'])
        ->name('test-cases-new.create');
    Route::post('/test-cases-new', [ManajemenTestingBaruController::class, 'store'])
        ->name('test-cases-new.store');
    Route::get('/test-cases-new/{id}/edit', [ManajemenTestingBaruController::class, 'edit'])
        ->name('test-cases-new.edit');
    Route::put('/test-cases-new/{id}', [ManajemenTestingBaruController::class, 'update'])
        ->name('test-cases-new.update');
    Route::delete('/test-cases-new/{id}', [ManajemenTestingBaruController::class, 'destroy'])
        ->name('test-cases-new.destroy');

    // Screen Format
    Route::get('/screen-format', [ScreenFormatController::class, 'index'])
        ->name('screen-format.index');
    Route::get('/screen-format/create', [ScreenFormatController::class, 'create'])
        ->name('screen-format.create');
    Route::post('/screen-format', [ScreenFormatController::class, 'store'])
        ->name('screen-format.store');
    Route::get('/screen-format/{id}/edit', [ScreenFormatController::class, 'edit'])
        ->name('screen-format.edit');
    Route::put('/screen-format/{id}', [ScreenFormatController::class, 'update'])
        ->name('screen-format.update');
    Route::delete('/screen-format/{id}', [ScreenFormatController::class, 'destroy'])
        ->name('screen-format.destroy');
    Route::get('/api/appmenu/search', [ScreenFormatController::class, 'searchappmenu'])
        ->name('appmenu.search');
    Route::get('/api/menus/search', [ScreenFormatController::class, 'searchMenus'])
        ->name('menus.search');

    // LAPORAN & STATISTIK
    Route::get('/laporan-statistik', [LaporanController::class, 'index'])
        ->name('laporan-statistik.index');
});


