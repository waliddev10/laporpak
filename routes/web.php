<?php

use App\Http\Controllers\LaporanBulananController;
use App\Http\Controllers\LaporanHarianController;
use App\Http\Controllers\Pengaturan\JenisPkbController;
use App\Http\Controllers\Pengaturan\KasirController;
use App\Http\Controllers\Pengaturan\KasirPembayaranController;
use App\Http\Controllers\Pengaturan\KotaPenandatanganController;
use App\Http\Controllers\Pengaturan\PaymentPointController;
use App\Http\Controllers\Pengaturan\PenandatanganController;
use App\Http\Controllers\Pengaturan\UserController;
use App\Http\Controllers\Pengaturan\WilayahController;
use App\Models\PaymentPoint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// setup

Route::get('/migrate', function () {
    return Artisan::call('migrate');
});
Route::get('/migrate/fresh', function () {
    return Artisan::call('migrate:fresh');
});
Route::get('/seed', function () {
    return Artisan::call('db:seed');
});
Route::get('/symlink', function () {
    $target =  env('SYMLINK_PATH');
    $shortcut = env('SYMLINK_PATH_TARGET');
    return symlink($target, $shortcut);
});

// router

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $payment_point = PaymentPoint::all();
        return view('pages.dashboard', ['payment_point' => $payment_point]);
    })->name('dashboard');

    Route::prefix('/laporan_harian')->group(function () {
        Route::get('/', [LaporanHarianController::class, 'index'])
            ->name('laporan_harian.index');
        Route::get('/payment_point/{payment_point}', [LaporanHarianController::class, 'show'])
            ->name('laporan_harian.show');
        Route::get('/payment_point/{payment_point}/{jenis_pkb}/create', [LaporanHarianController::class, 'create'])
            ->name('laporan_harian.create');
        Route::post('/payment_point/{payment_point}', [LaporanHarianController::class, 'store'])
            ->name('laporan_harian.store');
        Route::get('/payment_point/{payment_point}/{esamsat}', [LaporanHarianController::class, 'edit'])
            ->name('laporan_harian.edit');
        Route::put('/payment_point/{payment_point}/{esamsat}', [LaporanHarianController::class, 'update'])
            ->name('laporan_harian.update');
        Route::delete('/payment_point/{payment_point}/{esamsat}', [LaporanHarianController::class, 'destroy'])
            ->name('laporan_harian.destroy');
    });

    Route::prefix('/laporan_bulanan')->group(function () {
        Route::get('/', [LaporanBulananController::class, 'index'])
            ->name('laporan_bulanan.index');
        Route::get('/payment_point/{payment_point}', [LaporanBulananController::class, 'show'])
            ->name('laporan_bulanan.show');
        Route::get('/payment_point/{payment_point}/{jenis_pkb}/create', [LaporanBulananController::class, 'create'])
            ->name('laporan_bulanan.create');
        Route::post('/payment_point/{payment_point}', [LaporanBulananController::class, 'store'])
            ->name('laporan_bulanan.store');
        Route::get('/payment_point/{payment_point}/{esamsat}', [LaporanBulananController::class, 'edit'])
            ->name('laporan_bulanan.edit');
        Route::put('/payment_point/{payment_point}/{esamsat}', [LaporanBulananController::class, 'update'])
            ->name('laporan_bulanan.update');
        Route::delete('/payment_point/{payment_point}/{esamsat}', [LaporanBulananController::class, 'destroy'])
            ->name('laporan_bulanan.destroy');
    });

    Route::prefix('/pengaturan')->group(function () {
        Route::resource('/jenis_pkb', JenisPkbController::class)->except('show');
        Route::resource('/wilayah', WilayahController::class)->except('show');
        Route::resource('/kasir', KasirController::class)->except('show');
        Route::resource('/kasir_pembayaran', KasirPembayaranController::class)->except('show');
        Route::resource('/payment_point', PaymentPointController::class)->except('show');
        Route::resource('/penandatangan', PenandatanganController::class)->except('show');
        Route::resource('/kota_penandatangan', KotaPenandatanganController::class)->except('show');
        Route::resource('/user', UserController::class)->except('show');
    });
});

require __DIR__ . '/auth.php';
