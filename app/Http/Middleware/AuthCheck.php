<?php

namespace App\Http\Middleware;

use App\Http\Livewire\Components\Login;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = DB::table('sessions')
        ->where('user_id', Auth::user()->id)->get();

        if(count($user)>1){
            $user = DB::table('sessions')
            ->where('user_id', Auth::user()->id)->delete();
            $error = __('messages.alert.sesion_duplicada');
            return response()->view('livewire.components.login', compact('error'));

        }else{
            return $next($request);
        }
    }
}
