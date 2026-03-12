<?php

namespace App\Models;

use App\Traits\BelongsToTeam;
use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use BelongsToTeam, LogsActivity;

    public function attachable()
    {
        return $this->morphTo();
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
