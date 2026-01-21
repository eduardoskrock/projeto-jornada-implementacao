<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Migracao extends Model
{
    // Adicione esta linha abaixo:
    protected $fillable = ['nome', 'secao', 'observacao_alerta'];

    // Aproveite para garantir que a relação com os itens da tabela existe
    public function itens()
    {
        return $this->hasMany(ItemMigracao::class);
    }
}