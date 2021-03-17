<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArtworkResource extends JsonResource
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
            'museum_department' => $this->museum_department,
            'artists' => $this->hasArtists()->get(),
            'navigart_id' => $this->artist_uuid,
            'object_inventory' => $this->object_inventory,
            'object_title' => $this->object_title,
            'object_date' => $this->object_date,
            'object_type' => $this->object_type,
            'object_technique' => $this->object_technique,
            'object_height' => $this->object_height,
            'object_width' => $this->object_width,
            'object_depth' => $this->object_depth,
            'object_weight' => $this->object_weight,
            'object_copyright' => $this->object_copyright,
            'object_visibility' => $this->object_visibility,
            'acquisition' => [
                'acquisition_type' => $this->acquiredBy->acquisition_name,
                'acquisition_slug' => $this->acquiredBy->acquisition_slug,
                'acquisition_date' => $this->acquisition_date,
            ],
            'movements' => $this->inMovements()->get(),
        ];
    }
}
