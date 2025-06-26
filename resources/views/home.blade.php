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

            <!-- Progreso de Estudiantes -->
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="mb-0">Progreso de Estudiantes</h4>
                </div>

                <div class="card-body">
                    @if($students->count() > 0)
                        <div class="row">
                            @foreach($students as $student)
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">

                                    <div class="card-header bg-info text-white">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">{{ $student['name'] }}</h5>
                                            <span class="badge bg-light text-dark">{{ $student['progress_percentage'] }}%</span>
                                        </div>
                                    </div>


                                    <div class="card-body">
                                        
                                        <!-- Progreso General -->
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-1">
                                                <span>Progreso General</span>
                                                <span>{{ $student['completed_levels'] }}/{{ $student['total_levels'] }}</span>
                                            </div>

                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" 
                                                     style="width: {{ $student['progress_percentage'] }}%" 
                                                     aria-valuenow="{{ $student['progress_percentage'] }}" 
                                                     aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            
                                        </div>


                                        <!-- Puntuación Promedio -->
                                        <div class="mb-3">
                                            <h6 class="text-muted">Puntuación Promedio</h6>
                                            <h4 class="text-primary">{{ number_format($student['average_score'], 1) }}</h4>
                                        </div>


                                        <!-- Progreso por Materia -->
                                        <div class="mb-3">
                                            <h6 class="text-muted">Progreso por Materia</h6>

                                            @foreach($student['progress_by_subject'] as $subject)

                                            <div class="mb-2">

                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="small">{{ $subject['name'] }}</span>
                                                    <span class="small text-muted">{{ $subject['completed_levels'] }}/{{ $subject['total_levels'] }}</span>
                                                </div>


                                                <div class="progress" style="height: 6px;">

                                                    <div class="progress-bar bg-error" role="progressbar" 
                                                         style="width: {{ $subject['progress_percentage'] }}%" 
                                                         aria-valuenow="{{ $subject['progress_percentage'] }}" 
                                                         aria-valuemin="0" aria-valuemax="100">
                                                    </div>
                                                    
                                                </div>


                                                <div class="d-flex justify-content-between">
                                                    <small class="text-muted">{{ number_format($subject['average_score'], 1) }} pts</small>
                                                    <small class="text-muted">{{ $subject['progress_percentage'] }}%</small>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                        <!-- Estado del Estudiante -->
                                        <div class="text-center">
                                            @if($student['progress_percentage'] >= 80)
                                                <span class="badge bg-success">Excelente</span>
                                            @elseif($student['progress_percentage'] >= 60)
                                                <span class="badge bg-warning">Bueno</span>
                                            @elseif($student['progress_percentage'] >= 40)
                                                <span class="badge bg-info">Regular</span>
                                            @else
                                                <span class="badge bg-danger">Necesita Mejorar</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No hay estudiantes registrados</h5>
                            <p class="text-muted">Los estudiantes aparecerán aquí una vez que se registren y comiencen a jugar.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
