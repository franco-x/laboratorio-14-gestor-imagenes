<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('album.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // RUTAS DE ÁLBUMES
    Route::get('/album', [AlbumController::class, 'mostrar'])->name('album.index');
    Route::get('/album/crear', [AlbumController::class, 'getCrear'])->name('album.crear');
    Route::post('/album/crear', [AlbumController::class, 'postCrear'])->name('album.crear.post');

    Route::get('/album/{album}/editar', [AlbumController::class, 'edit'])->name('album.edit');
    Route::put('/album/{album}', [AlbumController::class, 'update'])->name('album.update');
    Route::delete('/album/{album}', [AlbumController::class, 'destroy'])->name('album.destroy');

    // RUTAS DE FOTOS
    Route::get('/album/fotos', [FotoController::class, 'index'])->name('foto.index');
    Route::get('/foto/crear', [FotoController::class, 'getCrear'])->name('foto.crear');
    Route::post('/foto/crear', [FotoController::class, 'postCrear'])->name('foto.crear.post');

    Route::get('/foto/{foto}/editar', [FotoController::class, 'edit'])->name('foto.edit');
    Route::put('/foto/{foto}', [FotoController::class, 'update'])->name('foto.update');
    Route::delete('/foto/{foto}', [FotoController::class, 'destroy'])->name('foto.destroy');

    // RUTAS DE PERFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';