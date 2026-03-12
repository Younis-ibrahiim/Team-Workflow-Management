<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'system_role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isSystemAdmin(){
        return $this->system_role === 'adminstrator';
    }
    public function teams()
    {
        return $this->belongsToMany(Team::class)
            ->using(TeamUser::class)
            ->withPivot('role', 'joined_at')
            ->withTimestamps();
    }

    public function assignedTasks(){
        return $this->hasMany(Task::class,'assigned_user_id');
    }

     public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }
}
