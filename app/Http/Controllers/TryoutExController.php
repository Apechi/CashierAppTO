<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TryoutExController extends Controller
{


    public function about()
    {
        return view('app.other.about');
    }


    public function layanan()
    {
        return view('app.other.service');
    }
}
