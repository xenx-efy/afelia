<?php

namespace App\Http\Controllers;

use App\Models\Composer;
use App\Models\Composition;
use App\Models\Tag;
use Illuminate\View\View;

class TrackListController extends Controller
{
    private const PAGINATE_COUNT = 50;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Generate view with track and tags.
     *
     * @return View
     */
    public function index()
    {
        $tracks = Composition::with('tags')->orderBy('title')->paginate(self::PAGINATE_COUNT);
        $tags = Tag::get();
        $composers = Composer::get();

        return view('pages.track-list', compact('tracks', 'tags', 'composers'));
    }
}
