<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role == 'Administrator') {
            return $next($request);
        }
        // For AJAX/JSON requests, return 403 JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Forbidden.'], 403);
        }
        // Try to redirect back if possible to avoid forcing dashboard
        $previous = url()->previous();
        if ($previous && $previous !== url()->current()) {
            return redirect()->back()->with('error', 'You do not have permissions to view this content!.');
        }
        // Fallback to dashboard
        return redirect('dashboard')->with('error', 'You do not have permissions to view this content!.');
    }
}
