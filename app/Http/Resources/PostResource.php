<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $locale = $request->get('locale', app()->getLocale());
        Carbon::setlocale($locale);

        return [
            'id' => $this->id,
            'title' => $this->getTranslation('title', $locale),
            'perex' => $this->getTranslation('perex', $locale),
            'date' => trim($this->published_at->formatLocalized('%e. %B %Y')),
            'url' => $this->url,
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ];
    }
}
