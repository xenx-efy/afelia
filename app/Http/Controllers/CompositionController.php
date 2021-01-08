<?php

namespace App\Http\Controllers;

use App\Http\Requests\Composition\StoreCompositionRequest;
use App\Http\Requests\Composition\GetCompositionsRequest;
use App\Http\Requests\Composition\UpdateCompositionRequest;
use App\Http\Resources\CompositionCollection;
use App\Http\Resources\CompositionResource;
use App\Models\Composition;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

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
     *     tags={"Composition"},
     *     operationId="getCompositions",
     *     summary="Получение треков с возможностью сортировки.",
     *     @OA\Parameter(
     *         description="Сортироует треки по орпеделенному полю.",
     *         in="query",
     *         name="sortBy",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             enum={"title", "last_played"},
     *         ),
     *     ),
     *     @OA\Parameter(
     *         description="Прямая или обратная сортировка.",
     *         in="query",
     *         name="sortType",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             enum={"asc", "desc"},
     *         ),
     *     ),
     *     @OA\Parameter(
     *         description="Фильтрация по названию трека или фамилии композитора.",
     *         in="query",
     *         name="title",
     *         required=false,
     *         @OA\Schema(
     *           type="string",
     *         ),
     *     ),
     *     @OA\Parameter(
     *         description="Фильтрация по тегам",
     *         in="query",
     *         name="tags[]",
     *         required=false,
     *         @OA\Schema(
     *           type="array",
     *           @OA\Items(type="integer"),
     *         ),
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success response"
     *      ),
     * )
     *
     * @param GetCompositionsRequest $request
     *
     * @return CompositionCollection
     */
    public function index(GetCompositionsRequest $request): JsonResource
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
                ->orderBy('title', 'asc')
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

    /**
     * Save track to db
     *
     * @OA\Post(
     *     path="/tracks",
     *     tags={"Composition"},
     *     operationId="storeCompositions",
     *     summary="Создает композицию с информацией о ней.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="Название произведения",
     *                     property="title",
     *                     type="string",
     *                     example="Adazio",
     *                 ),
     *                 @OA\Property(
     *                     description="Id композитора произведения",
     *                     property="composerId",
     *                     type="integer",
     *                     example=12,
     *                 ),
     *                 @OA\Property(
     *                     description="Теги произведения",
     *                     property="tags",
     *                     type="array",
     *                     example=1,
     *                     @OA\Items(type="integer"),
     *                 ),
     *                 required={"title", "composerId", "tags"},
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success response"
     *      ),
     *     @OA\Response(
     *          response=201,
     *          description="Success creation"
     *      ),
     * )
     * @param StoreCompositionRequest $request
     * @return JsonResource
     */
    public function store(StoreCompositionRequest $request): JsonResource
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

    /**
     * Update track
     *
     * @OA\Put(
     *     path="/tracks/{id}",
     *     tags={"Composition"},
     *     operationId="updateComposition",
     *     summary="Обновляет информацию о треке.",
     *     @OA\Parameter(
     *         description="Id обновляемого трека",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *         ),
     *     ),
     *     @OA\RequestBody(
     *         description="Формат входящих данных",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     description="Название произведения",
     *                     property="title",
     *                     type="string",
     *                     example="Adazio",
     *                 ),
     *                 @OA\Property(
     *                     description="Id композитора произведения",
     *                     property="composerId",
     *                     type="integer",
     *                     example=12,
     *                 ),
     *                 @OA\Property(
     *                     description="Теги произведения",
     *                     property="tags",
     *                     type="array",
     *                     @OA\Items(type="integer"),
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success response"
     *     ),
     * )
     *
     * @param int $id
     * @param UpdateCompositionRequest $request
     *
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function update($id, UpdateCompositionRequest $request)
    {
        $trackId = (int)$id;
        /** @var Composition $track */
        $track = Composition::find($trackId);

        $track->title = $request->title;
        $track->composer_id = $request->composerId;

        if ($request->has('tags')) {
            $track->tags()->sync($request->tags);
        }

        if (!$track->save()) {
            return response()->json(['status' => 'error', 'errors' => [
                'message' => 'Ошибка сохранения произведения',
            ]]);
        }

        return response('', 200);
    }

    /**
     * Delete track
     *
     * @OA\Delete(
     *     path="/tracks/{id}",
     *     tags={"Composition"},
     *     operationId="deleteCompotition",
     *     summary="Удалить трек.",
     *     @OA\Parameter(
     *         description="Id удаляемого трека",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success response"
     *     ),
     * )
     *
     * @param $id
     *
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function delete($id)
    {
        $trackId = (int)$id;

        /** @var Composition $track */
        $track = Composition::find($trackId);

        try {
            $track->delete();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'errors' => [
                'message' => 'Ошибка удаления композиции.',
            ]]);
        }

        return response('', 200);
    }

    public function nowPlayed($id)
    {
        $trackId = (int)$id;

        $track = Composition::find($trackId);

        $track->last_played = now();

        $track->save();

        return response()->json('');
    }
}
