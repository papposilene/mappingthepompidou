<?php

namespace App\Http\Controllers\Api;

use App\Models\Acquisition;
use App\Http\Controllers\Controller;
use App\Http\Resources\AcquisitionResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AcquisitionController extends Controller
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
            'created_at', 'acquired_artists_count',
            'acquisition_name', 'acquisition_slug',
        ];

        $query = $request->query();
        $query = array_intersect_key(
            $query,
            array_flip($whitelist)
        );

        if (empty($query)) {
            $order_key = 'acquired_artists_count';
            $order_value = 'desc';
        } else {
            $order_key = array_keys($query)[0];
            $order_value = $query[array_keys($query)[0]];

            if (! in_array($query[array_keys($query)[0]], ['asc', 'desc'], true)) {
                $order_value = 'asc';
            }
        }

        return AcquisitionResource::collection(Acquisition::withCount(
            [
                'acquiredArtists',
                'acquiredArtworks',
                //'acquiredMovements',
            ])->orderBy($order_key, $order_value)->paginate(20));
    }

    /**
     * Retrieve artists for a specified art movements.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function artists($slug)
    {
        $acquisition = Acquisition::where('acquisition_slug', $slug)->firstOrFail();
        return ArtistResource::collection(Artist::where('acquisition_uuid', $acquisition->uuid)->paginate(20));
    }

    /**
     * Retrieve artworks for a specified art movements.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function artworks($slug)
    {
        Acquisition::where('acquisition_slug', $slug)->firstOrFail();
        return ArtworkResource::collection(Artwork::where('acquisition_uuid', $acquisition->uuid)->paginate(20));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        Acquisition::where('acquisition_slug', $slug)->firstOrFail();
        return AcquisitionResource::collection(Acquisition::where('acquisition_slug', $slug)->withCount(
            [
                'acquiredArtists',
                'acquiredArtworks',
                //'acquiredMovements',
            ])->get());
    }

}
