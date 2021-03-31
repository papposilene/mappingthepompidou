<?php

namespace App\Http\Controllers\API;

use App\Models\Acquisition;
use App\Models\Artist;
use App\Models\Artwork;
use App\Models\Department;
use App\Models\Movement;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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

        $artworksExposed = Artwork::where('object_visibility', true)->count();
        $artworksStocked = Artwork::where('object_visibility', false)->count();

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
                    'total_visible' => $artworksExposed,
                    'total_invisible' => $artworksStocked,
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
                        'label' => 'Oeuvres par type d’acquisition',
                        'data' => $chartAcquisitions->pluck('acquired_artworks_count'),
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
                    'position' => 'top',
                    'text' => 'Nombre d’oeuvres par type d’acquisition',
                ],
                'responsive' => true,
                'legend' => [
                    'display' => false,
                    'position' => 'bottom',
                    'fontColor' => '#fff',
                ],
            ],
        ])->all();

        return $statistics;
    }

    /**
     * Retrieve statistics about departements for a specified acquisition type.
     *
     * @param  slug  $slug
     * @return \Illuminate\Http\Response
     */
    public function acquisitionsDepartments($slug)
    {
        $globalAcquisitions = Acquisition::withCount(['acquiredArtists', 'acquiredArtworks'])
            ->where('acquisition_slug', $slug)
            ->orderBy('acquired_artists_count', 'desc')->firstOrFail();

        $arrayDepartments = array();
        $globalDepartments = Department::all();
        $globalArtworks = Artwork::with(['acquiredBy', 'inDepartment'])->where('acquisition_uuid', $globalAcquisitions->uuid)->pluck('department_uuid');
        foreach($globalArtworks as $artworkDepartment) {
            $department = $globalDepartments->where('uuid', $artworkDepartment)->pluck('department_name')->first();
            if (!array_key_exists($department, $arrayDepartments)) {
                $arrayDepartments[$department] = 0;
            }
            (int) $arrayDepartments[$department]++;
        }
        arsort($arrayDepartments);

        $statistics = collect([
            'chart' => [
                'labels' => array_keys($arrayDepartments),
                'datasets' => [
                    [
                        'label' => 'Oeuvres par type d’acquisition',
                        'data' => array_values($arrayDepartments),
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
                    'position' => 'top',
                    'text' => 'Classement des départements pour ce type d’acquisition',
                ],
                'responsive' => true,
                'legend' => [
                    'display' => false,
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
                    'position' => 'top',
                    'text' => 'Oeuvres par département',
                ],
                'responsive' => true,
                'legend' => [
                    'display' => false,
                    'position' => 'bottom',
                    'fontColor' => '#fff',
                ],
            ],
        ])->all();

        return $statistics;
    }

    /**
     * Retrieve statistics about acquisitions.
     *
     * @return \Illuminate\Http\Response
     */
    public function exposed()
    {
        $artworksTotal = Artwork::count();
        $artworksExposed = Artwork::where('object_visibility', true)->count();
        $artworksStocked = Artwork::where('object_visibility', false)->count();

        $statistics = collect([
            'data' => [
                'total' => $artworksTotal,
                'total_visible' => $artworksExposed,
                'total_invisible' => $artworksStocked,
            ],
            'chart' => [
                'labels' => ['Oeuvres exposées', 'Oeuvres non exposées'],
                'datasets' => [
                    [
                        'label' => 'Oeuvres visibles/non exposées',
                        'data' => [
                            $artworksExposed,
                            $artworksStocked,
                        ],
                        'backgroundColor' => [
                            '#F87171',
                            '#60A5FA',
                        ],
                        'borderColor' => '#fff',
                    ],
                ],
            ],
            'options' => [
                'title' => [
                    'display' => true,
                    'fontColor' => '#fff',
                    'position' => 'top',
                    'text' => 'Proportion d’oeuvres visibles/non exposées',
                ],
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
                'men' => $genderMen,
                'women' => $genderWomen,
                'groups' => $genderGroups,
                'unknown' => $genderUnknown,
            ],
            'chart' => [
                'labels' => ['Men', 'Women', 'Groups', 'Genre inconnu'],
                'datasets' => [
                    [
                        'data' => [
                            $genderMen,
                            $genderWomen,
                            $genderGroups,
                            $genderUnknown,
                        ],
                        'backgroundColor' => [
                            '#60A5FA',
                            '#F87171',
                            '#A78BFA',
                            '#9CA3AF',
                        ],
                        'label' => 'Genres des artistes',
                    ],
                ],
            ],
            'options' => [
                'title' => [
                    'display' => true,
                    'fontColor' => '#fff',
                    'position' => 'top',
                    'text' => 'Genres des artistes conservés au Centre Pompidou',
                ],
                'responsive' => true,
                'legend' => [
                    'display' => false,
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
                    'position' => 'top',
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
        $chartAnonymous = Artist::where('artist_type', 'anonyme')->count();
        $chartArtistUnknown = Artist::where('artist_type', 'anonyme')->withCount('hasArtworks')->get();
        $chartArtworkNoDate = Artwork::where('object_date', null)->count();
        $departmentUnknown = Department::where('department_slug', 'inconnu')->first();
        $chartNoDepartment = Artwork::where('department_uuid', $departmentUnknown->uuid)->count();

        $chartTotalArtistUnknown = 0;
        foreach ($chartArtistUnknown as $noArtist) {
            $chartTotalArtistUnknown += (int) $noArtist->has_artworks_count;
        }

        $statistics = collect([
            'data' => [
                'artist_unknown' => $chartAnonymous,
                'artwork_artist_unknown' => $chartTotalArtistUnknown,
                'artwork_date_unknown' => $chartArtworkNoDate,
                'department_unknown' => $chartNoDepartment,
            ],
            'chart' => [
                'labels' => ['Auteur anonyme', 'Oeuvre sans auteur', 'Oeuvre sans date', 'Département inconnu'],
                'datasets' => [
                    [
                        'labels' => ['Auteur anonyme', 'Oeuvre sans auteur', 'Oeuvre sans date', 'Département inconnu'],
                        'data' => [
                            $chartAnonymous,
                            $chartTotalArtistUnknown,
                            $chartArtworkNoDate,
                            $chartNoDepartment,
                        ],
                        'backgroundColor' => [
                            '#F87171',
                            '#60A5FA',
                            '#A78BFA',
                            '#9CA3AF',
                        ],
                    ],
                ],
            ],
            'options' => [
                'title' => [
                    'display' => true,
                    'fontColor' => '#fff',
                    'position' => 'top',
                    'text' => 'Statistiques sur les oeuvres orphelines (auteur, datation, département)',
                ],
                'responsive' => true,
                'legend' => [
                    'display' => false,
                    'position' => 'bottom',
                    'fontColor' => '#fff',
                ],
            ],
        ])->all();

        return $statistics;
    }

}
