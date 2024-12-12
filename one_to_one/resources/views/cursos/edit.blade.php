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
            <label for="disciplina_nome" class="form-label">Disciplina</label>
            <input type="text" class="form-control" id="disciplina_nome" name="disciplina_nome" 
                value="{{ old('disciplina_nome', $curso->disciplina->nome ?? '') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@endsection