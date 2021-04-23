<?php

namespace App\Http\Controllers\API;

use App\Models\Artist;
use App\Models\Artwork;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArtistResource;
use App\Http\Resources\ArtworkResource;
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
            $order_key = 'artist_name';
            $order_value = 'asc';
        } else {
            $order_key = array_keys($query)[0];
            $order_value = $query[array_keys($query)[0]];

            if (! in_array($query[array_keys($query)[0]], ['asc', 'desc'], true)) {
                $order_value = 'asc';
            }
        }

        return ArtistResource::collection(
            Artist::orderBy($order_key, $order_value)->paginate(12)
        );
    }

    /**
     * Display a listing of artists for the specified nationality.
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function artworks($uuid)
    {
        Artist::findOrFail($uuid);

        return ArtworkResource::collection(
            Artwork::where('artist_uuid', $uuid)->paginate(10)
        );
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

        return ArtistResource::collection(
            Artist::where('artist_gender', $gender)
                ->orderBy($order_key, $order_value)->paginate(10)
        );
    }

    /**
     * Display a listing of artists for the specified nationality.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function nationalities(Request $request)
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
            $order_key = 'artist_nationality';
            $order_value = 'asc';
        } else {
            $order_key = array_keys($query)[0];
            $order_value = $query[array_keys($query)[0]];

            if (! in_array($query[array_keys($query)[0]], ['asc', 'desc'], true)) {
                $order_value = 'asc';
            }
        }

        return ArtistResource::collection(
            Artist::orderBy($order_key, $order_value)->paginate(10)
        );
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

        return ArtistResource::collection(
            Artist::where('artist_nationality', $cca3)
                ->orderBy($order_key, $order_value)->paginate(10)
        );
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
        return ArtistResource::collection(
            Artist::where('uuid', $uuid)->withCount('hasArtworks')->get()
        );
    }
}
