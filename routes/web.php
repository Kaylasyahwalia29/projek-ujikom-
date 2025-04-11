<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\KategoriController;
use App\Http\Middleware\IsAdmin;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// front
Route::get('/', [FrontController::class, 'index']);

// Route::get('kategori/shop/{id}', function ($id) {
//     return view('shop');
// });

// Route::get('kategori/{id}', function (int $id) {
//     return view('produk', ['kategori' => kategori::findOrFail($id)]);
// });

Route::get('produk', [FrontController::class, 'produk']);
Route::get('produk/{id}', [FrontController::class, 'show']);
Route::get('produk/kategori/{id}', [KategoriController::class, 'show']);
Route::get('about', [FrontController::class, 'about']);
Route::get('keranjang', [FrontController::class, 'keranjang']);
// harus login masuk ke pembayaran
Route::group(['middleware' => 'auth'], function () {
    Route::get('pembayaran', [FrontController::class, 'pembayaran']);
});

Route::get('blog', [FrontController::class, 'informasi']);
Route::get('contact', [FrontController::class, 'contact']);

// admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', IsAdmin::class]], function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::resource('informasi', App\Http\Controllers\InformasiController::class);
    Route::resource('kategori', App\Http\Controllers\KategoriController::class);
    // Route untuk user lihat detail kategori
    // Route::get('/kategori/{id}', [KategoriController::class, 'showKategoriToUser'])->name('kategori.detail');
    // Route::get('/kategori/{id}', [App\Http\Controllers\KategoriController::class, 'show'])->name('kategori.show');
    // Route untuk detail produk
    Route::get('/produk/{id}', [App\Http\Controllers\ProdukController::class, 'show'])->name('produk.show');
    // Route::resource('produk', App\Http\Controllers\ProdukController::class);
    // Route::resource('image', App\Http\Controllers\ImageController::class);
    Route::resource('method', App\Http\Controllers\MethodController::class);
    Route::resource('pembayaran', App\Http\Controllers\PembayaranController::class);
    Route::resource('keranjang', App\Http\Controllers\KeranjangController::class);
    // Route::post('/keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');

    Route::resource('transaksi', App\Http\Controllers\TransaksiController::class);
    Route::resource('user', App\Http\Controllers\UsersController::class);
    // Route::resource('produk/{produkId}/crete', App\Http\Controllers\ImageController::class);
});
