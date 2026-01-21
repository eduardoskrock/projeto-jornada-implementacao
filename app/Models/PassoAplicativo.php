<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassoAplicativo extends Model
{
    use HasFactory;

    // Garante que a tabela seja a correta
    protected $table = 'passos_apps'; 

    // Libera esses campos para serem salvos pelo formulário
    protected $fillable = [
    'numero', 
    'titulo', 
    'descricao', 
    'responsabilidade', 
    'prazo' 
    ];
}