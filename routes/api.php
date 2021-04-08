<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Delete this trick for production
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('1.1')->namespace('API')->group(function () {
    // Acquisitions
    Route::get('/acquisitions', 'AcquisitionController@index')->name('api.acquisition.index');
    Route::get('/acquisitions/show/{slug}', 'AcquisitionController@show')->name('api.acquisition.show');
    Route::get('/acquisitions/show/{slug}/artworks', 'AcquisitionController@artworks')->name('api.acquisition.artworks');
    // Artists
    Route::get('/artists', 'ArtistController@index')->name('api.artist.index');
    Route::get('/artists/gender/{gender}', 'ArtistController@gender')->name('api.artist.gender');

    Route::get('/artists/show/{uuid}', 'ArtistController@show')->name('api.artist.show');
    Route::get('/artists/show/{uuid}/artworks', 'ArtistController@artworks')->name('api.artist.artworks');
    // Artworks
    Route::get('/artworks', 'ArtworkController@index')->name('api.artwork.index');
    Route::get('/artworks/acquisition_date/{year}', 'ArtworkController@acquisition_date')->name('api.artwork.acquisition_date');
    Route::get('/artworks/acquisition_type/{slug}', 'ArtworkController@acquisition_type')->name('api.artwork.acquisition_type');
    Route::get('/artworks/exposed/{bool}', 'ArtworkController@exposed')->name('api.artwork.exposed');
    Route::get('/artworks/year/{year}', 'ArtworkController@year')->name('api.artwork.year');
    Route::get('/artworks/show/{uuid}', 'ArtworkController@show')->name('api.artwork.show');
    // Countries
    Route::get('/countries', 'CountryController@index')->name('api.country.index');
    Route::get('/countries/continent/{slug}/', 'CountryController@regions')->name('api.country.region');
    //Route::get('/countries/subregion/{slug}/', 'CountryController@subregions')->name('api.country.subregion');
    Route::get('/countries/show/{cca3}', 'CountryController@countries')->name('api.country.country');
    Route::get('/countries/show/{cca3}/artists', 'CountryController@artists')->name('api.country.artist');
    // Museum departements
    Route::get('/departments', 'DepartmentController@index')->name('api.department.index');
    Route::get('/departments/show/{slug}', 'DepartmentController@show')->name('api.department.show');
    Route::get('/departments/show/{slug}/artworks', 'DepartmentController@artworks')->name('api.department.artworks');
    // Artists' gender
    Route::get('/genders/show/{slug}/', 'GenderController@show')->name('api.gender.show');
    // Art movements
    Route::get('/movements', 'MovementController@index')->name('api.movement.index');
    Route::get('/movements/show/{slug}', 'MovementController@show')->name('api.movement.show');
    Route::get('/movements/show/{slug}/artists', 'MovementController@artists')->name('api.movement.artists');
    Route::get('/movements/show/{slug}/artworks', 'MovementController@artworks')->name('api.movement.artworks');
    // Statistics
    Route::get('/statistics', 'StatisticController@index')->name('api.statistic.index');
    Route::get('/statistics/acquisitions', 'StatisticController@acquisitions')->name('api.statistic.acquisitions');
    Route::get('/statistics/acquisitions/for-{slug}/departments', 'StatisticController@acquisitionsDepartments')->name('api.statistic.acquisitions.departments');
    Route::get('/statistics/artists/genders', 'StatisticController@genders')->name('api.statistic.artists.genders');
    Route::get('/statistics/artworks/exposed', 'StatisticController@exposed')->name('api.statistic.artworks.exposed');
    Route::get('/statistics/artworks/unknown', 'StatisticController@unknown')->name('api.statistic.artworks.unknown');
    Route::get('/statistics/departments', 'StatisticController@departments')->name('api.statistic.departments');
    Route::get('/statistics/countries', 'StatisticController@countries')->name('api.statistic.countries');
    Route::get('/statistics/movements', 'StatisticController@movements')->name('api.statistic.movement');
});
