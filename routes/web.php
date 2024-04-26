<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\KursiController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\TanggalController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('admin.dashboard', FilmController::class);


Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin'], function () {
    // halaman dasboard //
Route::get('/dashboard', [FilmController::class, 'dashboard'])->name('dashboard');
// halaman film //
Route::get('/film', [FilmController::class, 'film'])->name('film');
Route::post('/tambahfilm', [FilmController::class, 'proses_film'])->name('proses_film');
Route::post('/update-film/{id}', [FilmController::class, 'update_film'])->name('update_film');
Route::DELETE('/hapus-film/{id}', [FilmController::class, 'delete_film'])->name('delete_film');
// halaman tiket //
Route::get('/tiket', [TiketController::class, 'tiket'])->name('tiket');
Route::post('/tambahtiket', [TiketController::class, 'proses_tiket'])->name('proses_tiket');
Route::post('/update tiket/{id}', [TiketController::class, 'update_tiket'])->name('update_tiket');
Route::DELETE('/hapus Tiket/{id}', [TiketController::class, 'delete_tiket'])->name('delete_tiket');
// halaman kursi //
Route::get('/kursi', [KursiController::class, 'kursi'])->name('kursi');
Route::post('/tambahkursi', [KursiController::class, 'proses_kursi'])->name('proses_kursi');
// halaman tanggal //
Route::get('/tanggal', [TanggalController::class, 'tanggal'])->name('tanggal');
Route::post('/tambahjadwal', [TanggalController::class, 'proses_tanggal'])->name('proses_tanggal');
Route::post('/update-jadwal/{id}', [TanggalController::class, 'update_tanggal'])->name('update_tanggal');
Route::DELETE('/hapus tanggal/{id}', [TanggalController::class, 'delete_tanggal'])->name('delete_tanggal');
// halaman map
Route::get('/map', [MapController::class, 'map'])->name('map');
// halaman keuangan
Route::get('/Keuangan', [KeuanganController::class, 'keuangan'])->name('keuangan');
});

Auth::routes();


Route::get('/', [HomeController::class, 'index'])->name('welcome');


Route::post('/logout', [App\Http\Controllers\LogoutController::class, 'logout'])->name('logout');

/* Tiket */
Route::get('/order', function () {
    return view('user.order');
});

Route::get('/history', function () {
    return view('user.history');
});

Route::get('/order', [OrderController::class, 'index'])->name('order');
Route::get('/history', [HistoryController::class, 'index'])->name('history');
