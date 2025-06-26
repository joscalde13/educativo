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
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            
        <h1 class="text-center fw-bold mb-5 display-4">¡Bienvenido al Juego Educativo! </h1>



    


        <div class="row g-5">



            <!-- FORMULARIO DE BUSQUEDA DE ESTUDIANTE EXISTENTE -->
            <div class="col-md-6 border-end border-4 border-warning">
                <h2 class="fw-bold mb-4">¿Ya has jugado antes?</h2>

                <form action="{{ route('find-student') }}" method="POST" class="vstack gap-4">
                    @csrf

                    <div>
                        <label class="form-label">Selecciona tu nombre:</label>

                        <select name="name" required class="form-select form-select-lg">

                            <option value="">Encuentra tu nombre</option>

                            @foreach($students as $student)
                                <option>{{ $student->name }}</option>
                            @endforeach

                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">
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

                    <button type="submit" class="btn btn-success btn-lg w-100 fw-bold">
                        🚀 ¡Comenzar a jugar!
                    </button>
                </form>
            </div>




        </div>



    </div>

</body>
</html>
