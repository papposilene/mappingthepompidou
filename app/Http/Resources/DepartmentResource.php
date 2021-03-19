<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
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
            'department_name' => $this->department_name,
            'department_slug' => $this->department_slug,
            'conserved_artists_count' => $this->conserved_artists_count,
            'conserved_artworks_count' => $this->conserved_artworks_count,
            'artists' => [
                'gender_women' => $this->conservedArtists()->where('artist_gender', 'woman')->count(),
                'gender_men' => $this->conservedArtists()->where('artist_gender', 'man')->count(),
                'gender_groups' => $this->conservedArtists()->where('artist_gender', 'group')->count(),
                'gender_unknown' => $this->conservedArtists()->where('artist_gender', null)->count(),
            ],
        ];
    }
}
