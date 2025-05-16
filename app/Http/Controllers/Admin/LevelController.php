<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;




class LevelController extends Controller
{


    
    // MÉTODO PARA MOSTRAR LA LISTA DE MATERIAS CON SUS NIVELES
    public function index()
    {

        // OBTIENE TODAS LAS MATERIAS CON SUS NIVELES RELACIONADOS
        $subjects = Subject::with('levels')->get();


        // RETORNA LA VISTA CON LAS MATERIAS
        return view('admin.levels.index', compact('subjects'));
    }







    // MÉTODO PARA MOSTRAR EL FORMULARIO DE CREACIÓN DE UN NUEVO NIVEL
    public function create()
    {
        // OBTIENE TODAS LAS MATERIAS
        $subjects = Subject::all();
        $nextLevelNumbers = [];


        // RECORRE CADA MATERIA PARA CALCULAR EL SIGUIENTE NÚMERO DE NIVEL
        foreach ($subjects as $subject) {


            // OBTIENE EL ÚLTIMO NIVEL DE LA MATERIA ORDENADO DE FORMA DESCENDENTE
            $lastLevel = $subject->levels()->orderBy('level_number', 'desc')->first();


            // SI EXISTE UN NIVEL, SUMA 1. SI NO, COMIENZA EN 1
            $nextLevelNumbers[$subject->id] = $lastLevel ? $lastLevel->level_number + 1 : 1;

        }

        // RETORNA LA VISTA DE CREACIÓN CON LAS MATERIAS Y EL NÚMERO SIGUIENTE DE NIVEL
        return view('admin.levels.create', compact('subjects', 'nextLevelNumbers'));
    }






    // MÉTODO PARA GUARDAR UN NUEVO NIVEL EN LA BASE DE DATOS
    public function store(Request $request)
    {

        // VALIDACIÓN DE LOS CAMPOS DEL FORMULARIO
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'level_number' => [
                'required',
                'integer',
                'min:1',


                // VALIDACIÓN PERSONALIZADA PARA EVITAR NIVELES DUPLICADOS EN LA MISMA MATERIA
                function ($attribute, $value, $fail) use ($request) {
                    $exists = Level::where('subject_id', $request->subject_id)
                        ->where('level_number', $value)
                        ->exists();
                    if ($exists) {
                        $fail('Ya existe un nivel con este número en la materia seleccionada.');
                    }
                }
            ],

            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'question' => 'required|string',
            'correct_answer' => 'required|string',
            'wrong_answers' => 'required|array',
            'points' => 'required|integer|min:1',
        ]);

        // CREA EL NUEVO NIVEL CON LOS DATOS VALIDADOS
        Level::create($validated);


        // REDIRECCIONA A LA LISTA DE NIVELES CON UN MENSAJE DE ÉXITO
        return redirect()->route('admin.levels.index')
            ->with('success', 'Nivel creado exitosamente');
    }






    // MÉTODO PARA MOSTRAR EL FORMULARIO DE EDICIÓN DE UN NIVEL EXISTENTE
    public function edit(Level $level)
    {
        $subjects = Subject::all();

        return view('admin.levels.edit', compact('level', 'subjects'));
    }






    // MÉTODO PARA ACTUALIZAR UN NIVEL EXISTENTE
    public function update(Request $request, Level $level)
    {

        // VALIDACIÓN DE LOS CAMPOS
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'level_number' => [
                'required',
                'integer',
                'min:1',


                // VALIDACIÓN PERSONALIZADA PARA EVITAR DUPLICADOS (EXCLUYENDO EL MISMO NIVEL)
                function ($attribute, $value, $fail) use ($request, $level) {
                    $exists = Level::where('subject_id', $request->subject_id)
                        ->where('level_number', $value)
                        ->where('id', '!=', $level->id)
                        ->exists();
                    if ($exists) {
                        $fail('Ya existe un nivel con este número en la materia seleccionada.');
                    }
                }
            ],

            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'question' => 'required|string',
            'correct_answer' => 'required|string',
            'wrong_answers' => 'required|array',
            'points' => 'required|integer|min:1',
        ]);



        // ACTUALIZA EL NIVEL CON LOS DATOS VALIDADOS
        $level->update($validated);



        // REDIRECCIONA CON UN MENSAJE DE ÉXITO
        return redirect()->route('admin.levels.index')
            ->with('success', 'Nivel actualizado exitosamente');
    }






    // MÉTODO PARA ELIMINAR UN NIVEL
    public function destroy(Level $level)
    {
        $level->delete();

        return redirect()->route('admin.levels.index')
            ->with('success', 'Nivel eliminado exitosamente');

    }


    

}