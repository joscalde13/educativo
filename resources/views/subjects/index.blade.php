@extends('layouts.app')

@section('content')
<div class="container">
 

<hr>



    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gestionar Materias</h2>
        <a href="{{ route('admin.subjects.create') }}" class="btn btn-success">Crear Materia</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Ícono</th>
                    <th>Color del icono</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->id }}</td>
                    <td>{{ $subject->name }}</td>
                    <td><i class="fas fa-{{ $subject->icon }} text-{{ $subject->color }}"></i> </td>
                    <td><span class="badge badge-{{ $subject->color }}" style="display:inline-block; width:120px; height:20px;">&nbsp;</span></td>
                    <td>{{ $subject->description ?? 'Sin descripción' }}</td>
                    <td>
                        <div class="d-flex" role="group">
                            <a href="{{ route('admin.subjects.edit', $subject) }}" class="btn btn-sm btn-primary mr-2">Editar</a>
                            <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta materia?')">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection 