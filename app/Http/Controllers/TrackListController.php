<?php

namespace App\Http\Controllers;

class TrackListController extends Controller
{
    public function index()
    {
        return view('pages.track-list');
    }
}
