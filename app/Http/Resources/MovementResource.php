<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovementResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'movement_name' => $this->movement_name,
            'movement_slug' => $this->movement_slug,
            'artists' => [
                'total' => $this->hasInspired()->count(),
                'gender_women' => $this->hasInspired()->where('artist_gender', 'woman')->count(),
                'gender_men' => $this->hasInspired()->where('artist_gender', 'man')->count(),
                'gender_groups' => $this->hasInspired()->where('artist_gender', 'group')->count(),
                'gender_unknown' => $this->hasInspired()->where('artist_gender', null)->count(),
            ],
            'artworks' => [
                'total' => $this->hasArtworks()->count(),
            ]
        ];
    }
}
