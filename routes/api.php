<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('api')->namespace('Api')->group(function () {
    Route::get('/artists', 'ArtistController@index')->name('api.artist.index');
    Route::get('/artists/gender/{gender}', 'ArtistController@gender')->name('api.artist.gender');
    Route::get('/artists/nationality/{cca3}', 'ArtistController@nationality')->name('api.artist.nationality');
    Route::get('/artists/show/{uuid}', 'ArtistController@show')->name('api.artist.show');

    Route::get('/artworks', 'ArtworkController@index')->name('api.artwork.index');
    Route::get('/artworks/acquisition_date/{year}', 'ArtworkController@acquisition_date')->name('api.artwork.acquisition_date');
    Route::get('/artworks/acquisition_type/{slug}', 'ArtworkController@acquisition_type')->name('api.artwork.acquisition_type');
    Route::get('/artworks/exposed/{bool}', 'ArtworkController@exposed')->name('api.artwork.exposed');
    Route::get('/artworks/year/{year}', 'ArtworkController@year')->name('api.artwork.year');
    Route::get('/artworks/show/{uuid}', 'ArtworkController@show')->name('api.artwork.show');

    Route::get('/acquisitions', 'AcquisitionController@index')->name('api.acquisition.index');
    Route::get('/acquisitions/show/{slug}', 'AcquisitionController@show')->name('api.acquisition.show');
    Route::get('/acquisitions/show/{slug}/artworks', 'AcquisitionController@artworks')->name('api.acquisition.artworks');

    Route::get('/movements', 'MovementController@index')->name('api.movement.index');
    Route::get('/movements/show/{uuid}', 'MovementController@show')->name('api.movement.show');
    Route::get('/movements/show/{uuid}/artists', 'MovementController@artists')->name('api.movement.artists');
    Route::get('/movements/show/{uuid}/artworks', 'MovementController@artworks')->name('api.movement.artworks');


    Route::get('/statistics', 'StatisticController@index')->name('api.statistic.index');
    Route::get('/statistics/acquisitions', 'StatisticController@acquisitions')->name('api.statistic.acquisitions');
    Route::get('/statistics/artists/genders', 'StatisticController@genders')->name('api.statistic.genders');
    Route::get('/statistics/movements', 'StatisticController@movements')->name('api.statistic.movement');
});
