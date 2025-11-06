<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class extratoController extends Controller
{
    public function index(){
        $extrato_usuario = User::leftJoin('CONTA_USUARIO', 'users.id', 'CONTA_USUARIO.id_usuario')
        ->join('TRANSACOES', function ($join) {
            $join->on('CONTA_USUARIO.num_conta', '=', 'TRANSACOES.num_conta_destino')
                ->orOn('CONTA_USUARIO.num_conta', '=', 'TRANSACOES.num_conta_origem');
        })
        ->orderBy('data_transacao')
        ->get();

        return view('extrato', compact('extrato_usuario'));
    }
}
