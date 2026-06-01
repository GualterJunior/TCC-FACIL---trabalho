<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\EtapaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\SorteioController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidacaoController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('projetos', ProjetoController::class)->only(['index', 'show']);
    Route::resource('grupos', GrupoController::class)->only(['index', 'show']);
    Route::resource('temas', TemaController::class)->only(['index', 'show']);
    Route::resource('entregas', EntregaController::class)->only(['index', 'create', 'store', 'show']);

    Route::middleware('role:professor,coordenador')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('projetos', ProjetoController::class)->except(['index', 'show']);
        Route::resource('turmas', TurmaController::class);
        Route::resource('grupos', GrupoController::class)->except(['index', 'show']);
        Route::resource('temas', TemaController::class)->except(['index', 'show']);
        Route::resource('entregas', EntregaController::class)->except(['index', 'create', 'store', 'show']);
        Route::resource('etapas', EtapaController::class);
        Route::resource('notas', NotaController::class);
        Route::resource('sorteios', SorteioController::class);
        Route::resource('validacoes', ValidacaoController::class);
    });
});

require __DIR__.'/auth.php';
