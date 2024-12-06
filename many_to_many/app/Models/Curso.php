<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['nome',  'descricao'];
    
    /*//one do many
    public function disciplinas(){
        return $this->hasMany(Disciplina::class);
    }*/

    //many to many
    public function disciplinas(){
        return $this->belongsToMany(Disciplina::class, 'curso_disciplina', 'curso_id', 'disciplina_id');
    }
}


