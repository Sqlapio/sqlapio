<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilsController extends Controller
{
    static function get_action($value)
    {
        if($value == '1'){
            return 'login';
        }
        if($value == '2'){
            return 'logout';
        }
        if($value == '3'){
            return 'initial registration';
        }
        if($value == '4'){
            return 'update data';
        }
        if($value == '5'){
            return 'patient register';
        }
    }
}
