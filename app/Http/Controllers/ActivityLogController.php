<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ActivityLogController extends Controller
{
    /**
     * Se encarga de guardar la actividad del usuario en base de datos
     * Recibe una variable $action, que es el numero de accion que realiza
     * el usuario en ese momento.
     * 
     * Esta variable $action se define en el UtilsController
     * 
     * @method store_log()
     * @var $action
     */
    static function store_log($action)
    {

        try {

            $user = Auth::user();

            $activity_log = new ActivityLog();
            $activity_log->user = $user->name.''.$user->last_name;
            $activity_log->user_email = $user->email;
            $activity_log->ip = $_SERVER['REMOTE_ADDR'];
            $activity_log->browser = $_SERVER['HTTP_USER_AGENT'];
            $activity_log->action = UtilsController::get_action($action);
            $activity_log->save();

        } catch (\Throwable $th) {

            Log::error(['exeption in store_log(). ActivityLogController', $th]);
        }
        

    }
}
