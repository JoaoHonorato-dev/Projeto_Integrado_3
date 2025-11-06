<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\transacaoController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) { return $request->user(); });

// SEU NOVO ENDPOINT 
Route::post('/transacao', [transacaoController::class, 'postTransacao'])->name('api.transacao');
