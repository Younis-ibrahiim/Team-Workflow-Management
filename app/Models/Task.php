<?php

namespace App\Models;

use App\Traits\BelongsToTeam;
use App\Traits\LogsActivity;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Task extends Model
{
    use SoftDeletes,BelongsToTeam, LogsActivity,Translatable;

    protected $translatable = ['title', 'description'];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
