<?php

use App\Http\Controllers\DetailTransaacionController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\TransaacionController;
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

Route::middleware(['auth'])->group(function () {
    //Definimos todas las rutas de nuestros controladores de los productos.
    Route::get('/productos', [ProductController::class, 'index'])->name('productos');
    Route::get('/create/producto', [ProductController::class, 'create'])->name('createproducto');
    Route::post('/store/producto', [ProductController::class, 'store'])->name('productostore');
    Route::get('/productos/{id}/edit', [ProductController::class, 'edit']);
    Route::put('/productos/{id}', [ProductController::class, 'update'])->name('updateproducto');
    Route::delete('/productos/{id}', [ProductController::class, 'eliminar']);

    //Definimos todas las rutas de nuestros controladores de los proveedores.
    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores');
    Route::get('/create/proveedor', [ProveedorController::class, 'create'])->name('proveedorcreate');
    Route::post('/store/proveedor', [ProveedorController::class, 'store'])->name('proveedorstore');
    Route::get('/proveedor/{id}/edit', [ProveedorController::class, 'edit'])->name('edit');
    Route::put('/proveedores/{id}', [ProveedorController::class, 'update'])->name('updateproveedor');
    Route::delete('/proveedores/{id}', [ProveedorController::class, 'delete'])->name('eliminar.proveedor');

    //Definimos todas las rutas de nuestros controladores de transaaciones.
    Route::get('/transacciones', [TransaacionController::class, 'index'])->name('transaccion');
    Route::get('/create/transaccion', [TransaacionController::class, 'create'])->name('transaccioncreate');
    Route::post('/store/transaccion', [TransaacionController::class, 'store'])->name('transaccionstore');
    Route::get('/transaccion/{id}/edit', [TransaacionController::class, 'edit'])->name('edit');
    Route::put('/transaccion/{id}', [TransaacionController::class, 'update'])->name('updatetransaccion');
    Route::delete('/trasaccion/{id}', [TransaacionController::class, 'delete'])->name('delete');

    //Definimos todas las rutas de nuestros controladores de Detalles-transaaciones.
    Route::get('/detalles_transacciones', [DetailTransaacionController::class, 'index'])->name('details');
    Route::get('/create/details', [DetailTransaacionController::class, 'create'])->name('detailscreate');
    Route::post('/store/detailtransaccion', [DetailTransaacionController::class, 'store'])->name('detailtransaccion');
    Route::get('/detail/{id}/edit', [DetailTransaacionController::class, 'edit'])->name('edit');
    Route::put('/detailt/{id}', [DetailTransaacionController::class, 'update'])->name('updatedetailT');
    Route::delete('/detailtransaccion/{id}', [DetailTransaacionController::class, 'delete'])->name('deletedetail');

    //Definimos todas las rutas de nuestros controladores de Inventarios.
    Route::get('/inventarios', [InventarioController::class, 'index'])->name('inventarios');
});
