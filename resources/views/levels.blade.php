<!DOCTYPE html>
<html lang="es">


  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject->name }} - Niveles</title>

    <!-- FUENTES WEB DE GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">


    <style>
        

      .check-icon {
        position: absolute;
        top: -10px;
        right: -10px;
        background-color: #28a745;
        color: white;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 0 3px white;
        z-index: 10;
      }


      body {
        background: linear-gradient(145deg, #ffecd2 0%, #fcb69f 100%);
        min-height: 100vh;
        font-family: 'Inter', 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-rendering: optimizeLegibility;
      }

      .game-card {
        background: #fff9f3;
        border-radius: 30px;
        padding: 1rem;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        border: 5px solid #ffb347;
        font-family: 'Inter', 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
      }

      h1, h2 {
        font-family: 'Inter', 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
      }

      h1 {
        color: #ff6347;
      }

      h2 {
        color: #ff8c00;
      }

      .locked {
        opacity: 0.7;
        cursor: not-allowed;
      }

      /* Asegurar que todos los elementos usen las fuentes correctas */
      h1, h2, h3, h4, h5, h6, p, span, div, button, a {
        font-family: 'Inter', 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
      }
    </style>


  </head>




  <body class="d-flex flex-column align-items-center p-4">

    <div class="container" style="max-width: 960px;">


      <!-- INFORMACION DE ESTUDIANTE, MATERIA Y SCORE SEGUN EL ID -->
        <div class="game-card mb-5">

         <a href="{{ route('subjects', ['student' => $student->id]) }}" class="text-decoration-none text-warning">
            <i class="fas fa-arrow-left"></i> Volver a Materias
          </a>

            <h1 class="text-center mt-4">{{ $subject->name }}</h1>

          <p class="text-center text-muted mt-2">
             Estudiante: {{ $student->name }} | Puntaje: {{ $student->total_score }}
          </p>

        </div>



      

        <!-- NIVELES DE LA MATERIA -->
      <div class="row g-4">






        <!-- RECORRE LOS NIVELES DE LA MATERIA -->
        @foreach($subject->levels as $level)

        
          @php
            // LA VARIABLE COMPLETED VERIFICA EN LA TABLA SCORES HAYA UN LEVEL_ID QUE SEA COMPLETED TRUE 
            $completed = $scores->where('level_id', $level->id)->where('completed', true)->first();

            // LA VARIABLE PREVIOUSLEVEL VERIFICA EN LA TABLA SUBJECTS QUE PERTENECE A MUCHOS LEVELS PARA QUE VERIFIQUE SI EL NIVEL ANTERIOR FUE COMPLETADO
            $previousLevel = $subject->levels->where('level_number', $level->level_number - 1)->first();

            // LA VARIABLE PREVIOUSCOMPLETED VERIFICA SI EL NIVEL ANTERIOR FUE COMPLETADO EXCEPTO EL NIVEL 1 QUE SIEMPRE ESTARA TRUE, 
            $previousCompleted = $level->level_number == 1 || 
              // EXCEPTO SI EXISTE UN NIVEL ANTERIOR EN LA TABLA SCORES QUE SEA COMPLETED TRUE
              ($previousLevel && $scores->where('level_id', $previousLevel->id)->where('completed', true)->first());
          @endphp




            <div class="col-md-4">

                <div class="game-card h-100 text-center {{ $previousCompleted ? '' : 'locked' }}">

                        <div class="position-relative">


                            @if($completed)
                                <div class="check-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                            @endif




                            <div class="fs-1 mb-3 {{ $previousCompleted ? 'text-warning' : 'text-secondary' }}">
                                <i class="fas fa-star"></i>
                            </div>

                            <h2 class="h4 fw-bold {{ $previousCompleted ? 'text-dark' : 'text-muted' }}">
                                Nivel {{ $level->level_number }}
                            </h2>

                            <p class="text-muted">{{ $level->title }}</p>


                            @if($previousCompleted)

                                <a href="{{ route('play-level', ['student' => $student->id, 'level' => $level->id]) }}"
                                    class="btn btn-warning mt-3">
                                    {{ $completed ? 'Jugar de nuevo' : 'Jugar' }}
                                </a>

                                @else

                                <div class="btn btn-secondary mt-3 disabled">
                                    <i class="fas fa-lock me-2"></i> Bloqueado
                                </div>

                            @endif
                            
                        </div>

                </div>

            </div>

        @endforeach



        
      </div>


    </div>

  </body>
</html>
