<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Level;
use App\Models\Score;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $metrics = [
            'total_students' => Student::count(),
            'total_subjects' => Subject::count(),
            'total_levels' => Level::count(),
            'total_scores' => Score::count(),
            'average_score' => Score::avg('score') ?? 0,
            'completed_levels' => Score::where('completed', true)->count(),
        ];

        // Obtener métricas por materia
        $subjects = Subject::with(['levels.scores'])->get()->map(function($subject) {
            // Obtener todas las puntuaciones de los niveles de esta materia
            $scores = collect();
            foreach ($subject->levels as $level) {
                $scores = $scores->merge($level->scores);
            }

            return [
                'id' => $subject->id,
                'name' => $subject->name,
                'total_levels' => $subject->levels->count(),
                'completed_levels' => $scores->where('completed', true)->count(),
                'average_score' => $scores->avg('score') ?? 0,
                'total_students' => $scores->groupBy('student_id')->count(),
            ];
        });

        return view('home', compact('metrics', 'subjects'));
    }
}
