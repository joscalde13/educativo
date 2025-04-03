@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">Métricas Generales del Sistema</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Total de Estudiantes -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title">Total de Estudiantes</h6>
                                            <h2 class="mb-0">{{ $metrics['total_students'] }}</h2>
                                        </div>
                                        <i class="fas fa-users fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total de Materias -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title">Total de Materias</h6>
                                            <h2 class="mb-0">{{ $metrics['total_subjects'] }}</h2>
                                        </div>
                                        <i class="fas fa-book fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total de Niveles -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title">Total de Niveles</h6>
                                            <h2 class="mb-0">{{ $metrics['total_levels'] }}</h2>
                                        </div>
                                        <i class="fas fa-layer-group fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Niveles Completados -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title">Niveles Completados</h6>
                                            <h2 class="mb-0">{{ $metrics['completed_levels'] }}</h2>
                                        </div>
                                        <i class="fas fa-check-circle fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total de Puntuaciones -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title">Total de Puntuaciones</h6>
                                            <h2 class="mb-0">{{ $metrics['total_scores'] }}</h2>
                                        </div>
                                        <i class="fas fa-star fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Puntuación Promedio -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-secondary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title">Puntuación Promedio</h6>
                                            <h2 class="mb-0">{{ number_format($metrics['average_score'], 1) }}</h2>
                                        </div>
                                        <i class="fas fa-chart-line fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Métricas por Materia -->
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Métricas por Materia</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        @foreach($subjects as $subject)
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">{{ $subject['name'] }}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <h6 class="text-muted">Total de Niveles</h6>
                                                <h4>{{ $subject['total_levels'] }}</h4>
                                            </div>
                                            <div class="mb-3">
                                                <h6 class="text-muted">Niveles Completados</h6>
                                                <h4>{{ $subject['completed_levels'] }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <h6 class="text-muted">Estudiantes Activos</h6>
                                                <h4>{{ $subject['total_students'] }}</h4>
                                            </div>
                                            <div class="mb-3">
                                                <h6 class="text-muted">Puntuación Promedio</h6>
                                                <h4>{{ number_format($subject['average_score'], 1) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
