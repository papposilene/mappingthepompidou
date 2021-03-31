<?php

namespace App\Http\Controllers\API;

use App\Models\Artwork;
use App\Models\Department;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArtworkResource;
use App\Http\Resources\DepartmentResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

        if (Cache::has('_departments_data_withcounts')) {
            $departments_data = Cache::get('_departments_data_withcounts');
        } else {
            $departments_data = Department::withCount(
                [
                    'conservedArtists',
                    'conservedArtworks',
                ])->orderBy($order_key, $order_value)->get();
            Cache::put('_departments_data_withcounts', $departments_data);
        }

        return DepartmentResource::collection($departments_data->paginate(10));
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

        if (Cache::has('_artworks_data_for-' . $slug)) {
            $artworks_data = Cache::get('_artworks_data_for-' . $slug);
        } else {
            $artworks_data = Artwork::where('department_uuid', $department->uuid)->get();
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
        Department::where('department_slug', $slug)->firstOrFail();

        if (Cache::has('_departments_data_withcounts_for-' . $slug)) {
            $departments_data = Cache::get('_departments_data_withcounts_for-' . $slug);
        } else {
            $departments_data = Department::where('department_slug', $slug)->withCount(
                [
                    'conservedArtists',
                    'conservedArtworks',
                ])->get();
            Cache::put('_departments_data_withcounts_for-' . $slug, $departments_data);
        }

        return DepartmentResource::collection($departments_data);
    }

}
