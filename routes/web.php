<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SubjectController;

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

Route::get('/', [GameController::class, 'index'])->name('welcome');



Auth::routes();

Route::post('/start-game', [GameController::class, 'startGame'])->name('start-game');

Route::post('/find-student', [GameController::class, 'findStudent'])->name('find-student');

Route::get('/subjects/{student}', [GameController::class, 'subjects'])->name('subjects');

Route::get('/subject/{student}/{subject}', [GameController::class, 'showSubject'])->name('show-subject');

Route::get('/play/{student}/{level}', [GameController::class, 'playLevel'])->name('play-level');

Route::post('/submit-answer/{student}/{level}', [GameController::class, 'submitAnswer'])->name('submit-answer');

Route::get('/ranking-global', [GameController::class, 'rankingGlobal']);


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('levels', \App\Http\Controllers\Admin\LevelController::class);
    Route::resource('subjects', \App\Http\Controllers\SubjectController::class);
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

