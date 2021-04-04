<?php

namespace App\Http\Controllers\API;

use App\Models\ArtistMovement;
use App\Models\ArtworkMovement;
use App\Models\Movement;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArtistMovementResource;
use App\Http\Resources\ArtworkMovementResource;
use App\Http\Resources\MovementResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    /**
     * Retrieve art movements data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $whitelist = [
            'created_at', 'movement_name', 'movement_slug',
        ];

        $query = $request->query();
        $query = array_intersect_key(
            $query,
            array_flip($whitelist)
        );

        if (empty($query)) {
            $order_key = 'movement_name';
            $order_value = 'asc';
        } else {
            $order_key = array_keys($query)[0];
            $order_value = $query[array_keys($query)[0]];

            if (! in_array($query[array_keys($query)[0]], ['asc', 'desc'], true)) {
                $order_value = 'asc';
            }
        }

        return MovementResource::collection(
            Movement::orderBy($order_key, $order_value)->paginate(10)
        );
    }

    /**
     * Retrieve a specified art movements (artists, artworks).
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        Movement::findOrFail($uuid);

        return MovementResource::collection(
            Movement::where('uuid', $uuid)->get()
        );
    }

    /**
     * Retrieve artists for a specified art movements.
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function artists($uuid)
    {
        Movement::findOrFail($uuid);

        return ArtistMovementResource::collection(
            ArtistMovement::where('movement_uuid', $uuid)->paginate(10)
        );
    }

    /**
     * Retrieve artworks for a specified art movements.
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function artworks($uuid)
    {
        Movement::findOrFail($uuid);

        return ArtworkMovementResource::collection(
            ArtworkMovement::where('movement_uuid', $uuid)->paginate(10)
        );
    }
}
