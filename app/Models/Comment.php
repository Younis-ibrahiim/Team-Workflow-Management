<?php

namespace App\Models;

use App\Traits\BelongsToTeam;
use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{
    use BelongsToTeam, LogsActivity;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function commentable()
    {
        return $this->morphTo();
    }

     public function attachments() {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
