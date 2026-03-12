<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TeamUser extends Pivot
{
    use LogsActivity;
    protected $table='team_user';

    protected $fillable = [
        'team_id',
        'user_id',
        'role',
        'joined_at'
    ];

    public const ROLE_ADMIN   = 'admin';
    public const ROLE_MANAGER = 'manager';
    public const ROLE_MEMBER  = 'member';
}
