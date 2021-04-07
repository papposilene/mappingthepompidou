<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $slug = $this->cca3;

        if (Cache::has('_has_artists_count_for-' . $slug)) {
            $has_artists_count = Cache::get('_has_artists_count_for-' . $slug);
        } else {
            $has_artists_count = $this->hasArtists()->count();
            Cache::put('_has_artists_count_for-' . $slug, $has_artists_count);
        }

        if (Cache::has('_women_count_for-' . $slug)) {
            $women_count = Cache::get('_women_count_for-' . $slug);
        } else {
            $women_count = $this->hasArtists()->where('artist_gender', 'woman')->count();
            Cache::put('_women_count_for-' . $slug, $women_count);
        }

        if (Cache::has('_men_count_for-' . $slug)) {
            $men_count = Cache::get('_men_count_for-' . $slug);
        } else {
            $men_count = $this->hasArtists()->where('artist_gender', 'man')->count();
            Cache::put('_men_count_for-' . $slug, $men_count);
        }

        if (Cache::has('_groups_count_for-' . $slug)) {
            $groups_count = Cache::get('_groups_count_for-' . $slug);
        } else {
            $groups_count = $this->hasArtists()->where('artist_gender', 'group')->count();
            Cache::put('_groups_count_for-' . $slug, $groups_count);
        }

        if (Cache::has('_unknown_count_for-' . $slug)) {
            $unknown_count = Cache::get('_unknown_count_for-' . $slug);
        } else {
            $unknown_count = $this->hasArtists()->where('artist_gender', null)->count();
            Cache::put('_unknown_count_for-' . $slug, $unknown_count);
        }

        return [
            'uuid' => $this->uuid,
            'country_common_eng' => $this->name_common_eng,
            'country_common_fra' => $this->name_common_fra,
            'country_official_eng' => $this->name_official_eng,
            'country_official_fra' => $this->name_official_fra,
            'country_cca2' => $this->cca2,
            'country_cca3' => $this->cca3,
            'country_region' => $this->region,
            'country_subregion' => $this->subregion,
            'country_latlng' => $this->latlng,
            'country_flag' => $this->flag,
            'has_artists_count' => $has_artists_count,
            'artists' => [
                'gender_men' => $men_count,
                'gender_women' => $women_count,
                'gender_groups' => $groups_count,
                'gender_unknown' => $unknown_count,
            ],
        ];
    }
}
