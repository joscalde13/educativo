<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nivel {{ $level->level_number }} - {{ $level->subject->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #2ab3b6 0%, #a855f7 100%);
            min-height: 100vh;
        }
        .answer-button {
            transition: all 0.3s ease;
        }
        .answer-button:hover {
            transform: translateY(-2px);
        }
        @keyframes celebrate {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
        .celebrate {
            animation: celebrate 0.5s ease-in-out;
        }
    </style>


</head>




<body class="flex flex-col items-center p-8">

    <div class="w-full max-w-4xl">
        



        <!-- BUSCA EL ID DEL ESTUDIANTE Y EL NIVEL CON SU MATERIA Y ID RELACIONADO A TRAVES DEL METODO PLAY LEVEL -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">

            <a href="{{ route('show-subject', ['student' => $student->id, 'subject' => $level->subject_id]) }}" 
               class="text-indigo-600 hover:text-indigo-800">
                <i class="fas fa-arrow-left"></i> Volver a Niveles
            </a>

            <h1 class="text-3xl font-bold text-center text-indigo-600 mt-4">
                Nivel {{ $level->level_number }} - {{ $level->subject->name }}
            </h1>

            <p class="text-center text-gray-600 mt-2">
                Estudiante: {{ $student->name }} | Puntaje: <span id="total-score">{{ $student->total_score }}</span>
            </p>

        </div>


        
        <!-- CONTENEDOR DE TITULO Y PREGUNTAS -->
        <div class="bg-white rounded-lg shadow-lg p-8">
            

            <!-- MUESTRA EL TITULO DE LA PREGUNTA LA DESCRIPCION DE LA MISMA Y LA PREGUNTA  -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $level->title }}</h2>
                <p class="text-gray-600 mb-4">{{ $level->description }}</p>
                <div class="text-lg font-semibold text-gray-800">{{ $level->question }}</div>
            </div>


            
            
            <!-- BUSCA LAS RESPUESTAS Y MEZCLA LAS CORRECTAS CON LAS INCORRECTAS-->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="answers">
                @php
                    $answers = array_merge([$level->correct_answer], $level->wrong_answers);
                    shuffle($answers);
                @endphp



                <!-- MUESTRA LAS RESPUESTAS EN BOTONES Y CUANDO EL USUARIO SELECCIONA UNA RESPUESTA ES ENVIADA AL METODO SubmitAnswer PARA VALIDAR SI ES CORRECTA O NO  -->
                @foreach($answers as $answer)
                    <button class="answer-button bg-indigo-100 hover:bg-indigo-200 text-indigo-800 font-semibold py-4 px-6 rounded-lg text-left"
                            onclick="submitAnswer('{{ addslashes($answer) }}')">
                        {{ $answer }}
                    </button>
                @endforeach
            </div>

            






            <!-- CONTENEDOR PRINCIPAL DEL LA VENTANA EMERGENTE PARA RESPUESTAS CORRECTAS E INCORRECTAS-->
            <div id="result" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">


                <!-- CONTENEDOR DEL MODAL QUE MUESTRA UN CUADRO  -->
                <div class="bg-white p-8 rounded-2xl text-center shadow-2xl max-w-md w-full animate-popup">


                    <!-- MENSAJE DE EXITO QUE ESTA OCULTO SOLO SI EL ID ES VERIFICADO Y RESPUESTA ES CORRECTA SE MUESTRA -->
                    <div id="success" class="hidden">
                        <i class="fas fa-check-circle text-6xl text-green-500 mb-4 animate-bounce"></i>
                        <h3 class="text-3xl font-bold text-green-600 mb-2">¡Correcto!</h3>
                        <p class="text-gray-700 text-lg">Has ganado <span id="points" class="font-bold"></span> puntos</p>
                    </div>

                    
                    <!-- MENSAJE DE ERROR QUE ESTA OCULTO SOLO SI EL ID ES VERIFICADO Y RESPUESTA ES INCORRECTA SE MUESTRA -->
                    <div id="error" class="hidden">
                        <i class="fas fa-times-circle text-6xl text-red-500 mb-4 animate-bounce"></i>
                        <h3 class="text-3xl font-bold text-red-600 mb-2">¡Inténtalo de nuevo!</h3>
                        <p class="text-gray-700 text-lg">La respuesta no es correcta</p>
                    </div>
            

                    <!-- CONTENEDOR DE LOS 2 BOTONES -->
                    <div class="mt-6 space-y-4">


                        <!-- BOTON DE INTENTAR DE NUEVO QUE RECARGA LA PAGINA -->
                        <button onclick="window.location.reload()"
                            class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300">
                            Intentar de nuevo
                        </button>

                        <!-- BOTON DE VOLVER A NIVELES QUE REDIRECCIONA A LA RUTA DE NIVELES -->
                        <a href="{{ route('show-subject', ['student' => $student->id, 'subject' => $level->subject_id]) }}"
                            class="w-full inline-block bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-gray-700 transition duration-300">
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

                //ENVIA LA RESPUESTA AL SERVIDOR
                url: '/submit-answer/{{ $student->id }}/{{ $level->id }}',
                method: 'POST',
                data: { answer: answer },


                //MANEJO DE RESPUESTA CORRECTA
                success: function(data) {

                    // ACTUALIZA EL PUNTAJE TOTAL DEL ESTUDINTE
                    $('#total-score').text(data.total_score);

                    //MUESTRA EL MODAL CON EL RESULTADO
                    $('#result').removeClass('hidden');

                    // OCULTA EL CONTENEDOR DE RESPUESTAS
                    $('#answers').addClass('opacity-50 pointer-events-none');
                    

                    //SI LA RESPUESTA ES CORRECTA MUESTRA EL MENSAJE DE EXITO Y CAMBIA EL COLOR DEL BOTON A VERDE
                    if (data.correct) {
                        $('#success').removeClass('hidden');
                        $('#points').text(data.points);
                        $('.answer-button').each(function() {
                            if ($(this).text().trim() === answer) {
                                $(this).removeClass('bg-indigo-100').addClass('bg-green-200');
                            }
                        });
                        
                      // DE LO CONTRARIO MUESTRA EL MENSAJE DE ERROR Y CAMBIA EL COLOR DEL BOTON A ROJO  
                    } else {
                        $('#error').removeClass('hidden');
                        $('.answer-button').each(function() {
                            if ($(this).text().trim() === answer) {
                                $(this).removeClass('bg-indigo-100').addClass('bg-red-200');
                            }
                        });
                    }



                },
                //MANEJO DE RESPUESTA INCORRECTA
                error: function() {
                    alert('Hubo un error al procesar tu respuesta. Por favor, intenta de nuevo.');
                    $('.answer-button').prop('disabled', false);
                }
            });
        }
    </script>






</body>

</html>
