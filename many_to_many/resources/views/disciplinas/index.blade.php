@extends('layouts.app')

@section('titulo', 'Lista de Disciplinas')

@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Lista de Disciplinas</h1>
        <a href="{{ route('disciplinas.create') }}" class="btn btn-primary">Nova Disciplina</a>
    </div>

    @if ($disciplinas->isEmpty())
        <div class="alert alert-warning" role="alert">
            Nenhuma disciplina cadastrada no momento.
            </div>
    @else
        <table class="table table-hover table-striped table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Cursos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($disciplinas as $disciplina)
                    <tr>
                        <td>{{ $disciplina->id }}</td>
                        <td>{{ $disciplina->nome }}</td>
                        <td>
                            {{ $disciplina->cursos->pluck('nome')->join(', ') ?? 'Nenhum' }}
                        </td>
                        <td>
                            <a href="{{ route('disciplinas.edit', $disciplina->id) }}" class="btn btn-sm btn-warning me-2">Editar</a>
                            <form action="{{ route('disciplinas.destroy', $disciplina->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta disciplina?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection