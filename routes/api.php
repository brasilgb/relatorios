<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [HomeController::class, 'login']);
Route::post('/register', [HomeController::class, 'register']);
Route::get('/listusers', [HomeController::class, 'listUsers']);


// Rotas API Resumos Geral
Route::get('/filiais', [HomeController::class, 'getAllFiliais']);
Route::get('/associacoes', [HomeController::class, 'getAllAssociacao']);
Route::get('/exportacoes', [HomeController::class, 'getAllExportacao']);
Route::get('/totais', [HomeController::class, 'getAllTotais']);

// Rotas API Vendas Lojas
Route::get('/fatulojas', [HomeController::class, 'getAllRelFatuLojas']);
Route::get('/fatugraflojas', [HomeController::class, 'getAllRelGrafVenLojas']);
Route::get('/fatuperfassoclojas', [HomeController::class, 'getAllRelPerfAssocVenLojas']);
Route::get('/fatuperfmeslojas', [HomeController::class, 'getAllRelPerfMesVenLojas']);
Route::get('/fatutotlojas', [HomeController::class, 'getAllRelTotFatLojas']);
Route::get('/fatutotperflojas', [HomeController::class, 'getAllRelTotPerfVenLojas']);

// Rotas API Servicos Lojas
Route::get('/sergrafico', [HomeController::class, 'getLSerGrafico']);
Route::get('/serperform', [HomeController::class, 'getLSerPerform']);
Route::get('/serresumodia', [HomeController::class, 'getLSerResumoDia']);
Route::get('/sertotais', [HomeController::class, 'getLSerTotais']);

// Rotas API Compras Lojas
Route::get('/comcomparadia', [HomeController::class, 'getLComComparadia']);
Route::get('/comgrafico', [HomeController::class, 'getLComGrafico']);
Route::get('/comperfassoc', [HomeController::class, 'getLComPerfAssoc']);
Route::get('/comperfmes', [HomeController::class, 'getLComPerfMes']);
Route::get('/comtotais', [HomeController::class, 'getLComTotais']);

// Rotas Análise de Crédito por filial
Route::get('/analisekpis', [HomeController::class, 'getLAcrKpis']);
Route::get('/analisevencidos', [HomeController::class, 'getLAcrGrafVencidos']);
Route::get('/analiseprojecao', [HomeController::class, 'getLAcrGrafProjecao']);

// Rotas Análise de Crédito totais
Route::get('/analisekpistotal', [HomeController::class, 'getLAcrKpisTotal']);
Route::get('/analisevencidostotal', [HomeController::class, 'getLAcrGrafVencidosTotal']);
Route::get('/analiseprojecaototal', [HomeController::class, 'getLAcrGrafProjecaoTotal']);

// Rotas Gerencial
Route::get('/analisefiliais', [HomeController::class, 'getLGERAnaliseFiliais']);
Route::get('/conversaofiliais', [HomeController::class, 'getLGERConversaoFiliais']);
Route::get('/giroestoque', [HomeController::class, 'getLGERGiroEstoque']);
Route::get('/inadimplencia', [HomeController::class, 'getLGERInadimplencia']);
Route::get('/analisevendedores', [HomeController::class, 'getLGERAnaliseVendedores']);
Route::get('/conversaovendedores', [HomeController::class, 'getLGERConversaoVendedores']);
