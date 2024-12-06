@extends('layouts.app')
@section('titulo', 'Editar Curso')
@section('conteudo')
    <h1>Editar Curso</h1>
    <form action="{{route('cursos.update', $curso->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{old('nome', $curso->nome)}}"required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" name="descricao" id="descricao">{{old('descricao', $curso->descricao)}}</textarea>
        </div>
        <div class="mb-3">
            <label for="disciplinas" class="form-label">Disciplinas</label>
            <select name="disciplinas[]" id="disciplinas" class="form-control" multiple>
            @foreach($disciplinas as $disciplina)
                    <option value="{{ $disciplina->id }}" 
                        {{ in_array($disciplina->id, old('disciplinas', $curso->disciplinas->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>
                        {{ $disciplina->nome }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
@endsection