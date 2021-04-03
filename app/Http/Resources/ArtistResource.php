<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

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
            'navigart_id' => $this->navigart_id,
            'artist_name' => $this->artist_name,
            'artist_birth' => $this->artist_birth,
            'artist_death' => $this->artist_death,
            'artist_type' => $this->artist_type,
            'artist_gender' => $this->artist_gender,
            'nationality' => [
                'country_uuid' => ($this->hasNationality ? $this->hasNationality->uuid : null),
                'country_name' => ($this->hasNationality ? $this->hasNationality->name_common_fra : 'Pays inconnu'),
                'country_flag' => ($this->hasNationality ? $this->hasNationality->flag : null),
            ],
            'has_artworks_count' => $this->has_artworks_count,
            'movements' => [
                'total' => $this->hasWorkedFor()->count(),
                'list' => $this->hasWorkedFor()->get(),
            ],
        ];
    }
}
