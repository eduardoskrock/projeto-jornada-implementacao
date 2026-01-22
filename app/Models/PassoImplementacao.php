<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassoImplementacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo', 'segmentos', 'ordem', 'prazo', 'titulo', 'descricao', 'icone'
    ];

    // O CAST É O SEGREDO PARA SALVAR COMO ARRAY
    protected $casts = [
        'segmentos' => 'array',
    ];
}
