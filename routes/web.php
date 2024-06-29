<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\inicioController;
use App\Http\Controllers\productoController;
use App\Http\Controllers\rolController;

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

Route::get('/', inicioController::class);

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {

    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

    Route::controller(productoController::class)->group(function(){

        route::get('producto', 'principal')->name('producto.principal');
    
        Route::get('producto/{variable}/mostrar', 'mostrar')->name('producto.mostrar');
    
        route::get('producto/crear', 'crear')->name('producto.crear');
    
        route::post('producto','store')->name('producto.store');
    
        route::get('producto/{producto}/edit', 'editar')->name('producto.editar');
    
        route::put('producto/{producto}', 'update')->name('producto.update');
    
        route::delete('producto/{id}', 'borrar')->name('producto.borrar');
    
        route::get('desactiva/{id}', 'desactivaproducto')->name('desactivapro');
    
        route::get('activa/{id}', 'activaproducto')->name('activapro');
    });    

    Route::controller(rolController::class)->group(function(){

        route::get('principalRol', 'principal')->name('rol.principal');

        Route::get('principalRol/{variable}/mostrar', 'mostrar')->name('rol.mostrar');
    
        route::get('principalRol/crear', 'crear')->name('rol.crear');

        route::post('principalRol','store')->name('rol.store');
    
        route::get('principalRol/{producto}/edit', 'editar')->name('rol.editar');

        route::put('principalRol/{producto}', 'update')->name('rol.update');

        route::delete('principalRol/{id}', 'borrar')->name('rol.borrar');
    
        route::get('desactiva/{id}', 'desactivaproducto')->name('desactivapro');
    
        route::get('activa/{id}', 'activaproducto')->name('activapro');
        
    }); 

});
