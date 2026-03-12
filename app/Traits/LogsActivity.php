<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    /**
     * Boot the trait and register model observers.
     */
    protected static function bootLogsActivity(): void
    {
        // Listen for the 'created' event
        static::created(function ($model) {
            $model->recordActivity('created');
        });

        // Listen for the 'updated' event
        static::updated(function ($model) {
            $model->recordActivity('updated');
        });

        // Listen for the 'deleted' event
        static::deleted(function ($model) {
            $model->recordActivity('deleted');
        });
    }

    /**
     * Save the activity to the database.
     */
    protected function recordActivity(string $action): void
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'team_id' => app()->bound('active_team_id') ? app('active_team_id') : null,
            'action' => $action,
            'loggable_id' => $this->id,
            'loggable_type' => get_class($this),
            'changes' => $action === 'updated' ? $this->getDirty() : null,
        ]);
    }
}
