<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/extrato', [\App\Http\Controllers\extratoController::class, 'index'])->name('extrato');

