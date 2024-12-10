<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Club extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class, 'club_id');
    }

    public function manager()
    {
        return $this->hasOne(User::class, 'club_id')->whereHas('roles', function ($query) {
            $query->where('name', 'manager');
        });
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('clubs_logo')->singleFile();
    }
}
