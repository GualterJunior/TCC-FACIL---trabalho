<?php

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

// 1. Rota Principal: Redireciona quem acessa a raiz (localhost:8000) para o dashboard
Route::get('/', function () {
    return redirect('/aluno/dashboard');
});

// 2. Rota do Dashboard: Exibe a interface visual que você criou
Route::get('/aluno/dashboard', function () {
    return view('aluno.dashboard');
});

// Rotas de Recursos para o CRUD do Sistema
Route::resource('users', UserController::class);

Route::resource('turmas', TurmaController::class);

Route::resource('grupos', GrupoController::class);

Route::resource('temas', TemaController::class);

Route::resource('entregas', EntregaController::class);

Route::resource('etapas', EtapaController::class);

Route::resource('notas', NotaController::class);

Route::resource('sorteios', SorteioController::class);

Route::resource('validacoes', ValidacaoController::class);
