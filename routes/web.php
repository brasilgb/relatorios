<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NaturovosController;
use App\Http\Controllers\SupermercadosController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/resumo', [HomeController::class, 'resumo'])->name('resumo');

Route::get('/naturovos', [NaturovosController::class, 'index']);
Route::get('/supermercados', [SupermercadosController::class, 'index']);
