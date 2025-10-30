<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FixCSPMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        // Fix CSP for Livewire/Filament
        $response->headers->set('Content-Security-Policy', 
            "default-src 'self' http: https: data: blob: 'unsafe-inline' 'unsafe-eval'"
        );
        
        return $response;
    }
}

            "default-src 'self' http: https: data: blob: 'unsafe-inline' 'unsafe-eval'"
        );
        
        return $response;
    }
}
