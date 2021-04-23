<?php

namespace App\Http\Controllers\API;

use App\Models\Artist;
use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArtistResource;
use App\Http\Resources\CountryResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $whitelist = [
            'created_at', 'has_artists_count', 'cca3',
            'name_common_eng', 'name_common_fra',
        ];

        $query = $request->query();
        $query = array_intersect_key(
            $query,
            array_flip($whitelist)
        );

        if (empty($query)) {
            $order_key = 'has_artists_count';
            $order_value = 'desc';
        } else {
            $order_key = array_keys($query)[0];
            $order_value = $query[array_keys($query)[0]];

            if (! in_array($query[array_keys($query)[0]], ['asc', 'desc'], true)) {
                $order_value = 'asc';
            }
        }

        return CountryResource::collection(
            Country::withCount('hasArtists')
                ->orderBy($order_key, $order_value)->paginate(27)
        );
    }

    /**
     * Display a listing of artists for the specified nationality.
     *
     * @param  string  $cca3
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function artists($cca3, Request $request)
    {
        $whitelist = [
            'created_at', 'navigart_id',
            'artist_name', 'artist_type', 'artist_gender',
            'artist_birth', 'artist_death', 'artist_nationality',
        ];

        $query = $request->query();
        $query = array_intersect_key(
            $query,
            array_flip($whitelist)
        );
        if (empty($query)) {
            $order_key = 'created_at';
            $order_value = 'asc';
        } else {
            $order_key = array_keys($query)[0];
            $order_value = $query[array_keys($query)[0]];

            if (! in_array($query[array_keys($query)[0]], ['asc', 'desc'], true)) {
                $order_value = 'asc';
            }
        }

        return ArtistResource::collection(
            Artist::where('artist_nationality', $cca3)
                ->orderBy($order_key, $order_value)->paginate(10)
        );
    }

    /**
     * Retrieve a list of artists for a specified continent.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function regions($slug)
    {
        return CountryResource::collection(
            Country::where('region', $slug)
                ->withCount('hasArtists')->paginate(10)
        );
    }

    /**
     * Retrieve a list of artists for a specified subregion.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function subregions($slug)
    {
        return CountryResource::collection(
            Country::where('subregion', $slug)
                ->withCount('hasArtists')->paginate(10)
        );
    }

    /**
     * Retrieve a list of artists for a specified country.
     *
     * @param  string  $cca3
     * @return \Illuminate\Http\Response
     */
    public function countries($cca3)
    {
        Country::where('cca3', $cca3)->firstOrFail();

        return CountryResource::collection(
            Country::where('cca3', strtolower($cca3))
                ->withCount('hasArtists')->paginate(10)
        );
    }
}
