<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class ArtworkMovementResource extends JsonResource
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
            'uuid' => $this->isArtwork->uuid,
            'museum_department' => [
                'department_uuid' => $this->isArtwork->inDepartment->uuid,
                'department_name' => $this->isArtwork->inDepartment->department_name,
                'department_slug' => $this->isArtwork->inDepartment->department_slug,
            ],
            'artists' => $this->isArtwork->hasArtists()->get(),
            'navigart_id' => $this->isArtwork->navigart_id,
            'object_inventory' => $this->isArtwork->object_inventory,
            'object_title' => $this->isArtwork->object_title,
            'object_date' => $this->isArtwork->object_date,
            'object_type' => $this->isArtwork->object_type,
            'object_technique' => $this->isArtwork->object_technique,
            'object_height' => $this->isArtwork->object_height,
            'object_width' => $this->isArtwork->object_width,
            'object_depth' => $this->isArtwork->object_depth,
            'object_weight' => $this->isArtwork->object_weight,
            'object_copyright' => $this->isArtwork->object_copyright,
            'object_visibility' => $this->isArtwork->object_visibility,
            'acquisition' => [
                'acquisition_type' => $this->isArtwork->acquiredBy->acquisition_name,
                'acquisition_slug' => $this->isArtwork->acquiredBy->acquisition_slug,
                'acquisition_date' => $this->isArtwork->acquisition_date,
            ],
        ];
    }
}
