<?php

namespace App\Http\Controllers\Api;

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
            $order_key = 'created_at';
            $order_value = 'asc';
        } else {
            $order_key = array_keys($query)[0];
            $order_value = $query[array_keys($query)[0]];

            if (! in_array($query[array_keys($query)[0]], ['asc', 'desc'], true)) {
                $order_value = 'asc';
            }
        }

        return ArtworkResource::collection(Artwork::orderBy($order_key, $order_value)->paginate(20));
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

        return ArtworkResource::collection(Artwork::where('acquisition_date', $year)->orderBy($order_key, $order_value)->paginate(20));
    }

    /**
     * Display a listing of artworks for the specified type.
     *
     * @param  string  $type
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function acquisition_type($type, Request $request)
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

        return ArtworkResource::collection(Artwork::where('acquisition_type', $type)->orderBy($order_key, $order_value)->paginate(20));
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

        return ArtworkResource::collection(Artwork::where('object_visibility', $bool)->orderBy($order_key, $order_value)->paginate(20));
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

        return ArtworkResource::collection(Artwork::where('object_date', 'LIKE', '%' . $year . '%')->orderBy($order_key, $order_value)->paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        Artwork::findOrFail($uuid);
        return ArtworkResource::collection(Artwork::where('uuid', $uuid)->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        //
    }
}
