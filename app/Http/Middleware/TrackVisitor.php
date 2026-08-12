<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\VisitorCounter;
use App\Models\PageView;
use Illuminate\Support\Str;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip for admin routes and API routes
        if ($request->is('admin/*') || $request->is('api/*') || $request->is('livewire/*')) {
            return $next($request);
        }

        // Handle unique visitor counter
        if (!session()->has('visited')) {
            session()->put('visited', true);
            
            $counter = VisitorCounter::firstOrCreate(['id' => 1]);
            $counter->increment('count');
        }

        // Handle page view tracking (optional, but good for detailed analytics)
        $sessionId = session()->getId();
        if (!$sessionId) {
            session()->start();
            $sessionId = session()->getId();
        }

        PageView::create([
            'url' => $request->fullUrl(),
            'session_id' => $sessionId,
            'ip_address' => $request->ip(),
            'user_agent' => substr($request->header('User-Agent'), 0, 255),
        ]);

        return $next($request);
    }
}
