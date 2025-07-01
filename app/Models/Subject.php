<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'color', 'icon', 'description'];

    public function levels()
    {
        return $this->hasMany(Level::class);
    }
}
