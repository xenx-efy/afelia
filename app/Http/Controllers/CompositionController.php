<?php

namespace App\Http\Controllers;

use App\Http\Requests\Composition\StoreCompositionRequest;
use App\Http\Requests\Composition\DeleteCompositionRequest;
use App\Http\Requests\Composition\GetCompositionsRequest;
use App\Http\Requests\Composition\UpdateCompositionRequest;
use App\Http\Resources\CompositionCollection;
use App\Http\Resources\CompositionResource;
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
     * @OA\Get(
     *     path="/tracks",
     *     tags={"composition"},
     *     operationId="getCompositions",
     *     summary="Get all compositions with sorting",
     *     @OA\Response(
     *          response=200,
     *          description="Some response"
     *      ),
     * )
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
            $title = $request->title;
            $tracks = $query->where('title', 'like', '%' . $title . '%')
                ->orWhereHas('composer', function ($query) use ($title) {
                    $query->where('composer_name', 'like', '%' . $title . '%');
                })
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

    public function store(StoreCompositionRequest $request)
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

        return (new CompositionResource($track))->additional(['status' => 'success']);
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
