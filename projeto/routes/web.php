<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::prefix('extrato')->group(function () {
    Route::controller(\App\Http\Controllers\extratoController::class)->group(function () {
        Route::get('', 'index')->name('extrato'); 
        Route::get('{id_transacao}/detalhes', 'detalhes')->name('extrato.detalhes');
    });
});

Route::prefix('usuario')->group(function () {
    Route::controller(\App\Http\Controllers\CadastroUsuarioController::class)->group(function () {
        Route::get('create', 'create')->name('usuario.create'); 
        Route::post('store', 'store')->name('usuario.store'); 
    });
});

