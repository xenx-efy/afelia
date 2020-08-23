<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompositionRequest;
use App\Http\Requests\DeleteCompositionRequest;
use App\Http\Requests\GetCompositionsRequest;
use App\Http\Requests\UpdateCompositionRequest;
use App\Http\Resources\CompositionCollection;
use App\Models\Composition;

class CompositionController extends Controller
{

    private const PAGINATE_COUNT = 50;

    //todo uncomment this
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Return composition data with filters and pagination.
     *
     * @link https://www.notion.so/xenx/API-1542727d71214b798d7d2050729244c5#057f7de39f4d4dd488e53cd8ec74a8af
     *
     * @param GetCompositionsRequest $request
     *
     * @return CompositionCollection
     */
    public function index(GetCompositionsRequest $request)
    {
        $query = Composition::with('tags')->with('composer');

        if ($request->has(['sortBy', 'sortType'])) {
            $query->orderBy($request->sortBy, $request->sortType);
        }

        if ($request->has('title')) {
            $tracks = $query->where('title', 'like', '%' . $request->title . '%')
                ->paginate(self::PAGINATE_COUNT)->appends('title', $request->title);
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

    public function create(CreateCompositionRequest $request)
    {
        /** @var Composition $track */
        $track = Composition::create([
            'title' => $request->title,
            'composer_id' => $request->composerId,
        ]);

        if ($request->has('tags')) {
            $track->tags()->sync($request->tags);

            $track->save();
        }

        return response('', 201);
    }

    public function update(UpdateCompositionRequest $request)
    {
        /** @var Composition $track */
        $track = Composition::find($request->trackId);

        $track->title = $request->title;
        $track->composer_id = $request->composerId;

        if ($request->has('tags')) $track->tags()->sync($request->tags);

        if (!$track->save()) return response()->json(['status' => 'error', 'errors' => [
            'message' => 'Ошибка сохранения произведения',
        ]]);

        return response('', 200);
    }

    public function delete(DeleteCompositionRequest $request)
    {
        /** @var Composition $track */
        $track = Composition::find($request->trackId);

        try {
            $track->delete();
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'errors' => [
                'message' => 'Ошибка удаления композиции.',
            ]]);
        }

        return response('', 200);
    }
}
