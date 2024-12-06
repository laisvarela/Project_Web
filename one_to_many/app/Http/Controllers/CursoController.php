<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{
    public function index(){
        $cursos = Curso::with('disciplinas')->get();
        return view('cursos.index', compact('cursos'));
    }

    public function create(){
        return view('cursos.create');
    }

    public function edit(Curso $curso){
        return view('cursos.edit', compact('curso'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        Curso::create($request->except('_token'));

        return redirect()->route('cursos.index')->with('success', 'Curso criado com sucesso!');
    }
    
    public function update(Request $request, Curso $curso){
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $curso->update($request->except('_token'));
        return redirect()->route('cursos.index')->with('success', 'Curso atualizado com sucesso!');
    }
}
