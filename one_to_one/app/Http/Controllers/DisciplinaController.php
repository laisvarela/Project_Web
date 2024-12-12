<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\Curso;

class DisciplinaController extends Controller
{
    public function index()
    {
        $disciplinas = Disciplina::with('curso')->get(); // Carrega a disciplina com o curso vinculado
        return view('disciplinas.index', compact('disciplinas'));
    }

    public function create()
    {
        $cursos = Curso::doesntHave('disciplina')->get(); // Somente cursos sem disciplinas associadas
        return view('disciplinas.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'curso_id' => 'required|unique:disciplinas,curso_id|exists:cursos,id', // Garante a unicidade
        ]);

        Disciplina::create($request->only(['nome', 'curso_id']));

        return redirect()->route('disciplinas.index')->with('success', 'Disciplina criada com sucesso!');
    }

    public function edit(Disciplina $disciplina)
    {
        $cursos = Curso::doesntHave('disciplina')->orWhere('id', $disciplina->curso_id)->get();
        return view('disciplinas.edit', compact('disciplina', 'cursos'));
    }

    public function update(Request $request, Disciplina $disciplina)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'curso_id' => 'required|unique:disciplinas,curso_id,' . $disciplina->id . '|exists:cursos,id',
        ]);

        $disciplina->update($request->only(['nome', 'curso_id']));

        return redirect()->route('disciplinas.index')->with('success', 'Disciplina atualizada com sucesso!');
    }

    public function destroy(Disciplina $disciplina)
    {
        $disciplina->delete();

        return redirect()->route('disciplinas.index')->with('success', 'Disciplina excluída com sucesso!');
    }
}
