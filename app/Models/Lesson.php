<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Lesson extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name', 'club_id'];

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('lessons_logo')->singleFile();
    }
}
