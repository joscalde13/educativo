<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego Educativo</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #4c4d6f 0%, #3ea7a7 100%);
            min-height: 100vh;
        }
        .game-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
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
<body class="flex items-center justify-center">
    
    <a href="{{ route('login') }}"
   class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
    Iniciar sesión
</a>

    <div class="game-card p-8 m-4 w-full max-w-4xl">
        <h1 class="text-4xl font-bold text-center text-indigo-600 mb-8">¡Bienvenido al Juego Educativo!</h1>
        
        @if(session('error'))
            <div class="error-message bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Formulario de búsqueda de estudiante existente -->
            <div class="border-r-2 border-gray-200 pr-4">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">¿Ya has jugado antes?</h2>
                <form action="{{ route('find-student') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="search_name" class="block text-lg font-medium text-gray-700 mb-2">Selecciona tu nombre:</label>
                        <select name="name" id="search_name" required
                            class="w-full px-4 py-3 rounded-lg border-2 border-indigo-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">Encuentra tu nombre</option>
                            @foreach($students as $student)
                                <option value="{{ $student->name }}">{{ $student->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <button type="submit"
                        class="w-full bg-purple-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-purple-700 transition duration-300">
                        Buscar mi progreso
                    </button>
                </form>
            </div>

            <!-- Formulario para nuevo estudiante -->
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-4">¿Primera vez jugando?</h2>
                <form action="{{ route('start-game') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="new_name" class="block text-lg font-medium text-gray-700 mb-2">Ingresa tu nombre:</label>
                        <input type="text" name="name" id="new_name" required
                            class="w-full px-4 py-3 rounded-lg border-2 border-indigo-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Tu nombre aquí">
                    </div>
                    
                    <button type="submit"
                        class="w-full bg-green-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-green-700 transition duration-300">
                        ¡Comenzar a jugar!
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
