<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NaturovosController;
use App\Http\Controllers\SupermercadosController;
use App\Http\Controllers\AppBgImagesController;
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

/**
 * Aplicações de usuarios
 */
Route::post('/login', [HomeController::class, 'login']);
Route::post('/register', [HomeController::class, 'register']);
Route::get('/listusers', [HomeController::class, 'listUsers']);
Route::post('/listusersaccess', [HomeController::class, 'listUsersAccess']);

/**
 * Aplicações de resumos geral Rede Solar *************************************************
 */
// Filiais com metas e dados referentes
Route::get('/filiaisativas', [HomeController::class, 'getFiliaisAtivas']);
// Rotas API Resumos Geral
Route::get('/filiais/{date}', [HomeController::class, 'getAllFiliais']);
Route::get('/associacoes/{date}', [HomeController::class, 'getAllAssociacao']);
Route::get('/exportacoes/{date}', [HomeController::class, 'getAllExportacao']);
Route::get('/totais/{date}', [HomeController::class, 'getAllTotais']);

/**
 * Aplicações Lojas Solar
 */

// Rotas API Vendas Lojas
Route::get('/fatulojas/{date}', [HomeController::class, 'getAllRelFatuLojas']);
Route::get('/fatugraflojas/{date}', [HomeController::class, 'getAllRelGrafVenLojas']);
Route::get('/fatuperfassoclojas/{date}', [HomeController::class, 'getAllRelPerfAssocVenLojas']);
Route::get('/fatuperfmeslojas/{date}', [HomeController::class, 'getAllRelPerfMesVenLojas']);
Route::get('/fatutotlojas/{date}', [HomeController::class, 'getAllRelTotFatLojas']);
Route::get('/fatutotperflojas/{date}', [HomeController::class, 'getAllRelTotPerfVenLojas']);

// Rotas API Servicos Lojas
Route::get('/sergrafico/{date}', [HomeController::class, 'getLSerGrafico']);
Route::get('/serperform/{date}', [HomeController::class, 'getLSerPerform']);
Route::get('/serresumodia/{date}', [HomeController::class, 'getLSerResumoDia']);
Route::get('/sertotais/{date}', [HomeController::class, 'getLSerTotais']);

// Rotas API Compras Lojas
Route::get('/comcomparadia/{date}', [HomeController::class, 'getLComComparadia']);
Route::get('/comgrafico/{date}', [HomeController::class, 'getLComGrafico']);
Route::get('/comperfassoc/{date}', [HomeController::class, 'getLComPerfAssoc']);
Route::get('/comperfmes/{date}', [HomeController::class, 'getLComPerfMes']);
Route::get('/comtotais/{date}', [HomeController::class, 'getLComTotais']);

// Rotas Análise de Crédito por filial
Route::get('/analisekpis/{filial}', [HomeController::class, 'getLAcrKpis']);
Route::get('/analisevencidos/{filial}', [HomeController::class, 'getLAcrGrafVencidos']);
Route::get('/analiseprojecao/{filial}', [HomeController::class, 'getLAcrGrafProjecao']);

// Rotas Análise de Crédito totais
Route::get('/analisekpistotal', [HomeController::class, 'getLAcrKpisTotal']);
Route::get('/analisevencidostotal', [HomeController::class, 'getLAcrGrafVencidosTotal']);
Route::get('/analiseprojecaototal', [HomeController::class, 'getLAcrGrafProjecaoTotal']);

// Rotas Gerencial
Route::get('/analisefiliais/{filial}', [HomeController::class, 'getLGERAnaliseFiliais']);
Route::get('/conversaofiliais', [HomeController::class, 'getLGERConversaoFiliais']);
Route::get('/giroestoque/{filial}', [HomeController::class, 'getLGERGiroEstoque']);
Route::get('/inadimplencia/{filial}', [HomeController::class, 'getLGERInadimplencia']);
Route::get('/girosubgrupo/{filial}', [HomeController::class, 'getLGERGiroSubGrupo']);
Route::get('/analisevendedores/{filial}', [HomeController::class, 'getLGERAnaliseVendedores']);
Route::get('/conversaovendedores/{filial}', [HomeController::class, 'getLGERConversaoVendedores']);
Route::get('/margemvendedor/{filial}', [HomeController::class, 'getLGERMargemVendedor']);

/**
 * Aplicações Naturovos *****************************************************************
 */

//  Rotas de faturamento Naturovos
Route::get('/nfatuassoc/{date}', [NaturovosController::class, 'getNRFatAssoc']);
Route::get('/nfatugrafico/{date}', [NaturovosController::class, 'getNRFatGrafico']);
Route::get('/nfatugrupo/{date}', [NaturovosController::class, 'getNRFatGrupo']);
Route::get('/nfatuperfassoc/{date}', [NaturovosController::class, 'getNRFatPerfAssoc']);
Route::get('/nfatuperfgrupo/{date}', [NaturovosController::class, 'getNRFatPerfGrupo']);
Route::get('/nfatuperfmes/{date}', [NaturovosController::class, 'getNRFatPerfMes']);
Route::get('/nfatuperfsetor/{date}', [NaturovosController::class, 'getNRFatPerfSetor']);
Route::get('/nfatusetor/{date}', [NaturovosController::class, 'getNRFatSetor']);
Route::get('/nfatutotais/{date}', [NaturovosController::class, 'getNRFatTotais']);

// Rotas de compras Naturovos
Route::get('/ncomtipo/{date}', [NaturovosController::class, 'getNRCTipo']);
Route::get('/ncomperftipo/{date}', [NaturovosController::class, 'getNRCPerfTipo']);
Route::get('/ncomgrafico/{date}', [NaturovosController::class, 'getNRCGrafico']);
Route::get('/ncomperfmes/{date}', [NaturovosController::class, 'getNRCPerfMes']);
Route::get('/ncomtotal/{date}', [NaturovosController::class, 'getNRCTotal']);

// Rotas de Resumos Naturovos
Route::get('/nresassoc/{date}', [NaturovosController::class, 'getNRResAssoc']);
Route::get('/nresgrupo/{date}', [NaturovosController::class, 'getNRResGrupo']);
Route::get('/nresgrafico/{date}', [NaturovosController::class, 'getNRResGrafico']);
Route::get('/nrestotais/{date}', [NaturovosController::class, 'getNRResTotais']);

// Rotas de faturamento Supermercados
Route::get('sfatcomparativo/{date}', [SupermercadosController::class, 'getSRFatComparativo']);
Route::get('sfatgrafico/{date}', [SupermercadosController::class, 'getSRFatGrafico']);
Route::get('sfatperfassoc/{date}', [SupermercadosController::class, 'getSRFatPerfAssoc']);
Route::get('sfatperfmes/{date}', [SupermercadosController::class, 'getSRFatPerfMes']);
Route::get('sfattotais/{date}', [SupermercadosController::class, 'getSRFatTotais']);

// Rotas de compras Supermercados
Route::get('scomcomparativo/{date}', [SupermercadosController::class, 'getSRComComparativo']);
Route::get('scomgrafico/{date}', [SupermercadosController::class, 'getSRComGrafico']);
Route::get('scomperfassoc/{date}', [SupermercadosController::class, 'getSRComPerfAssoc']);
Route::get('scomperfmes/{date}', [SupermercadosController::class, 'getSRComPerfMes']);
Route::get('scomtotais/{date}', [SupermercadosController::class, 'getSRSRComTotais']);

// Rotas Imagens APPs
Route::get('/getbgimage', [AppBgImagesController::class, 'index']);
Route::post('/addbgimage', [AppBgImagesController::class, 'store']);

// Rotas API APP TV
Route::get('/tvfaturamento', [HomeController::class, 'getTVFaturamento']);
Route::get('/tvevolucao', [HomeController::class, 'getTVEvolucao']);

// Rotas Faturamento Gerencial
Route::get('/gerfilialfatudia/{filial}', [HomeController::class, 'getLGERFilialFatuDia']);
Route::get('/gerfilialfatutotal/{filial}', [HomeController::class, 'getLGERFilialFatuTotal']);
Route::get('/gerfilialgrafico/{filial}', [HomeController::class, 'getLGERFilialGrafico']);
Route::get('/gerfilialassoc/{filial}', [HomeController::class, 'getLGERFilialAssoc']);
Route::get('/gerfilialtotalassoc/{filial}', [HomeController::class, 'getLGERFilialTotalAssoc']);
Route::get('/gerfilialmes/{filial}', [HomeController::class, 'getLGERFilialMes']);