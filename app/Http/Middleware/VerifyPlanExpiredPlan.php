<?php

namespace App\Http\Middleware;

use App\Http\Livewire\Components\User;
use App\Models\User as ModelsUser;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyPlanExpiredPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()) {
            /** Validacion para plan vencido por transcurridos los 30 dias */
            $date_today =  date('Y-m-d');
            if (auth()->user()->date_end_plan == $date_today) {
                ModelsUser::where('id', auth()->user()->id)
                    ->update([
                        'expired_plan' => true,
                    ]);
                return response()->view('livewire.components.verifyplans-component');
            }
        }
        return $next($request);
    }
}
