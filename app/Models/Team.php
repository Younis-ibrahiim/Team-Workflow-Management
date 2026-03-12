<?php

namespace App\Models;

use App\Traits\LogsActivity;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes, LogsActivity, Translatable;

    protected $translatable = ['name', 'description'];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->using(TeamUser::class)
            ->withPivot('role', 'joined_at')
            ->withTimestamps();
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
