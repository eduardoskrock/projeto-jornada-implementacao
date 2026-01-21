<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcessoRequisito extends Model {
    use HasFactory;
    protected $fillable = ['titulo', 'descricao', 'icone'];
}
