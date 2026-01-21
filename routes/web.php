<?php

use App\Http\Controllers\JornadaController;
use App\Http\Controllers\Admin\JornadaAdminController;

// Site do Cliente
Route::get('/jornada', [JornadaController::class, 'index'])->name('jornada.index');

// API para buscar detalhes via JS (para o modal "Saiba Mais")
Route::get('/api/migracao/{id}', [JornadaController::class, 'getDetails']);

Route::prefix('admin')->group(function () {
    Route::get('/jornada', [JornadaAdminController::class, 'index'])->name('admin.index');
    Route::get('/migracao/criar', [JornadaAdminController::class, 'create'])->name('migracao.create');
    Route::post('/migracao', [JornadaAdminController::class, 'store'])->name('migracao.store');
    Route::get('/migracao/{id}/editar', [JornadaAdminController::class, 'edit'])->name('migracao.edit');
    Route::put('/migracao/{id}', [JornadaAdminController::class, 'update'])->name('migracao.update'); // Note o PUT
    Route::delete('/migracao/{id}', [JornadaAdminController::class, 'destroy'])->name('migracao.destroy');
    Route::post('/passos', [JornadaAdminController::class, 'storePasso'])->name('passos.store');
    Route::put('/passos/{id}', [JornadaAdminController::class, 'updatePasso'])->name('passos.update'); // Caso tenha criado updatePasso no controller
    Route::delete('/passos/{id}', [JornadaAdminController::class, 'destroyPasso'])->name('passos.destroy'); // Caso tenha criado destroyPasso no controller
    Route::post('/requisitos', [JornadaAdminController::class, 'storeRequisito'])->name('admin.requisito.store');
    Route::put('/requisitos/{id}', [JornadaAdminController::class, 'updateRequisito'])->name('admin.requisito.update');
    Route::delete('/requisitos/{id}', [JornadaAdminController::class, 'destroyRequisito'])->name('admin.requisito.destroy');
    Route::post('/perguntas', [JornadaAdminController::class, 'storePergunta'])->name('admin.pergunta.store');
    Route::put('/perguntas/{id}', [JornadaAdminController::class, 'updatePergunta'])->name('admin.pergunta.update');
    Route::delete('/perguntas/{id}', [JornadaAdminController::class, 'destroyPergunta'])->name('admin.pergunta.destroy');
    Route::post('/equipamentos', [JornadaAdminController::class, 'storeEquipamento'])->name('admin.equipamento.store');
    Route::put('/equipamentos/{id}', [JornadaAdminController::class, 'updateEquipamento'])->name('admin.equipamento.update');
    Route::delete('/equipamentos/{id}', [JornadaAdminController::class, 'destroyEquipamento'])->name('admin.equipamento.destroy');
    Route::post('/implementacao', [JornadaAdminController::class, 'storeImplementacao'])->name('admin.implementacao.store');
    Route::put('/implementacao/{id}', [JornadaAdminController::class, 'updateImplementacao'])->name('admin.implementacao.update');
    Route::delete('/implementacao/{id}', [JornadaAdminController::class, 'destroyImplementacao'])->name('admin.implementacao.destroy');
});
