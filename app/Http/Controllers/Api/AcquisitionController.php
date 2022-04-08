<?php

namespace App\Http\Controllers\Api;

use App\Models\Acquisition;
use App\Models\Artist;
use App\Models\Artwork;
use App\Http\Controllers\Controller;
use App\Http\Resources\AcquisitionResource;
use App\Http\Resources\ArtistResource;
use App\Http\Resources\ArtworkResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AcquisitionController extends Controller
{
    /**
     * Display a listing of the acquisition mode.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $whitelist = [
            'created_at', 'acquired_artists_count',
            'acquisition_name', 'acquisition_slug',
        ];

        $query = $request->query();
        $query = array_intersect_key(
            $query,
            array_flip($whitelist)
        );

        if (empty($query)) {
            $order_key = 'acquisition_name';
            $order_value = 'asc';
        } else {
            $order_key = array_keys($query)[0];
            $order_value = $query[array_keys($query)[0]];

            if (! in_array($query[array_keys($query)[0]], ['asc', 'desc'], true)) {
                $order_value = 'asc';
            }
        }

        return AcquisitionResource::collection(
            Acquisition::orderBy($order_key, $order_value)->paginate(10)
        );
    }

    /**
     * Retrieve artworks for a specified acquisition mode.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function artworks($slug)
    {
        $acquisition = Acquisition::where('acquisition_slug', $slug)->firstOrFail();

        return ArtworkResource::collection(
            Artwork::where('acquisition_uuid', $acquisition->uuid)->orderBy('object_date', 'desc')->paginate(10)
        );
    }

    /**
     * Display the specified acquisition mode.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        Acquisition::where('acquisition_slug', $slug)->firstOrFail();

        return AcquisitionResource::collection(
            Acquisition::where('acquisition_slug', $slug)->get()
        );
    }

}
