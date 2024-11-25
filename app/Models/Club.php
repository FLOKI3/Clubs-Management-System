<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Club extends Model
{
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
}
