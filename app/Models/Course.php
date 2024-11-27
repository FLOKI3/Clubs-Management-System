<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'club_id',
        'guard_name',
        'lesson_id',
        'coach_id',
        'room_id',
        'startTime',
        'endTime',
    ];

    /**
     * Get the club that owns the course.
     */
    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    /**
     * Get the lesson associated with the course.
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * Get the coach assigned to the course.
     */
    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    /**
     * Get the room assigned to the course.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
