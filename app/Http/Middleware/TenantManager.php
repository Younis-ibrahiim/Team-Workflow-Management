<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class TenantManager
{

    public function handle(Request $request, Closure $next): Response
    {
        // 1. Skip if user is not logged in
        if (! Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();
        $sessionTeamId = session('active_team_id');

        // 2. Resolve: If session is empty, try to auto-set it
        if (! $sessionTeamId) {
            $teamCount = $user->teams()->count();

            if ($teamCount === 1) {
                // Auto-select the only team they have
                $sessionTeamId = $user->teams()->first()->id;
                session(['active_team_id' => $sessionTeamId]);
            } elseif ($teamCount === 0 && ! $request->routeIs('teams.*')) {
                // Redirect to create team if they have none
                return redirect()->route('teams.create');
            } elseif ($teamCount > 1 && ! $request->routeIs('teams.selector')) {
                // Redirect to pick a team if they have many
                return redirect()->route('teams.selector');
            }
        }

        // 3. Set Context: Bind the ID to the Service Container
        // This ""BelongsToTeam"" Trait will use
        if ($sessionTeamId) {
            app()->instance('active_team_id', $sessionTeamId);
        }

        return $next($request);
    }
}
