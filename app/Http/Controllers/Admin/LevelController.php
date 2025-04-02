<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('levels')->get();
        return view('admin.levels.index', compact('subjects'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $nextLevelNumbers = [];
        
        // Obtener el siguiente número de nivel para cada materia
        foreach ($subjects as $subject) {
            $lastLevel = $subject->levels()->orderBy('level_number', 'desc')->first();
            $nextLevelNumbers[$subject->id] = $lastLevel ? $lastLevel->level_number + 1 : 1;
        }
        
        return view('admin.levels.create', compact('subjects', 'nextLevelNumbers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'level_number' => [
                'required',
                'integer',
                'min:1',
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

        Level::create($validated);

        return redirect()->route('admin.levels.index')
            ->with('success', 'Nivel creado exitosamente');
    }

    public function edit(Level $level)
    {
        $subjects = Subject::all();
        return view('admin.levels.edit', compact('level', 'subjects'));
    }

    public function update(Request $request, Level $level)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'level_number' => [
                'required',
                'integer',
                'min:1',
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

        $level->update($validated);

        return redirect()->route('admin.levels.index')
            ->with('success', 'Nivel actualizado exitosamente');
    }

    public function destroy(Level $level)
    {
        $level->delete();
        return redirect()->route('admin.levels.index')
            ->with('success', 'Nivel eliminado exitosamente');
    }
} 