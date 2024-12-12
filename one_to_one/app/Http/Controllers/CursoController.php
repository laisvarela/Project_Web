<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Disciplina;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::with('disciplina')->get(); // Carrega o curso com a disciplina vinculada
        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'disciplina_nome' => 'required|string|max:255', // Nome da disciplina associado
        ]);

        $curso = Curso::create($request->only(['nome', 'descricao']));

        // Cria a disciplina vinculada ao curso
        Disciplina::create([
            'nome' => $request->disciplina_nome,
            'curso_id' => $curso->id,
        ]);

        return redirect()->route('cursos.index')->with('success', 'Curso e disciplina criados com sucesso!');
    }

    public function edit(Curso $curso)
    {
        return view('cursos.edit', compact('curso'));
    }

    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'disciplina_nome' => 'required|string|max:255',
        ]);
        $curso->update($request->only(['nome', 'descricao']));

        // Atualiza a disciplina vinculada ao curso
        $curso->disciplina->update([
            'nome' => $request->disciplina_nome,
        ]);

        return redirect()->route('cursos.index')->with('success', 'Curso e disciplina atualizados com sucesso!');
    }

    public function destroy(Curso $curso)
    {
        // Exclui automaticamente a disciplina vinculada devido à regra `onDelete('cascade')`
        $curso->delete();

        return redirect()->route('cursos.index')->with('success', 'Curso e disciplina excluídos com sucesso!');
    }
}