<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject->name }} - Niveles</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            min-height: 100vh;
        }
        .level-card {
            transition: all 0.3s ease;
        }
        .level-card:hover:not(.locked) {
            transform: scale(1.05);
        }
        .locked {
            opacity: 0.7;
            cursor: not-allowed;
        }
    </style>


</head>
<body class="flex flex-col items-center p-8">
    <div class="w-full max-w-4xl">
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <a href="{{ route('subjects', ['student' => $student->id]) }}" class="text-indigo-600 hover:text-indigo-800">
                <i class="fas fa-arrow-left"></i> Volver a Materias
            </a>
            <h1 class="text-3xl font-bold text-center text-indigo-600 mt-4">{{ $subject->name }}</h1>
            <p class="text-center text-gray-600 mt-2">Estudiante: {{ $student->name }} | Puntaje: {{ $student->total_score }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($subject->levels as $level)
                @php
                    $completed = $scores->where('level_id', $level->id)->where('completed', true)->first();
                    $previousLevel = $subject->levels->where('level_number', $level->level_number - 1)->first();
                    $previousCompleted = $level->level_number == 1 || 
                        ($previousLevel && $scores->where('level_id', $previousLevel->id)->where('completed', true)->first());
                @endphp

                <div class="bg-white rounded-lg shadow-lg p-6 level-card {{ $previousCompleted ? '' : 'locked' }}">
                    <div class="relative">
                        @if($completed)
                            <div class="absolute -top-2 -right-2 bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center">
                                <i class="fas fa-check"></i>
                            </div>
                        @endif
                        
                        <div class="text-4xl mb-4 {{ $previousCompleted ? 'text-indigo-600' : 'text-gray-400' }}">
                            <i class="fas fa-star"></i>
                        </div>
                        
                        <h2 class="text-2xl font-bold {{ $previousCompleted ? 'text-gray-800' : 'text-gray-400' }}">
                            Nivel {{ $level->level_number }}
                        </h2>
                        
                        <p class="mt-2 text-gray-600">{{ $level->title }}</p>
                        
                        @if($previousCompleted)
                            <a href="{{ route('play-level', ['student' => $student->id, 'level' => $level->id]) }}"
                               class="mt-4 inline-block px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                {{ $completed ? 'Jugar de nuevo' : 'Jugar' }}
                            </a>
                        @else
                            <div class="mt-4 px-6 py-2 bg-gray-300 text-gray-600 rounded-lg">
                                <i class="fas fa-lock mr-2"></i> Bloqueado
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
