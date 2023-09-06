<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->get('Roles') === "hmsi") {
            // Apply the 'auth' middleware if the session variable condition is met.
            return $next($request);
        }

        // If the condition is not met, you can perform other actions or redirect.
        // For example, you could redirect the user to the login page or show an error.
        return redirect()->route('login');
    }
}
