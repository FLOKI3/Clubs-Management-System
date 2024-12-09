<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Club extends Model implements HasMedia
{
    use InteractsWithMedia;

    // Allow 'name' to be mass-assigned; 'manager_id' removed
    protected $fillable = ['name'];

    /**
     * Get all users belonging to the club.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'club_id');
    }

    /**
     * Get the manager of the club (assuming a single manager per club).
     * This assumes the manager is a user with the 'manager' role.
     */
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

    /**
     * Register media collections.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('clubs_logo')->singleFile();
    }
}
