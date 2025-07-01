<?php

namespace App\Http\Controllers;


use App\Models\Student; 
use App\Models\Subject; 
use App\Models\Level;
use App\Models\Score; 
use Illuminate\Http\Request; 



// CLASE QUE CONTROLARA TODO LA LOGICA DEL JUEGO

class GameController extends Controller
{
    


     // METODO PARA BUSCAR EL ESTUDIANTE EN DB Y LA MUESTRA EN WELCOME
    public function index()
    {
        $students = Student::orderBy('name')->get();
        return view('welcome', compact('students'));
    }


 

    // FUNCION PARA BUSCAR EL ESTUDIANTE EN LA VISTA WELCOME
    public function findStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|max:255'
        ]);

        //BUSCA EN DB CUYO NOMBRE EN DB COINCIDA CON EL NOMBRE QUE SE INGRESO EN EL FORMULARIO
        $student = Student::where('name', $request->name)->first();

        // SI NO ENCUENTRA NINGUN ESTUDIANTE CON ESE NOMBRE SE REDIRIGE A LA VISTA WELCOME CON UN MENSAJE DE ERROR
        if (!$student) {
            return redirect()->route('welcome')->with('error', 'No se encontró ningún estudiante con ese nombre. Por favor, verifica el nombre e intenta de nuevo.');
        }


        // VERIFICAR LA CLAVE
        if ($student->password !== $request->password) {
            return redirect()->route('welcome')->with('error', 'La clave es incorrecta. Por favor, verifica tu clave e intenta de nuevo.');
        }

        // SI ENCUENTRA UN ESTUDIANTE CON ESE NOMBRE Y LA CLAVE ES CORRECTA SE REDIRIGE A LA VISTA SUBJECTS CON EL ID DEL ESTUDIANTE
        return redirect()->route('subjects', ['student' => $student->id]);
    }




    // METODO PARA INGRESO DE NUEVO ESTUDIANTE
    public function startGame(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|max:255'
        ]);

        // VERRIFICA SI YA EXISTE UN ESTUDIANTE CON EL NOMBRE INGRESADO
        $existingStudent = Student::where('name', $request->name)->first();
        
        if ($existingStudent) {
            return redirect()->route('welcome')->with('error', 'Ya existe un estudiante con ese nombre. Por favor, busca tu nombre en la lista de estudiantes existentes.');
        }

        // CREA UN NUEVO ESTUDIANTE CON EL NOMBRE Y LA CLAVE INGRESADA
        $student = Student::create([
            'name' => $request->name,
            'password' => $request->password
        ]);

        return redirect()->route('subjects', ['student' => $student->id]);
    }

    


    

    // METODO PARA MOSTRAR EL ESTUDIANTE QUE VIENE DEL METODO StartGame 
    public function subjects($studentId)
    {
        // BUSCA EL ESTUDIANTE POR SU ID 
        $student = Student::findOrFail($studentId);

        // OBTIENE TODAS LAS MATERIAS DE BASE DE DATOS 
        $subjects = Subject::all();

        // MUESTRA EN LA VISTA LAS MATERIAS CON LOS DATOS DEL ESTUDIANTE
        return view('subjects', compact('student', 'subjects'));
    }

    





    // METODO PARA MOSTRAR LAS MATERIAS AL ESTUDIANTE RECIBIENDO DEL ESTUDIANTE EL ID Y EL ID DE LA MATERIA
    public function showSubject($studentId, $subjectId)
    {
        // BUSCA EL ESTUDIANTE POR SU ID EN DB
        $student = Student::findOrFail($studentId);


        // BUSCA LA MATERIA CON SUS NIVELES TOMANDO EL ID DE LA MATERIA DE DB Y DEPENDIENDO DE ESE ID MUESTRA LA MATERIA
        $subject = Subject::with('levels')->findOrFail($subjectId);
        
        
        // OBTIENE EL PUNTAJE DEL ESTUDIANTE POR MEDIO DEL ID Y EL NIVEL 
        $scores = Score::where('student_id', $studentId)
            ->whereHas('level', function($query) use ($subjectId) {
                $query->where('subject_id', $subjectId);
            })->get();


            
        // MUESTRA LA VISTA DE LEVELS PASANDO DATOS DEL ESTUDIANTE DE STUDENT MATERIA CON SUS NIVELES Y EL PUNTAJE DEL ESTUDIANTE
        return view('levels', compact('student', 'subject', 'scores'));
    }

    




    // METODO PARA VERIFICAR NIVELES COMPLETADOS DEL ESTUDIANTE
    public function playLevel($studentId, $levelId)
    {


        // BUSCA EL ESTUDIANTE Y SU NIVEL CON SU MATERIA RELACIONADA
        $student = Student::findOrFail($studentId);
        $level = Level::with('subject')->findOrFail($levelId);
        

        // VERIFICA QUE SI NO ES EL PRIMER NIVEL 
        if ($level->level_number > 1) {


            // LA VARIABLE PREVIUS LEVEL SE USA PARA VERIFICAR SI EL ESTUDIANTE COMPLETO EL ANTERIOR PASA AL SIGUIENTE NIVEL
            // LAS VARIABLES PREVIUSLEVEL Y PREVIOUSCOMPLETED SE USAN EN LA VISTA LEVELS.BLADE.PHP
            $previousLevel = Level::where('subject_id', $level->subject_id)
                
            
                // BUSCA EL NIVEL ANTERIOR 
                ->where('level_number', $level->level_number - 1)
                ->first();
            


            // VERIFICA SI EL ESTUDIANTE COMPLETO EL NIVEL ANTERIOR BUSCA EN TABLA SCORES DE DB
            $previousCompleted = Score::where('student_id', $studentId)
                ->where('level_id', $previousLevel->id)
                ->where('completed', true)
                ->exists();
            


            // SI NO COMPLETO EL NIVEL ANTERIOR REVUELVE A SUBJECTS PORQUE DEBERIA DE COMPLETAR 
            if (!$previousCompleted) {
                return redirect()->route('show-subject', [
                    'student' => $studentId,
                    'subject' => $level->subject_id
                ])->with('error', 'Debes completar el nivel anterior primero.');
            }
        }
        

        // MUESTRA LA VISTA DEL JUEGO CON EL NIVEL ACTUAL
        return view('play', compact('student', 'level'));
    }








    // METODO PARA VERIFICAR RESPUESTAS BUENAS O MALAS Y ACTUALIZAR EL SCORE DEL ESTUDIANTE CUANDO SELECCIONA UNA RESPUESTA
    public function submitAnswer(Request $request, $studentId, $levelId)
    {
        // BUSCA EL ESTUDIANTE Y EL NIVEL Y AMBOS POR SU ID LOS ENCUENTRA
        $student = Student::findOrFail($studentId);
        $level = Level::findOrFail($levelId);
        
        // VERIFICA SI LA RESPUESTA ES CORRECTA SI NO 0 PUNTOS
        $isCorrect = $request->answer === $level->correct_answer;
        $points = $isCorrect ? $level->points : 0;
        

        // BUSCA SI EL ESTUDIANTE YA INTENTO ESE NIVEL ANTES 
        $existingScore = Score::where('student_id', $studentId)
            ->where('level_id', $levelId)
            ->first();



        // SI YA EXISTE
        if ($existingScore) {

            // SI LA RESPUESTA ES CORRECTA Y NO HABIA COMPLETADO EL NIVEL
            if ($isCorrect && !$existingScore->completed) {

                // ACTUALIZA EL PUNTAJE EXISTENTE Y MARCA TRUE COMO COMPLETADO
                $existingScore->update([
                    'score' => $points,
                    'completed' => true
                ]);

                // INCREMENTA EL PUNTAJE TOTAL DEL ESTUDIANTE
                $student->increment('total_score', $points);
            }
        } else {

            // SI NO HAY PUNTEO Y LA RESPUESTA ES CORRECTA
            if ($isCorrect) {

                // CREA NUEVO REGISTRO EN LA TABLA SCORES DE DB GUARDA AL ESTUDIANTE
                Score::create([
                    'student_id' => $studentId,
                    'level_id' => $levelId,
                    'score' => $points,
                    'completed' => true
                ]);

                // SE INCREMENTA EL PUNTAJE TOTAL DEL ESTUDIANTE
                $student->increment('total_score', $points);
            }
        }

        // RETORNA RESPUESTA A LA VISTA 
        return response()->json([
            'correct' => $isCorrect,
            'points' => $points,
            'total_score' => $student->total_score
        ]);
    }






   

    


}