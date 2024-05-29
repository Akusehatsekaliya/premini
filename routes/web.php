<?php

use App\Http\Controllers\admin\MapController;
use App\Http\Controllers\admin\FilmController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\KeuanganController;
use App\Http\Controllers\admin\KursiController;
use App\Http\Controllers\admin\TanggalController;
use App\Http\Controllers\admin\TiketController;
use App\Http\Controllers\user\OrderController;
use App\Http\Controllers\user\HistoryController;
use App\http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
Route::get('/search', [HomeController::class, 'search'])->name('search');

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
Route::post('/update/{id}', [KursiController::class, 'update_kursi'])->name('update_kursi');
Route::DELETE('/hapus/{id}', [KursiController::class, 'delete_kursi'])->name('delete_kursi');
// halaman tanggal //
Route::get('/tanggal', [TanggalController::class, 'tanggal'])->name('tanggal');
Route::post('/tambahjadwal', [TanggalController::class, 'proses_tanggal'])->name('proses_tanggal');
Route::post('/update_tanggal/{id}', [TanggalController::class, 'update_tanggal'])->name('update_tanggal');
Route::DELETE('/hapus tanggal/{id}', [TanggalController::class, 'delete_tanggal'])->name('delete_tanggal');
// halaman map
Route::get('/map', [MapController::class, 'map'])->name('map');
Route::post('/tambah-map', [MapController::class, 'tambah_map'])->name('tambah_map');
Route::post('/update-map/{id}', [MapController::class, 'update_map'])->name('update_map');
Route::DELETE('delete-map/{id}', [MapController::class, 'delete_map'])->name('delete_map');
// halaman keuangan
Route::get('/keuangan', [KeuanganController::class, 'keuangan'])->name('keuangan');
Route::post('/admin/keuangan/verifikasi/{id}', [KeuanganController::class, 'verifikasi'])->name('admin.verifikasi');

});

Auth::routes();


Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/editprofile', [ProfileController::class, 'update'])->name('profile.update');

Route::post('/logout', [App\Http\Controllers\LogoutController::class, 'logout'])->name('logout');

/* Tiket */
Route::get('/order', function () {
    return view('user.order');
});

Route::get('/history', function () {
    return view('user.history');
});
/* Order */
Route::get('/detail/{id}', [OrderController::class, 'detail'])->name('detail');
Route::get('/pilihkursi/{id}', [OrderController::class, 'pilihkursi'])->name('pilihkursi');
Route::post('/pembayaran', [OrderController::class, 'store'])->name('pembayaran.store');
/* History */
Route::get('/history/{user_id}', [HistoryController::class, 'index'])->name('history');