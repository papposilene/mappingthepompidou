<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArtistMovementResource extends JsonResource
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
            'uuid' => $this->isArtist->uuid,
            'navigart_id' => $this->isArtist->navigart_id,
            'artist_name' => $this->isArtist->artist_name,
            'artist_birth' => $this->isArtist->artist_birth,
            'artist_death' => $this->isArtist->artist_death,
            'artist_type' => $this->isArtist->artist_type,
            'artist_gender' => $this->isArtist->artist_gender,
        ];
    }
}
