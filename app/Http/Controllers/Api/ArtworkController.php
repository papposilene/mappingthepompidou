<?php

namespace App\Http\Controllers\API;

use App\Models\Artwork;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArtworkResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtworkController extends Controller
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
            'created_at', 'museum_department', 'navigart_id',
            'object_inventory', 'object_date', 'object_type',
            'object_visibility', 'acquisition_type', 'acquisition_date',
        ];

        $query = $request->query();
        $query = array_intersect_key(
            $query,
            array_flip($whitelist)
        );

        if (empty($query)) {
            $order_key = 'navigart_id';
            $order_value = 'asc';
        } else {
            $order_key = array_keys($query)[0];
            $order_value = $query[array_keys($query)[0]];

            if (! in_array($query[array_keys($query)[0]], ['asc', 'desc'], true)) {
                $order_value = 'asc';
            }
        }

        return ArtworkResource::collection(
            Artwork::orderBy($order_key, $order_value)->paginate(10)
        );
    }

    /**
     * Display a listing of artworks for the specified year.
     *
     * @param  int  $year
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function acquisition_date($year, Request $request)
    {
        $whitelist = [
            'created_at', 'navigart_id', 'museum_department',
            'object_inventory', 'object_title', 'object_date', 'object_type',
            'object_height', 'object_width', 'object_depth', 'object_weight',
            'object_visibility', 'acquisition_date',
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

        return ArtworkResource::collection(
            Artwork::where('acquisition_date', $year)->orderBy($order_key, $order_value)->paginate(10)
        );
    }

    /**
     * Display a listing of artworks for the specified type.
     *
     * @param  string  $slug
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function acquisition_type($slug, Request $request)
    {
        $whitelist = [
            'created_at', 'navigart_id', 'museum_department',
            'object_inventory', 'object_title', 'object_date', 'object_type',
            'object_height', 'object_width', 'object_depth', 'object_weight',
            'object_visibility', 'acquisition_type', 'acquisition_date',
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

        return ArtworkResource::collection(
            Artwork::where('acquisition_type', $slug)->orderBy($order_key, $order_value)->paginate(10)
        );
    }

    /**
     * Display a listing of artworks for the specified year.
     *
     * @param  boolean  $bool
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exposed($bool, Request $request)
    {
        $whitelist = [
            'created_at', 'navigart_id', 'museum_department',
            'object_inventory', 'object_title', 'object_date', 'object_type',
            'object_height', 'object_width', 'object_depth', 'object_weight',
            'object_visibility', 'acquisition_type', 'acquisition_date',
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

        return ArtworkResource::collection(
            Artwork::where('object_visibility', $bool)->orderBy($order_key, $order_value)->paginate(10)
        );
    }

    /**
     * Display a listing of artworks for the specified year.
     *
     * @param  string  $date
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function year($year, Request $request)
    {
        $whitelist = [
            'created_at', 'navigart_id', 'museum_department',
            'object_inventory', 'object_title', 'object_date', 'object_type',
            'object_height', 'object_width', 'object_depth', 'object_weight',
            'object_visibility', 'acquisition_type', 'acquisition_date',
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

        return ArtworkResource::collection(
            Artwork::where('object_date', 'LIKE', '%' . $year . '%')->orderBy($order_key, $order_value)->paginate(10)
        );
    }

    /**
     * Display the specified artwork.
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        Artwork::findOrFail($uuid);

        return ArtworkResource::collection(
            Artwork::where('uuid', $uuid)->get()
        );
    }
}
