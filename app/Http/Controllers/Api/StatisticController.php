<?php

namespace App\Http\Controllers\Api;

use App\Models\Acquisition;
use App\Models\Artist;
use App\Models\Artwork;
use App\Models\Department;
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
        $acquisitions = Acquisition::count();
        $artists = Artist::all();
        $artworks = Artwork::count();
        $departments = Department::count();
        $movements = Movement::count();

        $statistics = collect([
            'data' => [
                'acquisitions' => [
                    'total' => $acquisitions,
                ],
                'artists' => [
                    'total' => count($artists),
                    'gender_women' => $artists->where('artist_gender', 'woman')->count(),
                    'gender_men' => $artists->where('artist_gender', 'man')->count(),
                    'gender_groups' => $artists->where('artist_gender', 'group')->count(),
                    'gender_unknown' => $artists->where('artist_gender', null)->count(),
                ],
                'artworks' => [
                    'total' => $artworks,
                ],
                'departments' => [
                    'total' => $departments,
                ],
                'movements' => [
                    'total' => $movements,
                ],

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
     * Retrieve statistics about departments.
     *
     * @return \Illuminate\Http\Response
     */
    public function departments()
    {
        $globalDepartments = Department::all();
        $chartDepartments = Department::withCount(['conservedArtworks'])->orderBy('conserved_artworks_count', 'desc')->limit(10)->get();

        $statistics = collect([
            'data' => [
                'total' => count($globalDepartments),
            ],
            'chart' => [
                'labels' => $chartDepartments->pluck('department_name'),
                'datasets' => [
                    [
                        'label' => 'Oeuvre par département',
                        'data' => $chartDepartments->pluck('conserved_artworks_count'),
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
                'title' => [
                    'display' => true,
                    'fontColor' => '#fff',
                    'position' => 'bottom',
                    'text' => 'Top 10 des départements (classés par le nombre d’oeuvres conservées)',
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
        $globalMovements = Movement::count();
        // Offset(1) to avoid unknown art movement
        $chartMovements = Movement::withCount(['hasArtworks', 'hasInspired'])->orderBy('has_artworks_count', 'desc')->limit(10)->offset(1)->get();

        $statistics = collect([
            'data' => [
                'total' => $globalMovements,
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

    /**
     * Retrieve statistics about artworks without information (department, date of creation, etc.).
     *
     * @return \Illuminate\Http\Response
     */
    public function unknown()
    {
        $globalArtworks = Artwork::count();
        //$chartAnonymous = Artist::where('artist_type', 'anonyme')->get();
        $chartNoArtist = Artist::withCount('hasArtworks')->where('artist_type', 'anonyme')->get();
        dd($chartNoArtist->count());
        $chartNoDate = Artwork::where('object_date', null)->count();
        $chartNoDepartment = Artwork::with('inDepartement')->where('department_name', 'Inconnu')->count();

        $statistics = collect([
            'data' => [
                'total' => $globalArtworks,
            ],
            'chart' => [
                'labels' => 'test',
                'datasets' => [
                    [
                        'label' => 'Oeuvre sans auteur',
                        'data' => $chartNoArtist,
                        'backgroundColor' => '#60A5FA',
                        'borderColor' => '#fff',
                        //'barThickness' => 10,
                    ],
                    [
                        'label' => 'Oeuvre sans date',
                        'data' => $chartNoDate,
                        'backgroundColor' => '#60A5FA',
                        'borderColor' => '#fff',
                        //'barThickness' => 10,
                    ],
                    [
                        'label' => 'Oeuvre dans un département inconnu',
                        'data' => $chartNoDepartment,
                        'backgroundColor' => '#F87171',
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
