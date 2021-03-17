<?php

namespace App\Http\Controllers\Api;

use App\Models\Acquisition;
use App\Models\Artist;
use App\Models\Artwork;
use App\Models\Movement;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acquisitions = Acquisition::all();
        $artists = Artist::all();
        $artworks = Artwork::all();
        $movements = Movement::all();

        $statistics = collect([
            'data' => [
                'artists' => [
                    'total' => count($artists),
                    'gender_women' => $artists->where('artist_gender', 'woman')->count(),
                    'gender_men' => $artists->where('artist_gender', 'man')->count(),
                    'gender_groups' => $artists->where('artist_gender', 'group')->count(),
                    'gender_unknown' => $artists->where('artist_gender', null)->count(),
                ],
                'artworks' => [
                    'total' => count($artworks),
                ],
                'movements' => [
                    'total' => count($movements),
                ],
                'acquisitions' => [
                    'total' => count($acquisitions),
                ]
            ]
        ])->all();

        return $statistics;
    }

    /**
     * Retrieve statistics about genders for the artists.
     *
     * @return \Illuminate\Http\Response
     */
    public function genders()
    {
        $artists = Artist::all();
        $genderWomen = $artists->where('artist_gender', 'woman')->count();
        $genderMen = $artists->where('artist_gender', 'man')->count();
        $genderGroups = $artists->where('artist_gender', 'group')->count();
        $genderUnknown = $artists->where('artist_gender', null)->count();

        $statistics = collect([
            'data' => [
                'total' => count($artists),
                'women' => $genderWomen,
                'men' => $genderMen,
                'groups' => $genderGroups,
                'unknown' => $genderUnknown,
            ],
            'chart' => [
                'labels' => ['Women', 'Men', 'Groups', 'Unknown'],
                'datasets' => [
                    [
                        'data' => [
                            $genderWomen,
                            $genderMen,
                            $genderGroups,
                            $genderUnknown,
                        ],
                        'backgroundColor' => [
                            '#F87171',
                            '#60A5FA',
                            '#A78BFA',
                            '#9CA3AF',
                        ],
                        'label' => 'Genres des artistes',
                    ],
                ],
            ],
            'options' => [
                'responsive' => true,
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'fontColor' => '#fff',
                ],
            ],
        ])->all();

        return $statistics;
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
        //
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
