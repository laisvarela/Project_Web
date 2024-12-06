<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Disciplina;

class CursoController extends Controller
{
    /* ONE TO MANY

    public function index(){
        $cursos = Curso::with('disciplinas')->get();
        return view('cursos.index', compact('cursos'));
    }

    public function create(){
        return view('cursos.create');
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
   
    public function edit(Curso $curso){
        return view('cursos.edit', compact('curso'));
    }

    public function update(Request $request, Curso $curso){
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $curso->update($request->except('_token'));
        return redirect()->route('cursos.index')->with('success', 'Curso atualizado com sucesso!');
    }
    */
    // MANY TO MANY

    public function index()
    {
        $cursos = Curso::with('disciplinas')->get(); // Carrega os cursos com suas disciplinas
        return view('cursos.index', compact('cursos'));
    }

    public function create(){
        $disciplinas = Disciplina::all(); // Busca todas as disciplinas do banco
        return view('cursos.create', compact('disciplinas')); // Passa as disciplinas para a view
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'disciplinas' => 'array|exists:disciplinas,id', // Validação para múltiplas disciplinas
        ]);

        $curso = Curso::create($request->only(['nome', 'descricao']));

        // Associa disciplinas ao curso
        if ($request->has('disciplinas')) {
            $curso->disciplinas()->attach($request->disciplinas);
        }return redirect()->route('cursos.index')->with('success', 'Curso criado com sucesso!');
    }

    public function update(Request $request, Curso $curso){
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'disciplinas' => 'array|exists:disciplinas,id', // Validação para múltiplas disciplinas
        ]);

        $curso->update($request->only(['nome', 'descricao']));
        $curso->disciplinas()->sync($request->disciplinas); // Sincroniza as disciplinas associadas ao curso
        return redirect()->route('cursos.index')->with('success', 'Curso atualizado com sucesso!');
    }

    public function edit(Curso $curso){
        $disciplinas = Disciplina::all(); //Busca todas as disciplinas para exibição
        return view('cursos.edit', compact('curso', 'disciplinas'));
    }
    public function destroy(Curso $curso)
    {
        // Excluir a disciplina
        $curso->delete();

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('curso.index')->with('success', 'Disciplina excluída com sucesso!');
    }
}
