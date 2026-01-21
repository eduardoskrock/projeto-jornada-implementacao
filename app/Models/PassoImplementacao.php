<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassoImplementacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo', 'ordem', 'prazo', 'titulo', 'descricao', 'icone'
    ];
}
