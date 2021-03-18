<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AcquisitionResource extends JsonResource
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
            'acquisition_name' => $this->acquisition_name,
            'acquisition_slug' => $this->acquisition_slug,
            'acquired_artists_count' => $this->acquired_artists_count,
            'acquired_artworks_count' => $this->acquired_artworks_count,
            //'acquired_movements_count' => $this->acquired_movements_count,
            'artists' => [
                'total' => $this->acquiredArtists()->count(),
                'gender_women' => $this->acquiredArtists()->where('artist_gender', 'woman')->count(),
                'gender_men' => $this->acquiredArtists()->where('artist_gender', 'man')->count(),
                'gender_groups' => $this->acquiredArtists()->where('artist_gender', 'group')->count(),
                'gender_unknown' => $this->acquiredArtists()->where('artist_gender', null)->count(),
            ],
            'artworks' => [
                'total' => $this->acquiredArtworks()->count(),
            ],
        ];
    }
}
