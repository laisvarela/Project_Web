@extends('layouts.app')
@section('titulo', 'Editar Disciplina')
@section('conteudo')
    <h1>Editar Disciplina</h1>
    <form action="{{ route('disciplinas.update', $disciplina->id) }}" method="POST" class="form-cadastro">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $disciplina->nome) }}" required>
        </div>
        <div class="mb-3">
            <label for="cursos" class="form-label">Cursos</label>
            <select name="cursos[]" id="cursos" class="form-control" multiple>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}" 
                        {{ in_array($curso->id, old('cursos', $disciplina->cursos->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>
                        {{ $curso->nome }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('disciplinas.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
@endsection
