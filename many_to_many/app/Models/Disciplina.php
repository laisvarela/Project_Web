<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];
    /* one to many
    public function curso(){
        return $this->belongsTo(Curso::class);
    }*/
    
    //many to many
    public function cursos(){
        return $this->belongsToMany(Curso::class, 'curso_disciplina', 'disciplina_id', 'curso_id');
    }
}
