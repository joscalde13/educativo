    @extends('layouts.app')

    @section('content')
    <div class="d-flex justify-content-center align-items-center min-vh-100 ">
        <div class="col-12 col-xl-9">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <span class="d-inline-block bg-info rounded-circle p-3 mb-2">
                            <i class="fas fa-book fa-2x text-white"></i>
                        </span>
                        <h3 class="mb-0 font-weight-bold">Crear Materia</h3>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('admin.subjects.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="name">Nombre de la materia</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="icon">Ícono</label>
                            <select name="icon" class="form-control" required>
                                <option value="calculator">Calculadora</option>
                                <option value="leaf">Hoja</option>
                                <option value="book-open">Libro abierto</option>
                                <option value="landmark">Historia</option>
                                <option value="flask">Ciencia</option>
                                <option value="palette">Arte</option>
                                <option value="music">Música</option>
                                <option value="globe">Geografía</option>
                                <option value="atom">Física</option>
                                
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label for="color">Color</label>
                            <select name="color" class="form-control" required>
                                <option value="primary">Azul</option>
                                <option value="success">Verde</option>
                                <option value="warning">Amarillo</option>
                                <option value="danger">Rojo</option>
                                <option value="info">Celeste</option>  
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label for="description">Descripción</label>
                            <textarea name="description" class="form-control" rows="2"></textarea>
                        </div>
                        <button type="submit" class="btn btn-info btn-block btn-lg font-weight-bold mb-3">
                            <i class="fas fa-plus mr-2"></i> Crear Materia
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