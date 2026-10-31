<?php

namespace App\Http\Middleware;

use App\Models\Tracker;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        Tracker::create([
            'page' => $request->path(),
            'ip' => $request->ip(),
            'status' => $response->getStatusCode(),
            'user_agent' => substr($request->userAgent(), 0, 255), // Зберігаємо User-Agent для аналізу
            'visited_at' => now(),
        ]);

        return $response;
    }
}
