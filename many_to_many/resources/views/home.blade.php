@extends('layouts.app')
@section('titulo', 'Home')
@section('conteudo')
    <a href="{{route('cursos.index')}}" class="btn btn_primary">Cursos</a><br>
    <a href="{{route('disciplinas.index')}}" class="btn btn_primary">Discilpinas</a>
@endsection