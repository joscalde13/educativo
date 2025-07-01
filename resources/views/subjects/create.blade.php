@extends('layouts.app')

@section('content')



<div class="container">
    
    <h2>Crear Materia</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('admin.subjects.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre de la materia</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="icon" class="form-label">Ícono</label>
            <select name="icon" class="form-select" required>
                <option value="calculator">Calculadora</option>
                <option value="leaf">Hoja</option>
                <option value="book-open">Libro abierto</option>
                <option value="landmark">Historia</option>
                <option value="flask">Ciencia</option>
                <option value="palette">Arte</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <select name="color" class="form-select" required>
                <option value="primary">Azul</option>
                <option value="success">Verde</option>
                <option value="warning">Amarillo</option>
                <option value="danger">Rojo</option>
                <option value="info">Celeste</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" class="form-control" rows="2"></textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Crear Materia</button>
            <a href="{{ route('admin.levels.create') }}" class="btn btn-primary">Crear Nivel</a>
            <button class="btn btn-primary" onclick="window.location.href='{{ route('admin.subjects.index') }}'">Volver</button>
            
        </div>
    </form>
</div>
@endsection 