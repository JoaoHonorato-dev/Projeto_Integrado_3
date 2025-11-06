<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CONTA_USUARIO extends Model
{
    use HasFactory;

    // Define o nome da tabela, se for diferente do plural automático "xs"
    protected $table = 'CONTA_USUARIO';
    protected $primaryKey = 'num_conta';

    // Define os campos que podem ser preenchidos em massa (mass assignment)
    protected $fillable = [
        'cod_conta_usuario',
        'id_usuario',
        'num_conta',
    ];
    public $timestamps = false;
}
