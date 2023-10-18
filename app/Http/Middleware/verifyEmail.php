<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;

class verifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


            if ($request->path() !=='logout'&&$request->path() !=='/' && auth()->user() && auth()->user()->email_verified_at === null) {
                $user = Auth::user();
                $laboratory = ($user) ? $user->get_laboratorio : [];
                return response()->view('livewire.components.profile', compact('user', 'laboratory'));
            } else {
                return $next($request);
            }
            return $next($request);
        
    }
}
