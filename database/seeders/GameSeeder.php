<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\Level;

class GameSeeder extends Seeder
{
    public function run()
    {
        // Crear materias
        $matematicas = Subject::create([
            'name' => 'Matemáticas',
            'color' => 'primary',
            'description' => 'Aprende matemáticas de forma divertida',
            'icon' => 'calculator'
        ]);

        $ciencias = Subject::create([
            'name' => 'Ciencias Naturales',
            'color' => 'info',
            'description' => 'Explora el mundo natural y sus maravillas',
            'icon' => 'leaf'
        ]);

        $lectura = Subject::create([
            'name' => 'Lectura',
            'color' => 'success',
            'description' => 'Desarrolla tus habilidades de lectura y comprensión',
            'icon' => 'book-open'
        ]);

        // Niveles de Matemáticas
        $mathLevels = [
            [
                'level_number' => 1,
                'title' => 'Suma Básica',
                'description' => '¡Aprende a sumar números pequeños!',
                'question' => '¿Cuánto es 5 + 3?',
                'correct_answer' => '8',
                'wrong_answers' => ['7', '9', '6'],
                'points' => 10
            ],
            [
                'level_number' => 2,
                'title' => 'Resta Simple',
                'description' => 'Practica la resta con números pequeños',
                'question' => '¿Cuánto es 9 - 4?',
                'correct_answer' => '5',
                'wrong_answers' => ['4', '6', '3'],
                'points' => 15
            ],
            [
                'level_number' => 3,
                'title' => 'Multiplicación',
                'description' => 'Multiplica números de una cifra',
                'question' => '¿Cuánto es 6 × 7?',
                'correct_answer' => '42',
                'wrong_answers' => ['36', '49', '35'],
                'points' => 20
            ],
            [
                'level_number' => 4,
                'title' => 'División',
                'description' => 'Aprende a dividir números simples',
                'question' => '¿Cuánto es 15 ÷ 3?',
                'correct_answer' => '5',
                'wrong_answers' => ['4', '6', '3'],
                'points' => 25
            ],
            [
                'level_number' => 5,
                'title' => 'Problemas Mixtos',
                'description' => '¡Resuelve problemas que combinan operaciones!',
                'question' => 'Si tienes 4 grupos de 3 manzanas y regalas 2 manzanas, ¿cuántas te quedan?',
                'correct_answer' => '10',
                'wrong_answers' => ['8', '11', '9'],
                'points' => 30
            ]
        ];

        foreach ($mathLevels as $level) {
            $matematicas->levels()->create($level);
        }

        // Niveles de Ciencias Naturales
        $scienceLevels = [
            [
                'level_number' => 1,
                'title' => 'Los Animales',
                'description' => 'Aprende sobre diferentes tipos de animales',
                'question' => '¿Qué animal es un mamífero?',
                'correct_answer' => 'Delfín',
                'wrong_answers' => ['Tiburón', 'Tortuga', 'Rana'],
                'points' => 10
            ],
            [
                'level_number' => 2,
                'title' => 'Las Plantas',
                'description' => 'Descubre cómo crecen las plantas',
                'question' => '¿Qué necesitan las plantas para crecer?',
                'correct_answer' => 'Agua y luz solar',
                'wrong_answers' => ['Solo agua', 'Solo tierra', 'Solo luz'],
                'points' => 15
            ],
            [
                'level_number' => 3,
                'title' => 'El Cuerpo Humano',
                'description' => 'Conoce las partes del cuerpo',
                'question' => '¿Cuál es el órgano que bombea sangre?',
                'correct_answer' => 'Corazón',
                'wrong_answers' => ['Pulmón', 'Cerebro', 'Estómago'],
                'points' => 20
            ],
            [
                'level_number' => 4,
                'title' => 'El Sistema Solar',
                'description' => 'Explora los planetas',
                'question' => '¿Cuál es el planeta más cercano al Sol?',
                'correct_answer' => 'Mercurio',
                'wrong_answers' => ['Venus', 'Marte', 'Tierra'],
                'points' => 25
            ],
            [
                'level_number' => 5,
                'title' => 'Los Estados de la Materia',
                'description' => 'Aprende sobre sólidos, líquidos y gases',
                'question' => '¿En qué estado está el agua cuando hierve?',
                'correct_answer' => 'Gaseoso',
                'wrong_answers' => ['Líquido', 'Sólido', 'Plasma'],
                'points' => 30
            ]
        ];

        foreach ($scienceLevels as $level) {
            $ciencias->levels()->create($level);
        }

        // Niveles de Lectura
        $readingLevels = [
            [
                'level_number' => 1,
                'title' => 'Vocales',
                'description' => 'Identifica las vocales',
                'question' => '¿Cuál es la primera vocal del alfabeto?',
                'correct_answer' => 'A',
                'wrong_answers' => ['E', 'I', 'O'],
                'points' => 10
            ],
            [
                'level_number' => 2,
                'title' => 'Consonantes',
                'description' => 'Aprende las consonantes',
                'question' => '¿Qué letra hace el sonido "MMM"?',
                'correct_answer' => 'M',
                'wrong_answers' => ['N', 'P', 'B'],
                'points' => 15
            ],
            [
                'level_number' => 3,
                'title' => 'Sílabas',
                'description' => 'Une sílabas para formar palabras',
                'question' => '¿Cuántas sílabas tiene la palabra "mariposa"?',
                'correct_answer' => '4',
                'wrong_answers' => ['3', '5', '2'],
                'points' => 20
            ],
            [
                'level_number' => 4,
                'title' => 'Palabras',
                'description' => 'Forma oraciones simples',
                'question' => '¿Qué palabra completa la oración: "El perro ___ en el jardín"?',
                'correct_answer' => 'juega',
                'wrong_answers' => ['come', 'duerme', 'ladra'],
                'points' => 25
            ],
            [
                'level_number' => 5,
                'title' => 'Comprensión',
                'description' => 'Lee y comprende textos cortos',
                'question' => 'Juan tiene un gato negro que le gusta dormir. ¿De qué color es el gato de Juan?',
                'correct_answer' => 'Negro',
                'wrong_answers' => ['Blanco', 'Gris', 'Marrón'],
                'points' => 30
            ]
        ];

        foreach ($readingLevels as $level) {
            $lectura->levels()->create($level);
        }
    }
}
