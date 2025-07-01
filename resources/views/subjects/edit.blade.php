@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Materia</h2>
    <form action="{{ route('admin.subjects.update', $subject) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre de la materia</label>
            <input type="text" name="name" class="form-control" value="{{ $subject->name }}" required>
        </div>

        <div class="mb-3">
            <label for="icon" class="form-label">Ícono</label>
            <select name="icon" class="form-select" required>
                <option value="calculator" {{ $subject->icon == 'calculator' ? 'selected' : '' }}>Calculadora</option>
                <option value="leaf" {{ $subject->icon == 'leaf' ? 'selected' : '' }}>Hoja</option>
                <option value="book-open" {{ $subject->icon == 'book-open' ? 'selected' : '' }}>Libro abierto</option>
                <option value="landmark" {{ $subject->icon == 'landmark' ? 'selected' : '' }}>Historia</option>
                <option value="flask" {{ $subject->icon == 'flask' ? 'selected' : '' }}>Ciencia</option>
                <option value="palette" {{ $subject->icon == 'palette' ? 'selected' : '' }}>Arte</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <select name="color" class="form-select" required>
                <option value="primary" {{ $subject->color == 'primary' ? 'selected' : '' }}>Azul</option>
                <option value="success" {{ $subject->color == 'success' ? 'selected' : '' }}>Verde</option>
                <option value="warning" {{ $subject->color == 'warning' ? 'selected' : '' }}>Amarillo</option>
                <option value="danger" {{ $subject->color == 'danger' ? 'selected' : '' }}>Rojo</option>
                <option value="info" {{ $subject->color == 'info' ? 'selected' : '' }}>Celeste</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" class="form-control" rows="2">{{ $subject->description }}</textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-warning">Actualizar Subject</button>
            <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection 