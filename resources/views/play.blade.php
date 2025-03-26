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
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
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

        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $level->title }}</h2>
                <p class="text-gray-600 mb-4">{{ $level->description }}</p>
                <div class="text-lg font-semibold text-gray-800">{{ $level->question }}</div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="answers">
                @php
                    $answers = array_merge([$level->correct_answer], $level->wrong_answers);
                    shuffle($answers);
                @endphp

                @foreach($answers as $answer)
                    <button class="answer-button bg-indigo-100 hover:bg-indigo-200 text-indigo-800 font-semibold py-4 px-6 rounded-lg text-left"
                            onclick="submitAnswer('{{ addslashes($answer) }}')">
                        {{ $answer }}
                    </button>
                @endforeach
            </div>

            <div id="result" class="mt-8 p-6 rounded-lg text-center hidden">
                <div id="success" class="hidden">
                    <i class="fas fa-check-circle text-6xl text-green-500 mb-4"></i>
                    <h3 class="text-2xl font-bold text-green-600 mb-2">¡Correcto!</h3>
                    <p class="text-gray-600">Has ganado <span id="points" class="font-bold"></span> puntos</p>
                </div>
                <div id="error" class="hidden">
                    <i class="fas fa-times-circle text-6xl text-red-500 mb-4"></i>
                    <h3 class="text-2xl font-bold text-red-600 mb-2">¡Inténtalo de nuevo!</h3>
                    <p class="text-gray-600">La respuesta no es correcta</p>
                </div>
                <button onclick="window.location.reload()" 
                        class="mt-4 bg-indigo-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-indigo-700">
                    Intentar de nuevo
                </button>
                <a href="{{ route('show-subject', ['student' => $student->id, 'subject' => $level->subject_id]) }}"
                   class="mt-4 inline-block bg-gray-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-gray-700">
                    Volver a Niveles
                </a>
            </div>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function submitAnswer(answer) {
            $('.answer-button').prop('disabled', true);
            
            $.ajax({
                url: '/submit-answer/{{ $student->id }}/{{ $level->id }}',
                method: 'POST',
                data: { answer: answer },
                success: function(data) {
                    $('#total-score').text(data.total_score);
                    $('#result').removeClass('hidden');
                    $('#answers').addClass('opacity-50 pointer-events-none');
                    
                    if (data.correct) {
                        $('#success').removeClass('hidden');
                        $('#points').text(data.points);
                        $('.answer-button').each(function() {
                            if ($(this).text().trim() === answer) {
                                $(this).removeClass('bg-indigo-100').addClass('bg-green-200');
                            }
                        });
                    } else {
                        $('#error').removeClass('hidden');
                        $('.answer-button').each(function() {
                            if ($(this).text().trim() === answer) {
                                $(this).removeClass('bg-indigo-100').addClass('bg-red-200');
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
