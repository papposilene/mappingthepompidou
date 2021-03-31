<?php

namespace App\Http\Controllers\API;

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

        if (Cache::has('_acquisitions_data_withcounts')) {
            $acquisitions_data = Cache::get('_acquisitions_data_withcounts');
        } else {
            $acquisitions_data = Acquisition::withCount(['acquiredArtists', 'acquiredArtworks'])->get();
            Cache::put('_acquisitions_data_withcounts', $acquisitions_data);
        }

        return AcquisitionResource::collection($acquisitions_data->orderBy($order_key, $order_value)->paginate(10));
    }

    /**
     * Retrieve artworks for a specified art movements.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function artworks($slug)
    {
        $acquisition = Acquisition::where('acquisition_slug', $slug)->firstOrFail();

        if (Cache::has('_artworks_data_for-' . $slug)) {
            $artworks_data = Cache::get('_artworks_data_for-' . $slug);
        } else {
            $artworks_data = Artwork::where('acquisition_uuid', $acquisition->uuid)->get();
            Cache::put('_artworks_data_for-' . $slug, $artworks_data);
        }

        return ArtworkResource::collection($artworks_data->orderBy('object_date', 'desc')->paginate(10));
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

        if (Cache::has('_acquisitions_data_withcounts_for-' . $slug)) {
            $acquisitions_data = Cache::get('_acquisitions_data_withcounts_for-' . $slug);
        } else {
            $acquisitions_data = Acquisition::where('acquisition_slug', $slug)->withCount(
                [
                    'acquiredArtists',
                    'acquiredArtworks',
                ])->get();
            Cache::put('_acquisitions_data_withcounts_for-' . $slug, $acquisitions_data);
        }

        return AcquisitionResource::collection($acquisitions_data);
    }

}
