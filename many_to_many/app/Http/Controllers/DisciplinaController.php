<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\Curso;

class DisciplinaController extends Controller
{
    public function index(){
        $disciplinas = Disciplina::with('cursos')->get(); //Carrega as disciplinas com seus cursos
        return view('disciplinas.index', compact('disciplinas'));
    }

    public function create(){
        $cursos = Curso::all();
        return view('disciplinas.create', compact('cursos'));
    }

    public function edit(Disciplina $disciplina){
        $cursos = Curso::all(); // Busca todos os cursos para exibição
        return view('disciplinas.edit', compact('disciplina', 'cursos'));
    }

    public function store(Request $request){
        $request->validate([
            'nome' => 'required|string|max:255',
            'cursos' => 'array|exists:cursos,id', // Validação para múltiplos cursos
        ]);

        // Criando nova disciplina
        $disciplina = Disciplina::create($request->only(['nome']));
        // Associa cursos à disciplina
        if ($request->has('cursos')) {
            $disciplina->cursos()->attach($request->cursos);
        }
        // Redireciona para a página de disciplinas com sucesso
        return redirect()->route('disciplinas.index')->with('success', 'Disciplina criada com sucesso!');
    }

    public function update(Request $request, Disciplina $disciplina){
        // Validação dos dados recebidos
        $request->validate([
            'nome' => 'required|string|max:255',
            'cursos' => 'array|exists:cursos,id', // Validação para múltiplos cursos
        ]);

        // Atualiza a disciplina com os novos dados
        $disciplina->update($request->only(['nome']));
        // Sincroniza os cursos associados à disciplina
        $disciplina->cursos()->sync($request->cursos);
        // Redireciona para a página de disciplinas com sucesso
        return redirect()->route('disciplinas.index')->with('success', 'Disciplina atualizada com sucesso!');
    }
}
