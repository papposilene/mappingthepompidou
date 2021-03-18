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
     * Retrieve statistics about acquisitions.
     *
     * @return \Illuminate\Http\Response
     */
    public function acquisitions()
    {
        $globalAcquisitions = Acquisition::all();
        $chartAcquisitions = Acquisition::withCount(['acquiredArtists', 'acquiredArtworks'])->orderBy('acquired_artists_count', 'desc')->limit(10)->get();

        $statistics = collect([
            'data' => [
                'total' => count($globalAcquisitions),
            ],
            'chart' => [
                'labels' => $chartAcquisitions->pluck('acquisition_name'),
                'datasets' => [
                    [
                        'label' => 'Artistes par type d’acquisition',
                        'data' => $chartAcquisitions->pluck('acquired_artists_count'),
                        'backgroundColor' => [
                            '#F87171',
                            '#FBBF24',
                            '#34D399',
                            '#60A5FA',
                            '#818CF8',
                            '#FCA5A5',
                            '#FCD34D',
                            '#6EE7B7',
                            '#93C5FD',
                            '#A5B4FC',
                        ],
                        'borderColor' => '#fff',
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
     * Retrieve statistics about art movements (artists, artworks).
     *
     * @return \Illuminate\Http\Response
     */
    public function movements()
    {
        $globalMovements = Movement::all();
        // Offset(1) to avoid unknown art movement
        $chartMovements = Movement::withCount(['hasArtworks', 'hasInspired'])->orderBy('has_artworks_count', 'desc')->limit(10)->offset(1)->get();

        $statistics = collect([
            'data' => [
                'total' => count($globalMovements),
            ],
            'chart' => [
                'labels' => $chartMovements->pluck('movement_name'),
                'datasets' => [
                    [
                        'label' => 'Oeuvre par mouvement',
                        'data' => $chartMovements->pluck('has_artworks_count'),
                        'backgroundColor' => '#F87171',
                        'borderColor' => '#fff',
                        //'barThickness' => 10,
                    ],
                    [
                        'label' => 'Artistes par mouvement',
                        'data' => $chartMovements->pluck('has_inspired_count'),
                        'backgroundColor' => '#60A5FA',
                        'borderColor' => '#fff',
                        //'barThickness' => 10,
                    ],
                ],
            ],
            'options' => [
                'title' => [
                    'display' => true,
                    'fontColor' => '#fff',
                    'position' => 'bottom',
                    'text' => 'Top 10 des mouvements artistisques (classés par le nombre d’oeuvres conservées)',
                ],
                'responsive' => true,
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'fontColor' => '#fff',
                ],
                'scales' => [
                    'xAxes' => [
                        [
                            //'id' => 'first-y-axis',
                            'type' => 'linear',
                            'ticks' => [
                                'beginAtZero' => false,
                            ],
                        ],
                    ],
                ],
            ],
        ])->all();

        return $statistics;
    }

}
