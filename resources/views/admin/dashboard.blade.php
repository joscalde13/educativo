@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Panel de Administración</div>

                <div class="card-body">
                    <h2>Bienvenido al Panel de Administración</h2>
                    
                    <div class="list-group mt-4">
                        <a href="{{ route('admin.levels.index') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Gestión de Niveles</h5>
                                <small>Administrar</small>
                            </div>
                            <p class="mb-1">Crear, editar y eliminar niveles para cada materia.</p>
                        </a>
                        <hr>
                        <a href="{{ route('home') }}" class="btn btn-primary">Ver Métricas del Sistema</a>
                    </div>
                </div>

       
            </div>
        </div>
    </div>
    
</div>


@endsection 