<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProductController as PublicProductController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/products', [PublicProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [PublicProductController::class, 'show'])->name('products.show');
Route::get('/products/image/{imageName}', [PublicProductController::class, 'image'])->name('products.image');

Route::prefix('carts')->name('carts.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index'); 
    Route::get('/add/{id}', [CartController::class, 'add'])->name('add'); 
    Route::patch('/update', [CartController::class, 'update'])->name('update'); 
    Route::delete('/remove', [CartController::class, 'destroy'])->name('remove'); 
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});
