@extends('layouts.app')

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-12">



          <!-- MOSTRAR ALERTA SI EXISTE UN MENSAJE DE ERROR EN LA SESIÓN -->
          @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
              <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle me-2 fs-5"></i>
                <span>{{ session('error') }}</span>
              </div>
            </div>
          @endif


          <!-- SECCIÓN DE MÉTRICAS GENERALES -->
          <section class="mb-5">
            <div class="row">




              <!-- ARREGLO CON TODAS LAS MÉTRICAS GENERALES A MOSTRAR EN CUADROS DE INFORMACIÓN -->
              @php
                $generalMetrics = [
                  ['title' => 'Total de Estudiantes',     'icon' => 'users',        'value' => $metrics['total_students'],     'color' => 'info'],
                  ['title' => 'Total de Materias',        'icon' => 'book',         'value' => $metrics['total_subjects'],     'color' => 'success'],
                  ['title' => 'Total de Niveles',         'icon' => 'layer-group',  'value' => $metrics['total_levels'],       'color' => 'primary'],
                  ['title' => 'Niveles Completados',      'icon' => 'check-circle', 'value' => $metrics['completed_levels'],   'color' => 'success'],
                  ['title' => 'Total de Puntuaciones',    'icon' => 'star',         'value' => $metrics['total_scores'],       'color' => 'danger'],
                  ['title' => 'Puntuación Promedio',      'icon' => 'chart-line',   'value' => number_format($metrics['average_score'], 1), 'color' => 'secondary']
                ];
              @endphp




              <!-- MOSTRAR CADA MÉTRICA EN UNA CAJA -->
              @foreach($generalMetrics as $metric)
                <div class="col-md-4 mb-3">
                  <div class="small-box bg-{{ $metric['color'] }}">
                    <div class="inner">
                      <h3>{{ $metric['value'] }}</h3>
                      <p>{{ $metric['title'] }}</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-{{ $metric['icon'] }}"></i>
                    </div>
                  </div>
                </div>
              @endforeach


            </div>
          </section>



          <!-- SECCIÓN DE MÉTRICAS POR MATERIA -->
          <section class="mb-5">
            <div class="card border-0 shadow rounded-4">
              <div class="card-body">
                <h4 class="fw-bold text-dark mb-4 border-bottom pb-2 fs-3">📚 MÉTRICAS POR MATERIA</h4>
                <div class="row g-4">



                  <!-- RECORRER CADA MATERIA PARA MOSTRAR SUS MÉTRICAS -->
                  @foreach($subjects as $subject)
                        <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 h-100">
                            <div class="card-body">



                            <!-- ENCABEZADO CON NOMBRE DE LA MATERIA -->
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                <i class="fas fa-book text-primary fa-2x"></i>
                                </div>
                                <h5 class="mb-0 fw-bold text-dark fs-4">{{ $subject['name'] }}</h5>
                            </div>



                            <!-- LISTA DE MÉTRICAS DE LA MATERIA -->
                            <ul class="list-group list-group-flush">

                                <li class="list-group-item d-flex justify-content-between px-0 fs-5">
                                <span class="text-muted">Total de Niveles</span>
                                <span class="fw-semibold text-dark">{{ $subject['total_levels'] }}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between px-0 fs-5">
                                <span class="text-muted">Niveles Completados</span>
                                <span class="fw-semibold text-success">{{ $subject['completed_levels'] }}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between px-0 fs-5">
                                <span class="text-muted">Estudiantes Activos</span>
                                <span class="fw-semibold text-primary">{{ $subject['total_students'] }}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between px-0 fs-5">
                                <span class="text-muted">Puntuación Promedio</span>
                                <span class="fw-semibold text-warning">{{ number_format($subject['average_score'], 1) }}</span>
                                </li>
                                
                            </ul>

                            </div>
                        </div>
                        </div>
                  @endforeach

                </div>
              </div>
            </div>
          </section>

          <!-- SECCIÓN DE PROGRESO DE ESTUDIANTES -->
          <section>
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h4 class="card-title mb-0">Progreso de Estudiantes</h4>
              </div>
              <div class="card-body">

                <!-- VERIFICAR SI HAY ESTUDIANTES REGISTRADOS -->
                @if($students->count() > 0)
                  <div class="row">

                    <!-- MOSTRAR TARJETA POR CADA ESTUDIANTE -->
                    @foreach($students as $student)
                      <div class="col-md-6 mb-4">
                        <div class="card card-success h-100">
                          <div class="card-body">

                            <!-- NOMBRE Y PORCENTAJE DE PROGRESO -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                              <h5 class="mb-0 font-weight-bold">{{ $student['name'] }}</h5>
                              <span class="badge badge-light">{{ $student['progress_percentage'] }}%</span>
                            </div>

                            <!-- BARRA DE PROGRESO GENERAL -->
                            <div class="mb-3">
                              <div class="d-flex justify-content-between small text-muted">
                                <span>Progreso General</span>
                                <span>{{ $student['completed_levels'] }}/{{ $student['total_levels'] }}</span>
                              </div>
                              <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-primary" style="width: {{ $student['progress_percentage'] }}%"></div>
                              </div>
                            </div>

                            <!-- PUNTUACIÓN PROMEDIO DEL ESTUDIANTE -->
                            <div class="mb-3">
                              <div class="small text-muted">Puntuación Promedio</div>
                              <div class="h5 mb-0">{{ number_format($student['average_score'], 1) }}</div>
                            </div>

                            <!-- PROGRESO POR MATERIA -->
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

                            <!-- ESTADO GENERAL DEL ESTUDIANTE -->
                            <div class="text-center">
                              @php
                                $status = match(true) {
                                  $student['progress_percentage'] >= 80 => ['Excelente', 'success'],
                                  $student['progress_percentage'] >= 60 => ['Bueno', 'warning'],
                                  $student['progress_percentage'] >= 40 => ['Regular', 'info'],
                                  default => ['Necesita Mejorar', 'danger']
                                };
                              @endphp
                              <span class="badge badge-{{ $status[1] }}">{{ $status[0] }}</span>
                            </div>

                          </div>
                        </div>
                      </div>
                    @endforeach

                  </div>
                @else
                  <!-- MENSAJE SI NO HAY ESTUDIANTES AÚN -->
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
  </div>
@endsection
