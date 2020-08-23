<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComposerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'composerName' => $this->composer_name,
        ];
    }
}
