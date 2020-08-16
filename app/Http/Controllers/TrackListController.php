<?php

namespace App\Http\Controllers;

use App\Models\Composition;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrackListController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        $tracks = Composition::with('tags')->orderBy('title')->paginate(12);
        $tags = Tag::get();

        return view('pages.track-list', compact('tracks', 'tags'));
    }

    /**
     * Search tracks by title.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function searchByTitle(Request $request)
    {
        $trackTitle = $request->input('title');

        $searchResults = Composition::query()->where('title', 'like', $trackTitle)->paginate(50);

        return response()->json($searchResults);
    }
}
