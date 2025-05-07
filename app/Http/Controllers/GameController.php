<?php

namespace App\Http\Controllers;

// Importamos los modelos y clases que vamos a usar
use App\Models\Student; 
use App\Models\Subject; 
use App\Models\Level;
use App\Models\Score; 
use Illuminate\Http\Request; // Clase para manejar solicitudes HTTP



// CLASE QUE CONTROLARA TODO LA LOGICA DEL JUEGO
class GameController extends Controller
{
    /**
     * Muestra la página principal del juego
     *
     * @return \Illuminate\View\View
     */

     
    public function index()
    {
        $students = Student::orderBy('name')->get();
        return view('welcome', compact('students'));
    }

    /**
     * Inicia un nuevo juego para un estudiante
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function startGame(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        // Buscar si ya existe un estudiante con ese nombre
        $student = Student::where('name', $request->name)->first();

        // Si no existe, crear uno nuevo
        if (!$student) {
            $student = Student::create([
                'name' => $request->name
            ]);
        }

        return redirect()->route('subjects', ['student' => $student->id]);
    }

    /**
     * Muestra las materias disponibles para un estudiante
     *
     * @param  int  $studentId
     * @return \Illuminate\View\View
     */
    public function subjects($studentId)
    {
        // Busca el estudiante por ID (si no existe, lanza error 404)
        $student = Student::findOrFail($studentId);
        // Obtiene todas las materias de la base de datos
        $subjects = Subject::all();
        // Muestra la vista de materias con los datos del estudiante y las materias
        return view('subjects', compact('student', 'subjects'));
    }

    /**
     * Muestra los niveles de una materia para un estudiante
     *
     * @param  int  $studentId
     * @param  int  $subjectId
     * @return \Illuminate\View\View
     */
    public function showSubject($studentId, $subjectId)
    {
        // Busca el estudiante por ID
        $student = Student::findOrFail($studentId);
        // Busca la materia y carga sus niveles relacionados
        $subject = Subject::with('levels')->findOrFail($subjectId);
        // Obtiene los puntajes del estudiante para esta materia
        $scores = Score::where('student_id', $studentId)
            ->whereHas('level', function($query) use ($subjectId) {
                $query->where('subject_id', $subjectId);
            })->get();

        // Muestra la vista de niveles con los datos necesarios
        return view('levels', compact('student', 'subject', 'scores'));
    }

    /**
     * Muestra un nivel de juego para un estudiante
     *
     * @param  int  $studentId
     * @param  int  $levelId
     * @return \Illuminate\View\View
     */
    public function playLevel($studentId, $levelId)
    {
        // Busca el estudiante y el nivel (con su materia relacionada)
        $student = Student::findOrFail($studentId);
        $level = Level::with('subject')->findOrFail($levelId);
        
        // Si no es el primer nivel, verifica si el nivel anterior está completado
        if ($level->level_number > 1) {
            // Busca el nivel anterior de la misma materia
            $previousLevel = Level::where('subject_id', $level->subject_id)
                ->where('level_number', $level->level_number - 1)
                ->first();
            
            // Verifica si el estudiante completó el nivel anterior
            $previousCompleted = Score::where('student_id', $studentId)
                ->where('level_id', $previousLevel->id)
                ->where('completed', true)
                ->exists();
            
            // Si no completó el nivel anterior, redirige con mensaje de error
            if (!$previousCompleted) {
                return redirect()->route('show-subject', [
                    'student' => $studentId,
                    'subject' => $level->subject_id
                ])->with('error', 'Debes completar el nivel anterior primero.');
            }
        }
        
        // Muestra la vista del juego con el nivel actual
        return view('play', compact('student', 'level'));
    }

    /**
     * Procesa la respuesta de un estudiante a un nivel de juego
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $studentId
     * @param  int  $levelId
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitAnswer(Request $request, $studentId, $levelId)
    {
        // Busca el estudiante y el nivel
        $student = Student::findOrFail($studentId);
        $level = Level::findOrFail($levelId);
        
        // Verifica si la respuesta es correcta y calcula los puntos
        $isCorrect = $request->answer === $level->correct_answer;
        $points = $isCorrect ? $level->points : 0;
        
        // Busca si ya existe un puntaje para este nivel y estudiante
        $existingScore = Score::where('student_id', $studentId)
            ->where('level_id', $levelId)
            ->first();
            
        if ($existingScore) {
            // Si ya existe un puntaje y la respuesta es correcta
            if ($isCorrect && !$existingScore->completed) {
                // Actualiza el puntaje existente y marca como completado
                $existingScore->update([
                    'score' => $points,
                    'completed' => true
                ]);
                // Incrementa el puntaje total del estudiante
                $student->increment('total_score', $points);
            }
        } else {
            // Si no existe un puntaje previo y la respuesta es correcta
            if ($isCorrect) {
                // Crea un nuevo registro
                Score::create([
                    'student_id' => $studentId,
                    'level_id' => $levelId,
                    'score' => $points,
                    'completed' => true
                ]);
                // Incrementa el puntaje total del estudiante
                $student->increment('total_score', $points);
            }
        }

        // Retorna la respuesta en formato JSON con el resultado
        return response()->json([
            'correct' => $isCorrect,
            'points' => $points,
            'total_score' => $student->total_score
        ]);
    }

    public function findStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $student = Student::where('name', $request->name)->first();

        if (!$student) {
            $students = Student::orderBy('name')->get();
            return redirect()->route('home')->with([
                'error' => 'No se encontró ningún estudiante con ese nombre. Por favor, selecciona tu nombre de la lista.',
                'students' => $students
            ]);
        }

        return redirect()->route('subjects', ['student' => $student->id]);
    }
}
