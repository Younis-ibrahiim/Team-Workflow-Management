<?php

namespace App\Models;

use App\Traits\BelongsToTeam;
use App\Traits\LogsActivity;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use BelongsToTeam, LogsActivity,Translatable;

    // Define which JSON columns the trait should handle
    protected $translatable = ['name', 'description'];
    
    protected $casts = [
        'name' => 'array',
        'description' => 'array',
    ];
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class,'attachable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }

}
