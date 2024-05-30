<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\TransaacionController;
use App\Models\Transaccion;
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

//Definimos todas las rutas de nuestros controladores de los productos.
Route::get('/productos', [ProductController::class, 'index'])->name('productos');
Route::post('/productos', [ProductController::class, 'obtener']);
Route::get('/create', [ProductController::class, 'create'])->name('create');
Route::post('/store', [ProductController::class, 'store'])->name('store');
Route::get('/productos/{id}/edit', [ProductController::class, 'edit']);
Route::put('/productos/{id}', [ProductController::class, 'update'])->name('update');
Route::delete('/productos/{id}', [ProductController::class, 'eliminar']);

//Definimos todas las rutas de nuestros controladores de los proveedores.
Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores');
Route::get('/create', [ProveedorController::class, 'create'])->name('create');
Route::post('/store', [ProveedorController::class, 'store'])->name('store');
Route::get('/proveedor/{id}/edit', [ProveedorController::class, 'edit'])->name('edit');
Route::put('/proveedores/{id}', [ProveedorController::class, 'update'])->name('update');
Route::delete('/proveedores/{id}', [ProveedorController::class, 'delete'])->name('eliminar.proveedor');

//Definimos todas las rutas de nuestros controladores de transaaciones.
Route::get('/transacciones', [TransaacionController::class, 'index'])->name('transaccion');
Route::get('/create', [TransaacionController::class, 'create'])->name('create');
Route::post('/store', [TransaacionController::class, 'store'])->name('store');
Route::get('/transaccion/{id}/edit', [TransaacionController::class, 'edit'])->name('edit');
Route::put('/transaccion/{id}', [TransaacionController::class, 'update'])->name('update');
Route::delete('/trasaccion/{id}', [TransaacionController::class, 'delete'])->name('delete');

