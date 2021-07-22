<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url,
            'state' => $this->state,
            'announced_at' => optional($this->announced_at)->formatLocalized(config('settings.date_format')),
            'finished_at' => optional($this->finished_at)->formatLocalized(config('settings.date_format')),
            'results_published_at' => optional($this->results_published_at)->formatLocalized(config('settings.date_format')),
            'created_at' => optional($this->created_at)->formatLocalized(config('settings.date_format')),
            'updated_at' => optional($this->updated_at)->formatLocalized(config('settings.date_format')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ];
    }
}
