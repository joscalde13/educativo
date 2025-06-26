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

        // Obtener progreso de cada estudiante
        $students = Student::with(['scores.level.subject'])->get()->map(function($student) {
            $scores = $student->scores;
            $totalLevels = Level::count();
            $completedLevels = $scores->where('completed', true)->count();
            $averageScore = $scores->avg('score') ?? 0;
            
            // Agrupar por materia
            $progressBySubject = $scores->groupBy('level.subject.name')->map(function($subjectScores, $subjectName) {
                $subjectLevels = $subjectScores->groupBy('level.subject_id')->first()->count();
                $completedSubjectLevels = $subjectScores->where('completed', true)->count();
                $subjectAverage = $subjectScores->avg('score') ?? 0;
                
                return [
                    'name' => $subjectName,
                    'total_levels' => $subjectLevels,
                    'completed_levels' => $completedSubjectLevels,
                    'average_score' => $subjectAverage,
                    'progress_percentage' => $subjectLevels > 0 ? round(($completedSubjectLevels / $subjectLevels) * 100, 1) : 0
                ];
            });

            return [
                'id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'total_levels' => $totalLevels,
                'completed_levels' => $completedLevels,
                'average_score' => $averageScore,
                'progress_percentage' => $totalLevels > 0 ? round(($completedLevels / $totalLevels) * 100, 1) : 0,
                'progress_by_subject' => $progressBySubject
            ];
        });

        return view('home', compact('metrics', 'subjects', 'students'));
    }
}
