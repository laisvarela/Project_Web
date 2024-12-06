@extends('layouts.app')
@section('titulo', 'Cadastrar Disciplina')
@section('conteudo')
    <h1>Cadastrar Disciplina</h1>
    <form action="{{route('disciplinas.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Disciplina</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{old('nome')}}"required>
        </div>
        <div class="mb-3">
            <label for="curso_id" class="form-label">Selecione o Curso</label>
            <select name="curso_id" id="curso_id" class="form-label" required>
                <option value="">Selecione um curso</option>
                @foreach($cursos as $curso)
                    <option value="{{$curso->id}}">{{$curso->nome}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@endsection