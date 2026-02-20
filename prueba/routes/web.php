<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
Route::get('/', function () { return view('welcome'); });
// Rutas del juego:
Route::get('/ppt', [GameController::class, 'index'])->name('ppt.index');
Route::post('/ppt', [GameController::class, 'play'])->name('ppt.play');
