<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// CONTROLLERS
use App\Http\Controllers\UserController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\EtapaController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\SorteioController;
use App\Http\Controllers\ValidacaoController;


Route::get('/', function () {

    return response()->json([
        'message' => 'API TCC FACIL ONLINE'
    ]);

});

Route::apiResource('users', UserController::class);

Route::apiResource('turmas', TurmaController::class);

Route::apiResource('grupos', GrupoController::class);

Route::apiResource('temas', TemaController::class);

Route::apiResource('entregas', EntregaController::class);

Route::apiResource('etapas', EtapaController::class);

Route::apiResource('notas', NotaController::class);

Route::apiResource('sorteios', SorteioController::class);

Route::apiResource('validacoes', ValidacaoController::class);