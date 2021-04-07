<?php

namespace App\Http\Controllers\API;

use App\Models\Artist;
use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DepartmentController extends Controller
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
            'created_at', 'cca3',
            'name_common_eng', 'name_common_fra',
        ];

        $query = $request->query();
        $query = array_intersect_key(
            $query,
            array_flip($whitelist)
        );

        if (empty($query)) {
            $order_key = 'cca3';
            $order_value = 'asc';
        } else {
            $order_key = array_keys($query)[0];
            $order_value = $query[array_keys($query)[0]];

            if (! in_array($query[array_keys($query)[0]], ['asc', 'desc'], true)) {
                $order_value = 'asc';
            }
        }

        return CountryResource::collection(
            Country::withCount('conservedArtworks')
                ->orderBy($order_key, $order_value)->paginate(10)
        );
    }

    /**
     * Retrieve artworks for a specified art movements.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function artist($slug)
    {
        $country = Country::where('department_slug', $slug)->firstOrFail();

        return CountryResource::collection(
            Artist::where('artist_nationality', $country->cca3)
                ->orderBy('object_date', 'desc')->paginate(10)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $cca3
     * @return \Illuminate\Http\Response
     */
    public function show($cca3)
    {
        Country::where('cca3', $cca3)->firstOrFail();

        return CountryResource::collection(
            Country::where('cca3', $cca3)
                ->withCount('hasArtists')->get()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function subregion($slug)
    {
        return CountryResource::collection(
            Country::where('subregion', $slug)
                ->withCount('hasArtists')->get()
        );
    }
}
