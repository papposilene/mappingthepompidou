<?php

namespace App\Http\Controllers\Api;

use App\Models\Artist;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArtistResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ArtistController extends Controller
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
            'created_at', 'has_artworks_count', 'navigart_id',
            'artist_name', 'artist_type', 'artist_gender',
            'artist_birth', 'artist_death', 'artist_nationality',
        ];

        $query = $request->query();
        $query = array_intersect_key(
            $query,
            array_flip($whitelist)
        );

        if (empty($query)) {
            $order_key = 'has_artworks_count';
            $order_value = 'desc';
        } else {
            $order_key = array_keys($query)[0];
            $order_value = $query[array_keys($query)[0]];

            if (! in_array($query[array_keys($query)[0]], ['asc', 'desc'], true)) {
                $order_value = 'asc';
            }
        }

        return ArtistResource::collection(Artist::withCount('hasArtworks')->orderBy($order_key, $order_value)->paginate(20));
    }

    /**
     * Display a listing of artists for the specified gender.
     *
     * @param  string  $gender
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function gender($gender, Request $request)
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

        if (! in_array($gender, ['woman', 'man', 'group', 'unknown'], true)) {
            abort(503, 'Invalid parameters during querying API.');
        }

        if ($gender === 'unknown') $gender = null;

        return ArtistResource::collection(Artist::where('artist_gender', $gender)->orderBy($order_key, $order_value)->paginate(20));
    }

    /**
     * Display a listing of artists for the specified nationality.
     *
     * @param  string  $cca3
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function nationality($cca3, Request $request)
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

        return ArtistResource::collection(Artist::where('artist_nationality', $cca3)->orderBy($order_key, $order_value)->paginate(20));
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
        Artist::findOrFail($uuid);
        return ArtistResource::collection(Artist::where('uuid', $uuid)->get());
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
