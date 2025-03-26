<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'total_score'];

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
