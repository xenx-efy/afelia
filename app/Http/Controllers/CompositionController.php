<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompositionRequest;
use App\Http\Resources\CompositionCollection;
use App\Models\Composition;

class CompositionController extends Controller
{

    private const PAGINATE_COUNT = 50;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Return composition data with filters and pagination.
     * @link https://www.notion.so/xenx/API-1542727d71214b798d7d2050729244c5#057f7de39f4d4dd488e53cd8ec74a8af
     *
     * @param CompositionRequest $request
     * @return CompositionCollection
     */
    public function index(CompositionRequest $request)
    {
        $query = Composition::with('tags')->with('composer');

        if ($request->has(['sortBy', 'sortType'])) {
            $query->orderBy($request->sortBy, $request->sortType);
        }

        if ($request->has('title')) {
            $title = $request->title;
            $tracks = $query->where('title', 'like', '%' . $title . '%')
                ->paginate(self::PAGINATE_COUNT)->appends('title', $title);
        } elseif ($request->has('tags')) {
            $tags = $request->tags;
            $tracks = $query->whereHas('tags', function ($query) use ($tags) {
                $query->whereIn('id', $tags);
            })->paginate(self::PAGINATE_COUNT)->appends('tags', $tags);
        } else {
            $tracks = $query->paginate(self::PAGINATE_COUNT);
        }

        return new CompositionCollection($tracks);
    }
}
