<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class ArchitectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(
            Arr::only(
                $this->resource->attributesToArray(),
                ['id', 'first_name', 'last_name', 'works_count', 'awards_count']
            ),
            [
                'location_city' => Arr::get($this, 'address.location_city'),
                'url' => 'TODO',
            ],
        );
    }
}
