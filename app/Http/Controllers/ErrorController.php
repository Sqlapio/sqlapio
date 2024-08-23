<?php

namespace App\Http\Controllers;

use App\Models\ErrorLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ErrorController extends Controller
{
    static function error_log($modulo, $error)
    {
        ErrorLog::create([
            'user' => Auth::user()->email,
            'modulo' => $modulo,
            'error' => $error,
            ]);
    }
}
