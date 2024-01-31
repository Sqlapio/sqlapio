<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MultilanguajeController extends Controller
{
    public function lang($lang)
    {
        session()->put('locale', $lang);
        return true;
    }
}
