<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DisciplinaController;

Route::get('/', function () {
    return view('home');
});

Route::resource('cursos', CursoController::class);
Route::resource('disciplinas', DisciplinaController::class);

