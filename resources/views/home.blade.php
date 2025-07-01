@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <!-- Métricas Generales -->
            <section class="mb-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h4 class="fw-semibold text-primary mb-4 border-bottom pb-2">Métricas Generales del Sistema</h4>
                        <div class="row g-3">
                            @php
                                $generalMetrics = [
                                    ['title' => 'Total de Estudiantes', 'icon' => 'users', 'value' => $metrics['total_students'], 'color' => 'bg-primary'],
                                    ['title' => 'Total de Materias', 'icon' => 'book', 'value' => $metrics['total_subjects'], 'color' => 'bg-success'],
                                    ['title' => 'Total de Niveles', 'icon' => 'layer-group', 'value' => $metrics['total_levels'], 'color' => 'bg-info'],
                                    ['title' => 'Niveles Completados', 'icon' => 'check-circle', 'value' => $metrics['completed_levels'], 'color' => 'bg-warning'],
                                    ['title' => 'Total de Puntuaciones', 'icon' => 'star', 'value' => $metrics['total_scores'], 'color' => 'bg-danger'],
                                    ['title' => 'Puntuación Promedio', 'icon' => 'chart-line', 'value' => number_format($metrics['average_score'], 1), 'color' => 'bg-secondary']
                                ];
                            @endphp

                            @foreach($generalMetrics as $metric)
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm text-white {{ $metric['color'] }}">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="small">{{ $metric['title'] }}</div>
                                                <div class="fs-4 fw-semibold">{{ $metric['value'] }}</div>
                                            </div>
                                            <i class="fas fa-{{ $metric['icon'] }} fa-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <!-- Métricas por Materia -->
            <section class="mb-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h4 class="fw-semibold text-primary mb-4 border-bottom pb-2">Métricas por Materia</h4>
                        <div class="row g-4">
                            @foreach($subjects as $subject)
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="text-dark fw-semibold mb-3">{{ $subject['name'] }}</h5>
                                        <div class="row">
                                            <div class="col-6 small text-muted">Total de Niveles: <span class="text-dark fw-semibold">{{ $subject['total_levels'] }}</span></div>
                                            <div class="col-6 small text-muted">Niveles Completados: <span class="text-dark fw-semibold">{{ $subject['completed_levels'] }}</span></div>
                                            <div class="col-6 small text-muted">Estudiantes Activos: <span class="text-dark fw-semibold">{{ $subject['total_students'] }}</span></div>
                                            <div class="col-6 small text-muted">Puntuación Promedio: <span class="text-dark fw-semibold">{{ number_format($subject['average_score'], 1) }}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <!-- Progreso de Estudiantes -->
            <section>
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h4 class="fw-semibold text-primary mb-4 border-bottom pb-2">Progreso de Estudiantes</h4>
                        @if($students->count() > 0)
                            <div class="row g-4">
                                @foreach($students as $student)
                                <div class="col-md-6">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="text-dark fw-semibold mb-0">{{ $student['name'] }}</h5>
                                                <span class="badge bg-light text-dark">{{ $student['progress_percentage'] }}%</span>
                                            </div>

                                            <!-- Progreso General -->
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between small text-muted">
                                                    <span>Progreso General</span>
                                                    <span>{{ $student['completed_levels'] }}/{{ $student['total_levels'] }}</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-primary" style="width: {{ $student['progress_percentage'] }}%"></div>
                                                </div>
                                            </div>

                                            <!-- Puntuación Promedio -->
                                            <div class="mb-3">
                                                <div class="small text-muted">Puntuación Promedio</div>
                                                <div class="fs-5 text-dark fw-semibold">{{ number_format($student['average_score'], 1) }}</div>
                                            </div>

                                            <!-- Progreso por Materia -->
                                            <div class="mb-3">
                                                <div class="small text-muted mb-2">Progreso por Materia</div>
                                                @foreach($student['progress_by_subject'] as $subject)
                                                    <div class="mb-2">
                                                        <div class="d-flex justify-content-between small text-muted">
                                                            <span>{{ $subject['name'] }}</span>
                                                            <span>{{ $subject['completed_levels'] }}/{{ $subject['total_levels'] }}</span>
                                                        </div>
                                                        <div class="progress" style="height: 6px;">
                                                            <div class="progress-bar bg-secondary" style="width: {{ $subject['progress_percentage'] }}%"></div>
                                                        </div>
                                                        <div class="d-flex justify-content-between small text-muted">
                                                            <span>{{ number_format($subject['average_score'], 1) }} pts</span>
                                                            <span>{{ $subject['progress_percentage'] }}%</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- Estado -->
                                            <div class="text-center">
                                                @php
                                                    $status = match(true) {
                                                        $student['progress_percentage'] >= 80 => ['Excelente', 'success'],
                                                        $student['progress_percentage'] >= 60 => ['Bueno', 'warning'],
                                                        $student['progress_percentage'] >= 40 => ['Regular', 'info'],
                                                        default => ['Necesita Mejorar', 'danger']
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ $status[1] }}-subtle text-{{ $status[1] }}">{{ $status[0] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-users fa-2x text-muted mb-3"></i>
                                <h5 class="text-muted">No hay estudiantes registrados</h5>
                                <p class="text-muted small">Los estudiantes aparecerán aquí una vez que se registren y comiencen a jugar.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
@endsection