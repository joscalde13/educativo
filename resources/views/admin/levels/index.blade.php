@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{ route('home') }}" class=" btn-primary">Ver Métricas del Sistema</a>
            <hr>
            <div class="card">
                 
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Gestión de Niveles y Materias</span>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.subjects.index') }}" class="btn btn-success btn-sm">Crear Materia</a>
                        <a href="{{ route('admin.levels.create') }}" class="btn btn-primary btn-sm">Crear Nuevo Nivel</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @foreach($subjects as $subject)
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">{{ $subject->name }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nivel</th>
                                                <th>Título</th>
                                                <th>Puntos</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($subject->levels as $level)
                                                <tr>
                                                    <td>{{ $level->level_number }}</td>
                                                    <td>{{ $level->title }}</td>
                                                    <td>{{ $level->points }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.levels.edit', $level) }}" class="btn btn-sm btn-primary">Editar</a>
                                                        <form action="{{ route('admin.levels.destroy', $level) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este nivel?')">Eliminar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 