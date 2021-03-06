<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class DocumentResource extends JsonResource
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
            'name' => $this->name,
            'download_count' => $this->download_count,
            'file' => new MediaResource($this->file),
            'created_at' => trim($this->created_at->formatLocalized(config('settings.date_format'))),
            'updated_at' => trim($this->updated_at->formatLocalized(config('settings.date_format'))),
            'types' => TagResource::collection($this->whenLoaded('types')),
            'topics' => TagResource::collection($this->whenLoaded('topics')),
            'roles' => TagResource::collection($this->whenLoaded('roles')),
        ];
    }
}
