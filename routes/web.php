<?php

use App\Http\Controllers\ProductController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Definimos todas las rutas de nuestros controladores.
Route::get('/productos', [ProductController::class, 'index'])->name('productos');
Route::post('/productos/all', [ProductController::class, 'obtener']);
Route::get('/create', [ProductController::class, 'create'])->name('create');
Route::post('/store', [ProductController::class, 'store'])->name('store');
Route::get('/productos/{id}/edit', [ProductController::class, 'edit']);
Route::put('/productos/{id}', [ProductController::class, 'update'])->name('update');
Route::delete('/productos/{id}', [ProductController::class, 'eliminar']);
