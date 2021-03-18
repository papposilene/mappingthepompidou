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
            'conserved_artworks_count' => $this->conserved_artworks_count,
        ];
    }
}
