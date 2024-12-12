@extends('layouts.app')
@section('titulo','Disciplinas')
@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Disciplinas</h1>
        <a href="{{ route('disciplinas.create') }}" class="btn btn-primary">Nova Disciplina</a>
    </div>
    
    @if($disciplinas->isEmpty())
        <div class="alert alert-warning" role="alert">Nenhuma disciplina cadastrada no momento.</div>
    @else
        <table class="table table-hover table-striped table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Curso</th>
                    <th>Ações</th>
                    <th>Curso</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($disciplinas as $disciplina)
                    <tr>
                        <td>{{ $disciplina->id }}</td>
                        <td>{{ $disciplina->nome }}</td>
                        <td>{{ $disciplina->curso->nome ?? 'Sem curso' }}</td> <!-- Exibe o nome do curso -->
                        <td>
                            <a href="{{ route('disciplinas.edit', $disciplina->id) }}" class="btn btn-primary">Editar</a>
                            <!-- Aqui você pode adicionar a funcionalidade de excluir -->
                            <form method="POST" action="{{ route('disciplinas.destroy', $disciplina->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
