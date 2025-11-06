<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TRANSACOES extends Model
{
    use HasFactory;

    // Define o nome da tabela, se for diferente do plural automático "xs"
    protected $table = 'TRANSACOES';

    // Define os campos que podem ser preenchidos em massa (mass assignment)
    protected $fillable = [
        'num_conta_origem',
        'num_conta_destino',
        'valor',
        'cod_unico_transacao',
        'status',
        'data_transacao'
    ];
    public $timestamps = false;
}
