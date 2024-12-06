<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\Curso;

class DisciplinaController extends Controller
{
    public function index(){
        $disciplinas = Disciplina::all();
        return view('disciplinas.index', compact('disciplinas'));
    }

    public function create(){
        $cursos = Curso::all();
        return view('disciplinas.create', compact('cursos'));
    }

    public function edit(Disciplina $disciplina){
        $cursos = Curso::all();
        return view('disciplinas.edit', compact('disciplina', 'cursos'));
    }
    
    public function store(Request $request){
        $request->validate([
            'nome' => 'required|string|max:255',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        // Criando nova disciplina
        Disciplina::create($request->only(['nome', 'curso_id']));

        // Redireciona para a página de disciplinas com sucesso
        return redirect()->route('disciplinas.index')->with('success', 'Disciplina criada com sucesso!');
    }

    public function update(Request $request, Disciplina $disciplina){
        // Validação dos dados recebidos
        $request->validate([
            'nome' => 'required|string|max:255',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        // Atualiza a disciplina com os novos dados
        $disciplina->update($request->only(['nome', 'curso_id']));

        // Redireciona para a página de disciplinas com sucesso
        return redirect()->route('disciplinas.index')->with('success', 'Disciplina atualizada com sucesso!');
    }

    public function destroy(Disciplina $disciplina)
    {
        // Excluir a disciplina
        $disciplina->delete();

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('disciplinas.index')->with('success', 'Disciplina excluída com sucesso!');
    }
}
