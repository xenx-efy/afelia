<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetTracks;
use App\Http\Requests\SearchByTags;
use App\Http\Requests\SearchByTitle;
use App\Http\Resources\CompositionCollection;
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

        return view('pages.track-list', compact('tracks', 'tags'));
    }

    /**
     * Get track list sorted by properties.
     * @link https://www.notion.so/xenx/API-1542727d71214b798d7d2050729244c5#057f7de39f4d4dd488e53cd8ec74a8af
     *
     * @param GetTracks $request
     * @return CompositionCollection
     */
    public function tracks(GetTracks $request)
    {
        $query = Composition::with('tags')->with('composer');

        if ($request->has(['sortBy', 'sortType'])){
            $query->orderBy($request->sortBy, $request->sortType);
        }

        $tracks = $query->paginate(self::PAGINATE_COUNT);

        return new CompositionCollection($tracks);
    }

    /**
     * Search tracks by title.
     * @link https://www.notion.so/xenx/API-1542727d71214b798d7d2050729244c5#b0c30d95e94445d8bc81ec98872addfc
     *
     * @param SearchByTitle $request
     * @return CompositionCollection
     */
    public function searchByTitle(SearchByTitle $request)
    {
        $trackTitle = $request->input('title');

        $tracks = Composition::query()
            ->where('title', 'like', '%' . $trackTitle . '%')
            ->with('tags')
            ->with('composer')
            ->paginate(self::PAGINATE_COUNT)
            ->appends('title', $trackTitle);

        return new CompositionCollection($tracks);
    }

    /**
     * Filter tracks by tags ids.
     * @param SearchByTags $request
     * @return CompositionCollection
     *
     * @link
     */
    public function searchByTags(SearchByTags $request)
    {
        $tags = $request->tags;

        $tracks = Composition::whereHas('tags', function ($query) use ($tags) {
            $query->whereIn('id', $tags);
        })->with('tags')->with('composer')->paginate(self::PAGINATE_COUNT);

        return new CompositionCollection($tracks);
    }
}
