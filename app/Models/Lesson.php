<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['name', 'club_id'];

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
