<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego Educativo</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <style>
        body {
            background-color: #f0f8ff;
            min-height: 100vh;
        }

        .game-card {
            background: #fff9f3;
            border-radius: 30px;
            padding: 3rem;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            border: 5px solid #ffb347;
        }

        h1, h2 {
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #ff6347;
        }

        h2 {
            color: #ff8c00;
        }

        .form-label {
            font-size: 1.25rem;
            color: #112b69;
        }

        .form-select,
        .form-control {
            background-color: #fff0f5;
            border-radius: 50px;
            font-size: 1.1rem;
            text-align: center;
        }

        .btn-lg {
            font-size: 1.4rem;
            border-radius: 50px;
            padding: 15px 25px;
        }

        .btn-primary {
            background-color: #32c72a;
            border-color: #37d41b;
        }

        .btn-primary:hover {
            background-color: #3e7c0f;
            border-color: #ff1493;
        }

        .btn-success {
            background-color: #244ead;
            border-color: #3237cd;
        }

        .btn-success:hover {
            background-color: #1b275b;
            border-color: #214166;
        }

        .error-message {
            animation: shake 0.5s;
        }

        .form-control[type="password"] {
            background-color: #fff0f5;
            border-radius: 50px;
            font-size: 1.1rem;
            text-align: center;
        }

        .text-muted {
            color: #6c757d !important;
            font-size: 0.9rem;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
    </style>


</head>







<!-- EL CUERPO DONDE ESTA PARA BUSCAR E INGRESAR EL NOMBRE DEL ESTUDIANTE -->
<body class="d-flex align-items-center justify-content-center">

   
   


    <div class="game-card w-100 m-4" style="max-width: 1000px;">

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-circle me-2 fs-5"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
                
            @endif

 
            
        <h1 class="text-center fw-bold mb-5 display-4">¡Bienvenido al Juego Educativo! </h1>



    


        <div class="row g-5">



            <!-- FORMULARIO DE BUSQUEDA DE ESTUDIANTE EXISTENTE -->
            <div class="col-md-6 border-end border-4 ">
                <h2 class="fw-bold mb-4">¿Ya has jugado antes?</h2>

                <form action="{{ route('find-student') }}" method="POST" class="vstack gap-4">
                    @csrf

                    <div>

                        <label class="form-label">Busca y selecciona tu nombre:</label>
                        

                        <input type="text" id="studentSearch" class="form-control form-control-lg mb-2" placeholder="Escribe para filtrar tu nombre">


                        <select name="name" id="studentSelect" class="form-select form-select-lg">

                            <option value="">Encuentra tu nombre</option>

                            @if($students->count() > 0)
                                @foreach($students as $student)
                                    <option value="{{ $student->name }}">{{ $student->name }}</option>
                                @endforeach
                            @else

                                <option value="" disabled>No hay estudiantes registrados</option>

                            @endif

                        </select>
                    </div>

                    <div>
                        <label class="form-label">Ingresa tu clave:</label>
                        <input type="password" name="password" required class="form-control form-control-lg" placeholder="Tu clave aquí">
                    </div>

                    <button type="submit" name="student" class="btn btn-primary btn-lg w-100 fw-bold">
                        🔎 Buscar mi progreso
                    </button>
                </form>
            </div>






            <!-- FORMULARIO PARA NUEVO ESTUDIANTE -->
            <div class="col-md-6">

                <h2 class="fw-bold mb-4"> ¿Primera vez jugando?</h2>

                <form action="{{ route('start-game') }}" method="POST" class="vstack gap-4">
                    @csrf

                    <div>
                        <label class="form-label">Ingresa tu nombre:</label>
                        <input type="text" name="name" required class="form-control form-control-lg" placeholder="Tu nombre aquí">
                    </div>

                    <div>
                        <label class="form-label">Crea tu clave:</label>
                        <input type="password" name="password" required class="form-control form-control-lg" placeholder="Crea una clave ">
                        <hr>
                        <small class="text-muted">Esta clave te servirá para acceder a tu progreso en el futuro</small>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg w-100 fw-bold">
                        🚀 ¡Comenzar a jugar!
                    </button>
                </form>
            </div>




        </div>



    </div>



    
    <script>
        
        document.addEventListener('DOMContentLoaded', function () {
        
            const searchInput = document.getElementById('studentSearch');
            const studentSelect = document.getElementById('studentSelect');

            if (searchInput && studentSelect) {
                const originalOptions = Array.from(studentSelect.options).map(opt => opt.cloneNode(true));

                searchInput.addEventListener('input', function () {
                    const filterText = this.value.toLowerCase();
                    const currentVal = studentSelect.value;

                    studentSelect.innerHTML = '';

                    originalOptions.forEach(option => {
                        if (option.value === '' || option.textContent.toLowerCase().includes(filterText)) {
                            studentSelect.appendChild(option.cloneNode(true));
                        }
                    });
                    
                    studentSelect.value = currentVal;
                });
            }
        });
    </script>

</body>
</html>
