<?php

namespace App\Http\Controllers;

class CompositionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
}
