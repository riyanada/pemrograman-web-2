<?php

use App\Http\Controllers\BlogController;
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

Route::get('/blog', [BlogController::class, 'home'])->name('blog');
Route::get('/blog/tentang', [BlogController::class, 'tentang'])->name('blog.tentang');
Route::get('/blog/kontak', [BlogController::class, 'kontak'])->name('blog.kontak');