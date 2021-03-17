<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArtistResource extends JsonResource
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
            'navigart_id' => $this->artist_id,
            'artist_name' => $this->artist_name,
            'artist_birth' => $this->artist_birth,
            'artist_death' => $this->artist_death,
            'artist_type' => $this->artist_type,
            'artist_gender' => $this->artist_gender,
            'artworks' => [
                'total' => $this->hasArtworks()->count(),
            ],
            'movements' => [
                'total' => $this->hasWorkedFor()->count(),
                'list' => $this->hasWorkedFor()->get(),
            ],
        ];
    }
}
