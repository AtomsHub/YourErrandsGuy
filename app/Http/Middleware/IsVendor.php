<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response; // ✅ Correct Response interface
use App\Models\Vendor;

class IsVendor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized. Please login.'
            ], 401);
        }

        // Check if user exists in the vendors table
        $isVendor = Vendor::where('id', $user->id)->exists();

        if (!$isVendor) {
            return response()->json([
                'message' => 'Access denied. Vendor only.'
            ], 403);
        }

        return $next($request);
    }
}
