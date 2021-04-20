<?php

namespace App\Http\Controllers\API;

use App\Models\Acquisition;
use App\Models\Artist;
use App\Models\Artwork;
use App\Models\Country;
use App\Models\Department;
use App\Models\Movement;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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
        $cache_key = '_api_statistics_index';

        if (Cache::has($cache_key)) {
            $statistics = Cache::get($cache_key);
        } else {
            if (Cache::has('_acquisitions_count')) {
                $acquisitions_count = Cache::get('_acquisitions_count');
            } else {
                $acquisitions_count = Acquisition::count();
                Cache::put('_acquisitions_count', $acquisitions_count);
            }

            if (Cache::has('_artists_count')) {
                $artists_count = Cache::get('_artists_count');
            } else {
                $artists_count = Artist::count();
                Cache::put('_artists_count', $artists_count);
            }

            if (Cache::has('_artworks_count')) {
                $artworks_count = Cache::get('_artworks_count');
            } else {
                $artworks_count = Artwork::count();
                Cache::put('_artworks_count', $artworks_count);
            }

            if (Cache::has('_departments_count')) {
                $departments_count = Cache::get('_departments_count');
            } else {
                $departments_count = Department::count();
                Cache::put('_departments_count', $departments_count);
            }

            if (Cache::has('_movements_count')) {
                $movements_count = Cache::get('_movements_count');
            } else {
                $movements_count = Movement::count();
                Cache::put('_movements_count', $movements_count);
            }

            if (Cache::has('_artists_gender_woman_count')) {
                $artists_genderWomen = Cache::get('_artists_gender_woman_count');
            } else {
                $artists_genderWomen = Artist::where('artist_gender', 'woman')->count();
                Cache::put('_artists_gender_woman_count', $artists_genderWomen);
            }

            if (Cache::has('_artists_gender_man_count')) {
                $artists_genderMen = Cache::get('_artists_gender_man_count');
            } else {
                $artists_genderMen = Artist::where('artist_gender', 'man')->count();
                Cache::put('_artists_gender_man_count', $artists_genderMen);
            }

            if (Cache::has('_artists_gender_group_count')) {
                $artists_genderGroups = Cache::get('_artists_gender_group_count');
            } else {
                $artists_genderGroups = Artist::where('artist_gender', 'group')->count();
                Cache::put('_artists_gender_group_count', $artists_genderGroups);
            }

            if (Cache::has('_artists_gender_unknown_count')) {
                $artists_genderUnknown = Cache::get('_artists_gender_unknown_count');
            } else {
                $artists_genderUnknown = Artist::where('artist_gender', null)->count();
                Cache::put('_artists_gender_unknown_count', $artists_genderUnknown);
            }

            if (Cache::has('_artworks_exposed')) {
                $artworksExposed_count = Cache::get('_artworks_exposed');
            } else {
                $artworksExposed_count = Artwork::where('object_visibility', true)->count();
                Cache::put('_artworks_exposed', $artworksExposed_count);
            }

            if (Cache::has('_artworks_stocked')) {
                $artworksStocked_count = Cache::get('_artworks_stocked');
            } else {
                $artworksStocked_count = Artwork::where('object_visibility', false)->count();
                Cache::put('_artworks_stocked', $artworksStocked_count);
            }

            $statistics = collect([
                'data' => [
                    'acquisitions' => [
                        'total' => $acquisitions_count,
                    ],
                    'artists' => [
                        'total' => $artists_count,
                        'gender_women' => $artists_genderWomen,
                        'gender_men' => $artists_genderMen,
                        'gender_groups' => $artists_genderGroups,
                        'gender_unknown' => $artists_genderUnknown,
                    ],
                    'artworks' => [
                        'total' => $artworks_count,
                        'total_visible' => $artworksExposed_count,
                        'total_invisible' => $artworksStocked_count,
                    ],
                    'departments' => [
                        'total' => $departments_count,
                    ],
                    'movements' => [
                        'total' => $movements_count,
                    ],

                ]
            ])->all();

            Cache::put($cache_key, $statistics);
        }

        return $statistics;
    }

    /**
     * Retrieve statistics about acquisitions.
     *
     * @return \Illuminate\Http\Response
     */
    public function acquisitions()
    {
        $cache_key = '_api_statistics_acquisitions';

        if (Cache::has($cache_key)) {
            $statistics = Cache::get($cache_key);
        } else {
            if (Cache::has('_acquisitions_count')) {
                $acquisitions_count = Cache::get('_acquisitions_count');
            } else {
                $acquisitions_count = Acquisition::count();
                Cache::put('_acquisitions_count', $acquisitions_count);
            }

            if (Cache::has('_acquisitions_chart_top10')) {
                $chartAcquisitions = Cache::get('_acquisitions_chart_top10');
            } else {
                $chartAcquisitions = Acquisition::withCount(['acquiredArtists', 'acquiredArtworks'])->orderBy('acquired_artists_count', 'desc')->limit(10)->get();
                Cache::put('_acquisitions_chart_top10', $chartAcquisitions);
            }

            $statistics = collect([
                'data' => [
                    'total' => $acquisitions_count,
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
                            'borderColor' => '#000',
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
        }

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
        $cache_key = '_api_statistics_acquisitions_for-' . $slug;

        if (Cache::has($cache_key)) {
            $statistics = Cache::get($cache_key);
        } else {
            if (Cache::has('_departments_data')) {
                $departments_data = Cache::get('_departments_data');
            } else {
                $departments_data = Department::withCount(['conservedArtworks'])->get();
                Cache::put('_departments_data', $departments_data);
            }

            if (Cache::has('_acquisitions_chart_top10_for-' . $slug)) {
                $acquisitions_data_for = Cache::get('_acquisitions_chart_top10_for-' . $slug);
            } else {
                $acquisitions_data_for = Acquisition::withCount('acquiredArtworks')
                    ->where('acquisition_slug', $slug)
                    ->orderBy('acquired_artworks_count', 'desc')->firstOrFail();
                Cache::put('_acquisitions_chart_top10_for-' . $slug, $acquisitions_data_for);
            }

            $arrayDepartments = array();
            $globalArtworks = Artwork::with(['acquiredBy', 'inDepartment'])->where('acquisition_uuid', $acquisitions_data_for->uuid)->pluck('department_uuid');
            foreach($globalArtworks as $artworkDepartment) {
                $department = $departments_data->where('uuid', $artworkDepartment)->pluck('department_name')->first();
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
                            'borderColor' => '#000',
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
        }

        return $statistics;
    }

    /**
     * Retrieve statistics about departments.
     *
     * @return \Illuminate\Http\Response
     */
    public function departments()
    {
        $cache_key = 'api_statistics_departments';

        if (Cache::has($cache_key)) {
            $statistics = Cache::get($cache_key);
        } else {
            if (Cache::has('_departments_count')) {
                $departments_count = Cache::get('_departments_count');
            } else {
                $departments_count = Department::count();
                Cache::put('_departments_count', $departments_count);
            }

            if (Cache::has('_departments_data')) {
                $departments_data = Cache::get('_departments_data');
            } else {
                $departments_data = Department::withCount(['conservedArtists', 'conservedArtworks'])
                    ->orderBy('conserved_artworks_count', 'desc')->get();
                Cache::put('_departments_data', $departments_data);
            }

            $statistics = collect([
                'data' => [
                    'total' => $departments_count,
                ],
                'chart' => [
                    'labels' => $departments_data->pluck('department_name'),
                    'datasets' => [
                        [
                            'label' => 'Oeuvre par département',
                            'data' => $departments_data->pluck('conserved_artworks_count'),
                            'backgroundColor' => [
                                '#F87171',
                                '#FBBF24',
                                '#34D399',
                                '#60A5FA',
                                '#818CF8',
                                '#FCA5A5',
                                '#FCD34D',
                                '#6EE7B7',
                            ],
                            'borderColor' => '#000',
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
        }

        return $statistics;
    }

    /**
     * Retrieve statistics about acquisitions.
     *
     * @return \Illuminate\Http\Response
     */
    public function exposed()
    {
        $cache_key = 'api_statistics_exposed';

        if (Cache::has($cache_key)) {
            $statistics = Cache::get($cache_key);
        } else {
            if (Cache::has('_artworks_count')) {
                $artworks_count = Cache::get('_artworks_count');
            } else {
                $artworks_count = Artwork::count();
                Cache::put('_artworks_count', $artworks_count);
            }

            if (Cache::has('_artworks_exposed')) {
                $artworksExposed_count = Cache::get('_artworks_exposed');
            } else {
                $artworksExposed_count = Artwork::where('object_visibility', true)->count();
                Cache::put('_artworks_exposed', $artworksExposed_count);
            }

            if (Cache::has('_artworks_stocked')) {
                $artworksStocked_count = Cache::get('_artworks_stocked');
            } else {
                $artworksStocked_count = Artwork::where('object_visibility', false)->count();
                Cache::put('_artworks_stocked', $artworksStocked_count);
            }

            $statistics = collect([
                'data' => [
                    'total' => $artworks_count,
                    'total_visible' => $artworksExposed_count,
                    'total_invisible' => $artworksStocked_count,
                ],
                'chart' => [
                    'labels' => ['Oeuvres exposées', 'Oeuvres non exposées'],
                    'datasets' => [
                        [
                            'label' => 'Oeuvres visibles/non exposées',
                            'data' => [
                                $artworksExposed_count,
                                $artworksStocked_count,
                            ],
                            'backgroundColor' => [
                                '#F87171',
                                '#60A5FA',
                            ],
                            'borderColor' => '#000',
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
        }

        return $statistics;
    }

    /**
     * Retrieve statistics about birth year for the artists.
     *
     * @return \Illuminate\Http\Response
     */
    public function birthyears()
    {
        $cache_key = 'api_statistics_birthyears';

        if (Cache::has($cache_key)) {
            $statistics = Cache::get($cache_key);
        } else {
            if (Cache::has('_artists_count')) {
                $artists_count = Cache::get('_artists_count');
            } else {
                $artists_count = Artist::count();
                Cache::put('_artists_count', $artists_count);
            }

            $yearsData = Artist::whereNotNull('artist_birth')
                ->select(DB::raw('SUM(artist_gender = \'man\') as count_men, SUM(artist_gender = \'woman\') as count_women, count(*) as count_total, artist_birth'))
                ->groupBy('artist_birth')
                ->orderBy('artist_birth', 'asc')
                ->get();

            $chartData = [];
            $yearsData->each(function ($artist_count) use (&$chartData) {
                $chartData[$artist_count['artist_birth']]['total'] = (int) $artist_count['count_total'];
                $chartData[$artist_count['artist_birth']]['men'] = (int) $artist_count['count_men'];
                $chartData[$artist_count['artist_birth']]['women'] = (int) $artist_count['count_women'];
            });

            $statistics = collect([
                'data' => [
                    'total' => $artists_count,
                ],
                'chart' => [
                    'labels' => array_keys($chartData),
                    'datasets' => [
                        [
                            'data' => data_get($chartData, '*.men'),
                            'label' => 'Artistes de genre masculin',
                            'borderColor' => '#60A5FA',
                            'fill' => true,
                        ],
                        [
                            'data' => data_get($chartData, '*.women'),
                            'label' => 'Artistes de genre féminin',
                            'borderColor' => '#F87171',
                            'fill' => true,
                        ],
                    ],
                ],
                'options' => [
                    'title' => [
                        'display' => true,
                        'fontColor' => '#fff',
                        'position' => 'top',
                        'text' => 'Répartition par genres (personnes physiques) des dates de naissance des artistes du Centre Pompidou',
                    ],
                    'responsive' => true,
                    'legend' => [
                        'display' => false,
                        'position' => 'bottom',
                        'fontColor' => '#fff',
                    ],
                    /*'scales' => [
                        'x' => [
                            'stacked' => true,
                        ],
                        'y' => [
                            'stacked' => true,
                        ],
                    ],*/
                ],
            ])->all();
        }

        return $statistics;
    }

    /**
     * Retrieve statistics about genders for the artists.
     *
     * @return \Illuminate\Http\Response
     */
    public function genders()
    {
        $cache_key = 'api_statistics_genders';

        if (Cache::has($cache_key)) {
            $statistics = Cache::get($cache_key);
        } else {
            if (Cache::has('_artists_count')) {
                $artists_count = Cache::get('_artists_count');
            } else {
                $artists_count = Artist::count();
                Cache::put('_artists_count', $artists_count);
            }

            if (Cache::has('_artists_gender_woman_count')) {
                $artists_genderWomen = Cache::get('_artists_gender_woman_count');
            } else {
                $artists_genderWomen = Artist::where('artist_gender', 'woman')->count();
                Cache::put('_artists_gender_woman_count', $artists_genderWomen);
            }

            if (Cache::has('_artists_gender_man_count')) {
                $artists_genderMen = Cache::get('_artists_gender_man_count');
            } else {
                $artists_genderMen = Artist::where('artist_gender', 'man')->count();
                Cache::put('_artists_gender_man_count', $artists_genderMen);
            }

            if (Cache::has('_artists_gender_group_count')) {
                $artists_genderGroups = Cache::get('_artists_gender_group_count');
            } else {
                $artists_genderGroups = Artist::where('artist_gender', 'group')->count();
                Cache::put('_artists_gender_group_count', $artists_genderGroups);
            }

            if (Cache::has('_artists_gender_unknown_count')) {
                $artists_genderUnknown = Cache::get('_artists_gender_unknown_count');
            } else {
                $artists_genderUnknown = Artist::where('artist_gender', null)->count();
                Cache::put('_artists_gender_unknown_count', $artists_genderUnknown);
            }

            $statistics = collect([
                'data' => [
                    'total' => $artists_count,
                    'men' => $artists_genderMen,
                    'women' => $artists_genderWomen,
                    'groups' => $artists_genderGroups,
                    'unknown' => $artists_genderUnknown,
                ],
                'chart' => [
                    'labels' => ['Men', 'Women', 'Groups', 'Genre inconnu'],
                    'datasets' => [
                        [
                            'data' => [
                                $artists_genderMen,
                                $artists_genderWomen,
                                $artists_genderGroups,
                                $artists_genderUnknown,
                            ],
                            'backgroundColor' => [
                                '#60A5FA',
                                '#F87171',
                                '#A78BFA',
                                '#9CA3AF',
                            ],
                            'label' => 'Genres des artistes',
                            'borderColor' => '#000',
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
        }

        return $statistics;
    }

    /**
     * Retrieve statistics about art movements (artists, artworks).
     *
     * @return \Illuminate\Http\Response
     */
    public function movements()
    {
        $cache_key = 'api_statistics_movements';

        if (Cache::has($cache_key)) {
            $statistics = Cache::get($cache_key);
        } else {
            if (Cache::has('_movements_count')) {
                $movements_count = Cache::get('_movements_count');
            } else {
                $movements_count = Movement::count();
                Cache::put('_movements_count', $movements_count);
            }

            if (Cache::has('_movements_data')) {
                $movements_data = Cache::get('_movements_data');
            } else {
                $movements_data = Movement::withCount(['hasArtworks', 'hasInspired'])->orderBy('has_artworks_count', 'desc')->get();
                Cache::put('_movements_data', $movements_data);
            }

            $data = $movements_data->splice(1, 10);
            $statistics = collect([
                'data' => [
                    'total' => $movements_count,
                ],
                'chart' => [
                    'labels' => $data->pluck('movement_name'),
                    'datasets' => [
                        [
                            'label' => 'Oeuvre par mouvement',
                            'data' => $data->pluck('has_artworks_count'),
                            'backgroundColor' => '#F87171',
                            'borderColor' => '#000',
                        ],
                        [
                            'label' => 'Artistes par mouvement',
                            'data' => $data->pluck('has_inspired_count'),
                            'backgroundColor' => '#60A5FA',
                            'borderColor' => '#000',
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
        }

        return $statistics;
    }

    /**
     * Retrieve statistics about countries.
     *
     * @return \Illuminate\Http\Response
     */
    public function countries()
    {
        $cache_key = 'api_statistics_countries';

        if (Cache::has($cache_key)) {
            $statistics = Cache::get($cache_key);
        } else {
            if (Cache::has('_countries_count')) {
                $countries_count = Cache::get('_countries_count');
            } else {
                $countries_count = Country::count();
                Cache::put('_countries_count', $countries_count);
            }

            if (Cache::has('_countries_data')) {
                $countries_data = Cache::get('_countries_data');
            } else {
                $countries_data = Country::withCount('hasArtists')->orderBy('has_artists_count', 'desc')->get();
                Cache::put('_countries_data', $countries_data);
            }

            $data = $countries_data->splice(0, 10);
            $statistics = collect([
                'data' => [
                    'total' => $countries_count,
                ],
                'chart' => [
                    'labels' => $data->pluck('name_common_fra'),
                    'datasets' => [
                        [
                            'label' => 'Artistes par nationalité',
                            'data' => $data->pluck('has_artists_count'),
                            'backgroundColor' => '#9CA3AF',
                            'borderColor' => '#000',
                        ],
                    ],
                ],
                'options' => [
                    'title' => [
                        'display' => true,
                        'fontColor' => '#fff',
                        'position' => 'top',
                        'text' => 'Top 10 des nationalités (classés par le nombre d’artistes)',
                    ],
                    'responsive' => true,
                    'legend' => [
                        'display' => true,
                        'position' => 'bottom',
                        'fontColor' => '#fff',
                    ],
                    'scales' => [
                        'yAxes' => [
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
        }

        return $statistics;
    }

    /**
     * Retrieve statistics about artworks without information (department, date of creation, etc.).
     *
     * @return \Illuminate\Http\Response
     */
    public function unknown()
    {
        $cache_key = '_api_statistics_unknwon';

        if (Cache::has($cache_key)) {
            $statistics = Cache::get($cache_key);
        } else {
            if (Cache::has('_statistics_artworks_noauthor')) {
                $statistics_artworks_noauthor = Cache::get('_statistics_artworks_noauthor');
            } else {
                $statistics_artworks_noauthor = Artist::where('artist_type', 'anonyme')->withCount('hasArtworks')->get();
                Cache::put('_statistics_artworks_noauthor', $statistics_artworks_noauthor);
            }

            if (Cache::has('_statistics_artworks_nodate')) {
                $statistics_artworks_nodate = Cache::get('_statistics_artworks_nodate');
            } else {
                $statistics_artworks_nodate = Artwork::where('object_date', null)->count();
                Cache::put('_statistics_artworks_nodate', $statistics_artworks_nodate);
            }

            if (Cache::has('_statistics_artworks_nodepartment')) {
                $statistics_artworks_nodepartment = Cache::get('_statistics_artworks_nodepartment');
            } else {
                $departmentUnknown = Department::where('department_slug', 'inconnu')->first();
                $statistics_artworks_nodepartment = Artwork::where('department_uuid', $departmentUnknown->uuid)->count();
                Cache::put('_statistics_artworks_nodepartment', $statistics_artworks_nodepartment);
            }

            $chartTotalArtistUnknown = 0;
            foreach ($statistics_artworks_noauthor as $noArtist) {
                $chartTotalArtistUnknown += (int) $noArtist->has_artworks_count;
            }

            $statistics = collect([
                'data' => [
                    'artwork_artist_unknown' => $chartTotalArtistUnknown,
                    'artwork_date_unknown' => $statistics_artworks_nodate,
                    'department_unknown' => $statistics_artworks_nodepartment,
                ],
                'chart' => [
                    'labels' => ['Oeuvre sans auteur', 'Oeuvre sans date', 'Département inconnu'],
                    'datasets' => [
                        [
                            'labels' => ['Oeuvre sans auteur', 'Oeuvre sans date', 'Département inconnu'],
                            'data' => [
                                $chartTotalArtistUnknown,
                                $statistics_artworks_nodate,
                                $statistics_artworks_nodepartment,
                            ],
                            'backgroundColor' => [
                                '#F87171',
                                '#60A5FA',
                                '#A78BFA',
                            ],
                            'borderColor' => '#000',
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
        }

        return $statistics;
    }

}
