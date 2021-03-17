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
            'created_at', 'movement_name', 'movement_slug',
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

        return AcquisitionResource::collection(Acquisition::orderBy($order_key, $order_value)->paginate(20));
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
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        Acquisition::where('acquisition_slug', $slug)->firstOrFail();
        return AcquisitionResource::collection(Acquisition::where('acquisition_slug', $slug)->get());
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
