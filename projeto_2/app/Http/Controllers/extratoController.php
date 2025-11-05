<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class extratoController extends Controller
{
    public function index(){
        $extrato_usuario = User::leftJoin('CONTA_USUARIO', 'users.id', 'CONTA_USUARIO.id_usuario')
        ->leftJoin('TRANSACOES', 'CONTA_USUARIO.num_conta', 'TRANSACOES.num_conta_destino')
        ->get();
        dd($extrato_usuario);

        return view('extrato');
    }
}
