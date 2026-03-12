<?php

namespace App\Traits;

use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;

trait BelongsToTeam
{
    protected static function bootBelongsToTeam(): void
    {
        // 1. GLOBAL SCOPE: Automatically filter all "SELECT" queries
        static::addGlobalScope('team_id', function (Builder $builder) {
            if (app()->bound('active_team_id')) {
                $builder->where('team_id', app('active_team_id'));
            }
        });

        // 2. CREATING EVENT: Automatically set team_id on "INSERT"
        static::creating(function ($model) {
            if (app()->bound('active_team_id')) {
                // Only set it if it hasn't been manually set already
                if (!$model->team_id) {
                    $model->team_id = app('active_team_id');
                }
            }
        });
    }

    //Relationship to the Team
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
