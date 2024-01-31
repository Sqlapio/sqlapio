<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MultilanguajeController extends Controller
{
    public function lang(Request $request, $lang)
    {
        session()->put('locale', $lang);
        return redirect()->back();
    }
}
