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
        $slug = $this->navigart_id;

        if (Cache::has('_has_artworks_count_for-' . $slug)) {
            $has_artworks_count = Cache::get('_has_artworks_count_for-' . $slug);
        } else {
            $has_artworks_count = $this->hasArtworks()->count();
            Cache::put('_has_artworks_count_for-' . $slug, $has_artworks_count);
        }

        if (Cache::has('_has_worked_count_for-' . $slug)) {
            $has_worked_count = Cache::get('_has_worked_count_for-' . $slug);
        } else {
            $has_worked_count = $this->hasWorkedFor()->count();
            Cache::put('_has_worked_count_for-' . $slug, $has_worked_count);
        }

        if (Cache::has('_has_worked_for-' . $slug)) {
            $has_worked = Cache::get('_has_worked_for-' . $slug);
        } else {
            $has_worked = $this->hasWorkedFor()->get();
            Cache::put('_has_worked_for-' . $slug, $has_worked);
        }

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
                'country_cca3' => ($this->hasNationality ? strtolower($this->hasNationality->cca3) : null),
                'country_name' => ($this->hasNationality ? $this->hasNationality->name_common_fra : 'Pays inconnu'),
                'country_flag' => ($this->hasNationality ? $this->hasNationality->flag : '🏳️'),
            ],
            'has_artworks_count' => $has_artworks_count,
            'movements' => [
                'total' => $has_worked_count,
                'list' => $has_worked,
            ],
        ];
    }
}
