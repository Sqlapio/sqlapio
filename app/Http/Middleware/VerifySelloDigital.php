<?php

namespace App\Http\Middleware;

use App\Models\Specialty;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifySelloDigital
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $laboratory = ($user) ? $user->get_laboratorio : [];
        $speciality = Specialty::all();
        if (auth()->user() && auth()->user()->role == "medico"  && auth()->user()->digital_cello === null) {
            return response()->view('livewire.components.profile', compact('user', 'laboratory', 'speciality'));
        } else {
            return $next($request);
        }
        return $next($request);
    }
}
