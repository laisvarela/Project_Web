@extends('layouts.app')
@section('titulo', 'Criar Curso')
@section('conteudo')
    <h1>Criar Produto</h1>
    <form action="{{route('cursos.store')}}" method="POST" class="form-curso">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{old('nome')}}"required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" name="descricao" id="descricao">{{old('descricao')}}</textarea>
        </div>
        <div class="mb-3">
            <label for="disciplinas" class="form-label">Disciplinas</label>
            <select name="disciplinas[]" id="disciplinas" class="form-control" multiple>
                @foreach($disciplinas as $disciplina)
                    <option value="{{ $disciplina->id }}">{{ $disciplina->nome }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
@endsection