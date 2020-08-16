<?php

namespace App\Http\Controllers;

use App\Models\Composition;
use App\Models\Tag;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     * @link https://www.notion.so/xenx/API-1542727d71214b798d7d2050729244c5#b0c30d95e94445d8bc81ec98872addfc
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function searchByTitle(Request $request)
    {
        $validator = Validator::make($request->all(),
            ['title' => 'required|min:3'],
            [
                'title.required' => 'Название произведение не должно быть пустым.',
                'title.min' => 'Название произведения не должно быть меньше трех символов.'
            ]);

        if ($validator->fails()) {
            $errorMessages = $validator->getMessageBag()->getMessages();

            return response()->json(['status' => 'error', 'messages' => $errorMessages], 400);
        }
        $trackTitle = $request->input('title');

        $searchResults = Composition::query()->where('title', 'like', '%' . $trackTitle . '%')
            ->paginate(50)
            ->appends('title', $trackTitle);

        $response = collect(['status' => 'success'])->merge($searchResults);

        return response()->json($response, 200);
    }

    public function searchByTags(Request $request)
    {
        $validator = Validator::make($request->all(), ['tags.*' => 'required|numeric'],
            [
                'tags.require' => 'Необходимо выбрать хоть один тег.',
                'tags.numeric' => 'Необходимо чтобы теги были числами.'
            ]);

        if ($validator->fails()) {
            $errorMessages = $validator->getMessageBag()->getMessages();

            return response()->json(['status' => 'error', 'messages' => $errorMessages], 400);
            // todo сделать вывод сообщений нормальным, сейчас "the tags 3 must be a number"
        }

        $tags = $request->input('tags');

        $searchResults = Composition::whereHas('tags', function ($query) use ($tags) {
            $query->whereIn('id', $tags);
        })->with('tags')->paginate(50);

        $response = collect(['status' => 'success', $searchResults]);

        return response()->json($response, 200);
    }
}
