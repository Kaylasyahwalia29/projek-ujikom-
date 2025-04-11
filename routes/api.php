<?php

use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

    //ini route produk
    // Route::get('/', [ProdukController::class, 'index']);          
    // Route::post('/create', [ProdukController::class, 'store']);   
    // Route::get('/{id}', [ProdukController::class, 'show']);     
    // Route::put('/{id}', [ProdukController::class, 'update']);    
    // Route::delete('/{id}', [ProdukController::class, 'destroy']); 

    // ini route kategori
    // Route::get('/', [KategoriController::class, 'index']);
    // Route::post('/create', [KategoriController::class, 'store']);
    // Route::get('/{id}', [KategoriController::class, 'show']);
    // Route::put('/{id}', [KategoriController::class, 'update']);
    // Route::delete('/{id}', [KategoriController::class, 'destroy']);

    // Route::resource('produk', ProdukController::class)->except(['create', 'edit']);
    // Route::resource('kategori', KategoriController::class)->except(['create', 'edit']);
});

Route::apiResource('transaksi', TransaksiController::class);
Route::apiResource('detail-transaksi', DetailTransaksiController::class);

Route::prefix('kategori')->group(function () {
    Route::get('/', [KategoriController::class, 'index']);      
    Route::post('/', [KategoriController::class, 'store']);    
    Route::get('/{id}', [KategoriController::class, 'show']);   
    Route::put('/{id}', [KategoriController::class, 'update']); 
    Route::delete('/{id}', [KategoriController::class, 'destroy']);
    // Route::post('/upload-image', [ProdukController::class, 'uploadImage']);


});

Route::prefix('produk')->group(function () {
    Route::get('/', [ProdukController::class, 'index']);      
    Route::post('/', [ProdukController::class, 'store']);     
    Route::get('/{id}', [ProdukController::class, 'show']);  
    Route::put('/{id}', [ProdukController::class, 'update']); 
    Route::delete('/{id}', [ProdukController::class, 'destroy']);

});
