@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Panel de Administración</h3>
                    </div>
                    <div class="card-body">
                        <h4 class="mb-4">Bienvenido al Panel de Administración</h4>
                        <div class="list-group mb-4">
                            <a href="{{ route('admin.levels.index') }}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Gestión de Niveles</h5>
                                    <span class="badge badge-info">Administrar</span>
                                </div>
                                <p class="mb-1">Crear, editar y eliminar niveles para cada materia.</p>
                            </a>
                        </div>
                        <a href="{{ route('home') }}" class="btn btn-primary"><i class="fas fa-chart-bar mr-1"></i> Ver Métricas del Sistema</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 