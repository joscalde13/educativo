<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

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

Route::get('/', [GameController::class, 'index'])->name('home');
Route::post('/start-game', [GameController::class, 'startGame'])->name('start-game');
Route::get('/subjects/{student}', [GameController::class, 'subjects'])->name('subjects');
Route::get('/subject/{student}/{subject}', [GameController::class, 'showSubject'])->name('show-subject');
Route::get('/play/{student}/{level}', [GameController::class, 'playLevel'])->name('play-level');
Route::post('/submit-answer/{student}/{level}', [GameController::class, 'submitAnswer'])->name('submit-answer');
