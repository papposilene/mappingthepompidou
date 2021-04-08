<?php

namespace App\Http\Controllers\API;

use App\Models\Artist;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArtistResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    /**
     * Retrieve artists for a specified gender.
     *
     * @param  string  $slug
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($slug, Request $request)
    {
        $whitelist = [
            'created_at', 'navigart_id',
            'artist_name', 'artist_type',
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
            Artist::where('artist_gender', $slug)
                ->orderBy($order_key, $order_value)->paginate(10)
        );
    }
}
