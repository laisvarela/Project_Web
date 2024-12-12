<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    // Adicione 'nome' e 'descricao' ao fillable
    protected $fillable = [
        'nome', // Permite a atribuição em massa para o campo 'nome'
        'descricao', // Permite a atribuição em massa para o campo 'descricao'
    ];

    public function disciplina()
    {
        return $this->hasOne(Disciplina::class);
    }
    
}


