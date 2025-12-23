<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::middleware(['auth', RoleMiddleware::class.':admin'])->group(function () {

        Route::get('/menu', [MenuController::class, 'index']);
        Route::get('/menu/create', [MenuController::class, 'create']);
        Route::post('/menu', [MenuController::class, 'store']);
        Route::get('/menu/{id}/edit', [MenuController::class, 'edit']);
        Route::put('/menu/{id}', [MenuController::class, 'update']);
        Route::delete('/menu/{id}', [MenuController::class, 'destroy']);
    
        Route::get('/user', [UserController::class, 'index']);
        Route::get('/user/create', [UserController::class, 'create']);
        Route::post('/user', [UserController::class, 'store']);
        Route::get('/user/{id}/edit', [UserController::class, 'edit']);
        Route::put('/user/{id}', [UserController::class, 'update']);
        Route::delete('/user/{id}', [UserController::class, 'destroy']);
    });

    Route::middleware(['auth', RoleMiddleware::class.':admin,kasir'])->group(function () {

        Route::get('/transaksi', [TransaksiController::class, 'index']);
        Route::get('/transaksi/create', [TransaksiController::class, 'create']);
        Route::post('/transaksi', [TransaksiController::class, 'store']);
        Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy']);
        
        Route::post('/transaksi/checkout',
         [TransaksiController::class, 'checkout']
                    )->middleware(['auth','role:admin,kasir']);

Route::get('/transaksi/{id}/struk', [TransaksiController::class, 'struk'])
    ->middleware(['auth','role:admin,kasir']);

    Route::get('/transaksi/{id}/bayar',
    [TransaksiController::class, 'bayar']
)->middleware(['auth','role:admin,kasir']);

Route::post('/transaksi/{id}/bayar',
    [TransaksiController::class, 'prosesBayar']
)->middleware(['auth','role:admin,kasir']);




    });
    


    

    Route::get('/dashboard', function () {
        if(auth()->user()->role == 'admin'){
            return view('dashboard.admin');
        }elseif(auth()->user()->role == 'kasir'){
            return view('dashboard.kasir');
        }else{
            return view('dashboard.manager');
        }
    })->name('dashboard');

    // 👇 INI ROUTE MENU (WAJIB)
    Route::resource('menu', MenuController::class);

});

require __DIR__.'/auth.php';
