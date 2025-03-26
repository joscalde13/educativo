<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elige tu Materia - Juego Educativo</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            min-height: 100vh;
        }
        .subject-card {
            transition: transform 0.3s ease;
        }
        .subject-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="flex flex-col items-center p-8">
    <div class="w-full max-w-4xl">
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h1 class="text-3xl font-bold text-center text-indigo-600">¡Bienvenido, {{ $student->name }}!</h1>
            <p class="text-center text-gray-600 mt-2">Puntaje Total: {{ $student->total_score }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Matemáticas -->
            <a href="{{ route('show-subject', ['student' => $student->id, 'subject' => 1]) }}" 
               class="subject-card bg-blue-500 rounded-lg p-6 text-center text-white hover:bg-blue-600">
                <i class="fas fa-calculator text-5xl mb-4"></i>
                <h2 class="text-2xl font-bold">Matemáticas</h2>
                <p class="mt-2">¡Resuelve problemas y aprende números!</p>
            </a>

            <!-- Ciencias Naturales -->
            <a href="{{ route('show-subject', ['student' => $student->id, 'subject' => 2]) }}"
               class="subject-card bg-green-500 rounded-lg p-6 text-center text-white hover:bg-green-600">
                <i class="fas fa-leaf text-5xl mb-4"></i>
                <h2 class="text-2xl font-bold">Ciencias Naturales</h2>
                <p class="mt-2">¡Explora la naturaleza y sus secretos!</p>
            </a>

            <!-- Lectura -->
            <a href="{{ route('show-subject', ['student' => $student->id, 'subject' => 3]) }}"
               class="subject-card bg-purple-500 rounded-lg p-6 text-center text-white hover:bg-purple-600">
                <i class="fas fa-book-open text-5xl mb-4"></i>
                <h2 class="text-2xl font-bold">Lectura</h2>
                <p class="mt-2">¡Descubre historias fascinantes!</p>
            </a>
        </div>
    </div>
</body>
</html>
