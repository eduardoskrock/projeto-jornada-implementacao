<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemMigracao extends Model
{
    protected $fillable = ['migracao_id', 'dado', 'importa', 'observacao', 'arquivo'];
}