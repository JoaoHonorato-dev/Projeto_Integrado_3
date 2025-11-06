<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CadastroUsuarioController extends Controller
{
    public function create(){
        return view('cadastro_usuario');
    }
}
