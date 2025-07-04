@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-12 col-xl-9">
        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <span class="d-inline-block bg-primary rounded-circle p-3 mb-2">
                        <i class="fas fa-edit fa-2x text-white"></i>
                    </span>
                    <h3 class="mb-0 font-weight-bold">Editar Materia</h3>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.subjects.update', $subject) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-4">
                        <label for="name">Nombre de la materia</label>
                        <input type="text" name="name" class="form-control" value="{{ $subject->name }}" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="icon">Ícono</label>
                        <select name="icon" class="form-control" required>
                            <option value="calculator" {{ $subject->icon == 'calculator' ? 'selected' : '' }}>Calculadora</option>
                            <option value="leaf" {{ $subject->icon == 'leaf' ? 'selected' : '' }}>Hoja</option>
                            <option value="book-open" {{ $subject->icon == 'book-open' ? 'selected' : '' }}>Libro abierto</option>
                            <option value="landmark" {{ $subject->icon == 'landmark' ? 'selected' : '' }}>Historia</option>
                            <option value="flask" {{ $subject->icon == 'flask' ? 'selected' : '' }}>Ciencia</option>
                            <option value="palette" {{ $subject->icon == 'palette' ? 'selected' : '' }}>Arte</option>
                            <option value="music" {{ $subject->icon == 'music' ? 'selected' : '' }}>Música</option>
                            <option value="globe" {{ $subject->icon == 'globe' ? 'selected' : '' }}>Geografía</option>
                            <option value="atom" {{ $subject->icon == 'atom' ? 'selected' : '' }}>Física</option>   
                            
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="color">Color</label>
                        <select name="color" class="form-control" required>
                            <option value="primary" {{ $subject->color == 'primary' ? 'selected' : '' }}>Azul</option>
                            <option value="success" {{ $subject->color == 'success' ? 'selected' : '' }}>Verde</option>
                            <option value="warning" {{ $subject->color == 'warning' ? 'selected' : '' }}>Amarillo</option>
                            <option value="danger" {{ $subject->color == 'danger' ? 'selected' : '' }}>Rojo</option>
                            <option value="info" {{ $subject->color == 'info' ? 'selected' : '' }}>Celeste</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="description">Descripción</label>
                        <textarea name="description" class="form-control" rows="2">{{ $subject->description }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg font-weight-bold mb-3">
                        <i class="fas fa-save mr-2"></i> Actualizar Materia
                    </button>

                    <div class="text-center">
                        <a href="{{ route('admin.subjects.index') }}" class="btn btn-link">Volver a la lista</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
