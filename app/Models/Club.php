<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Club extends Model
{
    protected $fillable = ['name', 'manager_id'];

    protected static function booted()
    {
        static::created(function ($club) {
            // Assign "Manager" role dynamically
            $manager = $club->manager;
            if ($manager) {
                $roleName = 'manager_of_club_' . $club->name;

                // Assign the role to the user
                $manager->assignRole($roleName);
            }
        });
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
