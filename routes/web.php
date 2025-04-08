<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [GameController::class, 'index'])->name('home');

// Rutas de autenticación
Auth::routes(); // ✅ solo una vez

Route::post('/start-game', [GameController::class, 'startGame'])->name('start-game');
Route::post('/find-student', [GameController::class, 'findStudent'])->name('find-student');
Route::get('/subjects/{student}', [GameController::class, 'subjects'])->name('subjects');
Route::get('/subject/{student}/{subject}', [GameController::class, 'showSubject'])->name('show-subject');
Route::get('/play/{student}/{level}', [GameController::class, 'playLevel'])->name('play-level');
Route::post('/submit-answer/{student}/{level}', [GameController::class, 'submitAnswer'])->name('submit-answer');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('levels', \App\Http\Controllers\Admin\LevelController::class);
});
