@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-lg border-0">
                <div class="card-header d-flex align-items-center bg-white">
                    <h4 class="mb-0 font-weight-bold text-primary">Gestión de Niveles y Materias</h4>
                    <div class="ml-auto">
                        <a href="{{ route('admin.levels.create') }}" class="btn btn-success btn-sm font-weight-bold text-white">
                            <i class="fas fa-plus mr-1"></i> Crear Nuevo Nivel
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @foreach($subjects as $subject)
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0 font-weight-bold"><i class="fas fa-book mr-2"></i>{{ $subject->name }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th style="width: 10%">Nivel</th>
                                                <th style="width: 40%">Título</th>
                                                <th style="width: 15%">Puntos</th>
                                                <th style="width: 20%">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($subject->levels as $level)
                                                <tr>
                                                    <td class="font-weight-bold">{{ $level->level_number }}</td>
                                                    <td>{{ $level->title }}</td>
                                                    <td><span class="badge badge-success">{{ $level->points }}</span></td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('admin.levels.edit', $level) }}" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i> Editar</a>
                                                            <form action="{{ route('admin.levels.destroy', $level) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este nivel?')">
                                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                                </button>
                                                            </form>
                                                        </div>
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