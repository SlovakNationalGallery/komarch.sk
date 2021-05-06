<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
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
            'name' => $this->getTranslation('name', 'sk'),
            'slug' => $this->getTranslation('slug', 'sk'),
            'type' => $this->type,
        ];
    }
}
