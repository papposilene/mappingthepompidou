<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

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
        $slug = $this->acquisition_slug;

        if (Cache::has('_acquired_artists_count_for-' . $slug)) {
            $acquired_artists_count = Cache::get('_acquired_artists_count_for-' . $slug);
        } else {
            $acquired_artists_count = $this->acquiredArtists()->count();
            Cache::put('_acquired_artists_count_for-' . $slug, $acquired_artists_count);
        }

        if (Cache::has('_acquired_artworks_count_for-' . $slug)) {
            $acquired_artworks_count = Cache::get('_acquired_artworks_count_for-' . $slug);
        } else {
            $acquired_artworks_count = $this->acquiredArtworks()->count();
            Cache::put('_acquired_artworks_count_for-' . $slug, $acquired_artworks_count);
        }

        if (Cache::has('_women_count_for-' . $slug)) {
            $women_count = Cache::get('_women_count_for-' . $slug);
        } else {
            $women_count = $this->acquiredArtists()->where('artist_gender', 'woman')->count();
            Cache::put('_women_count_for-' . $slug, $women_count);
        }

        if (Cache::has('_men_count_for-' . $slug)) {
            $men_count = Cache::get('_men_count_for-' . $slug);
        } else {
            $men_count = $this->acquiredArtists()->where('artist_gender', 'man')->count();
            Cache::put('_men_count_for-' . $slug, $men_count);
        }

        if (Cache::has('_groups_count_for-' . $slug)) {
            $groups_count = Cache::get('_groups_count_for-' . $slug);
        } else {
            $groups_count = $this->acquiredArtists()->where('artist_gender', 'group')->count();
            Cache::put('_groups_count_for-' . $slug, $groups_count);
        }

        if (Cache::has('_unknown_count_for-' . $slug)) {
            $unknown_count = Cache::get('_unknown_count_for-' . $slug);
        } else {
            $unknown_count = $this->acquiredArtists()->where('artist_gender', null)->count();
            Cache::put('_unknown_count_for-' . $slug, $unknown_count);
        }

        return [
            'uuid' => $this->uuid,
            'acquisition_name' => $this->acquisition_name,
            'acquisition_slug' => $this->acquisition_slug,
            'acquired_artists_count' => $acquired_artists_count,
            'acquired_artworks_count' => $acquired_artworks_count,
            'artists' => [
                'gender_men' => $men_count,
                'gender_women' => $women_count,
                'gender_groups' => $groups_count,
                'gender_unknown' => $unknown_count,
            ],
        ];
    }
}
