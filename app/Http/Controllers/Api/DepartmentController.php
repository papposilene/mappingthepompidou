<?php

namespace App\Http\Controllers\Api;

use App\Models\Artwork;
use App\Models\Department;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArtworkResource;
use App\Http\Resources\DepartmentResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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
            'created_at', 'conserved_artworks_count',
            'department_name', 'department_slug',
        ];

        $query = $request->query();
        $query = array_intersect_key(
            $query,
            array_flip($whitelist)
        );

        if (empty($query)) {
            $order_key = 'conserved_artworks_count';
            $order_value = 'desc';
        } else {
            $order_key = array_keys($query)[0];
            $order_value = $query[array_keys($query)[0]];

            if (! in_array($query[array_keys($query)[0]], ['asc', 'desc'], true)) {
                $order_value = 'asc';
            }
        }

        return DepartmentResource::collection(Department::withCount(
            [
                'conservedArtworks',
            ])->orderBy($order_key, $order_value)->paginate(10));
    }

    /**
     * Retrieve artworks for a specified art movements.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function artworks($slug)
    {
        $department = Department::where('department_slug', $slug)->firstOrFail();
        return ArtworkResource::collection(Artwork::where('department_uuid', $department->uuid)->orderBy('object_date', 'desc')->paginate(10));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        Department::where('department_slug', $slug)->firstOrFail();
        return DepartmentResource::collection(Department::where('department_slug', $slug)->withCount(
            [
                'conservedArtists',
                'conservedArtworks',
            ])->get());
    }

}
