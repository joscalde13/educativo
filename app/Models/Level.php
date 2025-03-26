<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = [
        'subject_id',
        'level_number',
        'title',
        'description',
        'question',
        'correct_answer',
        'wrong_answers',
        'points'
    ];

    protected $casts = [
        'wrong_answers' => 'array'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
