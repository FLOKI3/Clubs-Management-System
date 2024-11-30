<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Models\Role;

class Club extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name', 'manager_id', 'guard_name'];


    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
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
