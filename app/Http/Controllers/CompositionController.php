<?php

namespace App\Http\Controllers;

use App\Models\Composition;

class CompositionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tracks = Composition::with('tags')->orderBy('title')->paginate(12);

        return view('pages.track-list', compact('tracks'));
    }
}
