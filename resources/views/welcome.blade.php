<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego Educativo</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            min-height: 100vh;
        }
        .game-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="flex items-center justify-center">
    <div class="game-card p-8 m-4 w-full max-w-md">
        <h1 class="text-4xl font-bold text-center text-indigo-600 mb-8">¡Bienvenido al Juego Educativo!</h1>
        
        <form action="{{ route('start-game') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-lg font-medium text-gray-700 mb-2">¿Cómo te llamas?</label>
                <input type="text" name="name" id="name" required
                    class="w-full px-4 py-3 rounded-lg border-2 border-indigo-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="Escribe tu nombre aquí">
            </div>
            
            <button type="submit"
                class="w-full bg-indigo-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-indigo-700 transition duration-300">
                ¡Comenzar a Jugar!
            </button>
        </form>
    </div>
</body>
</html>
