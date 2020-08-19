<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Jenssegers\Date\Date;

class CompositionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (int)$this->id,
            'title' => (string)$this->title,
            'tags' => $this->whenLoaded('tags'),
            'composer' => new ComposerResource($this->whenLoaded('composer')),
            'lastPlayed' => Date::parse($this->last_played)->format('d F Y'),
        ];
    }
}
