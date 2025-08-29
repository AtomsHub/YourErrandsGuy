<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Dispatcher; // Make sure this model exists

class IsDispatcher
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized. Please login.'
            ], 401);
        }

        // Check if user exists in the dispatchers table
        $isDispatcher = Dispatcher::where('user_id', $user->id)->exists();

        if (!$isDispatcher) {
            return response()->json([
                'message' => 'Access denied. Dispatcher only.'
            ], 403);
        }

        return $next($request);
    }
}
