<!DOCTYPE html>
<html lang="es">
<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nivel {{ $level->level_number }} - {{ $level->subject->name }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <style>
        body {
            background: linear-gradient(145deg, #ffecd2 0%, #fcb69f 100%);
            font-family: 'Comic Sans MS', cursive, sans-serif;
            min-height: 100vh;
        }

        .answer-button {
            background-color: #fff9f3;
            border: 4px solid #ffb347;
            transition: transform 0.3s;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            color: #4b4b4b;
        }

        .answer-button:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.3);
            background-color: #ffe7d6;
        }

        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        .celebrate {
            animation: celebrate 0.5s ease-in-out;
        }

        .custom-box {
            background-color: #fff;
            border-radius: 1.5rem;
            border: 4px solid #ffe066;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .main-title {
            color: #ff6347;
            font-weight: bold;
        }

        .subtitle {
            color: #4b4b4b;
        }
    </style>

</head>




<body class="d-flex flex-column align-items-center p-4">

    <div class="container" style="max-width: 960px;">
        



        <!-- BUSCA EL ID DEL ESTUDIANTE Y EL NIVEL CON SU MATERIA Y ID RELACIONADO A TRAVES DEL METODO PLAY LEVEL -->
        <div class="custom-box p-4 mb-4">

            <a href="{{ route('show-subject', ['student' => $student->id, 'subject' => $level->subject_id]) }}" 
               class="text-decoration-none text-primary fw-bold">
                <i class="fas fa-arrow-left"></i> Volver a Niveles
            </a>

            <h1 class="text-center mt-3 main-title fs-3">
                Nivel {{ $level->level_number }} - {{ $level->subject->name }}
            </h1>

            <p class="text-center subtitle mt-2">
                Estudiante: {{ $student->name }} | Puntaje: <span id="total-score">{{ $student->total_score }}</span>
            </p>

        </div>


        
        <!-- CONTENEDOR DE TITULO Y PREGUNTAS -->
        <div class="custom-box p-4">
            

            <!-- MUESTRA EL TITULO DE LA PREGUNTA LA DESCRIPCION DE LA MISMA Y LA PREGUNTA  -->
            <div class="mb-4">
                <h2 class="fs-4 main-title mb-2">{{ $level->title }}</h2>
                <p class="subtitle">{{ $level->description }}</p>
                <div class="fw-semibold subtitle">{{ $level->question }}</div>
            </div>


            <!-- BUSCA LAS RESPUESTAS Y MEZCLA LAS CORRECTAS CON LAS INCORRECTAS-->
            <div class="row g-3" id="answers">
                @php
                    $answers = array_merge([$level->correct_answer], $level->wrong_answers);
                    shuffle($answers);
                @endphp



                <!-- MUESTRA LAS RESPUESTAS EN BOTONES Y CUANDO EL USUARIO SELECCIONA UNA RESPUESTA ES ENVIADA AL METODO SubmitAnswer PARA VALIDAR SI ES CORRECTA O NO  -->
                @foreach($answers as $answer)
                    <div class="col-md-6">
                        <button class="btn w-100 text-start fw-semibold answer-button py-3 px-4"
                                onclick="submitAnswer('{{ addslashes($answer) }}')">
                            {{ $answer }}
                        </button>
                    </div>
                @endforeach
            </div>






            <!-- CONTENEDOR PRINCIPAL DEL LA VENTANA EMERGENTE PARA RESPUESTAS CORRECTAS E INCORRECTAS-->
            <div id="result" class="position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-dark bg-opacity-50 d-none z-3"> <!-- ESTA OCULTO POR DEFECTO -->


                <!-- CONTENEDOR DEL MODAL QUE MUESTRA UN CUADRO  -->
                <div class="bg-white p-5 rounded-4 text-center shadow-lg" style="max-width: 400px; width: 100%;">


                    <!-- MENSAJE DE EXITO QUE ESTA OCULTO SOLO SI EL ID ES VERIFICADO Y RESPUESTA ES CORRECTA SE MUESTRA -->
                    <div id="success" class="d-none">
                        <i class="fas fa-check-circle fs-1 text-success mb-3 celebrate"></i>
                        <h3 class="fs-3 text-success fw-bold mb-2">¡Correcto!</h3>
                        <p class="text-muted fs-5">Has ganado <span id="points" class="fw-bold"></span> puntos</p>
                    </div>

                    
                    <!-- MENSAJE DE ERROR QUE ESTA OCULTO SOLO SI EL ID ES VERIFICADO Y RESPUESTA ES INCORRECTA SE MUESTRA -->
                    <div id="error" class="d-none">
                        <i class="fas fa-times-circle fs-1 text-danger mb-3 celebrate"></i>
                        <h3 class="fs-3 text-danger fw-bold mb-2">¡Inténtalo de nuevo!</h3>
                        <p class="text-muted fs-5">La respuesta no es correcta</p>
                        <p id="error-message" class="text-warning mt-2 fw-semibold"></p>
                    </div>



                    <!-- CONTENEDOR DE LOS 2 BOTONES -->
                    <div class="mt-4 d-grid gap-3">

                        <!-- BOTON DE INTENTAR DE NUEVO QUE RECARGA LA PAGINA -->
                        <button onclick="window.location.reload()"
                                class="btn btn-warning fw-bold" style="background-color: #2f722e;">
                                
                            Intentar de nuevo
                        </button>

                        <!-- BOTON DE VOLVER A NIVELES QUE REDIRECCIONA A LA RUTA DE NIVELES -->
                        <a href="{{ route('show-subject', ['student' => $student->id, 'subject' => $level->subject_id]) }}"
                            class="btn btn-secondary fw-bold">
                            Volver a Niveles
                        </a>

                    </div>


                </div>

            </div>



        </div>


        
    </div>





    <!-- SCRIPT PARA MANEJO DE MODAL, RESPUESTAS Y ANIMACIONES -->
    <script>

        <!-- CONFIGURACION DE AJAX PARA ENVIAR EL TOKEN CSRF EN CADA PETICION AJAX -->
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        <!-- FUNCION QUE ENVIA LA RESPUESTA SELECCIONADA POR EL USUARIO AL METODO SUBMITANSWER DE GameController -->
        function submitAnswer(answer) {

            // DESHABILITA LOS BOTONES DE RESPUESTA PARA EVITAR QUE SE HAGAN MAS PETICIONES
            $('.answer-button').prop('disabled', true);

            //PETICION AJAX
            $.ajax({
                url: '/submit-answer/{{ $student->id }}/{{ $level->id }}',
                method: 'POST',
                data: { answer: answer },

                success: function(data) {

                    // ACTUALIZA EL PUNTAJE TOTAL DEL ESTUDINTE
                    $('#total-score').text(data.total_score);

                    //MUESTRA EL MODAL CON EL RESULTADO
                    $('#result').removeClass('d-none');

                    // OCULTA EL CONTENEDOR DE RESPUESTAS
                    $('#answers').addClass('opacity-500 pe-none');

                    if (data.correct) {
                        $('#success').removeClass('d-none');
                        $('#points').text(data.points);
                        $('.answer-button').each(function() {
                            if ($(this).text().trim() === answer) {
                                $(this).css('background-color', '#c8f7c5'); // verde claro
                            }
                        });


                    } else {

                        // Frases motivadoras si se equivoca
                        const frasesMotivadoras = [
                            "¡No te rindas, lo estás haciendo genial!",
                            "¡Sigue intentándolo, aprender es un proceso!",
                            "¡Cada error te acerca al acierto!",
                            "¡Ánimo, tú puedes con esto!",
                            "¡Recuerda que equivocarse es parte de aprender!"
                        ];

                    const mensajeAleatorio = frasesMotivadoras[Math.floor(Math.random() * frasesMotivadoras.length)];
                    
                    $('#error').removeClass('d-none');
                        $('#error-message').text(mensajeAleatorio);
                        $('.answer-button').each(function() {
                            if ($(this).text().trim() === answer) {
                                $(this).css('background-color', '#ffc2c2'); // rojo clar
                            }
                        });
                    }
                },

                error: function() {
                    alert('Hubo un error al procesar tu respuesta. Por favor, intenta de nuevo.');
                    $('.answer-button').prop('disabled', false);
                }
            });
        }
    </script>

</body>
</html>
