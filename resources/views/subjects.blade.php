<!DOCTYPE html>
<html lang="es">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Elige tu Materia - Juego Educativo</title>

  <!-- FUENTES WEB DE GOOGLE FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

  @vite(['resources/css/app.css', 'resources/js/app.js'])  
 
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">


  <style>
    body {
      background: linear-gradient(145deg, #ffecd2 0%, #fcb69f 100%);
      font-family: 'Inter', 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
      min-height: 100vh;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      text-rendering: optimizeLegibility;
    }

    .subject-card {
      background-color: #fff9f3;
      border-radius: 1.5rem;
      padding: 2rem;
      border: 4px solid #ffb347;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ;
      color: inherit;
      text-decoration: none;
      display: block;
      font-family: 'Inter', 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
    }

    .subject-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 25px 45px rgba(0, 0, 0, 0.3);
    }

    .subject-card i {
      font-size: 3rem;
      margin-bottom: 1rem;
    }

    .welcome-box {
      background-color: #fff;
      border-radius: 1.5rem;
      border: 4px solid #ffe066;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      padding: 2rem;
      margin-bottom: 2rem;
      text-align: center;
      font-family: 'Inter', 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
    }

    .subject-title {
      color: #ff6347;
      font-weight: bold;
      font-family: 'Inter', 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
    }

    .subject-description {
      color: #4b4b4b;
      font-family: 'Inter', 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
    }

    /* Asegurar que todos los elementos usen las fuentes correctas */
    h1, h2, h3, h4, h5, h6, p, span, div, a {
      font-family: 'Inter', 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
    }
  </style>



<!-- ESTILOS PARA EL BOTÓN Y MODAL DE RANKING GLOBAL -->
<style>
    #ranking-btn {
        position: fixed;
        top: 32px;
        right: 32px;
        z-index: 1050;
        background: #ffb347;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 56px;
        height: 56px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.7rem;
        transition: background 0.2s;
    }
    #ranking-btn:hover {
        background: #ff9800;
    }
    #ranking-modal {
        position: fixed;
        z-index: 2000;
        left: 0; top: 0; width: 100vw; height: 100vh;
        background: rgba(0,0,0,0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.3s;
    }
    #ranking-modal .modal-content {
        background: #fff;
        border-radius: 2rem;
        padding: 2.5rem 2rem 2rem 2rem;
        max-width: 420px;
        width: 95vw;
        box-shadow: 0 12px 48px rgba(0,0,0,0.25);
        position: relative;
        animation: modalFadeIn 0.35s cubic-bezier(.4,2,.6,1) both;
        border: 4px solid #ffe066;
    }
    #ranking-modal .close {
        position: absolute;
        top: 1.2rem;
        right: 1.2rem;
        font-size: 2rem;
        color: #ff6347;
        cursor: pointer;
        transition: color 0.2s;
    }
    #ranking-modal .close:hover {
        color: #d32f2f;
    }
    #ranking-modal h4 {
        color: #ff9800;
        font-weight: bold;
        margin-bottom: 1.5rem;
        letter-spacing: 0.5px;
    }
    #ranking-table-container table {
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        margin-bottom: 0;
    }
    #ranking-table-container th {
        background: #ffe066;
        color: #4b4b4b;
        font-weight: 600;
        border: none;
        text-align: center;
    }
    #ranking-table-container td {
        background: #fff9f3;
        color: #4b4b4b;
        border: none;
        text-align: center;
        font-size: 1.05rem;
        vertical-align: middle;
    }
    #ranking-table-container tr[style*="background:#fff9e6"] td {
        background: #fff9e6 !important;
        color: #ff9800;
        font-weight: bold;
    }
    @keyframes modalFadeIn {
        0% { opacity: 0; transform: translateY(-40px) scale(0.95); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }
</style>

</head>








<body class="d-flex justify-content-center align-items-center p-4">

    <!-- BOTÓN FLOTANTE DE RANKING GLOBAL -->
    <button id="ranking-btn" title="Ver Ranking Global">
      <i class="fas fa-trophy"></i>
  </button>

    <!-- MODAL DE RANKING GLOBAL -->
    <div id="ranking-modal" class="d-none text-center">
        <div class="modal-content" id="ranking-modal-content">
            <span class="close" id="close-ranking-modal">&times;</span>
            <h4 class="subject-title mb-3"><i class="fas fa-trophy text-warning me-2"></i>Ranking Global de Estudiantes</h4>
            <div id="ranking-table-container" class="mb-2 text-center">
                <div class="text-muted">Cargando ranking...</div>
            </div>
        </div>
    </div>




  <div class="container" style="max-width: 960px;">

        
        <div class="welcome-box">

          <h1 class="mb-3 text-primary">🎉 ¡Hola, {{ $student->name }}!</h1>
          <p class="fs-5 text-secondary">🌟 Puntaje Total: {{ $student->total_score }}</p>

        </div>


  
    <div class="row g-4">

        @foreach($subjects as $subject)

        <div class="col-md-4">
            <a href="{{ route('show-subject', ['student' => $student->id, 'subject' => $subject->id]) }}" class="subject-card text-center">
                <i class="fas fa-{{ $subject->icon  }} text-{{ $subject->color }}"></i>
                <h5 class="subject-title mt-2">{{ $subject->name }}</h5>
                <p class="subject-description">{{ $subject->description }}</p>



                <!-- PHP BARRA DE PROGRESO DE PUNTOS POR MATERIA -->
                @php
                  $totalPoints = $subject->total_points;
                  $earnedPoints = $subject->earned_points;
                  $progress = $totalPoints > 0 ? round(($earnedPoints / $totalPoints) * 100) : 0;
                @endphp

                <!-- HTML BARRA DE PROGESO-->
                <div class="mt-3">
                  <div class="d-flex justify-content-between align-items-center mb-1 small">
                    <span class="text-muted">Progreso</span>
                    <span class="fw-bold">{{ $earnedPoints }}/{{ $totalPoints }} Puntos</span>
                  </div>
                  <div class="progress" style="height: 10px; background: #e8f5e8;">
                    <div class="progress-bar" style="width: {{ $progress }}%; background: linear-gradient(90deg, #4CAF50 0%, #45a049 100%);" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <div class="text-end small text-muted mt-1">{{ $progress }}%</div>
                </div>
            </a>
        </div>
        @endforeach

    </div> 


  </div>

  
</body>

















<!-- SCRIPTS: LOGICA DEL MODAL DE RANKING GLOBAL -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rankingBtn = document.getElementById('ranking-btn');
        const rankingModal = document.getElementById('ranking-modal');
        const closeRankingModal = document.getElementById('close-ranking-modal');
        const rankingTableContainer = document.getElementById('ranking-table-container');
        const modalContent = document.getElementById('ranking-modal-content');

        // MOSTRAR EL MODAL SOLO AL PRESIONAR EL BOTON
        rankingBtn.addEventListener('click', function() {
            rankingModal.classList.remove('d-none');
            // CARGAR RANKING GLOBAL VIA AJAX
            fetch('/ranking-global')
                .then(response => response.json())
                .then(data => {
                    let html = '<table class="table table-bordered align-middle">';
                    html += '<thead><tr><th>Puesto</th><th>Estudiante</th><th>Puntaje</th></tr></thead><tbody>';
                    if (data.length === 0) {
                        html += '<tr><td colspan="4">No hay datos de ranking.</td></tr>';
                    } else {
                        data.forEach(function(student, idx) {
                            html += `<tr${student.id == {{ $student->id }} ? ' style="background:#fff9e6;font-weight:bold;"' : ''}>
                                <td>${idx+1}</td>
                                <td>${student.name}</td>
                                <td>${student.total_score}</td>
                              
                            </tr>`;
                        });
                    }
                    html += '</tbody></table>';
                    rankingTableContainer.innerHTML = html;
                })
                .catch(() => {
                    rankingTableContainer.innerHTML = '<div class="text-danger">No se pudo cargar el ranking.</div>';
                });
        });
        // CERRAR MODAL AL PRESIONAR LA X
        closeRankingModal.addEventListener('click', function() {
            rankingModal.classList.add('d-none');
        });
        // CERRAR MODAL AL HACER CLICK FUERA DEL CONTENIDO
        rankingModal.addEventListener('click', function(e) {
            if (e.target === rankingModal) {
                rankingModal.classList.add('d-none');
            }
        });
    });
</script>


</html>
