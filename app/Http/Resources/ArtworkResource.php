<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class ArtworkResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $slug = $this->navigart_id;

        if (Cache::has('_has_artists_for-' . $slug)) {
            $has_artists = Cache::get('_has_artists_for-' . $slug);
        }

        if (Cache::has('_in_movements_for-' . $slug)) {
            $in_movements = Cache::get('_in_movements_for-' . $slug);
        } else {
            $in_movements = $this->inMovements()->get();
            Cache::put('_in_movements_for-' . $slug, $in_movements);
        }

        return [
            'uuid' => $this->uuid,
            'museum_department' => [
                'department_uuid' => $this->inDepartment->uuid,
                'department_name' => $this->inDepartment->department_name,
                'department_slug' => $this->inDepartment->department_slug,
            ],
            'artists' => ($has_artists ?? $this->hasArtists()->get()),
            'navigart_id' => $this->navigart_id,
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
            'movements' => $in_movements,
        ];
    }
}
