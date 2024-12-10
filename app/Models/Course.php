<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Course extends Model
{
    use HasFactory, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'club_id',
        'coach_id',
        'lesson_id',
        'room_id',
        'startTime',
        'endTime',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
