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
            <label for="disciplina_nome" class="form-label">Disciplina</label>
            <input type="text" class="form-control" id="disciplina_nome" name="disciplina_nome" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@endsection