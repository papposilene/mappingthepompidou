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
        $movementsTop10 = $this->acquiredMovements()->limit(10)->get();

        return [
            'uuid' => $this->uuid,
            'acquisition_name' => $this->acquisition_name,
            'acquisition_slug' => $this->acquisition_slug,
            'artists' => [
                'total' => $this->acquiredArtists()->count(),
                'gender_women' => $this->acquiredArtists()->where('artist_gender', 'woman')->count(),
                'gender_men' => $this->acquiredArtists()->where('artist_gender', 'man')->count(),
                'gender_groups' => $this->acquiredArtists()->where('artist_gender', 'group')->count(),
                'gender_unknown' => $this->acquiredArtists()->where('artist_gender', null)->count(),
            ],
            'artworks' => [
                'total' => $this->hasArtworks()->count(),
            ],
            //'movements' => [
            //    $movementsTop10,
            //],
        ];
    }
}
