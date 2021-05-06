<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
        $locale = LaravelLocalization::getCurrentLocale();
        Carbon::setlocale($locale);

        return [
            'id' => $this->id,
            'title' => $this->getTranslation('title', $locale),
            'perex' => $this->getTranslation('perex', $locale),
            'date' => $this->published_at->formatLocalized('%d %B %Y'),
            'url' => $this->url,
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ];
    }
}
