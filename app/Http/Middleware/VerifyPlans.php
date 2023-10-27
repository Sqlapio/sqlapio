<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyPlans
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(auth()->user() ){
            if (auth()->user()->patient_counter >= 20 ||
                auth()->user()->medical_record_counter >= 20 ||
                auth()->user()->ref_counter >= 20
            ) {
    
                return response()->view('livewire.components.verifyplans-component');
            } else {
                return $next($request);
            }
        }
        return $next($request);
    }
}
